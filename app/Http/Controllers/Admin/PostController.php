<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
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

        $posts = $query->orderBy('orderposition', 'asc')->orderBy('title', 'asc')->paginate(15);

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
    public function store(PostRequest $request)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('posts', 'public');
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('posts/icons', 'public');
        }

        // Handle Schema (Repeater Arrays) - already filtered in PostRequest
        
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
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();

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

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($post->icon) {
                Storage::disk('public')->delete($post->icon);
            }
            $validated['icon'] = $request->file('icon')->store('posts/icons', 'public');
        }

        // Handle Schema (Repeater Arrays) - already filtered in PostRequest

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

        // Delete icon if exists
        if ($post->icon) {
            Storage::disk('public')->delete($post->icon);
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
