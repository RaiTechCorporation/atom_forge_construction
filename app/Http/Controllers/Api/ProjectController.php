<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProjectController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-projects', only: ['index', 'show']),
            new Middleware('permission:create-projects', only: ['store']),
            new Middleware('permission:edit-projects', only: ['update']),
            new Middleware('permission:delete-projects', only: ['destroy']),
        ];
    }

    public function index()
    {
        return response()->json(Project::with('client')->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'location' => 'required|string',
            'project_type' => 'required|string',
            'cost_per_sqft' => 'required|numeric',
            'total_area_sqft' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'total_budget' => 'required|numeric',
            'status' => 'required|in:active,completed,on_hold',
            'stage' => 'required|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return response()->json($project->load(['expenses', 'investments.investor.user', 'projectUpdates']));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'location' => 'sometimes|string',
            'project_type' => 'sometimes|string',
            'cost_per_sqft' => 'sometimes|numeric',
            'total_area_sqft' => 'sometimes|numeric',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date',
            'total_budget' => 'sometimes|numeric',
            'status' => 'sometimes|in:active,completed,on_hold',
            'stage' => 'sometimes|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
