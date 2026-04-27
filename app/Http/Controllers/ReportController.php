<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Expense;
use App\Models\Labour;
use App\Models\Material;
use App\Models\MaterialTransaction;
use App\Models\Project;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ReportController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-reports'),
        ];
    }

    public function index()
    {
        // 1. Project-wise Budget vs Actual
        $projects = Project::with(['expenses'])->get()->map(function ($project) {
            $actualSpend = $project->expenses->sum('amount');

            return [
                'name' => $project->name,
                'budget' => $project->total_budget,
                'actual' => $actualSpend,
                'remaining' => $project->total_budget - $actualSpend,
                'status' => $project->status,
            ];
        });

        // 2. Recent Expenses (Last 30 Days)
        $recentExpenses = Expense::with('project')
            ->where('date', '>=', now()->subDays(30))
            ->orderBy('date', 'desc')
            ->get();

        // 3. Labour Cost Summary (Total Estimated Payout)
        $labourSummary = Attendance::with(['labour', 'project'])
            ->where('status', 'present')
            ->get()
            ->groupBy('labour_id')
            ->map(function ($attendances) {
                $labour = $attendances->first()->labour;
                $regularShifts = $attendances->whereIn('shift', ['1st Shift', '2nd Shift'])->count();
                $uniqueDaysPresent = $attendances->whereIn('shift', ['1st Shift', '2nd Shift'])->unique('date')->count();
                $overtimeHours = $attendances->sum('overtime_hours');

                $regularPay = ($regularShifts * 0.5) * $labour->wage_rate;
                $overtimePay = $overtimeHours * ($labour->wage_rate / 8);

                return [
                    'name' => $labour->name,
                    'days_present' => $uniqueDaysPresent,
                    'overtime_hours' => $overtimeHours,
                    'wage_rate' => $labour->wage_rate,
                    'total_pay' => $regularPay + $overtimePay,
                ];
            });

        // 4. Material Consumption Summary
        $materialConsumption = MaterialTransaction::with('material', 'project')
            ->where('type', 'consumption')
            ->get()
            ->groupBy('material_id')
            ->map(function ($transactions) {
                $material = $transactions->first()->material;

                return [
                    'name' => $material->name,
                    'total_consumed' => $transactions->sum('quantity'),
                    'unit' => $material->unit,
                ];
            });

        // 5. Overall Stats
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'total_spend' => Expense::sum('amount') + Attendance::sum('payment_amount'),
            'total_budget' => Project::sum('total_budget'),
        ];

        return view('reports.index', compact('projects', 'recentExpenses', 'labourSummary', 'materialConsumption', 'stats'));
    }
}
