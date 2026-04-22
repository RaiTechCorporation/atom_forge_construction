<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $fileFields = [
            'design_documents', 
            'contracts_agreements', 
            'permits_licenses', 
            'safety_documents', 
            'blueprints_layouts',
            'site_media',
            'progress_photos',
            'inspection_reports'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $paths = [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('projects/documents', 'public');
                    $paths[] = $path;
                }
                $validated[$field] = $paths;
            }
        }

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['expenses', 'attendances.labour', 'materialTransactions.material', 'investments.investor', 'payouts.investor']);
        
        $totalExpenses = $project->expenses->sum('amount');
        $totalInvested = $project->investments()->where('status', 'approved')->sum('investment_amount');
        $budgetRemaining = $project->total_budget - $totalExpenses;
        $totalPayouts = $project->payouts()->where('status', 'approved')->sum('amount_paid');

        return view('projects.show', compact('project', 'totalExpenses', 'budgetRemaining', 'totalInvested', 'totalPayouts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $fileFields = [
            'design_documents', 
            'contracts_agreements', 
            'permits_licenses', 
            'safety_documents', 
            'blueprints_layouts',
            'site_media',
            'progress_photos',
            'inspection_reports'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $paths = $project->$field ?? [];
                foreach ($request->file($field) as $file) {
                    $path = $file->store('projects/documents', 'public');
                    $paths[] = $path;
                }
                $validated[$field] = $paths;
            }
        }

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
