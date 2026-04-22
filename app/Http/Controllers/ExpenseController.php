<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Project;
use App\Models\Vendor;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Expense::with(['project', 'vendor'])->latest();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $expenses = $query->paginate(15);
        $projects = Project::all();

        return view('expenses.index', compact('expenses', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }
        $vendors = Vendor::all();
        $selectedProjectId = $request->project_id;
        $expense = new Expense();

        return view('expenses.create', compact('projects', 'vendors', 'selectedProjectId', 'expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('bill')) {
            $path = $request->file('bill')->store('bills', 'public');
            $validated['bill_path'] = $path;
        }

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $projects = Project::all();
        $vendors = Vendor::all();
        return view('expenses.edit', compact('expense', 'projects', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $validated = $request->validated();

        if ($request->hasFile('bill')) {
            // Delete old bill if exists
            if ($expense->bill_path) {
                Storage::disk('public')->delete($expense->bill_path);
            }
            $path = $request->file('bill')->store('bills', 'public');
            $validated['bill_path'] = $path;
        }

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if ($expense->bill_path) {
            Storage::disk('public')->delete($expense->bill_path);
        }
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
