<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class ClientController extends Controller
{
    #[OA\Get(
        path: "/api/client/dashboard",
        summary: "Get client dashboard data",
        tags: ["Client"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated")
        ]
    )]
    public function dashboard(Request $request)
    {
        $projects = Project::where('client_id', $request->user()->id)
            ->with(['projectUpdates', 'expenses'])
            ->get();

        return response()->json([
            'projects' => $projects,
        ]);
    }
}
