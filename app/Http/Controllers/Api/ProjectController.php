<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use OpenApi\Attributes as OA;

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

    #[OA\Get(
        path: "/api/admin/projects",
        summary: "Get list of projects",
        tags: ["Projects"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden")
        ]
    )]
    public function index()
    {
        return response()->json(Project::with('client')->latest()->get());
    }

    #[OA\Post(
        path: "/api/admin/projects",
        summary: "Create a new project",
        tags: ["Projects"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "location", "project_type", "cost_per_sqft", "total_area_sqft", "start_date", "total_budget", "status", "stage"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Modern Villa"),
                    new OA\Property(property: "location", type: "string", example: "Downtown"),
                    new OA\Property(property: "project_type", type: "string", example: "Residential"),
                    new OA\Property(property: "cost_per_sqft", type: "number", example: 2500),
                    new OA\Property(property: "total_area_sqft", type: "number", example: 1500),
                    new OA\Property(property: "start_date", type: "string", format: "date", example: "2024-05-01"),
                    new OA\Property(property: "total_budget", type: "number", example: 3750000),
                    new OA\Property(property: "status", type: "string", enum: ["active", "completed", "on_hold"], example: "active"),
                    new OA\Property(property: "stage", type: "string", example: "Planning"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Project created successfully"),
            new OA\Response(response: 400, description: "Bad Request"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden")
        ]
    )]
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

    #[OA\Get(
        path: "/api/admin/projects/{project}",
        summary: "Get project details",
        tags: ["Projects"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "project", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 404, description: "Project not found")
        ]
    )]
    public function show(Project $project)
    {
        return response()->json($project->load(['expenses', 'investments.investor.user', 'projectUpdates']));
    }

    #[OA\Put(
        path: "/api/admin/projects/{project}",
        summary: "Update an existing project",
        tags: ["Projects"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "project", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string"),
                    new OA\Property(property: "status", type: "string", enum: ["active", "completed", "on_hold"]),
                    new OA\Property(property: "stage", type: "string"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Project updated successfully"),
            new OA\Response(response: 404, description: "Project not found")
        ]
    )]
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

    #[OA\Delete(
        path: "/api/admin/projects/{project}",
        summary: "Delete a project",
        tags: ["Projects"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "project", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 204, description: "Project deleted successfully"),
            new OA\Response(response: 404, description: "Project not found")
        ]
    )]
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
