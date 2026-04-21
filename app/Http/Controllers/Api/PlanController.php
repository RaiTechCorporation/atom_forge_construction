<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConstructionPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(ConstructionPlan::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_sqft' => 'required|numeric',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $plan = ConstructionPlan::create($validated);

        return response()->json($plan, 201);
    }

    public function show(ConstructionPlan $plan)
    {
        return response()->json($plan);
    }

    public function update(Request $request, ConstructionPlan $plan)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price_per_sqft' => 'sometimes|numeric',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $plan->update($validated);

        return response()->json($plan);
    }

    public function destroy(ConstructionPlan $plan)
    {
        $plan->delete();
        return response()->json(null, 204);
    }
}
