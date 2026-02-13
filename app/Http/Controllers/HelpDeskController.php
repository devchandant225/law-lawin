<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HelpDeskController extends Controller
{
    /**
     * Display the specified help desk post.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Find the help desk post by slug
        $post = Post::ofType('help_desk')
                    ->active()
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Get left-right contents associated with this post
        $leftRightContents = $post->leftRightContents()
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        // Get FAQs associated with this post
        $faqs = $post->postFaqs()
            ->where('status', 'active')
            ->orderBy('created_at', 'asc')
            ->get();

        // Get related help desk posts
        $relatedHelpDeskPosts = Post::ofType('help_desk')
            ->active()
            ->where('id', '!=', $post->id)
            ->orderBy('orderposition', 'asc')
            ->orderBy('title', 'asc')
            ->limit(6)
            ->get();

        return view('help-desk.show', [
            'helpDesk' => $post,
            'leftRightContents' => $leftRightContents,
            'faqs' => $faqs,
            'relatedHelpDeskPosts' => $relatedHelpDeskPosts
        ]);
    }

    /**
     * Display NRN Legal Help Desk page
     */
    public function nrnLegal()
    {
        return view('help-desk.nrn-legal', [
            'title' => 'NRN Legal Help Desk',
            'description' => 'Legal assistance and support for Non-Resident Nepalis'
        ]);
    }

    /**
     * Display FDI Legal Help Desk page
     */
    public function fdiLegal()
    {
        return view('help-desk.fdi-legal', [
            'title' => 'FDI Legal Help Desk',
            'description' => 'Legal assistance and support for Foreign Direct Investment'
        ]);
    }
}
