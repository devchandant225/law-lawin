<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MorePublicationController extends Controller
{
    /**
     * Display a listing of more-publications.
     */
    public function index(Request $request)
    {
        $query = Publication::morePublication();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('metatitle', 'like', '%' . $request->search . '%')
                  ->orWhere('metadescription', 'like', '%' . $request->search . '%');
            });
        }

        $morePublications = $query->ordered()->paginate(15);

        return view('admin.more-publications.index', compact('morePublications'));
    }

    /**
     * Show the form for creating a new more-publication.
     */
    public function create()
    {
        return view('admin.more-publications.create');
    }

    /**
     * Store a newly created more-publication in storage.
     */
    public function store(PublicationRequest $request)
    {
        $validated = $request->validated();
        
        // Force post_type to more-publication
        $validated['post_type'] = 'more-publication';

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('publications', 'public');
        }

        // Parse Google Schema JSON
        if ($request->filled('google_schema')) {
            $decoded = json_decode($validated['google_schema'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['google_schema'] = $decoded;
            } else {
                unset($validated['google_schema']);
            }
        }

        $publication = Publication::create($validated);

        return redirect()->route('admin.more-publications.index')
                        ->with('success', 'More Publication created successfully.');
    }

    /**
     * Display the specified more-publication.
     */
    public function show(Publication $morePublication)
    {
        // Ensure we're only showing more-publication type
        if ($morePublication->post_type !== 'more-publication') {
            abort(404);
        }
        
        return view('admin.more-publications.show', compact('morePublication'));
    }

    /**
     * Show the form for editing the specified more-publication.
     */
    public function edit(Publication $morePublication)
    {
        // Ensure we're only editing more-publication type
        if ($morePublication->post_type !== 'more-publication') {
            abort(404);
        }
        
        return view('admin.more-publications.edit', compact('morePublication'));
    }

    /**
     * Update the specified more-publication in storage.
     */
    public function update(PublicationRequest $request, Publication $morePublication)
    {
        // Ensure we're only updating more-publication type
        if ($morePublication->post_type !== 'more-publication') {
            abort(404);
        }
        
        $validated = $request->validated();
        
        // Force post_type to more-publication
        $validated['post_type'] = 'more-publication';

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($morePublication->feature_image) {
                Storage::disk('public')->delete($morePublication->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('publications', 'public');
        }

        // Parse Google Schema JSON
        if ($request->filled('google_schema')) {
            $decoded = json_decode($validated['google_schema'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['google_schema'] = $decoded;
            } else {
                unset($validated['google_schema']);
            }
        }

        $morePublication->update($validated);

        return redirect()->route('admin.more-publications.index')
                        ->with('success', 'More Publication updated successfully.');
    }

    /**
     * Remove the specified more-publication from storage.
     */
    public function destroy(Publication $morePublication)
    {
        // Ensure we're only deleting more-publication type
        if ($morePublication->post_type !== 'more-publication') {
            abort(404);
        }
        
        // Delete feature image if exists
        if ($morePublication->feature_image) {
            Storage::disk('public')->delete($morePublication->feature_image);
        }

        $morePublication->delete();

        return redirect()->route('admin.more-publications.index')
                        ->with('success', 'More Publication deleted successfully.');
    }

    /**
     * Toggle more-publication status.
     */
    public function toggleStatus(Publication $morePublication)
    {
        // Ensure we're only toggling more-publication type
        if ($morePublication->post_type !== 'more-publication') {
            return response()->json(['success' => false, 'message' => 'Invalid publication type.'], 400);
        }
        
        $newStatus = $morePublication->status === 'active' ? 'inactive' : 'active';
        $morePublication->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'More Publication status updated successfully.'
        ]);
    }
}
