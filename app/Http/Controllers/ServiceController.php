<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ServiceController extends Controller implements HasMiddleware
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
        $services = Service::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('services', $request->file('image'));
            $validated['image'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->image && !Str::startsWith($service->image, 'http')) {
                $oldPath = Str::after($service->image, 'storage/');
                Storage::disk('public')->delete($oldPath);
            }
            $path = Storage::disk('public')->putFile('services', $request->file('image'));
            $validated['image'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features']);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->image && !Str::startsWith($service->image, 'http')) {
            $path = Str::after($service->image, 'storage/');
            Storage::disk('public')->delete($path);
        }
        
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
