<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'profile_exists' => Profile::exists(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Upload image for CKEditor
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('editor-images', $filename, 'public');
            $url = Storage::url($path);

            // Return response for CKEditor
            return response()->json([
                'uploaded' => true,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'Upload failed']
        ], 400);
    }
}
