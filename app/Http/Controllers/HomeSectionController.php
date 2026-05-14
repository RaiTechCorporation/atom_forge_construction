<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeSectionController extends Controller implements HasMiddleware
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
        $homeSections = HomeSection::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.home_sections.index', compact('homeSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('home-sections', $request->file('image'));
            $validated['image'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        HomeSection::create($validated);

        return redirect()->route('home-sections.index')->with('success', 'Home section created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeSection $homeSection)
    {
        return view('admin.home_sections.edit', compact('homeSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeSection $homeSection)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($homeSection->image) {
                $oldPath = Str::after($homeSection->image, 'storage/');
                Storage::disk('public')->delete($oldPath);
            }
            $path = Storage::disk('public')->putFile('home-sections', $request->file('image'));
            $validated['image'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        $homeSection->update($validated);

        return redirect()->route('home-sections.index')->with('success', 'Home section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeSection $homeSection)
    {
        if ($homeSection->image) {
            $path = Str::after($homeSection->image, 'storage/');
            Storage::disk('public')->delete($path);
        }
        
        $homeSection->delete();

        return redirect()->route('home-sections.index')->with('success', 'Home section deleted successfully.');
    }
}
