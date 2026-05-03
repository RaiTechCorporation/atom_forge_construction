<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Labour;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AttendanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-attendance', only: ['index']),
            new Middleware('permission:manage-attendance', only: ['create', 'store']),
        ];
    }

    public function index(Request $request)
    {
        $query = Attendance::with(['labour', 'project', 'recorder']);

        if ($request->date) {
            $query->where('date', $request->date);
        }

        if ($request->shift) {
            $query->where('shift', $request->shift);
        }

        if ($request->project_id) {
            $query->where('project_id', $request->project_id);
        }

        $attendances = $query->orderBy('date', 'desc')
            ->orderBy('shift', 'asc')
            ->paginate(50);

        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }

        return view('attendance.index', compact('attendances', 'projects'));
    }

    public function create(Request $request)
    {
        $projects = Project::active()->get();
        if ($projects->isEmpty()) {
            $projects = Project::all();
        }

        $selectedProjectId = $request->project_id;
        $date = $request->date ?? date('Y-m-d');
        $shift = $request->shift ?? '1st Shift';

        $labours = Labour::all();

        // Get existing attendance for this project, date and shift
        $existingAttendance = [];
        if ($selectedProjectId) {
            $existingAttendance = Attendance::where('project_id', $selectedProjectId)
                ->where('date', $date)
                ->where('shift', $shift)
                ->get()
                ->keyBy('labour_id');
        }

        return view('attendance.create', compact('projects', 'labours', 'selectedProjectId', 'date', 'shift', 'existingAttendance'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'date' => 'required|date',
                'shift' => 'required|string',
                'attendance' => 'required|array',
                'attendance.*' => 'required|in:present,absent',
                'overtime_hours' => 'nullable|array',
                'overtime_hours.*' => 'nullable|numeric|min:0',
                'payment_amount' => 'nullable|array',
                'payment_amount.*' => 'nullable|numeric|min:0',
                'remark' => 'nullable|array',
                'remark.*' => 'nullable|string|max:255',
            ]);

            foreach ($request->attendance as $labourId => $status) {
                $overtime = $request->overtime_hours[$labourId] ?? 0;
                $payment = $request->payment_amount[$labourId] ?? 0;
                $remark = $request->remark[$labourId] ?? null;

                Attendance::updateOrCreate(
                    [
                        'project_id' => $request->project_id,
                        'labour_id' => $labourId,
                        'date' => $request->date,
                        'shift' => $request->shift,
                    ],
                    [
                        'status' => $status,
                        'overtime_hours' => $overtime,
                        'payment_amount' => $payment,
                        'remark' => $remark,
                        'recorded_by' => auth()->id(),
                        'recorded_at' => now(),
                    ]
                );
            }

            return redirect()->route('attendance.create', [
                'project_id' => $request->project_id,
                'date' => $request->date,
                'shift' => $request->shift,
            ])->with('success', 'Attendance recorded successfully.');
        } catch (\Exception $e) {
            \Log::error('Attendance Save Error: '.$e->getMessage());

            return redirect()->route('attendance.create', [
                'project_id' => $request->project_id,
                'date' => $request->date,
                'shift' => $request->shift,
            ])->withErrors(['error' => 'Failed to save attendance: '.$e->getMessage()])->withInput();
        }
    }
}
