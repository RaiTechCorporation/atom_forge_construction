<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Labour;
use App\Models\Project;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }
        
        $selectedProjectId = $request->project_id;
        $date = $request->date ?? date('Y-m-d');
        
        $labours = Labour::all();
        
        // Get existing attendance for this project and date
        $existingAttendance = [];
        if ($selectedProjectId) {
            $existingAttendance = Attendance::where('project_id', $selectedProjectId)
                ->where('date', $date)
                ->pluck('status', 'labour_id')
                ->toArray();
        }

        return view('attendance.create', compact('projects', 'labours', 'selectedProjectId', 'date', 'existingAttendance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
        ]);

        foreach ($request->attendance as $labourId => $status) {
            Attendance::updateOrCreate(
                [
                    'project_id' => $request->project_id,
                    'labour_id' => $labourId,
                    'date' => $request->date,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }
}
