<?php

namespace App\Http\Controllers;

use App\Models\ProjectUpdate;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectUpdateController extends Controller
{
    public function index()
    {
        $updates = ProjectUpdate::with('project')->latest()->paginate(15);
        return view('project_updates.index', compact('updates'));
    }

    public function create()
    {
        $projects = Project::active()->get();
        $update = new ProjectUpdate();
        return view('project_updates.create', compact('projects', 'update'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
            'description' => 'required|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('project_updates', 'public');
            }
        }

        $validated['images'] = $imagePaths;

        ProjectUpdate::create($validated);

        return redirect()->route('project-updates.index')->with('success', 'Project update recorded.');
    }

    public function destroy(ProjectUpdate $projectUpdate)
    {
        if ($projectUpdate->images) {
            foreach ($projectUpdate->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        $projectUpdate->delete();
        return redirect()->route('project-updates.index')->with('success', 'Project update deleted.');
    }
}
