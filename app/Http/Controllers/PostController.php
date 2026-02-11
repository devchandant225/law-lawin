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
        $types = ['service', 'practice', 'news', 'blog', 'help_desk'];

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

        if ($post->type === 'help_desk') {
            // Get left-right contents associated with this post
            $leftRightContents = $post->leftRightContents()
                ->where('status', true)
                ->orderBy('order', 'asc')
                ->get();

            // Get FAQs associated with this post
            $faqs = $post->postFaqs()
                ->where('status', 'active')
                ->orderBy('created_at', 'asc')
                ->get();

            // Get related help desk posts
            $relatedHelpDeskPosts = Post::ofType('help_desk')
                ->active()
                ->where('id', '!=', $post->id)
                ->orderBy('orderposition', 'asc')
                ->orderBy('title', 'asc')
                ->limit(6)
                ->get();

            return view('help-desk.show', [
                'helpDesk' => $post,
                'leftRightContents' => $leftRightContents,
                'faqs' => $faqs,
                'relatedHelpDeskPosts' => $relatedHelpDeskPosts
            ]);
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
        if (!in_array($type, ['service', 'practice', 'news', 'blog', 'help_desk'])) {
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
        $types = ['service', 'practice', 'news', 'blog', 'help_desk'];

        return view('posts.by-type', compact('posts', 'type', 'types'));
    }
}
