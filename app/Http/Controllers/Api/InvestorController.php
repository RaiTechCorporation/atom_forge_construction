<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class InvestorController extends Controller
{
    #[OA\Get(
        path: "/api/investor/dashboard",
        summary: "Get investor dashboard data",
        tags: ["Investor"],
        security: [["sanctum" => []]],
        responses: [
            new OA\Response(response: 200, description: "Successful operation"),
            new OA\Response(response: 401, description: "Unauthenticated"),
            new OA\Response(response: 404, description: "Investor profile not found")
        ]
    )]
    public function dashboard(Request $request)
    {
        $investor = $request->user()->investor;

        if (! $investor) {
            return response()->json(['message' => 'Investor profile not found'], 404);
        }

        $investments = Investment::where('investor_id', $investor->id)
            ->with('project')
            ->get();

        $stats = [
            'total_invested' => $investments->sum('investment_amount'),
            'total_projects' => $investments->pluck('project_id')->unique()->count(),
            'active_investments' => $investments->where('status', 'approved')->count(),
        ];

        return response()->json([
            'stats' => $stats,
            'investments' => $investments,
        ]);
    }
}
