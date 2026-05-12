<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Labour;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Exports\AttendanceExport;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-attendance', only: ['index']),
            new Middleware('permission:manage-attendance', only: ['create', 'store', 'bulkDelete']),
        ];
    }

    public function index(Request $request)
    {
        $query = Attendance::with(['labour', 'project', 'recorder']);

        if ($request->date) {
            $query->where('date', $request->date);
        }

        if ($request->start_date) {
            $query->where('date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->where('date', '<=', $request->end_date);
        }

        if ($request->month) {
            $query->whereMonth('date', $request->month);
        }

        if ($request->year) {
            $query->whereYear('date', $request->year);
        }

        if ($request->shift) {
            $query->where('shift', $request->shift);
        }

        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        $attendances = $query->orderBy('date', 'desc')
            ->orderBy('shift', 'asc')
            ->paginate(50);

        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }

        return view('attendance.index', compact('attendances', 'projects'));
    }

    public function create(Request $request)
    {
        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }

        $selectedProjectId = $request->project_id;
        $date = $request->date ?? date('Y-m-d');
        $shift = $request->shift ?? '1st Shift';

        $labours = Labour::all();

        // Get existing attendance for this project, date and shift
        $existingAttendance = [];
        if ($selectedProjectId) {
            $existingAttendance = Attendance::where('project_id', $selectedProjectId)
                ->where('date', $date)
                ->where('shift', $shift)
                ->get()
                ->keyBy('labour_id');
        }

        $isSupervisor = auth()->user()->role === 'site_supervisor';
        $isToday = $date === date('Y-m-d');

        return view('attendance.create', compact('projects', 'labours', 'selectedProjectId', 'date', 'shift', 'existingAttendance', 'isSupervisor', 'isToday'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'date' => 'required|date',
                'shift' => 'required|string',
                'attendance' => 'required|array',
                'attendance.*' => 'required|in:present,absent',
                'overtime_hours' => 'nullable|array',
                'overtime_hours.*' => 'nullable|numeric|min:0',
                'payment_amount' => 'nullable|array',
                'payment_amount.*' => 'nullable|numeric|min:0',
                'remark' => 'nullable|array',
                'remark.*' => 'nullable|string|max:255',
            ]);

            $isSupervisor = auth()->user()->role === 'site_supervisor';
            $isToday = $request->date === now()->format('Y-m-d');

            foreach ($request->attendance as $labourId => $status) {
                $overtime = $request->overtime_hours[$labourId] ?? 0;
                $payment = $request->payment_amount[$labourId] ?? 0;
                $remark = $request->remark[$labourId] ?? null;

                // Check for existing attendance to see if payment is being modified for a previous day
                $existing = Attendance::where([
                    'project_id' => $request->project_id,
                    'labour_id' => $labourId,
                    'date' => $request->date,
                    'shift' => $request->shift,
                ])->first();

                $updateData = [
                    'status' => $status,
                    'overtime_hours' => $overtime,
                    'remark' => $remark,
                    'recorded_by' => auth()->id(),
                    'recorded_at' => now(),
                ];

                // Only allow supervisor to set/modify payment if it's today
                // If it's not today and they are a supervisor, we keep the existing payment or set it to 0 if new
                if ($isSupervisor && !$isToday) {
                    if ($existing) {
                        // Keep existing payment_amount, don't update it from request
                        $updateData['payment_amount'] = $existing->payment_amount;
                    } else {
                        // For new records on previous days, payment must be 0 for supervisors
                        $updateData['payment_amount'] = 0;
                    }
                } else {
                    // Admin or today: allow payment update
                    $updateData['payment_amount'] = $payment;
                }

                Attendance::updateOrCreate(
                    [
                        'project_id' => $request->project_id,
                        'labour_id' => $labourId,
                        'date' => $request->date,
                        'shift' => $request->shift,
                    ],
                    $updateData
                );
            }

            return redirect()->route('attendance.create', [
                'project_id' => $request->project_id,
                'date' => $request->date,
                'shift' => $request->shift,
            ])->with('success', 'Attendance recorded successfully.');
        } catch (\Exception $e) {
            \Log::error('Attendance Save Error: '.$e->getMessage());

            return redirect()->route('attendance.create', [
                'project_id' => $request->project_id,
                'date' => $request->date,
                'shift' => $request->shift,
            ])->withErrors(['error' => 'Failed to save attendance: '.$e->getMessage()])->withInput();
        }
    }

    public function export(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $projectId = $request->project_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $fileName = 'attendance_';
        if ($startDate && $endDate) {
            $fileName .= $startDate . '_to_' . $endDate;
        } elseif ($year && $month) {
            $fileName .= $year . '_' . $month;
        } else {
            $fileName .= now()->format('Y_m');
        }
        $fileName .= '.xlsx';

        return Excel::download(new AttendanceExport($month, $year, $projectId, $startDate, $endDate), $fileName);
    }

    public function import(Request $request)
    {
        // Increase execution time for large imports
        ini_set('max_execution_time', 300); // 5 minutes

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'import_type' => 'required|in:all,day,week,month',
            'import_date' => 'nullable|required_if:import_type,day|date',
            'import_week' => 'nullable|required_if:import_type,week|string',
            'import_month' => 'nullable|required_if:import_type,month|integer|between:1,12',
            'import_year' => 'nullable|required_if:import_type,month|integer',
        ]);

        if (!class_exists('ZipArchive') && in_array($request->file('file')->getClientOriginalExtension(), ['xlsx', 'xls'])) {
            return redirect()->back()->with('error', 'Excel import is currently unavailable because the PHP "zip" extension is not enabled on this server. Please use a CSV file or contact your administrator.')->withInput();
        }

        try {
            $constraints = [
                'type' => $request->import_type,
                'date' => $request->import_date,
                'week' => $request->import_week,
                'month' => $request->import_month,
                'year' => $request->import_year,
            ];

            Excel::import(new AttendanceImport($constraints), $request->file('file'));

            return redirect()->back()->with('success', 'Attendance imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error during import: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        \Log::info('Bulk Delete Request:', $request->all());
        
        $request->validate([
            'type' => 'required|in:day,week,month',
            'date' => 'nullable|required_if:type,day|date',
            'week' => 'nullable|required_if:type,week|string', // Format: YYYY-Www
            'month' => 'nullable|required_if:type,month|integer|between:1,12',
            'year' => 'nullable|required_if:type,month|integer',
            'project_id' => 'nullable|exists:projects,id',
        ]);

        $query = Attendance::query();

        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->type == 'day') {
            $query->whereDate('date', $request->date);
        } elseif ($request->type == 'week') {
            $weekParts = explode('-W', $request->week);
            if (count($weekParts) == 2) {
                $year = $weekParts[0];
                $week = $weekParts[1];
                // YEARWEEK(date, 1) returns YYYYWW where week starts on Monday
                $query->whereRaw('YEARWEEK(date, 1) = ?', [$year . sprintf('%02d', $week)]);
            }
        } elseif ($request->type == 'month') {
            $query->whereMonth('date', $request->month)
                  ->whereYear('date', $request->year);
        }

        $count = $query->count();
        \Log::info('Bulk Delete Count: ' . $count);
        
        if ($count == 0) {
            return redirect()->back()->with('error', 'No attendance records found for the selected criteria.')->withInput();
        }

        // Use whereIn with IDs to ensure deletion works correctly across all drivers
        $ids = $query->pluck('id');
        Attendance::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', $count . ' attendance records deleted successfully.');
    }
}
