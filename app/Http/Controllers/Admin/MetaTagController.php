<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metaTags = MetaTag::orderBy('page_type')->paginate(15);
        return view('admin.meta-tags.index', compact('metaTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTypes = MetaTag::getPageTypes();
        $usedPageTypes = MetaTag::pluck('page_type')->toArray();
        
        return view('admin.meta-tags.create', compact('pageTypes', 'usedPageTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'keyword' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'schema_json_ld' => 'nullable|json',
            'page_type' => [
                'required',
                'string',
                Rule::in(array_keys(MetaTag::getPageTypes())),
                'unique:meta_tags,page_type'
            ],
            'is_active' => 'boolean'
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('meta-tags', 'public');
        }
        
        // Parse JSON-LD if provided
        if ($request->filled('schema_json_ld')) {
            $validated['schema_json_ld'] = json_decode($request->schema_json_ld, true);
        }
        
        $validated['is_active'] = $request->has('is_active');
        
        MetaTag::create($validated);
        
        return redirect()->route('admin.meta-tags.index')
            ->with('success', 'Meta tag created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaTag $metaTag)
    {
        return view('admin.meta-tags.show', compact('metaTag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaTag $metaTag)
    {
        $pageTypes = MetaTag::getPageTypes();
        return view('admin.meta-tags.edit', compact('metaTag', 'pageTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetaTag $metaTag)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'keyword' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'schema_json_ld' => 'nullable|json',
            'page_type' => [
                'required',
                'string',
                Rule::in(array_keys(MetaTag::getPageTypes())),
                Rule::unique('meta_tags', 'page_type')->ignore($metaTag->id)
            ],
            'is_active' => 'boolean'
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($metaTag->image) {
                Storage::disk('public')->delete($metaTag->image);
            }
            $validated['image'] = $request->file('image')->store('meta-tags', 'public');
        }
        
        // Parse JSON-LD if provided
        if ($request->filled('schema_json_ld')) {
            $validated['schema_json_ld'] = json_decode($request->schema_json_ld, true);
        } else {
            $validated['schema_json_ld'] = null;
        }
        
        $validated['is_active'] = $request->has('is_active');
        
        $metaTag->update($validated);
        
        return redirect()->route('admin.meta-tags.index')
            ->with('success', 'Meta tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaTag $metaTag)
    {
        // Delete associated image
        if ($metaTag->image) {
            Storage::disk('public')->delete($metaTag->image);
        }
        
        $metaTag->delete();
        
        return redirect()->route('admin.meta-tags.index')
            ->with('success', 'Meta tag deleted successfully!');
    }
    
    /**
     * Toggle status of meta tag
     */
    public function toggleStatus(MetaTag $metaTag)
    {
        $metaTag->update(['is_active' => !$metaTag->is_active]);
        
        $status = $metaTag->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Meta tag {$status} successfully!");
    }
}
