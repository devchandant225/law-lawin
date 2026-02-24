<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Publication::query();
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by post type
        if ($request->filled('post_type')) {
            $query->where('post_type', $request->post_type);
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

        $publications = $query->ordered()->paginate(15);

        return view('admin.publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationRequest $request)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure post_type is properly cast as string
        if (isset($validated['post_type'])) {
            $validated['post_type'] = (string) $validated['post_type'];
        }
        
        // Handle file upload
        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('publications', 'public');
        }

        // Parse Schema JSON
        if ($request->filled('schema_head')) {
            $decoded = json_decode($validated['schema_head'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['schema_head'] = $decoded;
            } else {
                unset($validated['schema_head']);
            }
        }

        if ($request->filled('schema_body')) {
            $decoded = json_decode($validated['schema_body'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['schema_body'] = $decoded;
            } else {
                unset($validated['schema_body']);
            }
        }

        $publication = Publication::create($validated);

        return redirect()->route('admin.publications.index')
                        ->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        return view('admin.publications.show', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        return view('admin.publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Publication $publication)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure post_type is properly cast as string
        if (isset($validated['post_type'])) {
            $validated['post_type'] = (string) $validated['post_type'];
        }

        // Handle file upload
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($publication->feature_image) {
                Storage::disk('public')->delete($publication->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('publications', 'public');
        }

        // Parse Schema JSON
        if ($request->filled('schema_head')) {
            $decoded = json_decode($validated['schema_head'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['schema_head'] = $decoded;
            } else {
                unset($validated['schema_head']);
            }
        }

        if ($request->filled('schema_body')) {
            $decoded = json_decode($validated['schema_body'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $validated['schema_body'] = $decoded;
            } else {
                unset($validated['schema_body']);
            }
        }

        $publication->update($validated);

        return redirect()->route('admin.publications.index')
                        ->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        // Delete feature image if exists
        if ($publication->feature_image) {
            Storage::disk('public')->delete($publication->feature_image);
        }

        $publication->delete();

        return redirect()->route('admin.publications.index')
                        ->with('success', 'Publication deleted successfully.');
    }

    /**
     * Toggle publication status.
     */
    public function toggleStatus(Publication $publication)
    {
        $newStatus = $publication->status === 'active' ? 'inactive' : 'active';
        $publication->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Publication status updated successfully.'
        ]);
    }


      public function editorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->move(public_path() . '/uploads/editor/publication', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/editor/publication/' . $filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

            // Render HTML output
        @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }

    /**
     * Display the terms and conditions page.
     */
    public function showTermsCondition()
    {
        $publication = Publication::where('post_type', 'terms-condition')
                                 ->where('status', 'active')
                                 ->first();

        if (!$publication) {
            abort(404, 'Terms & Conditions not found');
        }

        return view('terms-condition', compact('publication'));
    }

    /**
     * Display the privacy policy page.
     */
    public function showPrivacyPolicy()
    {
        $publication = Publication::where('post_type', 'privacy-policy')
                                 ->where('status', 'active')
                                 ->first();

        if (!$publication) {
            abort(404, 'Privacy Policy not found');
        }

        return view('privacy-policy', compact('publication'));
    }

    /**
     * Display the cookies policy page.
     */
    public function showCookiesPolicy()
    {
        $publication = Publication::where('post_type', 'cookies-policy')
                                 ->where('status', 'active')
                                 ->first();

        if (!$publication) {
            abort(404, 'Cookies Policy not found');
        }

        return view('cookies-policy', compact('publication'));
    }
}
