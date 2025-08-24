<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function create()
    {
        return view('membership.register');
    }

    public function listing(string $type)
    {
        return view('membership.list', compact('type'));
    }
}


