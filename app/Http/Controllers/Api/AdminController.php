<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Investment;
use App\Models\Expense;
use App\Models\Material;
use App\Models\Labour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboardStats()
    {
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'total_revenue' => Project::sum('total_budget'),
            'investor_funds' => Investment::sum('investment_amount'),
            'total_expenses' => Expense::sum('amount'),
            'material_usage' => Material::count(),
            'labor_costs' => Expense::where('category', 'labor')->sum('amount'),
        ];

        // Profit/Loss per project (Sample calculation)
        $projects_performance = Project::select('id', 'name', 'total_budget')
            ->withSum('expenses', 'amount')
            ->get()
            ->map(function ($project) {
                return [
                    'name' => $project->name,
                    'budget' => $project->total_budget,
                    'expenses' => $project->expenses_sum_amount ?? 0,
                    'profit' => $project->total_budget - ($project->expenses_sum_amount ?? 0),
                ];
            });

        return response()->json([
            'stats' => $stats,
            'projects_performance' => $projects_performance,
        ]);
    }

    public function getUsers()
    {
        return response()->json(User::all());
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:super_admin,admin_staff,client,investor',
        ]);

        $user->update(['role' => $request->role]);

        return response()->json(['message' => 'User role updated successfully']);
    }
}
