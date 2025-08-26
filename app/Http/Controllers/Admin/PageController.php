<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the pages.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->get('type'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $pages = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        $types = Page::getTypes();
        $statuses = Page::getStatuses();
        
        return view('admin.pages.create', compact('types', 'statuses'));
    }

    /**
     * Store a newly created page in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'type' => ['required', Rule::in(array_keys(Page::getTypes()))],
            'excerpt' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => ['required', Rule::in(array_keys(Page::getStatuses()))],
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string|max:500',
            'metakeywords' => 'nullable|string|max:500',
            'json_ld_schema' => 'nullable|json',
        ]);

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('pages', 'public');
        }

        // Parse JSON-LD Schema if provided
        if ($request->filled('json_ld_schema')) {
            $validated['json_ld_schema'] = json_decode($request->json_ld_schema, true);
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified page.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit(Page $page)
    {
        $types = Page::getTypes();
        $statuses = Page::getStatuses();
        
        return view('admin.pages.edit', compact('page', 'types', 'statuses'));
    }

    /**
     * Update the specified page in storage.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($page->id)],
            'type' => ['required', Rule::in(array_keys(Page::getTypes()))],
            'excerpt' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => ['required', Rule::in(array_keys(Page::getStatuses()))],
            'metatitle' => 'nullable|string|max:255',
            'metadescription' => 'nullable|string|max:500',
            'metakeywords' => 'nullable|string|max:500',
            'json_ld_schema' => 'nullable|json',
        ]);

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($page->feature_image) {
                Storage::disk('public')->delete($page->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('pages', 'public');
        }

        // Parse JSON-LD Schema if provided
        if ($request->filled('json_ld_schema')) {
            $validated['json_ld_schema'] = json_decode($request->json_ld_schema, true);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified page from storage.
     */
    public function destroy(Page $page)
    {
        // Delete associated image
        if ($page->feature_image) {
            Storage::disk('public')->delete($page->feature_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully!');
    }

    /**
     * Toggle the status of the specified page.
     */
    public function toggleStatus(Page $page)
    {
        $newStatus = $page->status === 'active' ? 'inactive' : 'active';
        $page->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Page status updated successfully!'
        ]);
    }
}
