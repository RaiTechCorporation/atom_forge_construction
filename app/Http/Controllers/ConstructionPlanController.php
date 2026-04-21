<?php

namespace App\Http\Controllers;

use App\Models\ConstructionPlan;
use Illuminate\Http\Request;

class ConstructionPlanController extends Controller
{
    public function index()
    {
        $plans = ConstructionPlan::all();
        return view('construction_plans.index', compact('plans'));
    }

    public function create()
    {
        return view('construction_plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_sqft' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (isset($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_active'] = $request->has('is_active');

        ConstructionPlan::create($validated);

        return redirect()->route('construction-plans.index')
            ->with('success', 'Plan created successfully.');
    }

    public function edit(ConstructionPlan $construction_plan)
    {
        return view('construction_plans.edit', compact('construction_plan'));
    }

    public function update(Request $request, ConstructionPlan $construction_plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_sqft' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (isset($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        } else {
            $validated['features'] = [];
        }

        $validated['is_active'] = $request->has('is_active');

        $construction_plan->update($validated);

        return redirect()->route('construction-plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    public function destroy(ConstructionPlan $construction_plan)
    {
        $construction_plan->delete();

        return redirect()->route('construction-plans.index')
            ->with('success', 'Plan deleted successfully.');
    }
}
