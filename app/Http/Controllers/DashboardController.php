<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\Project;
use App\Models\Investor;
use App\Models\Expense;
use App\Models\Investment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $data = [];

        if ($user->isAdmin()) {
            $data['totalProjects'] = Project::count();
            $data['totalLabours'] = Labour::count();
            $data['totalInvestors'] = Investor::count();
            $data['totalExpenses'] = Expense::sum('amount');
            $data['totalInvestments'] = Investment::where('status', 'Approved')->sum('investment_amount');
            
            // Recent Projects
            $data['recentProjects'] = Project::latest()->take(5)->get();
            $data['allProjects'] = Project::orderBy('name')->get();

            // Workforce Intelligence
            $filter = $request->get('filter', 'day');
            $projectId = $request->get('project_id');
            $startDate = null;
            $endDate = null;

            if ($filter == 'day') {
                $startDate = Carbon::today();
                $endDate = Carbon::today();
            } elseif ($filter == 'week') {
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
            } elseif ($filter == 'month') {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
            } elseif ($filter == 'custom') {
                $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : Carbon::today();
                $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::today();
            }

            $attendanceQuery = Attendance::with(['labour', 'project.siteManager', 'recorder']);

            if ($projectId) {
                $attendanceQuery->where('project_id', $projectId);
            }

            if ($startDate && $endDate) {
                $attendanceQuery->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()]);
            }

            $data['attendances'] = $attendanceQuery->latest('date')->get();
            $data['totalWorkingLabours'] = $data['attendances']->where('status', 'Present')->unique('labour_id')->count();
            $data['filter'] = $filter;
            $data['projectId'] = $projectId;
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;

        } elseif ($user->isSiteSupervisor()) {
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
