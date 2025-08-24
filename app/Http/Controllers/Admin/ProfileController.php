<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the profile (only one profile exists)
     */
    public function index()
    {
        $profile = Profile::getProfile();
        $profile_exists = $profile !== null;
        
        $data = compact('profile', 'profile_exists');
        
        if ($profile) {
            $data['last_updated'] = $profile->updated_at ? $profile->updated_at->format('M d, Y') : 'Never';
            $data['created_at'] = $profile->created_at ? $profile->created_at->format('M d, Y') : 'Not set';
        } else {
            $data['last_updated'] = 'Never';
            $data['created_at'] = 'Not set';
        }
        
        return view('admin.profile.index', $data);
    }

    /**
     * Show the form for creating/editing the profile
     */
    public function create()
    {
        $profile = Profile::getProfile();
        return view('admin.profile.form', compact('profile'));
    }

    /**
     * Store or update the profile
     */
    public function store(ProfileRequest $request)
    {
        $profile = Profile::first();
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profile && $profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        if ($profile) {
            // Update existing profile
            $profile->update($data);
            $message = 'Profile updated successfully!';
        } else {
            // Create new profile
            $profile = Profile::create($data);
            $message = 'Profile created successfully!';
        }

        return redirect()->route('admin.profile.index')->with('success', $message);
    }

    /**
     * Show the form for editing the profile
     */
    public function edit()
    {
        $profile = Profile::getProfile();
        return view('admin.profile.form', compact('profile'));
    }

    /**
     * Update the profile
     */
    public function update(ProfileRequest $request)
    {
        return $this->store($request);
    }

    /**
     * Remove the logo from the profile
     */
    public function removeLogo()
    {
        $profile = Profile::first();
        
        if ($profile && $profile->logo) {
            Storage::disk('public')->delete($profile->logo);
            $profile->update(['logo' => null]);
            
            return redirect()->back()->with('success', 'Logo removed successfully!');
        }
        
        return redirect()->back()->with('error', 'No logo found to remove.');
    }
}
