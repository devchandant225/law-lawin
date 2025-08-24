<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function introduction()
    {
        return view('about.introduction');
    }

    public function executiveCommittee()
    {
        return view('about.executive-committee');
    }
}


