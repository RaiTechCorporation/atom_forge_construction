<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSiteManagerRequest;
use App\Http\Requests\UpdateSiteManagerRequest;
use App\Models\Project;
use App\Models\SiteManager;
use App\Models\SiteManagerAttendance;
use App\Models\SiteManagerPayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SiteManagerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-employees', only: ['index', 'show', 'dashboard', 'export']),
            new Middleware('permission:create-employees', only: ['create', 'store', 'import']),
            new Middleware('permission:edit-employees', only: ['edit', 'update']),
            new Middleware('permission:delete-employees', only: ['destroy']),
            new Middleware('permission:manage-attendance', only: ['storeAttendance']),
            new Middleware('permission:view-attendance', only: ['attendance', 'attendanceRecords']),
        ];
    }

    public function index()
    {
        $managers = SiteManager::with('project')->latest()->paginate(15);
        return view('site_managers.index', compact('managers'));
    }

    public function dashboard(Request $request)
    {
        $projectId = $request->project_id;
        $managers = SiteManager::when($projectId, fn($q) => $q->where('project_id', $projectId))->get();
        
        $totalManagers = $managers->count();
        $activeManagers = $managers->where('status', 'Active')->count();
        
        $projects = Project::all();
        
        return view('site_managers.dashboard', compact(
            'totalManagers', 
            'activeManagers', 
            'projects',
            'projectId'
        ));
    }

    public function create()
    {
        $projects = Project::all();
        return view('site_managers.create', compact('projects'));
    }

    public function store(StoreSiteManagerRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($request, $data) {
            // Create User account
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'site_supervisor',
            ]);

            // Assign standard supervisor permissions via role
            $supervisorRole = Role::where('slug', 'site_supervisor')->first() ?? Role::where('slug', 'admin')->first();
            if ($supervisorRole) {
                $user->roles()->attach($supervisorRole->id);
            }

            if ($request->hasFile('id_proof_path')) {
                $data['id_proof_path'] = Storage::disk('public')->putFile('site_managers/id_proofs', $request->file('id_proof_path'));
            }

            if ($request->hasFile('pan_proof_path')) {
                $data['pan_proof_path'] = Storage::disk('public')->putFile('site_managers/pan_proofs', $request->file('pan_proof_path'));
            }

            if ($request->hasFile('certificate_10th_path')) {
                $data['certificate_10th_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('certificate_10th_path'));
            }

            if ($request->hasFile('certificate_12th_path')) {
                $data['certificate_12th_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('certificate_12th_path'));
            }

            if ($request->hasFile('graduation_certificate_path')) {
                $data['graduation_certificate_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('graduation_certificate_path'));
            }

            if ($request->hasFile('skilled_certificate_path')) {
                $data['skilled_certificate_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('skilled_certificate_path'));
            }

            if ($request->hasFile('photo_path')) {
                $data['photo_path'] = Storage::disk('public')->putFile('site_managers/photos', $request->file('photo_path'));
                // Sync photo to user profile as well
                $user->update(['profile_picture' => $data['photo_path']]);
            }

            $data['user_id'] = $user->id;
            $siteManager = SiteManager::create($data);

            if ($request->has('experiences')) {
                foreach ($request->experiences as $experience) {
                    $siteManager->experiences()->create($experience);
                }
            }

            return redirect()->route('site-managers.index')->with('success', 'Site Manager and login account created successfully.');
        });
    }

    public function show(SiteManager $siteManager, Request $request)
    {
        $query = $siteManager->attendances()->with(['project', 'recorder']);

        // Attendance list filter
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        $attendances = $query->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        // Monthly Summary & Calendar Logic
        $selectedYear = $request->year ?? now()->year;
        $selectedMonth = $request->month ?? now()->month;

        // Detailed attendance for calendar
        $calendarAttendance = $siteManager->attendances()
            ->with(['project', 'recorder'])
            ->whereYear('date', $selectedYear)
            ->whereMonth('date', $selectedMonth)
            ->get()
            ->groupBy('date');

        $monthlyAttendance = $siteManager->attendances()
            ->selectRaw('YEAR(date) as year, MONTH(date) as month, 
                         COUNT(CASE WHEN status = "Present" THEN 1 END) as present_days,
                         COUNT(CASE WHEN status = "Half Day" THEN 1 END) as half_days,
                         COUNT(CASE WHEN status = "Absent" THEN 1 END) as absent_days,
                         SUM(overtime_hours) as total_ot_hours')
            ->whereYear('date', $selectedYear)
            ->groupBy('year', 'month')
            ->orderBy('month', 'desc')
            ->get();

        $years = $siteManager->attendances()
            ->selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($years->isEmpty()) {
            $years = collect([now()->year]);
        }

        $payouts = $siteManager->payouts()->latest()->take(10)->get();
        
        return view('site_managers.show', compact(
            'siteManager', 
            'attendances', 
            'payouts',
            'startDate',
            'endDate',
            'monthlyAttendance',
            'calendarAttendance',
            'selectedYear',
            'selectedMonth',
            'years'
        ));
    }

    public function edit(SiteManager $siteManager)
    {
        $projects = Project::all();
        return view('site_managers.edit', compact('siteManager', 'projects'));
    }

    public function update(UpdateSiteManagerRequest $request, SiteManager $siteManager)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($request, $data, $siteManager) {
            // Update User account if exists
            if ($siteManager->user) {
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ];
                if (!empty($data['password'])) {
                    $userData['password'] = Hash::make($data['password']);
                }
                $siteManager->user->update($userData);
            }

            if ($request->hasFile('id_proof_path')) {
                if ($siteManager->id_proof_path) Storage::disk('public')->delete($siteManager->id_proof_path);
                $data['id_proof_path'] = Storage::disk('public')->putFile('site_managers/id_proofs', $request->file('id_proof_path'));
            }

            if ($request->hasFile('pan_proof_path')) {
                if ($siteManager->pan_proof_path) Storage::disk('public')->delete($siteManager->pan_proof_path);
                $data['pan_proof_path'] = Storage::disk('public')->putFile('site_managers/pan_proofs', $request->file('pan_proof_path'));
            }

            if ($request->hasFile('certificate_10th_path')) {
                if ($siteManager->certificate_10th_path) Storage::disk('public')->delete($siteManager->certificate_10th_path);
                $data['certificate_10th_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('certificate_10th_path'));
            }

            if ($request->hasFile('certificate_12th_path')) {
                if ($siteManager->certificate_12th_path) Storage::disk('public')->delete($siteManager->certificate_12th_path);
                $data['certificate_12th_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('certificate_12th_path'));
            }

            if ($request->hasFile('graduation_certificate_path')) {
                if ($siteManager->graduation_certificate_path) Storage::disk('public')->delete($siteManager->graduation_certificate_path);
                $data['graduation_certificate_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('graduation_certificate_path'));
            }

            if ($request->hasFile('skilled_certificate_path')) {
                if ($siteManager->skilled_certificate_path) Storage::disk('public')->delete($siteManager->skilled_certificate_path);
                $data['skilled_certificate_path'] = Storage::disk('public')->putFile('site_managers/certificates', $request->file('skilled_certificate_path'));
            }

            if ($request->hasFile('photo_path')) {
                if ($siteManager->photo_path) Storage::disk('public')->delete($siteManager->photo_path);
                $data['photo_path'] = Storage::disk('public')->putFile('site_managers/photos', $request->file('photo_path'));
                if ($siteManager->user) {
                    $siteManager->user->update(['profile_picture' => $data['photo_path']]);
                }
            }

            $siteManager->update($data);

            if ($request->has('experiences')) {
                $siteManager->experiences()->delete();
                foreach ($request->experiences as $experience) {
                    $siteManager->experiences()->create($experience);
                }
            }

            return redirect()->route('site-managers.index')->with('success', 'Site Manager updated successfully.');
        });
    }

    public function destroy(SiteManager $siteManager)
    {
        if (auth()->user()->isSiteSupervisor()) {
            return redirect()->route('site-managers.index')->with('error', 'Site Supervisors are not allowed to delete supervisor records.');
        }

        DB::transaction(function () use ($siteManager) {
            if ($siteManager->user) {
                $siteManager->user->delete();
            }
            $siteManager->delete();
        });
        return redirect()->route('site-managers.index')->with('success', 'Site Manager and associated login account deleted successfully.');
    }

    public function attendance(Request $request)
    {
        $date = $request->date ?? now()->format('Y-m-d');
        $projectId = $request->project_id;
        $user = auth()->user();

        if ($user->isSiteSupervisor()) {
            $managers = SiteManager::where('user_id', $user->id)->get();
        } else {
            $managers = SiteManager::when($projectId, fn($q) => $q->where('project_id', $projectId))
                ->where('status', 'Active')
                ->get();
        }
            
        $attendances = SiteManagerAttendance::where('date', $date)->get()->keyBy('site_manager_id');
        $projects = Project::all();
        
        // Add monthly summary for each manager
        $carbonDate = \Carbon\Carbon::parse($date);
        $month = $carbonDate->month;
        $year = $carbonDate->year;
        
        $attendanceSummaries = [];
        foreach ($managers as $manager) {
            $attendanceSummaries[$manager->id] = $manager->getAttendanceSummary($month, $year);
        }
        
        return view('site_managers.attendance', compact('managers', 'attendances', 'date', 'projects', 'projectId', 'attendanceSummaries'));
    }

    public function storeAttendance(Request $request)
    {
        $date = $request->date;
        $attendanceData = $request->attendance; // [manager_id => [status, overtime, remarks]]

        if (!$attendanceData) {
            return redirect()->back()->with('success', 'No attendance data to save.');
        }

        $managerIds = array_keys($attendanceData);
        $managers = SiteManager::whereIn('id', $managerIds)->get()->keyBy('id');

        foreach ($attendanceData as $managerId => $data) {
            if (!isset($managers[$managerId])) continue;

            SiteManagerAttendance::updateOrCreate(
                ['site_manager_id' => $managerId, 'date' => $date],
                [
                    'status' => $data['status'],
                    'overtime_hours' => $data['overtime_hours'] ?? 0,
                    'remarks' => $data['remarks'] ?? null,
                    'project_id' => $managers[$managerId]->project_id,
                    'recorded_by' => auth()->id(),
                    'recorded_at' => now(),
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }

    public function payouts(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');
        $projectId = $request->project_id;
        
        $payouts = SiteManagerPayout::with('siteManager.project')
            ->when($projectId, function($q) use ($projectId) {
                $q->whereHas('siteManager', fn($sq) => $sq->where('project_id', $projectId));
            })
            ->where('month', $month)
            ->latest()
            ->paginate(15);

        // Dashboard Stats
        $stats = [
            'total_salary_due' => SiteManagerPayout::where('month', $month)->sum('net_amount'),
            'paid_this_month' => SiteManagerPayout::where('month', $month)->sum('paid_amount'),
            'pending_payments' => SiteManagerPayout::where('month', $month)->whereIn('status', ['Pending', 'Partial Paid', 'Hold'])->count(),
            'attendance_avg' => 0, // Simplified for now
        ];

        $projects = Project::all();

        return view('site_managers.payouts.index', compact('payouts', 'stats', 'projects', 'projectId', 'month'));
    }

    public function generatePayroll(Request $request)
    {
        $request->validate([
            'month' => 'required|string', // Y-m
        ]);

        $monthStr = $request->month;
        [$year, $month] = explode('-', $monthStr);
        
        $managers = SiteManager::where('status', 'Active')->get();
        $generatedCount = 0;

        foreach ($managers as $manager) {
            // Check if payout already exists for this month
            $exists = SiteManagerPayout::where('site_manager_id', $manager->id)
                ->where('month', $monthStr)
                ->exists();
            
            if ($exists) continue;

            $summary = $manager->getAttendanceSummary($month, $year);
            
            // Basic salary calculation logic
            // If salary_type is Monthly, we might deduct for absences
            $baseSalary = $manager->salary_amount;
            $absenceDeduction = 0;
            
            if ($manager->salary_type === 'Monthly') {
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $perDaySalary = $baseSalary / $daysInMonth;
                $absenceDeduction = $summary['total_absent'] * $perDaySalary;
                $absenceDeduction += ($summary['total_half_day'] * 0.5) * $perDaySalary;
            } else if ($manager->salary_type === 'Daily') {
                $baseSalary = ($summary['total_present'] + ($summary['total_half_day'] * 0.5)) * $manager->salary_amount;
            }

            $netAmount = $baseSalary - $absenceDeduction;

            SiteManagerPayout::create([
                'site_manager_id' => $manager->id,
                'payout_date' => now(),
                'month' => $monthStr,
                'base_salary' => $baseSalary,
                'absence_deduction' => $absenceDeduction,
                'net_amount' => $netAmount,
                'status' => 'Pending',
            ]);

            $generatedCount++;
        }

        return redirect()->back()->with('success', "Payroll generated for $generatedCount supervisors.");
    }

    public function updatePayoutStatus(Request $request, SiteManagerPayout $payout)
    {
        $request->validate([
            'status' => 'required|in:Pending,Paid,Partial Paid,Hold',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $data = $request->only(['status', 'payment_method', 'transaction_id', 'remarks']);
        
        if ($request->status === 'Paid') {
            $data['paid_amount'] = $payout->net_amount;
        } elseif ($request->has('paid_amount')) {
            $data['paid_amount'] = $request->paid_amount;
        }

        $payout->update($data);

        return redirect()->back()->with('success', 'Payout status updated successfully.');
    }

    public function downloadPayslip(SiteManagerPayout $payout)
    {
        // For now, return a simple view that can be printed
        $siteManager = $payout->siteManager;
        [$year, $month] = explode('-', $payout->month);
        $attendanceSummary = $siteManager->getAttendanceSummary($month, $year);

        return view('site_managers.payouts.payslip', compact('payout', 'siteManager', 'attendanceSummary'));
    }

    public function exportPayroll(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');
        $payouts = SiteManagerPayout::with('siteManager.project')
            ->where('month', $month)
            ->get();

        $filename = "payroll_$month.csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, [
            'Supervisor Name', 'Site/Project', 'Month', 'Base Salary', 
            'Absence Deduction', 'Late Deduction', 'Penalty', 'Advance Recovery', 
            'Net Payable', 'Paid Amount', 'Status'
        ]);

        foreach ($payouts as $payout) {
            fputcsv($handle, [
                $payout->siteManager->name,
                $payout->siteManager->project->name ?? 'N/A',
                $payout->month,
                $payout->base_salary,
                $payout->absence_deduction,
                $payout->late_arrival_deduction,
                $payout->penalty_deduction,
                $payout->advance_salary_recovery,
                $payout->net_amount,
                $payout->paid_amount,
                $payout->status
            ]);
        }

        fclose($handle);
        exit;
    }

    public function exportPayrollPDF(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');
        $payouts = SiteManagerPayout::with('siteManager.project')
            ->where('month', $month)
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('site_managers.payouts.pdf', compact('payouts', 'month'));
        return $pdf->download("Payroll_Report_$month.pdf");
    }

    public function exportPayrollExcel(Request $request)
    {
        $month = $request->month ?? now()->format('Y-m');
        $payouts = SiteManagerPayout::with('siteManager.project')
            ->where('month', $month)
            ->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PayrollExport($payouts), "Payroll_Report_$month.xlsx");
    }

    public function downloadPDFReport(SiteManager $siteManager, Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        $attendances = $siteManager->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('site_managers.reports.pdf', compact('siteManager', 'attendances', 'startDate', 'endDate'));
        return $pdf->download("Supervisor_Report_{$siteManager->name}.pdf");
    }

    public function downloadExcelReport(SiteManager $siteManager, Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        $attendances = $siteManager->attendances()
            ->with('project')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SiteManagerAttendanceExport($attendances), "Supervisor_Report_{$siteManager->name}.xlsx");
    }

    public function attendanceRecords(Request $request)
    {
        $query = SiteManagerAttendance::with(['siteManager', 'project', 'recorder']);

        if ($request->date) {
            $query->where('date', $request->date);
        }

        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->site_manager_id) {
            $query->where('site_manager_id', $request->site_manager_id);
        }

        $attendances = $query->orderBy('date', 'desc')
            ->paginate(50);

        $projects = Project::all();
        $siteManagers = SiteManager::all();

        return view('site_managers.attendance_records', compact('attendances', 'projects', 'siteManagers'));
    }

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SiteManagerExport, 'site_managers.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\SiteManagerImport, $request->file('file'));

        return redirect()->back()->with('success', 'Site Manager data imported successfully.');
    }
}
