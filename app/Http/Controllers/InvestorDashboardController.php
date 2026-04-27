<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Http\Request;

class InvestorDashboardController extends Controller
{
    private function getInvestor()
    {
        $user = auth()->user();
        $investor = $user->investor;

        if (! $investor && $user->isAdmin()) {
            $investor = Investor::first();
        }

        return $investor;
    }

    public function index()
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return redirect()->route('dashboard')->with('error', 'Investor profile not found.');
        }

        $investments = Investment::with('project')
            ->where('investor_id', $investor->id)
            ->latest('investment_date')
            ->get();

        $availableProjects = Project::where('need_funding', true)
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
        $investor = $this->getInvestor();
        if (! $investor) {
            return redirect()->route('dashboard')->with('error', 'Investor profile not found.');
        }

        $investment = Investment::where('investor_id', $investor->id)
            ->where('project_id', $id)
            ->first();

        if (! $investment) {
            $project = Project::where('id', $id)->where('need_funding', true)->firstOrFail();
        } else {
            $project = $investment->project;
        }

        $project->load(['expenses', 'projectUpdates' => function ($q) {
            $q->latest('date');
        }]);

        $totalExpenses = $project->expenses->sum('amount');
        $totalInvestedInProject = $project->investments()->where('status', 'approved')->sum('investment_amount');

        $payouts = $investor->payouts()->where('project_id', $id)->latest('payment_date')->get();
        $totalReceived = $payouts->where('status', 'approved')->sum('amount_paid');

        return view('investor.project-details', compact('project', 'investment', 'totalExpenses', 'totalInvestedInProject', 'payouts', 'totalReceived'));
    }

    // Portfolio
    public function portfolioOverview()
    {
        return $this->index();
    }

    public function portfolioActive()
    {
        $investor = $this->getInvestor();
        $investments = Investment::with('project')
            ->where('investor_id', $investor->id)
            ->where('status', 'approved')
            ->whereHas('project', function ($q) {
                $q->where('status', '!=', 'completed');
            })
            ->latest()
            ->get();

        return view('investor.portfolio.active', compact('investor', 'investments'));
    }

    public function portfolioCompleted()
    {
        $investor = $this->getInvestor();
        $investments = Investment::with('project')
            ->where('investor_id', $investor->id)
            ->where('status', 'approved')
            ->whereHas('project', function ($q) {
                $q->where('status', 'completed');
            })
            ->latest()
            ->get();

        return view('investor.portfolio.completed', compact('investor', 'investments'));
    }

    // Projects
    public function projectsAll()
    {
        $investor = $this->getInvestor();
        $projects = Project::latest()->get();

        return view('investor.projects.all', compact('investor', 'projects'));
    }

    public function projectsPerformance()
    {
        $investor = $this->getInvestor();
        $investments = Investment::with('project')
            ->where('investor_id', $investor->id)
            ->where('status', 'approved')
            ->get();

        return view('investor.projects.performance', compact('investor', 'investments'));
    }

    // Earnings
    public function earningsSummary()
    {
        $investor = $this->getInvestor();
        $payouts = $investor->payouts()->with('project')->latest()->get();

        return view('investor.earnings.summary', compact('investor', 'payouts'));
    }

    public function earningsHistory()
    {
        $investor = $this->getInvestor();
        $payouts = $investor->payouts()->with('project')->where('status', 'approved')->latest()->get();

        return view('investor.earnings.history', compact('investor', 'payouts'));
    }

    public function earningsAnalytics()
    {
        $investor = $this->getInvestor();

        return view('investor.earnings.analytics', compact('investor'));
    }

    // Transactions
    public function transactionsAll()
    {
        $investor = $this->getInvestor();
        $investments = Investment::where('investor_id', $investor->id)->latest()->get();
        $payouts = $investor->payouts()->latest()->get();

        return view('investor.transactions.all', compact('investor', 'investments', 'payouts'));
    }

    public function transactionsHistory()
    {
        $investor = $this->getInvestor();
        $investments = Investment::with('project')->where('investor_id', $investor->id)->latest()->get();

        return view('investor.transactions.history', compact('investor', 'investments'));
    }

    public function transactionsWithdrawals()
    {
        $investor = $this->getInvestor();
        $payouts = $investor->payouts()->where('status', 'approved')->latest()->get();

        return view('investor.transactions.withdrawals', compact('investor', 'payouts'));
    }

    // Documents
    public function documentsAgreements()
    {
        $investor = $this->getInvestor();

        return view('investor.documents.agreements', compact('investor'));
    }

    public function documentsReports()
    {
        $investor = $this->getInvestor();

        return view('investor.documents.reports', compact('investor'));
    }

    public function documentsReceipts()
    {
        $investor = $this->getInvestor();

        return view('investor.documents.receipts', compact('investor'));
    }

    public function notifications()
    {
        $investor = $this->getInvestor();

        return view('investor.notifications', compact('investor'));
    }

    public function support()
    {
        $investor = $this->getInvestor();

        return view('investor.support', compact('investor'));
    }

    // Profile
    public function profileInfo()
    {
        $investor = $this->getInvestor();
        $user = auth()->user();

        return view('investor.profile.info', compact('investor', 'user'));
    }

    public function profileInfoUpdate(Request $request)
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return back()->with('error', 'Investor profile not found.');
        }

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $investor->update($validated);

        return back()->with('status', 'profile-info-updated');
    }

    public function profileBank()
    {
        $investor = $this->getInvestor();
        $bankAccounts = $investor->bankAccounts()->latest()->get();

        return view('investor.profile.bank', compact('investor', 'bankAccounts'));
    }

    public function profileBankUpdate(Request $request)
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return back()->with('error', 'Investor profile not found.');
        }

        if ($investor->bankAccounts()->count() >= 3) {
            return back()->with('error', 'You can only add up to 3 bank accounts.');
        }

        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'other_bank_name' => 'required_if:bank_name,Other|nullable|string|max:255',
            'account_number' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'account_type' => 'required|string|in:Savings,Current',
        ]);

        if ($validated['bank_name'] === 'Other') {
            $validated['bank_name'] = $validated['other_bank_name'];
        }
        unset($validated['other_bank_name']);

        $isFirst = $investor->bankAccounts()->count() === 0;

        $investor->bankAccounts()->create(array_merge($validated, [
            'is_primary' => $isFirst,
        ]));

        return back()->with('status', 'bank-account-added');
    }

    public function profileBankSetPrimary($id)
    {
        $investor = $this->getInvestor();
        $account = $investor->bankAccounts()->findOrFail($id);

        $investor->bankAccounts()->update(['is_primary' => false]);
        $account->update(['is_primary' => true]);

        return back()->with('status', 'primary-bank-updated');
    }

    public function profileBankDelete($id)
    {
        $investor = $this->getInvestor();
        $account = $investor->bankAccounts()->findOrFail($id);

        if ($account->is_primary) {
            return back()->with('error', 'You cannot delete your primary bank account. Set another account as primary first.');
        }

        $account->delete();

        return back()->with('status', 'bank-account-deleted');
    }

    public function profileSecurity()
    {
        $investor = $this->getInvestor();
        $user = auth()->user();

        return view('investor.profile.security', compact('investor', 'user'));
    }

    public function toggleTwoFactor(Request $request)
    {
        $user = auth()->user();
        $user->two_factor_enabled = ! $user->two_factor_enabled;
        $user->save();

        $status = $user->two_factor_enabled ? 'enabled' : 'disabled';

        return back()->with('status', "two-factor-$status");
    }
}
