<?php

namespace App\Http\Controllers;

use App\Models\PostFAQ;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostFAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        
        $faqs = PostFAQ::where('post_id', $postId)
            ->when($request->search, function ($query, $search) {
                $query->search($search);
            })
            ->ordered()
            ->paginate(10);

        return view('admin.post_faqs.index', compact('faqs', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postId)
    {
        $post = Post::findOrFail($postId);
        return view('admin.post_faqs.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string', // Allow HTML content from CKEditor
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        PostFAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'post_id' => $postId,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.posts.faqs.index', $postId)
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($postId, $faqId)
    {
        $post = Post::findOrFail($postId);
        $faq = PostFAQ::where('post_id', $postId)->findOrFail($faqId);

        return view('admin.post_faqs.edit', compact('faq', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $postId, $faqId)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string', // Allow HTML content from CKEditor
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $faq = PostFAQ::where('post_id', $postId)->findOrFail($faqId);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.posts.faqs.index', $postId)
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId, $faqId)
    {
        $faq = PostFAQ::where('post_id', $postId)->findOrFail($faqId);
        $faq->delete();

        return redirect()->route('admin.posts.faqs.index', $postId)
            ->with('success', 'FAQ deleted successfully.');
    }
}