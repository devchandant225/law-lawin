<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'description' => 'required|string',
            'bottom_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'type' => 'required|in:service,practice,news,blog',
            'layout' => 'required|in:with_sidebar,fullscreen',
            'feature_image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'google_schema' => 'nullable|string'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('posts', 'public');
        }

        // Parse Google Schema JSON
        if ($request->filled('google_schema')) {
            $decoded = json_decode($validated['google_schema'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['google_schema'] = $decoded;
            } else {
                unset($validated['google_schema']);
            }
        }

        $post = Post::create($validated);

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
            'description' => 'required|string',
            'bottom_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'type' => 'required|in:service,practice,news,blog',
            'layout' => 'required|in:with_sidebar,fullscreen',
            'feature_image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'google_schema' => 'nullable|string'
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($post->feature_image) {
                Storage::disk('public')->delete($post->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('posts', 'public');
        }

        // Parse Google Schema JSON
        if ($request->filled('google_schema')) {
            $decoded = json_decode($validated['google_schema'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['google_schema'] = $decoded;
            } else {
                unset($validated['google_schema']);
            }
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete feature image if exists
        if ($post->feature_image) {
            Storage::disk('public')->delete($post->feature_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
                        ->with('success', 'Post deleted successfully.');
    }

    /**
     * Toggle post status.
     */
    public function toggleStatus(Post $post)
    {
        $newStatus = $post->status === 'active' ? 'inactive' : 'active';
        $post->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Post status updated successfully.'
        ]);
    }
}
