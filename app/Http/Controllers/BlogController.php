<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Services\AiContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $aiService;

    public function __construct(AiContentService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display admin listing of blogs.
     */
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blogs.index', compact('posts'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Generate blog content using AI.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
        ]);

        try {
            $content = $this->aiService->generateBlogPost($request->topic);
            return response()->json($content);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate content: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a new blog post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'featured_video_url' => 'nullable|url|max:255',
            'featured_video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'tags' => 'nullable|array',
            'faq' => 'nullable|array',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['featured_image'] = asset('storage/' . $path);
        }

        if ($request->hasFile('featured_video_file')) {
            $path = $request->file('featured_video_file')->store('blog-videos', 'public');
            $validated['featured_video_file'] = asset('storage/' . $path);
        }

        $validated['is_published'] = $request->has('is_published');
        $post = BlogPost::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the blog post.
     */
    public function edit(BlogPost $blog)
    {
        return view('admin.blogs.edit', ['post' => $blog]);
    }

    /**
     * Update the blog post.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $blog->id,
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'featured_video_url' => 'nullable|url|max:255',
            'featured_video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'tags' => 'nullable|array',
            'faq' => 'nullable|array',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog-images', 'public');
            $validated['featured_image'] = asset('storage/' . $path);
        }

        if ($request->hasFile('featured_video_file')) {
            $path = $request->file('featured_video_file')->store('blog-videos', 'public');
            $validated['featured_video_file'] = asset('storage/' . $path);
        }

        $validated['is_published'] = $request->has('is_published');
        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the blog post.
     */
    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Public listing of blogs.
     */
    public function publicIndex()
    {
        $posts = BlogPost::where('is_published', true)->latest()->paginate(12);
        return view('public.blogs.index', compact('posts'));
    }

    /**
     * Public show of a blog post.
     */
    public function publicShow($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('public.blogs.show', compact('post'));
    }
}
