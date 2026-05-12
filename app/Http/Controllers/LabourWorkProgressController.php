<?php

namespace App\Http\Controllers;

use App\Models\SiteManager;
use App\Models\LabourWorkProgress;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabourWorkProgressController extends Controller
{
    public function index(Request $request)
    {
        $siteManagers = SiteManager::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();

        $query = LabourWorkProgress::with(['siteManager', 'project'])
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        $project = null;
        if ($request->filled('project_id')) {
            $project = Project::findOrFail($request->project_id);
            $query->where('project_id', $project->id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('site_manager_id')) {
            $query->where('site_manager_id', $request->site_manager_id);
        }

        $progresses = $query->get()->groupBy('date');

        return view('labour.progress.index', compact('progresses', 'siteManagers', 'projects', 'project'));
    }

    public function store(Request $request, SiteManager $siteManager)
    {
        try {
            $request->validate([
                'project_id' => 'required|exists:projects,id',
                'date' => 'required|date',
                'shift' => 'required|string|in:1st Shift,2nd Shift,Overtime',
                'images' => 'nullable|array|max:10',
                'images.*' => 'image|max:10240', // 10MB max per image
                'videos' => 'nullable|array|max:5',
                'videos.*' => 'mimes:mp4,mov,avi,wmv,quicktime|max:51200', // 50MB max per video
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
            ]);

            $date = $request->date;
            $shift = $request->shift;
            $projectId = $request->project_id;
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = Storage::disk('public')->putFile('labour_progress/images', $image);
                    LabourWorkProgress::create([
                        'site_manager_id' => $siteManager->id,
                        'project_id' => $projectId,
                        'date' => $date,
                        'shift' => $shift,
                        'file_path' => $path,
                        'file_type' => 'image',
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ]);
                }
            }

            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $video) {
                    $path = Storage::disk('public')->putFile('labour_progress/videos', $video);
                    LabourWorkProgress::create([
                        'site_manager_id' => $siteManager->id,
                        'project_id' => $projectId,
                        'date' => $date,
                        'shift' => $shift,
                        'file_path' => $path,
                        'file_type' => 'video',
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ]);
                }
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Progress uploaded successfully.'
                ]);
            }

            return back()->with('success', 'Progress uploaded successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Upload failed: ' . $e->getMessage(), [
                'site_manager_id' => $siteManager->id,
                'project_id' => $request->project_id,
                'exception' => $e
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Upload failed: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Upload failed: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(LabourWorkProgress $progress)
    {
        if (auth()->user()->isSiteSupervisor()) {
            return back()->with('error', 'Site Supervisors are not allowed to delete media files.');
        }

        Storage::disk('public')->delete($progress->file_path);
        $progress->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
