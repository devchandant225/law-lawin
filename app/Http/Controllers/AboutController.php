<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUsContentSection;

class AboutController extends Controller
{
    public function index()
    {
        $aboutContent = AboutUsContentSection::getAboutPageContent();
        
        return view('about.index', compact('aboutContent'));
    }

    public function introduction()
    {
        return view('about.introduction');
    }

    public function executiveCommittee()
    {
        return view('about.executive-committee');
    }
}


