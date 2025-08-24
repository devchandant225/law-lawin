<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    public function journalIndex()
    {
        return view('publications.journal.index');
    }

    public function issue(string $volume, string $number)
    {
        return view('publications.journal.issue', compact('volume', 'number'));
    }

    public function article(string $slug)
    {
        return view('publications.journal.article', compact('slug'));
    }
}


