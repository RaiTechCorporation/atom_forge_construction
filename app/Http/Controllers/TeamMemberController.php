<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TeamMemberController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('two-factor'),
            new Middleware(function ($request, $next) {
                if (auth()->check() && auth()->user()->isSiteSupervisor()) {
                    abort(403, 'Unauthorized action.');
                }
                return $next($request);
            }),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->orderBy('created_at', 'desc')->get();
        $sectionSettings = WebsiteContent::where('group', 'team')
            ->where('key', 'not like', 'team_member_%')
            ->get();
        return view('admin.team_members.index', compact('teamMembers', 'sectionSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team_members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('team', $request->file('image'));
            $validated['image_url'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        TeamMember::create($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team_members.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teamMember->image_url) {
                $oldPath = Str::after($teamMember->image_url, 'storage/');
                Storage::disk('public')->delete($oldPath);
            }
            $path = Storage::disk('public')->putFile('team', $request->file('image'));
            $validated['image_url'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        $teamMember->update($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image_url) {
            $path = Str::after($teamMember->image_url, 'storage/');
            Storage::disk('public')->delete($path);
        }
        
        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team member removed successfully.');
    }
}
