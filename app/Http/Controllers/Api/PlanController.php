<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConstructionPlan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use OpenApi\Attributes as OA;

class PlanController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-settings', only: ['index', 'show']),
            new Middleware('permission:update-settings', only: ['store', 'update', 'destroy']),
        ];
    }

    #[OA\Get(
        path: "/api/admin/plans",
        summary: "Get all construction plans",
        tags: ["Plans"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated")
        ]
    )]
    public function index()
    {
        return response()->json(ConstructionPlan::all());
    }

    #[OA\Post(
        path: "/api/admin/plans",
        summary: "Create a new construction plan",
        tags: ["Plans"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "price_per_sqft"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Premium Plan"),
                    new OA\Property(property: "price_per_sqft", type: "number", example: 3500),
                    new OA\Property(property: "features", type: "array", items: new OA\Items(type: "string")),
                    new OA\Property(property: "is_active", type: "boolean", example: true),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Plan created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
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

    #[OA\Get(
        path: "/api/admin/plans/{plan}",
        summary: "Get plan details",
        tags: ["Plans"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "plan", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 404, description: "Plan not found")
        ]
    )]
    public function show(ConstructionPlan $plan)
    {
        return response()->json($plan);
    }

    #[OA\Put(
        path: "/api/admin/plans/{plan}",
        summary: "Update construction plan",
        tags: ["Plans"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "plan", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "name", type: "string"),
                    new OA\Property(property: "price_per_sqft", type: "number"),
                    new OA\Property(property: "is_active", type: "boolean"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Plan updated successfully"),
            new OA\Response(response: 404, description: "Plan not found")
        ]
    )]
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

    #[OA\Delete(
        path: "/api/admin/plans/{plan}",
        summary: "Delete construction plan",
        tags: ["Plans"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "plan", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 204, description: "Plan deleted successfully"),
            new OA\Response(response: 404, description: "Plan not found")
        ]
    )]
    public function destroy(ConstructionPlan $plan)
    {
        $plan->delete();

        return response()->json(null, 204);
    }
}
