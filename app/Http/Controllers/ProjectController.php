<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProjectController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-projects', only: ['index', 'show']),
            new Middleware('permission:create-projects', only: ['create', 'store']),
            new Middleware('permission:edit-projects', only: ['edit', 'update']),
            new Middleware('permission:delete-projects', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Project::query();

        if (auth()->user()->isSiteSupervisor()) {
            $siteManager = auth()->user()->siteManager;
            if ($siteManager && $siteManager->project_id) {
                $query->where('id', $siteManager->project_id);
            } else {
                $query->where('id', 0);
            }
        }

        $projects = $query->latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project;

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
            'inspection_reports',
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

        $project = Project::create($validated);

        if ($request->has('payment_phases')) {
            foreach ($request->payment_phases as $phase) {
                $project->paymentPhases()->create($phase);
            }
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorizeProjectAccess($project);

        $project->load(['expenses', 'attendances.labour', 'materialTransactions.material', 'investments.investor', 'payouts.investor', 'payments', 'paymentPhases']);

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
        $this->authorizeProjectAccess($project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorizeProjectAccess($project);
        $validated = $request->validated();

        $fileFields = [
            'design_documents',
            'contracts_agreements',
            'permits_licenses',
            'safety_documents',
            'blueprints_layouts',
            'site_media',
            'progress_photos',
            'inspection_reports',
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

        if ($request->has('payment_phases')) {
            $project->paymentPhases()->delete();
            foreach ($request->payment_phases as $phase) {
                $project->paymentPhases()->create($phase);
            }
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorizeProjectAccess($project);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    protected function authorizeProjectAccess(Project $project)
    {
        if (auth()->user()->isSiteSupervisor()) {
            $siteManager = auth()->user()->siteManager;
            if (!$siteManager || $siteManager->project_id !== $project->id) {
                abort(403, 'Unauthorized access to this project.');
            }
        }
    }
}
