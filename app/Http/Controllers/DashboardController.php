<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->isSiteSupervisor()) {
            $data['totalLabours'] = Labour::count();
            
            $siteManager = $user->siteManager;
            $data['supervisorLabours'] = 0;
            
            $projectQuery = Project::withCount('labours');

            if ($siteManager && $siteManager->project_id) {
                $data['supervisorLabours'] = Labour::where('project_id', $siteManager->project_id)->count();
                $projectQuery->where('id', $siteManager->project_id);
            } else {
                $projectQuery->where('id', 0);
            }

            $data['projectLabours'] = $projectQuery->get();
        }

        return view('dashboard', $data);
    }
}
