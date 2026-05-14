<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\WebsiteContent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FaqController extends Controller implements HasMiddleware
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
        $faqs = Faq::orderBy('order')->orderBy('created_at', 'desc')->get();
        $sectionSettings = WebsiteContent::where('group', 'faq')->get();
        return view('admin.faqs.index', compact('faqs', 'sectionSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        Faq::create($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        $faq->update($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
