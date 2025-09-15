<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::ordered()->paginate(20);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
            'alt_texts' => 'nullable|array',
            'alt_texts.*' => 'nullable|string|max:255',
        ]);

        $uploadedImages = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                try {
                    // Generate unique filename
                    $filename = time() . '_' . $index . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $path = 'gallery/' . $filename;

                    // Store original image
                    Storage::disk('public')->put($path, file_get_contents($image));

                    // Create optimized version using Intervention Image if available
                    try {
                        $fullPath = storage_path('app/public/' . $path);
                        $img = Image::make($fullPath);
                        
                        // Resize if too large (max 1920px width)
                        if ($img->width() > 1920) {
                            $img->resize(1920, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        }
                        
                        // Optimize quality
                        $img->save($fullPath, 85);
                    } catch (\Exception $e) {
                        // If Intervention Image is not available, continue with original
                    }

                    // Create gallery record
                    $gallery = Gallery::create([
                        'title' => $request->titles[$index],
                        'description' => $request->descriptions[$index] ?? null,
                        'image_path' => $path,
                        'alt_text' => $request->alt_texts[$index] ?? $request->titles[$index],
                        'sort_order' => $index,
                        'is_active' => true,
                    ]);

                    $uploadedImages[] = $gallery;

                } catch (\Exception $e) {
                    // Clean up any uploaded files on error
                    foreach ($uploadedImages as $uploaded) {
                        if (Storage::disk('public')->exists($uploaded->image_path)) {
                            Storage::disk('public')->delete($uploaded->image_path);
                        }
                        $uploaded->delete();
                    }
                    
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['error' => 'Failed to upload image: ' . $e->getMessage()]);
                }
            }
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', count($uploadedImages) . ' images uploaded successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'alt_text' => $request->alt_text ?: $request->title,
            'sort_order' => $request->sort_order ?: 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        // Handle image update
        if ($request->hasFile('image')) {
            try {
                // Delete old image
                if (Storage::disk('public')->exists($gallery->image_path)) {
                    Storage::disk('public')->delete($gallery->image_path);
                }

                // Upload new image
                $image = $request->file('image');
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = 'gallery/' . $filename;

                Storage::disk('public')->put($path, file_get_contents($image));

                // Optimize image if Intervention Image is available
                try {
                    $fullPath = storage_path('app/public/' . $path);
                    $img = Image::make($fullPath);
                    
                    if ($img->width() > 1920) {
                        $img->resize(1920, null, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    }
                    
                    $img->save($fullPath, 85);
                } catch (\Exception $e) {
                    // Continue with original if optimization fails
                }

                $data['image_path'] = $path;

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery image updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        try {
            // Delete image file
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            // Delete database record
            $gallery->delete();

            return redirect()->route('admin.gallery.index')
                ->with('success', 'Gallery image deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete image: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk delete images
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_images' => 'required|array',
            'selected_images.*' => 'exists:galleries,id'
        ]);

        try {
            $galleries = Gallery::whereIn('id', $request->selected_images)->get();
            
            foreach ($galleries as $gallery) {
                // Delete image file
                if (Storage::disk('public')->exists($gallery->image_path)) {
                    Storage::disk('public')->delete($gallery->image_path);
                }
                
                // Delete database record
                $gallery->delete();
            }

            return redirect()->route('admin.gallery.index')
                ->with('success', count($request->selected_images) . ' images deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete images: ' . $e->getMessage()]);
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        
        $status = $gallery->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Gallery image {$status} successfully!");
    }
}
