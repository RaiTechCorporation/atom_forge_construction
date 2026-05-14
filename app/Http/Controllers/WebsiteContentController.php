<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WebsiteContentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-media', only: ['index']),
            new Middleware('permission:upload-media', only: ['update', 'addProject']),
        ];
    }

    public function addProject(Request $request)
    {
        // Find the highest existing project index
        $highestIndex = WebsiteContent::where('key', 'like', 'project_%_name')
            ->get()
            ->map(function ($item) {
                preg_match('/project_(\d+)_name/', $item->key, $matches);
                return (int) ($matches[1] ?? 0);
            })
            ->max() ?: 0;

        $newIndex = $highestIndex + 1;

        $fields = [
            ['key' => "project_{$newIndex}_name", 'label' => "Project {$newIndex} Name", 'type' => 'text', 'value' => 'New Project'],
            ['key' => "project_{$newIndex}_type", 'label' => "Project {$newIndex} Type", 'type' => 'text', 'value' => 'Residential'],
            ['key' => "project_{$newIndex}_location", 'label' => "Project {$newIndex} Location", 'type' => 'text', 'value' => 'Location'],
            ['key' => "project_{$newIndex}_description", 'label' => "Project {$newIndex} Description", 'type' => 'textarea', 'value' => 'Description'],
            ['key' => "project_{$newIndex}_image", 'label' => "Project {$newIndex} Image", 'type' => 'image', 'value' => ''],
        ];

        foreach ($fields as $field) {
            WebsiteContent::create([
                'group' => 'projects',
                'key' => $field['key'],
                'label' => $field['label'],
                'type' => $field['type'],
                'value' => $field['value'],
            ]);
        }

        return redirect()->route('website-content.index', ['group' => 'projects'])
            ->with('success', 'New project slot added successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedGroup = $request->query('group');

        $query = WebsiteContent::query();
        if ($selectedGroup) {
            $query->where('group', $selectedGroup);
        }

        $contents = $query->get()->groupBy('group');

        $homeSections = collect();
        if ($selectedGroup === 'home' || !$selectedGroup) {
            $homeSections = HomeSection::orderBy('order')->get();
        }

        // If empty group requested, fall back to all
        if ($contents->isEmpty() && $selectedGroup) {
            $contents = WebsiteContent::all()->groupBy('group');
            $selectedGroup = null;
            $homeSections = HomeSection::orderBy('order')->get();
        }

        return view('admin.website_content.index', compact('contents', 'selectedGroup', 'homeSections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'contents' => 'nullable|array',
            'contents.*' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Handle regular text content
        if ($request->has('contents')) {
            foreach ($request->input('contents') as $key => $value) {
                WebsiteContent::where('key', $key)->update(['value' => $value]);
            }
        }

        // Handle file uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                $path = Storage::disk('public')->putFile('website-content', $file);
                $url = asset('storage/'.$path);
                WebsiteContent::where('key', $key)->update(['value' => $url]);
            }
        }

        $group = $request->input('group');

        return redirect()->route('website-content.index', ['group' => $group])
            ->with('success', 'Website content updated successfully.');
    }
}
