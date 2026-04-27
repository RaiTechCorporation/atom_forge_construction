<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\LabourWorkProgress;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabourWorkProgressController extends Controller
{
    public function index(Request $request)
    {
        $labours = Labour::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        if (! $request->filled('project_id')) {
            return view('labour.progress.projects', compact('projects', 'labours'));
        }

        $project = Project::findOrFail($request->project_id);
        $query = LabourWorkProgress::with(['labour', 'project'])
            ->where('project_id', $project->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('labour_id')) {
            $query->where('labour_id', $request->labour_id);
        }

        $progresses = $query->get()->groupBy('date');

        return view('labour.progress.index', compact('progresses', 'labours', 'projects', 'project'));
    }

    public function store(Request $request, Labour $labour)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'shift' => 'required|string|in:1st Shift,2nd Shift,Overtime',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:10240', // 10MB max per image
            'videos' => 'nullable|array|max:5',
            'videos.*' => 'mimes:mp4,mov,avi,wmv|max:51200', // 50MB max per video
        ]);

        $date = $request->date;
        $shift = $request->shift;
        $projectId = $request->project_id;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('labour_progress/images', 'public');
                LabourWorkProgress::create([
                    'labour_id' => $labour->id,
                    'project_id' => $projectId,
                    'date' => $date,
                    'shift' => $shift,
                    'file_path' => $path,
                    'file_type' => 'image',
                ]);
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('labour_progress/videos', 'public');
                LabourWorkProgress::create([
                    'labour_id' => $labour->id,
                    'project_id' => $projectId,
                    'date' => $date,
                    'shift' => $shift,
                    'file_path' => $path,
                    'file_type' => 'video',
                ]);
            }
        }

        return back()->with('success', 'Progress uploaded successfully.');
    }

    public function destroy(LabourWorkProgress $progress)
    {
        Storage::disk('public')->delete($progress->file_path);
        $progress->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
