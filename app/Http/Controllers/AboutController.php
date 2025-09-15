<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index');
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


