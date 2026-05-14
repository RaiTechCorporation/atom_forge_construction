<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TestimonialController extends Controller implements HasMiddleware
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
        $testimonials = Testimonial::orderBy('order')->orderBy('created_at', 'desc')->get();
        $sectionSettings = WebsiteContent::where('group', 'testimonials')->get();
        return view('admin.testimonials.index', compact('testimonials', 'sectionSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('testimonials', $request->file('image'));
            $validated['image_url'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        Testimonial::create($validated);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image_url) {
                $oldPath = Str::after($testimonial->image_url, 'storage/');
                Storage::disk('public')->delete($oldPath);
            }
            $path = Storage::disk('public')->putFile('testimonials', $request->file('image'));
            $validated['image_url'] = asset('storage/' . $path);
        }

        $validated['is_active'] = $request->has('is_active');
        
        $testimonial->update($validated);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image_url) {
            $path = Str::after($testimonial->image_url, 'storage/');
            Storage::disk('public')->delete($path);
        }
        
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
