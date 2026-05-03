<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Project;
use App\Models\FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Combine FundRequests and Investments for transaction history
        $fundRequests = $investor->fundRequests()->latest()->get();
        
        $transactions = collect();
        
        foreach($fundRequests as $fr) {
            $transactions->push((object)[
                'type' => 'credit',
                'amount' => $fr->amount,
                'status' => $fr->status,
                'date' => $fr->created_at,
                'description' => 'Added Funds via ' . str_replace('_', ' ', $fr->payment_method),
            ]);
        }
        
        foreach($investments as $inv) {
            $transactions->push((object)[
                'type' => 'debit',
                'amount' => $inv->investment_amount,
                'status' => $inv->status,
                'date' => $inv->investment_date,
                'description' => 'Investment in ' . $inv->project->name,
            ]);
        }
        
        $transactions = $transactions->sortByDesc('date')->values()->take(10);

        return view('investor.dashboard', compact('investor', 'investments', 'stats', 'availableProjects', 'transactions'));
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

        // Get all investments for this project by this investor
        $allInvestments = Investment::where('investor_id', $investor->id)
            ->where('project_id', $id)
            ->latest('investment_date')
            ->get();

        return view('investor.project-details', compact('project', 'investment', 'totalExpenses', 'totalInvestedInProject', 'payouts', 'totalReceived', 'allInvestments', 'investor'));
    }

    public function addFunds(Request $request)
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return back()->with('error', 'Investor profile not found.');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:bank_transfer,cheque,cash,upi',
            'reference_number' => 'nullable|string|max:100',
            'receipt_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('receipt_proof')) {
            $path = $request->file('receipt_proof')->store('receipt_proofs', 'public');
            $validated['receipt_proof'] = $path;
        }

        $validated['investor_id'] = $investor->id;
        $validated['status'] = 'pending';

        FundRequest::create($validated);

        return redirect()->route('investor.dashboard')->with('success', 'Fund request submitted. Balance will be updated after admin verification.');
    }

    public function showAddFunds()
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return redirect()->route('dashboard')->with('error', 'Investor profile not found.');
        }

        $fundRequests = $investor->fundRequests()->latest()->paginate(10);

        return view('investor.wallet.add-funds', compact('investor', 'fundRequests'));
    }

    public function storeInvestment(Request $request, $id)
    {
        $investor = $this->getInvestor();
        if (! $investor) {
            return back()->with('error', 'Investor profile not found.');
        }

        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'investment_amount' => 'required|numeric|min:1',
            'investment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($investor->balance < $validated['investment_amount']) {
            return back()->with('error', 'Insufficient balance in your account. Please add funds first.');
        }

        DB::transaction(function () use ($investor, $id, $validated) {
            $validated['investor_id'] = $investor->id;
            $validated['project_id'] = $id;
            $validated['status'] = 'pending';
            $validated['created_by'] = auth()->id();
            $validated['payout_cycle'] = 'monthly';

            Investment::create($validated);
            
            // We can either deduct now or wait for approval. 
            // Usually, for "investments", we deduct upon request and maybe refund if rejected.
            // Or only allow investing from balance and deduct immediately.
            $investor->decrement('balance', $validated['investment_amount']);
        });

        return back()->with('success', 'Investment request submitted successfully. Amount deducted from your balance.');
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
