<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPayment;
use Illuminate\Http\Request;

class ProjectPaymentController extends Controller
{
    public function index()
    {
        $payments = ProjectPayment::with(['project', 'project.client'])->orderBy('payment_date', 'desc')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        $projects = Project::orderBy('name')->get();
        $selected_project_id = $request->get('project_id');
        return view('admin.payments.create', compact('projects', 'selected_project_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|string',
            'reference_no' => 'nullable|string',
            'note' => 'nullable|string',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('payments/proofs', 'public');
            $validated['proof_image'] = $path;
        }

        ProjectPayment::create($validated);

        return redirect()->route('project-payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function show(ProjectPayment $projectPayment)
    {
        return view('admin.payments.show', compact('projectPayment'));
    }

    public function receipt(ProjectPayment $projectPayment)
    {
        return view('admin.payments.receipt', compact('projectPayment'));
    }

    public function invoice(ProjectPayment $projectPayment)
    {
        // For project payments, an invoice might be for the whole project or a milestone.
        // Assuming we want to show the current payment as part of the project billing.
        return view('admin.payments.invoice', compact('projectPayment'));
    }

    public function history()
    {
        $payments = ProjectPayment::with(['project', 'project.client'])->orderBy('payment_date', 'desc')->get();
        return view('admin.payments.history', compact('payments'));
    }

    public function balances()
    {
        $projects = Project::with(['client'])->get();
        return view('admin.payments.balances', compact('projects'));
    }

    public function destroy(ProjectPayment $projectPayment)
    {
        $projectPayment->delete();
        return redirect()->back()->with('success', 'Payment record deleted successfully.');
    }
}
