<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Material;
use App\Models\Project;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MaterialController extends Controller implements HasMiddleware
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
    public function index()
    {
        $materials = Material::with(['transactions', 'project'])->latest()->paginate(15);

        // Calculate stock for each material
        foreach ($materials as $material) {
            $in = $material->transactions->whereIn('type', ['purchase', 'transfer_in'])->sum('quantity');
            $out = $material->transactions->whereIn('type', ['transfer_out', 'consumption'])->sum('quantity');
            $material->current_stock = $in - $out;
        }

        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = new Material;
        $projects = Project::active()->get();
        $units = [
            'Bags' => 'Bags (e.g. Cement)',
            'CFT' => 'CFT (e.g. Sand)',
            'KG' => 'KG (e.g. Steel)',
            'Nos' => 'Nos (e.g. Bricks)',
            'Liters' => 'Liters (e.g. Paint)',
            'Sq Ft' => 'Sq Ft (e.g. Area)',
            'm³' => 'm³ (e.g. Volume)',
        ];

        return view('materials.create', compact('material', 'projects', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        Material::create($request->validated());

        return redirect()->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        $material->load('transactions.project');

        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $projects = Project::active()->get();
        $units = [
            'Bags' => 'Bags (e.g. Cement)',
            'CFT' => 'CFT (e.g. Sand)',
            'KG' => 'KG (e.g. Steel)',
            'Nos' => 'Nos (e.g. Bricks)',
            'Liters' => 'Liters (e.g. Paint)',
            'Sq Ft' => 'Sq Ft (e.g. Area)',
            'm³' => 'm³ (e.g. Volume)',
        ];

        return view('materials.edit', compact('material', 'projects', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->update($request->validated());

        return redirect()->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}
