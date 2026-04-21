<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Project;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function dashboard(Request $request)
    {
        $investor = $request->user()->investor;
        
        if (!$investor) {
            return response()->json(['message' => 'Investor profile not found'], 404);
        }

        $investments = Investment::where('investor_id', $investor->id)
            ->with('project')
            ->get();

        $stats = [
            'total_invested' => $investments->sum('investment_amount'),
            'total_projects' => $investments->pluck('project_id')->unique()->count(),
            'active_investments' => $investments->where('status', 'approved')->count(),
        ];

        return response()->json([
            'stats' => $stats,
            'investments' => $investments,
        ]);
    }
}
