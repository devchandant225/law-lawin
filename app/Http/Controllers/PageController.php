<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the specified page.
     */
    public function show(Page $page): View
    {
        // Check if page is active
        if ($page->status !== 'active') {
            abort(404);
        }

        return view('pages.show', compact('page'));
    }
}
