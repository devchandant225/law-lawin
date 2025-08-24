<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::ordered()->paginate(10);
        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }
        
        // Set status if not provided
        $data['status'] = $request->has('status') ? 1 : 0;
        
        Slider::create($data);
        
        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }
        
        // Set status if not provided
        $data['status'] = $request->has('status') ? 1 : 0;
        
        $slider->update($data);
        
        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // Delete image file
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();
        
        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Slider deleted successfully.');
    }

    /**
     * Toggle slider status
     */
    public function toggleStatus(Slider $slider)
    {
        $slider->update(['status' => !$slider->status]);
        
        return response()->json([
            'success' => true,
            'message' => 'Slider status updated successfully.',
            'status' => $slider->status
        ]);
    }
}
