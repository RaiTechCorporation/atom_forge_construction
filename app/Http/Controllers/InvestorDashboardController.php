<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $investor = $user->investor;

        // If user is admin and doesn't have an investor profile, pick the first one to simulate "Investor Mode"
        if (!$investor && $user->isAdmin()) {
            $investor = \App\Models\Investor::first();
        }

        if (!$investor) {
            return redirect()->route('dashboard')->with('error', 'Investor profile not found.');
        }

        $investments = Investment::with('project')
            ->where('investor_id', $investor->id)
            ->latest('investment_date')
            ->get();

        $availableProjects = \App\Models\Project::where('need_funding', true)
            ->whereNotIn('id', $investments->pluck('project_id'))
            ->latest()
            ->get();

        $projectIds = $investments->pluck('project_id')->unique();
        
        $stats = [
            'total_invested' => $investments->where('status', 'approved')->sum('investment_amount'),
            'project_count' => $projectIds->count(),
            'recent_investment' => $investments->first(),
            'total_payouts' => $investor->payouts()->where('status', 'approved')->sum('amount_paid'),
        ];

        return view('investor.dashboard', compact('investor', 'investments', 'stats', 'availableProjects'));
    }

    public function projectDetails($id)
    {
        $user = auth()->user();
        $investor = $user->investor;

        // If user is admin and doesn't have an investor profile, pick the first one to simulate "Investor Mode"
        if (!$investor && $user->isAdmin()) {
            $investor = \App\Models\Investor::first();
        }

        if (!$investor) {
            return redirect()->route('dashboard')->with('error', 'Investor profile not found.');
        }

        $investment = Investment::where('investor_id', $investor->id)
            ->where('project_id', $id)
            ->first();

        if (!$investment) {
            $project = \App\Models\Project::where('id', $id)->where('need_funding', true)->firstOrFail();
        } else {
            $project = $investment->project;
        }

        $project->load(['expenses', 'projectUpdates' => function($q) {
            $q->latest('date');
        }]);

        $totalExpenses = $project->expenses->sum('amount');
        $totalInvestedInProject = $project->investments()->where('status', 'approved')->sum('investment_amount');
        
        $payouts = $investor->payouts()->where('project_id', $id)->latest('payment_date')->get();
        $totalReceived = $payouts->where('status', 'approved')->sum('amount_paid');

        return view('investor.project-details', compact('project', 'investment', 'totalExpenses', 'totalInvestedInProject', 'payouts', 'totalReceived'));
    }

    public function history()
    {
        return $this->index();
    }
}
