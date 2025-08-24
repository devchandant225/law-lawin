<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index(Request $request)
    {
        $query = Post::active();

        // Filter by type
        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest()->paginate(12);
        $types = ['service', 'practice', 'news', 'blog'];

        return view('posts.index', compact('posts', 'types'));
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        // Only show active posts
        if ($post->status !== 'active') {
            abort(404);
        }

        $relatedPosts = Post::active()
                          ->ofType($post->type)
                          ->where('id', '!=', $post->id)
                          ->latest()
                          ->take(3)
                          ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display posts by type.
     */
    public function byType($type, Request $request)
    {
        if (!in_array($type, ['service', 'practice', 'news', 'blog'])) {
            abort(404);
        }

        $query = Post::active()->ofType($type);

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest()->paginate(12);
        $types = ['service', 'practice', 'news', 'blog'];

        return view('posts.by-type', compact('posts', 'type', 'types'));
    }
}
