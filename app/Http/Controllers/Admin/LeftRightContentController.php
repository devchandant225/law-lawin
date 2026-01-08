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
    public function index()
    {
        $query = LeftRightContent::with('post')->orderBy('order', 'asc');

        if (request('post_id')) {
            $query->where('post_id', request('post_id'));
        }

        $contents = $query->get();
        return view('admin.left-right-contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        $selectedPostId = request('post_id') ? request('post_id') : null;
        return view('admin.left-right-contents.create', compact('posts', 'selectedPostId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
            'status' => 'required|boolean',
            'post_id' => 'required|exists:posts,id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('left-right-contents', 'public');
            $data['image'] = $imagePath;
        }

        LeftRightContent::create($data);

        return redirect()->route('admin.left-right-contents.index')->with('success', 'Left-right content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeftRightContent $leftRightContent)
    {
        return view('admin.left-right-contents.show', compact('leftRightContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeftRightContent $leftRightContent)
    {
        $posts = Post::all();
        return view('admin.left-right-contents.edit', compact('leftRightContent', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeftRightContent $leftRightContent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
            'status' => 'required|boolean',
            'post_id' => 'required|exists:posts,id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($leftRightContent->image) {
                Storage::disk('public')->delete($leftRightContent->image);
            }

            $imagePath = $request->file('image')->store('left-right-contents', 'public');
            $data['image'] = $imagePath;
        }

        $leftRightContent->update($data);

        return redirect()->route('admin.left-right-contents.index')->with('success', 'Left-right content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeftRightContent $leftRightContent)
    {
        // Delete image if exists
        if ($leftRightContent->image) {
            Storage::disk('public')->delete($leftRightContent->image);
        }

        $leftRightContent->delete();

        return redirect()->route('admin.left-right-contents.index')->with('success', 'Left-right content deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(LeftRightContent $leftRightContent)
    {
        $leftRightContent->update([
            'status' => !$leftRightContent->status
        ]);

        return response()->json(['success' => true]);
    }
}
