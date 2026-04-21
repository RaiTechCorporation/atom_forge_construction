<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with(['investor', 'project', 'creator'])->latest()->paginate(15);
        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        $investors = Investor::all();
        $projects = Project::all();
        return view('investments.create', compact('investors', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'investor_id' => 'required|exists:investors,id',
            'project_id' => 'required|exists:projects,id',
            'investment_amount' => 'required|numeric|min:0',
            'investment_date' => 'required|date',
            'expected_return' => 'nullable|numeric|min:0',
            'profit_share' => 'nullable|numeric|min:0',
            'payout_cycle' => 'required|in:monthly,quarterly,end',
            'agreement' => 'nullable|file|mimes:pdf|max:2048',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('agreement')) {
            $path = $request->file('agreement')->store('agreements', 'public');
            $validated['agreement_file'] = $path;
        }

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';

        Investment::create($validated);

        return redirect()->route('investments.index')->with('success', 'Investment recorded and pending approval.');
    }

    public function approve(Investment $investment)
    {
        $investment->update(['status' => 'approved']);
        return back()->with('success', 'Investment approved.');
    }

    public function destroy(Investment $investment)
    {
        if ($investment->agreement_file) {
            Storage::disk('public')->delete($investment->agreement_file);
        }
        $investment->delete();
        return redirect()->route('investments.index')->with('success', 'Investment deleted.');
    }
}
