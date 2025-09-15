<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index()
    {
        $posts = Post::active()
            ->ofType('blog')
            ->ordered()
            ->paginate(12);

        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(Post $post)
    {
        // Ensure the post is a blog type and is active
        if ($post->type !== 'blog' || $post->status !== 'active') {
            abort(404);
        }

        // Get related blog posts
        $relatedPosts = Post::active()
            ->ofType('blog')
            ->where('id', '!=', $post->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
