<?php

namespace App\Http\Controllers;

use App\Exports\LabourAttendanceExport;
use App\Exports\LabourExport;
use App\Http\Requests\StoreLabourRequest;
use App\Http\Requests\UpdateLabourRequest;
use App\Imports\LabourImport;
use App\Models\Attendance;
use App\Models\Labour;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class LabourController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-employees', only: ['index', 'show', 'dashboard', 'downloadReport', 'export']),
            new Middleware('permission:create-employees', only: ['create', 'store', 'import']),
            new Middleware('permission:edit-employees', only: ['edit', 'update']),
            new Middleware('permission:delete-employees', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedMonth = $request->month;
        $selectedYear = $request->year;

        $labours = Labour::query()
            ->addSelect([
                'total_paid' => Attendance::selectRaw('SUM(payment_amount)')
                    ->whereColumn('labour_id', 'labour.id')
                    ->where('status', 'present')
                    ->when($selectedMonth, fn ($q) => $q->whereMonth('date', $selectedMonth))
                    ->when($selectedYear, fn ($q) => $q->whereYear('date', $selectedYear)),
                'reg_count' => Attendance::selectRaw('COUNT(*)')
                    ->whereColumn('labour_id', 'labour.id')
                    ->where('status', 'present')
                    ->whereIn('shift', ['1st Shift', '2nd Shift'])
                    ->when($selectedMonth, fn ($q) => $q->whereMonth('date', $selectedMonth))
                    ->when($selectedYear, fn ($q) => $q->whereYear('date', $selectedYear)),
                'ot_hours' => Attendance::selectRaw('SUM(overtime_hours)')
                    ->whereColumn('labour_id', 'labour.id')
                    ->where('status', 'present')
                    ->when($selectedMonth, fn ($q) => $q->whereMonth('date', $selectedMonth))
                    ->when($selectedYear, fn ($q) => $q->whereYear('date', $selectedYear)),
            ])
            ->latest()
            ->paginate(15);

        // We need to manually calculate the earned and balance since they depend on wage_rate per row
        $labours->getCollection()->transform(function ($labour) {
            $wage = $labour->wage_rate ?? 0;
            $earned = (($labour->reg_count * 0.5) * $wage) + ($labour->ot_hours * ($wage / 8));

            // Set these as attributes so the view can access them without triggering the model accessors
            $labour->setRawAttributes(array_merge($labour->getAttributes(), [
                'total_earned' => $earned,
                'total_paid' => $labour->total_paid ?? 0,
                'balance_due' => $earned - ($labour->total_paid ?? 0),
            ]));

            return $labour;
        });

        $years = Attendance::selectRaw('YEAR(date) as year')->distinct()->orderBy('year', 'desc')->pluck('year');
        if ($years->isEmpty()) {
            $years = collect([now()->year]);
        }

        return view('labour.index', compact('labours', 'selectedMonth', 'selectedYear', 'years'));
    }

    public function dashboard(Request $request)
    {
        $projectId = $request->project_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Base queries
        $labourQuery = Labour::query();

        if ($projectId) {
            // Workers who are either assigned to this project OR have attendance records for this project
            $labourQuery->where(function ($q) use ($projectId) {
                $q->where('project_id', $projectId)
                    ->orWhereHas('attendances', function ($aq) use ($projectId) {
                        $aq->where('project_id', $projectId);
                    });
            });
        }

        $totalWorkers = $labourQuery->count();
        $activeWorkers = (clone $labourQuery)->where('status', 'Active')->count();

        // Get all relevant labours
        $labours = $labourQuery->get();
        $labourIds = $labours->pluck('id');

        // Aggregated Attendance Data for all relevant labours in one query
        $attendanceAggregates = Attendance::query()
            ->whereIn('labour_id', $labourIds)
            ->where('status', 'present')
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->when($startDate, fn ($q) => $q->where('date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->where('date', '<=', $endDate))
            ->select('labour_id',
                DB::raw('COUNT(DISTINCT date) as total_days_present'),
                DB::raw('COUNT(CASE WHEN shift IN ("1st Shift", "2nd Shift") THEN 1 END) as reg_count'),
                DB::raw('SUM(overtime_hours) as ot_hours'),
                DB::raw('SUM(payment_amount) as total_paid_amount')
            )
            ->groupBy('labour_id')
            ->get()
            ->keyBy('labour_id');

        $totalEarned = 0;
        $totalPaid = 0;

        // Labour Work Records (Per Labourer Stats) - Calculated from aggregates to avoid N+1
        $labourWorkRecords = $labours->map(function ($labour) use ($attendanceAggregates) {
            $agg = $attendanceAggregates->get($labour->id);

            // If no attendance records matching filters, we might still want to show them if no filters are applied
            // but the original logic filtered them out if total_days == 0 and total_earned == 0
            $regCount = $agg->reg_count ?? 0;
            $otHours = $agg->ot_hours ?? 0;
            $wage = $labour->wage_rate ?? 0;

            $earned = (($regCount * 0.5) * $wage) + ($otHours * ($wage / 8));
            $paid = $agg->total_paid_amount ?? 0;

            return [
                'id' => $labour->id,
                'name' => $labour->name,
                'unique_id' => $labour->labour_unique_id,
                'photo' => $labour->photo_path,
                'total_days' => ($agg->reg_count ?? 0) * 0.5,
                'total_earned' => $earned,
                'total_paid' => $paid,
                'balance' => $earned - $paid,
            ];
        })->filter(fn ($item) => $item['total_days'] > 0 || $item['total_earned'] > 0)->values();

        // Financials
        $totalEarned = $labourWorkRecords->sum('total_earned');
        $totalPaid = $labourWorkRecords->sum('total_paid');
        $totalBalance = $totalEarned - $totalPaid;

        $todayAttendance = Attendance::where('date', now()->format('Y-m-d'))
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->where('status', 'present')
            ->whereIn('shift', ['1st Shift', '2nd Shift'])
            ->count() * 0.5;

        // Monthly attendance should always be for the current month but respect project filter
        $monthlyAttendance = Attendance::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->where('status', 'present')
            ->whereIn('shift', ['1st Shift', '2nd Shift'])
            ->count() * 0.5;

        // Attendance Trends (Optimized to one query)
        $sevenDaysAgo = now()->subDays(6)->format('Y-m-d');
        $trendsData = Attendance::where('date', '>=', $sevenDaysAgo)
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->where('status', 'present')
            ->select('date', DB::raw('count(DISTINCT labour_id) as count'))
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $attendanceTrends = collect(range(6, 0))->map(function ($i) use ($trendsData) {
            $date = now()->subDays($i)->format('Y-m-d');

            return [
                'date' => $date,
                'count' => $trendsData->has($date) ? $trendsData->get($date)->count : 0,
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
        $recentAttendances = Attendance::query()
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->when($startDate, fn ($q) => $q->where('date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->where('date', '<=', $endDate))
            ->with(['labour', 'project', 'recorder'])
            ->latest('date')
            ->take(5)
            ->get();

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
            $data['id_proof_path'] = Storage::disk('public')->putFile('labour/id_proofs', $request->file('id_proof_path'));
        }

        if ($request->hasFile('pan_proof_path')) {
            $data['pan_proof_path'] = Storage::disk('public')->putFile('labour/pan_proofs', $request->file('pan_proof_path'));
        }

        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = Storage::disk('public')->putFile('labour/photos', $request->file('photo_path'));
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
        // Monthly Summary & Calendar Logic
        $selectedYear = $request->year ?? now()->year;
        $selectedMonth = $request->month ?? now()->month;

        $query = $labour->attendances()->with(['project', 'recorder']);

        // Attendance list filter - Default to selected month if not explicitly provided
        $startDate = $request->start_date ?? Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth()->format('Y-m-d');

        $attendances = $query->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        // Calculate Analytics for the selected range
        $rangeStats = $labour->attendances()
            ->whereBetween('date', [$startDate, $endDate])
            ->selectRaw('
                SUM(CASE WHEN status = "present" AND shift IN ("1st Shift", "2nd Shift") THEN 0.5 ELSE 0 END) as present_days,
                SUM(overtime_hours) as total_ot_hours,
                SUM(payment_amount) as total_paid
            ')
            ->first();

        $wage = $labour->wage_rate ?? 0;
        $rangeAnalytics = [
            'present_days' => $rangeStats->present_days ?? 0,
            'total_ot_hours' => $rangeStats->total_ot_hours ?? 0,
            'total_regular_earned' => ($rangeStats->present_days ?? 0) * $wage,
            'total_overtime_earned' => ($rangeStats->total_ot_hours ?? 0) * ($wage / 8),
            'total_paid' => $rangeStats->total_paid ?? 0,
        ];
        $rangeAnalytics['total_earned'] = $rangeAnalytics['total_regular_earned'] + $rangeAnalytics['total_overtime_earned'];
        $rangeAnalytics['balance_due'] = $rangeAnalytics['total_earned'] - $rangeAnalytics['total_paid'];

        $totalPaidInRange = $attendances->sum('payment_amount');

        // Detailed attendance for calendar
        $calendarAttendance = $labour->attendances()
            ->with(['project', 'recorder'])
            ->whereYear('date', $selectedYear)
            ->whereMonth('date', $selectedMonth)
            ->get()
            ->groupBy('date');

        $monthlyAttendance = $labour->attendances()
            ->selectRaw('YEAR(date) as year, MONTH(date) as month, 
                         SUM(CASE WHEN status = "present" AND shift IN ("1st Shift", "2nd Shift") THEN 0.5 ELSE 0 END) as present_days,
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

        $projects = Project::all();

        return view('labour.show', compact(
            'labour',
            'attendances',
            'startDate',
            'endDate',
            'totalPaidInRange',
            'rangeAnalytics',
            'monthlyAttendance',
            'calendarAttendance',
            'selectedYear',
            'selectedMonth',
            'years',
            'projects'
        ));
    }

    public function addPayment(Labour $labour, Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'project_id' => 'required|exists:projects,id',
            'shift' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        // Supervisor restriction: only current day
        if ($user->role === 'site_supervisor') {
            if ($request->date !== now()->format('Y-m-d')) {
                return redirect()->back()->with('error', 'Supervisors can only record payments for the current day.');
            }
        }
        // Admin (super_admin, admin_staff) has full access, others might be restricted or allowed
        // Following user's specific request for Admin vs Supervisor

        Attendance::updateOrCreate(
            [
                'labour_id' => $labour->id,
                'date' => $request->date,
                'shift' => $request->shift,
                'project_id' => $request->project_id,
            ],
            [
                'payment_amount' => $request->amount,
                'remark' => $request->remark,
                'recorded_by' => $user->id,
                'recorded_at' => now(),
                'status' => 'present',
            ]
        );

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }

    public function updatePayment(Request $request, Attendance $attendance)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:255',
        ]);

        if (auth()->user()->role === 'site_supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to modify payments.');
        }

        $attendance->update([
            'payment_amount' => $request->payment_amount,
            'remark' => $request->remark,
        ]);

        return redirect()->back()->with('success', 'Payment updated successfully.');
    }

    public function destroyPayment(Attendance $attendance)
    {
        if (auth()->user()->role === 'site_supervisor') {
            return redirect()->back()->with('error', 'Supervisors are not allowed to delete payments.');
        }

        // If it's a dedicated payment record (no attendance status or just for payment)
        // Actually, in this system, attendance and payment are in the same row.
        // If we "delete" a payment, should we delete the whole record or just set amount to 0?
        // Given the UI filters by payment_amount > 0, setting to 0 is safer if attendance was also marked.
        // But if they want to DELETE it, they probably want it gone from the payout list.

        $attendance->update(['payment_amount' => 0]);

        return redirect()->back()->with('success', 'Payment removed successfully.');
    }

    public function downloadReport(Labour $labour, Request $request)
    {
        $startDate = $request->start_date ?? now()->subMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $attendances = $labour->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
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

    public function downloadPDF(Labour $labour, Request $request)
    {
        $selectedYear = $request->year ?? now()->year;
        $selectedMonth = $request->month ?? now()->month;

        $startDate = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth()->format('Y-m-d');

        $attendances = $labour->attendances()
            ->with(['project', 'recorder'])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        // Calculate Analytics for the selected range
        $rangeStats = $labour->attendances()
            ->whereBetween('date', [$startDate, $endDate])
            ->selectRaw('
                SUM(CASE WHEN status = "present" AND shift IN ("1st Shift", "2nd Shift") THEN 0.5 ELSE 0 END) as present_days,
                SUM(overtime_hours) as total_ot_hours,
                SUM(payment_amount) as total_paid
            ')
            ->first();

        $wage = $labour->wage_rate ?? 0;
        $rangeAnalytics = [
            'present_days' => $rangeStats->present_days ?? 0,
            'total_ot_hours' => $rangeStats->total_ot_hours ?? 0,
            'total_regular_earned' => ($rangeStats->present_days ?? 0) * $wage,
            'total_overtime_earned' => ($rangeStats->total_ot_hours ?? 0) * ($wage / 8),
            'total_paid' => $rangeStats->total_paid ?? 0,
        ];
        $rangeAnalytics['total_earned'] = $rangeAnalytics['total_regular_earned'] + $rangeAnalytics['total_overtime_earned'];
        $rangeAnalytics['balance_due'] = $rangeAnalytics['total_earned'] - $rangeAnalytics['total_paid'];

        $pdf = Pdf::loadView('labour.profile-pdf', compact(
            'labour',
            'attendances',
            'rangeAnalytics',
            'selectedMonth',
            'selectedYear',
            'startDate',
            'endDate'
        ));

        return $pdf->download("Labour_Profile_{$labour->labour_unique_id}_{$selectedMonth}_{$selectedYear}.pdf");
    }

    public function downloadPDFReport(Labour $labour, Request $request)
    {
        $startDate = $request->start_date ?? now()->subMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $attendances = $labour->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        $pdf = Pdf::loadView('labour.reports.pdf', compact('labour', 'attendances', 'startDate', 'endDate'));

        return $pdf->download("Labour_Report_{$labour->labour_unique_id}.pdf");
    }

    public function downloadExcelReport(Labour $labour, Request $request)
    {
        $startDate = $request->start_date ?? now()->subMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $attendances = $labour->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        return Excel::download(new LabourAttendanceExport($attendances), "Labour_Report_{$labour->labour_unique_id}.xlsx");
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
            $data['id_proof_path'] = Storage::disk('public')->putFile('labour/id_proofs', $request->file('id_proof_path'));
        }

        if ($request->hasFile('pan_proof_path')) {
            if ($labour->pan_proof_path) {
                Storage::disk('public')->delete($labour->pan_proof_path);
            }
            $data['pan_proof_path'] = Storage::disk('public')->putFile('labour/pan_proofs', $request->file('pan_proof_path'));
        }

        if ($request->hasFile('photo_path')) {
            if ($labour->photo_path) {
                Storage::disk('public')->delete($labour->photo_path);
            }
            $data['photo_path'] = Storage::disk('public')->putFile('labour/photos', $request->file('photo_path'));
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
        if (auth()->user()->isSiteSupervisor()) {
            return redirect()->route('labour.index')
                ->with('error', 'Site Supervisors are not allowed to delete labour records.');
        }

        $labour->delete();

        return redirect()->route('labour.index')
            ->with('success', 'Labour record deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new LabourExport, 'labours.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new LabourImport, $request->file('file'));

        return redirect()->back()->with('success', 'Labour data imported successfully.');
    }
}
