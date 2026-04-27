<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialTransactionRequest;
use App\Http\Requests\UpdateMaterialTransactionRequest;
use App\Models\Material;
use App\Models\MaterialTransaction;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class MaterialTransactionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-inventory', only: ['index', 'show']),
            new Middleware('permission:add-inventory', only: ['create', 'store']),
            new Middleware('permission:edit-inventory', only: ['edit', 'update']),
            new Middleware('permission:delete-inventory', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MaterialTransaction::with(['project', 'material', 'vendor'])->latest();

        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->has('material_id')) {
            $query->where('material_id', $request->material_id);
        }

        $transactions = $query->paginate(15);
        $projects = Project::all();
        $materials = Material::all();

        return view('material_transactions.index', compact('transactions', 'projects', 'materials'));
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
        $materials = Material::all();
        $vendors = Vendor::all();
        $selectedProjectId = $request->project_id;
        $selectedMaterialId = $request->material_id;
        $transaction = new MaterialTransaction;

        return view('material_transactions.create', compact('projects', 'materials', 'vendors', 'selectedProjectId', 'selectedMaterialId', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialTransactionRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('bill')) {
            $path = $request->file('bill')->store('material_bills', 'public');
            $validated['bill_path'] = $path;
        }

        MaterialTransaction::create($validated);

        return redirect()->route('material_transactions.index')
            ->with('success', 'Material transaction recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialTransaction $materialTransaction)
    {
        return view('material_transactions.show', compact('materialTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialTransaction $materialTransaction)
    {
        $projects = Project::all();
        $materials = Material::all();
        $vendors = Vendor::all();

        return view('material_transactions.edit', compact('materialTransaction', 'projects', 'materials', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialTransactionRequest $request, MaterialTransaction $materialTransaction)
    {
        $validated = $request->validated();

        if ($request->hasFile('bill')) {
            if ($materialTransaction->bill_path) {
                Storage::disk('public')->delete($materialTransaction->bill_path);
            }
            $path = $request->file('bill')->store('material_bills', 'public');
            $validated['bill_path'] = $path;
        }

        $materialTransaction->update($validated);

        return redirect()->route('material_transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialTransaction $materialTransaction)
    {
        if ($materialTransaction->bill_path) {
            Storage::disk('public')->delete($materialTransaction->bill_path);
        }
        $materialTransaction->delete();

        return redirect()->route('material_transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
