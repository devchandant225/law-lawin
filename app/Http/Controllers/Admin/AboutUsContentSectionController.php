<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsContentSection;
use App\Http\Requests\AboutUsContentSectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsContentSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AboutUsContentSection::query();

        // Filter by page type
        if ($request->filled('page_type')) {
            $query->forPageType($request->page_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $contentSections = $query->ordered()->latest()->paginate(15);
        
        // Get filter options
        $pageTypeOptions = AboutUsContentSection::getPageTypeOptions();
        $statusOptions = AboutUsContentSection::getStatusOptions();

        return view('admin.about-us-contents.index', compact('contentSections', 'pageTypeOptions', 'statusOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTypeOptions = AboutUsContentSection::getPageTypeOptions();
        $statusOptions = AboutUsContentSection::getStatusOptions();

        return view('admin.about-us-contents.create', compact('pageTypeOptions', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutUsContentSectionRequest $request)
    {
        $validated = $request->validated();
        
        // Handle image uploads
        if ($request->hasFile('image1')) {
            $validated['image1'] = $request->file('image1')->store('about-us-content', 'public');
        }
        
        if ($request->hasFile('image2')) {
            $validated['image2'] = $request->file('image2')->store('about-us-content', 'public');
        }
        
        $contentSection = AboutUsContentSection::create($validated);

        return redirect()->route('admin.about-us-contents.index')
                        ->with('success', 'About Us Content Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUsContentSection $aboutUsContent)
    {
        return view('admin.about-us-contents.show', compact('aboutUsContent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUsContentSection $aboutUsContent)
    {
        $pageTypeOptions = AboutUsContentSection::getPageTypeOptions();
        $statusOptions = AboutUsContentSection::getStatusOptions();
        
        return view('admin.about-us-contents.edit', compact('aboutUsContent', 'pageTypeOptions', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutUsContentSectionRequest $request, AboutUsContentSection $aboutUsContent)
    {
        $validated = $request->validated();
        
        // Handle image uploads
        if ($request->hasFile('image1')) {
            // Delete old image if exists
            if ($aboutUsContent->image1 && Storage::disk('public')->exists($aboutUsContent->image1)) {
                Storage::disk('public')->delete($aboutUsContent->image1);
            }
            $validated['image1'] = $request->file('image1')->store('about-us-content', 'public');
        }
        
        if ($request->hasFile('image2')) {
            // Delete old image if exists
            if ($aboutUsContent->image2 && Storage::disk('public')->exists($aboutUsContent->image2)) {
                Storage::disk('public')->delete($aboutUsContent->image2);
            }
            $validated['image2'] = $request->file('image2')->store('about-us-content', 'public');
        }
        
        $aboutUsContent->update($validated);

        return redirect()->route('admin.about-us-contents.index')
                        ->with('success', 'About Us Content Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUsContentSection $aboutUsContent)
    {
        // Delete associated images
        if ($aboutUsContent->image1 && Storage::disk('public')->exists($aboutUsContent->image1)) {
            Storage::disk('public')->delete($aboutUsContent->image1);
        }
        
        if ($aboutUsContent->image2 && Storage::disk('public')->exists($aboutUsContent->image2)) {
            Storage::disk('public')->delete($aboutUsContent->image2);
        }
        
        $aboutUsContent->delete();

        return redirect()->route('admin.about-us-contents.index')
                        ->with('success', 'About Us Content Section deleted successfully.');
    }

    /**
     * Toggle content section status.
     */
    public function toggleStatus(AboutUsContentSection $aboutUsContent)
    {
        $newStatus = $aboutUsContent->status === AboutUsContentSection::STATUS_ACTIVE 
                    ? AboutUsContentSection::STATUS_INACTIVE 
                    : AboutUsContentSection::STATUS_ACTIVE;
        
        $aboutUsContent->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Content section status updated successfully.'
        ]);
    }
}
