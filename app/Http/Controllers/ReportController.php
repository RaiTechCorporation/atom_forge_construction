<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Expense;
use App\Models\Labour;
use App\Models\Material;
use App\Models\Attendance;
use App\Models\MaterialTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Project-wise Budget vs Actual
        $projects = Project::with(['expenses'])->get()->map(function($project) {
            $actualSpend = $project->expenses->sum('amount');
            return [
                'name' => $project->name,
                'budget' => $project->total_budget,
                'actual' => $actualSpend,
                'remaining' => $project->total_budget - $actualSpend,
                'status' => $project->status
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
            ->map(function($attendances) {
                $labour = $attendances->first()->labour;
                return [
                    'name' => $labour->name,
                    'days_present' => $attendances->count(),
                    'wage_rate' => $labour->wage_rate,
                    'total_pay' => $attendances->count() * $labour->wage_rate
                ];
            });

        // 4. Material Consumption Summary
        $materialConsumption = MaterialTransaction::with('material', 'project')
            ->where('type', 'consumption')
            ->get()
            ->groupBy('material_id')
            ->map(function($transactions) {
                $material = $transactions->first()->material;
                return [
                    'name' => $material->name,
                    'total_consumed' => $transactions->sum('quantity'),
                    'unit' => $material->unit
                ];
            });

        // 5. Overall Stats
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'total_spend' => Expense::sum('amount'),
            'total_budget' => Project::sum('total_budget')
        ];

        return view('reports.index', compact('projects', 'recentExpenses', 'labourSummary', 'materialConsumption', 'stats'));
    }
}
