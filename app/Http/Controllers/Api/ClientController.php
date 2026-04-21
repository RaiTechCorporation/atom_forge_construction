<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ClientController extends Controller
{
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
