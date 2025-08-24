<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function notices()
    {
        return view('information.notices');
    }

    public function showNotice(string $slug)
    {
        return view('information.notice-detail', compact('slug'));
    }

    public function events()
    {
        return view('information.events');
    }
}


