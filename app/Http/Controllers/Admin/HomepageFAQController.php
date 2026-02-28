<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageFAQ;
use App\Http\Requests\Admin\HomepageFAQRequest;
use Illuminate\Http\Request;

class HomepageFAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HomepageFAQ::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        $faqs = $query->orderBy('order_index', 'asc')->latest()->paginate(15);

        return view('admin.homepage-faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.homepage-faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomepageFAQRequest $request)
    {
        $validated = $request->validated();
        
        HomepageFAQ::create($validated);

        return redirect()->route('admin.homepage-faqs.index')
                        ->with('success', 'Homepage FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomepageFAQ $homepageFaq)
    {
        return view('admin.homepage-faqs.edit', compact('homepageFaq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomepageFAQRequest $request, HomepageFAQ $homepageFaq)
    {
        $validated = $request->validated();
        
        $homepageFaq->update($validated);

        return redirect()->route('admin.homepage-faqs.index')
                        ->with('success', 'Homepage FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomepageFAQ $homepageFaq)
    {
        $homepageFaq->delete();

        return redirect()->route('admin.homepage-faqs.index')
                        ->with('success', 'Homepage FAQ deleted successfully.');
    }

    /**
     * Toggle FAQ status.
     */
    public function toggleStatus(HomepageFAQ $homepageFaq)
    {
        $newStatus = $homepageFaq->status === 'active' ? 'inactive' : 'active';
        $homepageFaq->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'FAQ status updated successfully.'
        ]);
    }
}
