<?php

namespace App\Http\Controllers;

use App\Models\Payout;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::with(['investor', 'project', 'creator'])->latest()->paginate(15);
        return view('payouts.index', compact('payouts'));
    }

    public function create()
    {
        $investors = Investor::all();
        $projects = Project::all();
        return view('payouts.create', compact('investors', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'investor_id' => 'required|exists:investors,id',
            'project_id' => 'required|exists:projects,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';

        Payout::create($validated);

        return redirect()->route('payouts.index')->with('success', 'Payout recorded and pending approval.');
    }

    public function approve(Payout $payout)
    {
        $payout->update(['status' => 'approved']);
        return back()->with('success', 'Payout approved.');
    }

    public function destroy(Payout $payout)
    {
        $payout->delete();
        return redirect()->route('payouts.index')->with('success', 'Payout deleted.');
    }
}
