<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::ordered()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'desc' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'nullable|in:1,on',
            'sort_order' => 'nullable|integer',
            'img' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048'
        ]);

        $data = $request->except(['_token']);
        $data['status'] = $request->has('status') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = 'testimonials/' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $data['img'] = $image->storeAs('testimonials', basename($imageName), 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'desc' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'nullable|in:1,on',
            'sort_order' => 'nullable|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['_token', '_method']);
        $data['status'] = $request->has('status') ? 1 : 0;

        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($testimonial->img && Storage::disk('public')->exists($testimonial->img)) {
                Storage::disk('public')->delete($testimonial->img);
            }

            $image = $request->file('img');
            $imageName = 'testimonials/' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $data['img'] = $image->storeAs('testimonials', basename($imageName), 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete image if exists
        if ($testimonial->img && Storage::disk('public')->exists($testimonial->img)) {
            Storage::disk('public')->delete($testimonial->img);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }

    /**
     * Toggle status of testimonial
     */
    public function toggleStatus(Testimonial $testimonial)
    {
        $testimonial->update(['status' => !$testimonial->status]);
        
        $status = $testimonial->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.testimonials.index')->with('success', "Testimonial {$status} successfully!");
    }
}
