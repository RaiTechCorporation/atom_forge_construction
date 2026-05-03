<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabourRequest;
use App\Http\Requests\UpdateLabourRequest;
use App\Models\Attendance;
use App\Models\Labour;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LabourController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-employees', only: ['index', 'show', 'dashboard', 'downloadReport']),
            new Middleware('permission:create-employees', only: ['create', 'store']),
            new Middleware('permission:edit-employees', only: ['edit', 'update']),
            new Middleware('permission:delete-employees', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labours = Labour::with('attendances')->latest()->paginate(15);

        return view('labour.index', compact('labours'));
    }

    public function dashboard(Request $request)
    {
        $projectId = $request->project_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Base queries
        $labourQuery = Labour::query();
        $attendanceQuery = Attendance::query();

        if ($projectId) {
            // Workers who are either assigned to this project OR have attendance records for this project
            $labourQuery->where(function ($q) use ($projectId) {
                $q->where('project_id', $projectId)
                    ->orWhereHas('attendances', function ($aq) use ($projectId) {
                        $aq->where('project_id', $projectId);
                    });
            });
            $attendanceQuery->where('project_id', $projectId);
        }

        if ($startDate) {
            $attendanceQuery->where('date', '>=', $startDate);
        }
        if ($endDate) {
            $attendanceQuery->where('date', '<=', $endDate);
        }

        $totalWorkers = $labourQuery->count();
        $activeWorkers = (clone $labourQuery)->where('status', 'Active')->count();

        // Define $labours here so it's available for both financials and work records
        $labours = $labourQuery->get();

        $todayAttendance = Attendance::where('date', now()->format('Y-m-d'))
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->where('status', 'present')
            ->count();

        // Monthly attendance should always be for the current month but respect project filter
        $monthlyAttendance = Attendance::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->where('status', 'present')
            ->count();

        // Financials
        if ($startDate || $endDate || $projectId) {
            // Join with labour to get wage_rate
            $financialAttendanceQuery = Attendance::query()
                ->join('labour', 'attendance.labour_id', '=', 'labour.id')
                ->where('attendance.status', 'present');

            if ($projectId) {
                $financialAttendanceQuery->where('attendance.project_id', $projectId);
            }
            if ($startDate) {
                $financialAttendanceQuery->where('attendance.date', '>=', $startDate);
            }
            if ($endDate) {
                $financialAttendanceQuery->where('attendance.date', '<=', $endDate);
            }

            $attendances = $financialAttendanceQuery
                ->select('attendance.*', 'labour.wage_rate')
                ->get();

            $totalEarned = 0;
            $totalPaid = 0;

            foreach ($attendances as $att) {
                $wage = $att->wage_rate ?? 0;
                if (in_array($att->shift, ['1st Shift', '2nd Shift'])) {
                    $totalEarned += (0.5 * $wage);
                }
                $totalEarned += ($att->overtime_hours * ($wage / 8));
                $totalPaid += $att->payment_amount;
            }
            $totalBalance = $totalEarned - $totalPaid;
        } else {
            // No filters - use aggregated totals from the already fetched $labours
            $totalEarned = $labours->sum('total_earned');
            $totalPaid = $labours->sum('total_paid');
            $totalBalance = $labours->sum('balance_due');
        }

        // Attendance Trends (Always last 7 days for the chart, but respect project)
        $attendanceTrends = collect(range(6, 0))->map(function ($i) use ($projectId) {
            $date = now()->subDays($i)->format('Y-m-d');

            return [
                'date' => $date,
                'count' => Attendance::where('date', $date)
                    ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
                    ->where('status', 'present')
                    ->count(),
            ];
        });

        // Skill Distribution
        $skillDistribution = (clone $labourQuery)
            ->select('skill_level', DB::raw('count(*) as count'))
            ->groupBy('skill_level')
            ->get();

        // Work Type Distribution
        $workTypeDistribution = (clone $labourQuery)
            ->select('work_type', DB::raw('count(*) as count'))
            ->groupBy('work_type')
            ->get();

        // Recent Attendances
        $recentAttendances = (clone $attendanceQuery)
            ->with(['labour', 'project', 'recorder'])
            ->latest('date')
            ->take(5)
            ->get();

        // Labour Work Records (Per Labourer Stats)
        $labourWorkRecords = $labours->map(function ($labour) use ($startDate, $endDate, $projectId) {
            $query = $labour->attendances()->where('status', 'present');
            if ($projectId) {
                $query->where('project_id', $projectId);
            }
            if ($startDate) {
                $query->where('date', '>=', $startDate);
            }
            if ($endDate) {
                $query->where('date', '<=', $endDate);
            }

            $attendances = $query->get();
            $totalDays = $attendances->whereIn('shift', ['1st Shift', '2nd Shift'])->unique('date')->count();

            // Re-calculating using the same dashboard logic for consistency
            $regCount = $attendances->whereIn('shift', ['1st Shift', '2nd Shift'])->count();
            $otHours = $attendances->sum('overtime_hours');
            $wage = $labour->wage_rate ?? 0;

            $earned = (($regCount * 0.5) * $wage) + ($otHours * ($wage / 8));
            $paid = $attendances->sum('payment_amount');

            return [
                'id' => $labour->id,
                'name' => $labour->name,
                'unique_id' => $labour->labour_unique_id,
                'photo' => $labour->photo_path,
                'total_days' => $totalDays,
                'total_earned' => $earned,
                'total_paid' => $paid,
                'balance' => $earned - $paid,
            ];
        })->filter(fn ($item) => $item['total_days'] > 0 || $item['total_earned'] > 0);

        $projects = Project::all();

        return view('labour.dashboard', compact(
            'totalWorkers',
            'activeWorkers',
            'todayAttendance',
            'monthlyAttendance',
            'totalEarned',
            'totalPaid',
            'totalBalance',
            'attendanceTrends',
            'skillDistribution',
            'workTypeDistribution',
            'recentAttendances',
            'labourWorkRecords',
            'projects',
            'projectId',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labour = new Labour;
        $projects = Project::all();

        return view('labour.create', compact('labour', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabourRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('id_proof_path')) {
            $data['id_proof_path'] = $request->file('id_proof_path')->store('labour/id_proofs', 'public');
        }

        if ($request->hasFile('pan_proof_path')) {
            $data['pan_proof_path'] = $request->file('pan_proof_path')->store('labour/pan_proofs', 'public');
        }

        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('labour/photos', 'public');
        }

        Labour::create($data);

        return redirect()->route('labour.index')
            ->with('success', 'Labour record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Labour $labour, Request $request)
    {
        $query = $labour->attendances()->with(['project', 'recorder']);

        // Attendance list filter
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        $attendances = $query->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        $totalPaidInRange = $attendances->sum('payment_amount');

        // Monthly Summary & Calendar Logic
        $selectedYear = $request->year ?? now()->year;
        $selectedMonth = $request->month ?? now()->month;

        // Detailed attendance for calendar
        $calendarAttendance = $labour->attendances()
            ->with(['project', 'recorder'])
            ->whereYear('date', $selectedYear)
            ->whereMonth('date', $selectedMonth)
            ->get()
            ->groupBy('date');

        $monthlyAttendance = $labour->attendances()
            ->selectRaw('YEAR(date) as year, MONTH(date) as month, 
                         COUNT(CASE WHEN status = "present" THEN 1 END) as present_days,
                         SUM(overtime_hours) as total_ot_hours,
                         SUM(payment_amount) as total_payout')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->orderBy('month', 'desc')
            ->get();

        $years = $labour->attendances()
            ->selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($years->isEmpty()) {
            $years = collect([now()->year]);
        }

        return view('labour.show', compact(
            'labour',
            'attendances',
            'startDate',
            'endDate',
            'totalPaidInRange',
            'monthlyAttendance',
            'calendarAttendance',
            'selectedYear',
            'selectedMonth',
            'years'
        ));
    }

    public function downloadReport(Labour $labour, Request $request)
    {
        $startDate = $request->start_date ?? now()->subMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $attendances = $labour->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        $filename = "Labour_Report_{$labour->labour_unique_id}_{$startDate}_to_{$endDate}.csv";

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Date', 'Project', 'Shift', 'Status', 'OT Hours', 'Payment (₹)'];

        $callback = function () use ($attendances, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($attendances as $record) {
                fputcsv($file, [
                    $record->date,
                    $record->project->name,
                    $record->shift,
                    ucfirst($record->status),
                    $record->overtime_hours,
                    $record->payment_amount,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Labour $labour)
    {
        $projects = Project::all();

        return view('labour.edit', compact('labour', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabourRequest $request, Labour $labour)
    {
        $data = $request->validated();

        if ($request->hasFile('id_proof_path')) {
            if ($labour->id_proof_path) {
                Storage::disk('public')->delete($labour->id_proof_path);
            }
            $data['id_proof_path'] = $request->file('id_proof_path')->store('labour/id_proofs', 'public');
        }

        if ($request->hasFile('pan_proof_path')) {
            if ($labour->pan_proof_path) {
                Storage::disk('public')->delete($labour->pan_proof_path);
            }
            $data['pan_proof_path'] = $request->file('pan_proof_path')->store('labour/pan_proofs', 'public');
        }

        if ($request->hasFile('photo_path')) {
            if ($labour->photo_path) {
                Storage::disk('public')->delete($labour->photo_path);
            }
            $data['photo_path'] = $request->file('photo_path')->store('labour/photos', 'public');
        }

        $labour->update($data);

        return redirect()->route('labour.index')
            ->with('success', 'Labour record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Labour $labour)
    {
        $labour->delete();

        return redirect()->route('labour.index')
            ->with('success', 'Labour record deleted successfully.');
    }
}
