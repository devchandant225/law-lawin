<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the media.
     */
    public function index(Request $request)
    {
        $query = Media::latest();

        if ($request->filled('type')) {
            if ($request->type === 'image') {
                $query->where('file_type', 'like', 'image/%');
            } elseif ($request->type === 'pdf') {
                $query->where('file_type', 'application/pdf');
            }
        }

        if ($request->filled('search')) {
            $query->where('original_name', 'like', '%' . $request->search . '%');
        }

        $media = $query->paginate(20);

        return view('admin.media.index', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf|max:10240', // 10MB limit
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
                
                $path = $file->storeAs('media', $fileName, 'public');

                Media::create([
                    'file_name' => $fileName,
                    'file_path' => $path,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'original_name' => $originalName,
                ]);
            }

            return redirect()->route('admin.media.index')->with('success', 'Media uploaded successfully!');
        }

        return redirect()->back()->with('error', 'No files selected.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $medium)
    {
        $medium->delete();

        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully!');
    }
}
