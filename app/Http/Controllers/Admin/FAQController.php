<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Publication;
use App\Http\Requests\FAQRequest;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FAQ::with('publication');

        // Filter by publication
        if ($request->filled('publication_id')) {
            $query->where('publication_id', $request->publication_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $faqs = $query->latest()->paginate(15);
        
        // Get all publications for filter dropdown
        $publications = Publication::select('id', 'title')->orderBy('title')->get();

        return view('admin.faqs.index', compact('faqs', 'publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $publications = Publication::select('id', 'title')->orderBy('title')->get();
        $selectedPublication = $request->publication_id;

        return view('admin.faqs.create', compact('publications', 'selectedPublication'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {
        $validated = $request->validated();
        
        $faq = FAQ::create($validated);

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $faq)
    {
        $faq->load('publication');
        
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        $publications = Publication::select('id', 'title')->orderBy('title')->get();
        
        return view('admin.faqs.edit', compact('faq', 'publications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        $validated = $request->validated();
        
        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
                        ->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Toggle FAQ status.
     */
    public function toggleStatus(FAQ $faq)
    {
        $newStatus = $faq->status === 'active' ? 'inactive' : 'active';
        $faq->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'FAQ status updated successfully.'
        ]);
    }
}
