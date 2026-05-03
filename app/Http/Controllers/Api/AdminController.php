<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\Material;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use OpenApi\Attributes as OA;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-dashboard', only: ['dashboardStats']),
            new Middleware('permission:view-users', only: ['getUsers']),
            new Middleware('permission:create-users', only: ['storeUser']),
            new Middleware('permission:edit-users', only: ['updateUser', 'updateUserRole']),
            new Middleware('permission:delete-users', only: ['deleteUser']),
            new Middleware('permission:view-roles', only: ['getRoles']),
        ];
    }

    #[OA\Get(
        path: "/api/admin/roles",
        summary: "Get list of all active roles",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden")
        ]
    )]
    public function getRoles()
    {
        return response()->json(Role::where('is_active', true)->get());
    }

    #[OA\Get(
        path: "/api/admin/dashboard-stats",
        summary: "Get admin dashboard stats",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden")
        ]
    )]
    public function dashboardStats()
    {
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'total_revenue' => Project::sum('total_budget'),
            'investor_funds' => Investment::sum('investment_amount'),
            'total_expenses' => Expense::sum('amount'),
            'material_usage' => Material::count(),
            'labor_costs' => Expense::where('category', 'labor')->sum('amount'),
        ];

        // Profit/Loss per project (Sample calculation)
        $projects_performance = Project::select('id', 'name', 'total_budget')
            ->withSum('expenses', 'amount')
            ->get()
            ->map(function ($project) {
                return [
                    'name' => $project->name,
                    'budget' => $project->total_budget,
                    'expenses' => $project->expenses_sum_amount ?? 0,
                    'profit' => $project->total_budget - ($project->expenses_sum_amount ?? 0),
                ];
            });

        return response()->json([
            'stats' => $stats,
            'projects_performance' => $projects_performance,
        ]);
    }

    #[OA\Get(
        path: "/api/admin/users",
        summary: "Get list of all users",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 403, description: "Forbidden")
        ]
    )]
    public function getUsers()
    {
        return response()->json(User::all());
    }

    #[OA\Post(
        path: "/api/admin/users",
        summary: "Create a new user",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["first_name", "last_name", "email", "password", "password_confirmation", "role"],
                properties: [
                    new OA\Property(property: "first_name", type: "string", example: "John"),
                    new OA\Property(property: "last_name", type: "string", example: "Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "john@example.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "password123"),
                    new OA\Property(property: "password_confirmation", type: "string", format: "password", example: "password123"),
                    new OA\Property(property: "role", type: "string", enum: ["super_admin", "admin_staff", "client", "investor"], example: "admin_staff"),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "User created successfully"),
            new OA\Response(response: 422, description: "Validation error")
        ]
    )]
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,slug',
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip' => $request->zip,
            'status' => $request->status ?? true,
        ]);

        return response()->json($user, 201);
    }

    #[OA\Put(
        path: "/api/admin/users/{user}",
        summary: "Update user details",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "user", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "first_name", type: "string"),
                    new OA\Property(property: "last_name", type: "string"),
                    new OA\Property(property: "email", type: "string"),
                    new OA\Property(property: "role", type: "string", enum: ["super_admin", "admin_staff", "client", "investor"]),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "User updated successfully"),
            new OA\Response(response: 404, description: "User not found")
        ]
    )]
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,slug',
        ]);

        $data = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip' => $request->zip,
            'status' => $request->status ?? true,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return response()->json($user);
    }

    #[OA\Delete(
        path: "/api/admin/users/{user}",
        summary: "Delete user",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "user", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 204, description: "User deleted successfully"),
            new OA\Response(response: 404, description: "User not found")
        ]
    )]
    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    #[OA\Patch(
        path: "/api/admin/users/{user}/role",
        summary: "Update user role",
        tags: ["Admin"],
        security: [["sanctum" => []]],
        parameters: [
            new OA\Parameter(name: "user", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["role"],
                properties: [
                    new OA\Property(property: "role", type: "string", enum: ["super_admin", "admin_staff", "client", "investor"]),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Role updated successfully"),
            new OA\Response(response: 404, description: "User not found")
        ]
    )]
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,slug',
        ]);

        $user->update(['role' => $request->role]);

        return response()->json(['message' => 'User role updated successfully']);
    }
}
