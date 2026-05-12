<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
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
            new Middleware('permission:upload-media', only: ['update']),
        ];
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

        // If empty group requested, fall back to all
        if ($contents->isEmpty() && $selectedGroup) {
            $contents = WebsiteContent::all()->groupBy('group');
            $selectedGroup = null;
        }

        return view('admin.website_content.index', compact('contents', 'selectedGroup'));
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
