<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeftRightContent;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeftRightContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $contents = LeftRightContent::where('post_id', $post->id)
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.left-right-contents.index', compact('contents', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('admin.left-right-contents.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->except('image');
        $data['post_id'] = $post->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('left-right-contents', 'public');
            $data['image'] = $imagePath;
        }

        LeftRightContent::create($data);

        return redirect()->route('admin.posts.left-right-contents.index', $post->id)->with('success', 'Left-right content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, LeftRightContent $leftRightContent)
    {
        return view('admin.left-right-contents.show', compact('leftRightContent', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, LeftRightContent $leftRightContent)
    {
        return view('admin.left-right-contents.edit', compact('leftRightContent', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, LeftRightContent $leftRightContent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $data = $request->except('image');
        $data['post_id'] = $post->id;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($leftRightContent->image) {
                Storage::disk('public')->delete($leftRightContent->image);
            }

            $imagePath = $request->file('image')->store('left-right-contents', 'public');
            $data['image'] = $imagePath;
        }

        $leftRightContent->update($data);

        return redirect()->route('admin.posts.left-right-contents.index', $post->id)->with('success', 'Left-right content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, LeftRightContent $leftRightContent)
    {
        // Delete image if exists
        if ($leftRightContent->image) {
            Storage::disk('public')->delete($leftRightContent->image);
        }

        $leftRightContent->delete();

        return redirect()->route('admin.posts.left-right-contents.index', $post->id)->with('success', 'Left-right content deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Post $post, LeftRightContent $leftRightContent)
    {
        $leftRightContent->update([
            'status' => !$leftRightContent->status
        ]);

        return response()->json(['success' => true]);
    }
}
