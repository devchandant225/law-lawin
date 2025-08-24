<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function gallery()
    {
        return view('media.gallery');
    }
}


