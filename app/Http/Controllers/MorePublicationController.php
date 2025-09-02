<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class MorePublicationController extends Controller
{
    /**
     * Display a listing of more-publications.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->morePublication()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $morePublications = $query->paginate(12)->withQueryString();

        // Get featured more-publications for sidebar
        $featuredMorePublications = Publication::active()->morePublication()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalMorePublications = Publication::active()->morePublication()->count();

        return view('more-publications.index', compact('morePublications', 'featuredMorePublications', 'totalMorePublications'));
    }

    /**
     * Display the specified more-publication.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $morePublication = Publication::where('slug', $slug)->active()->morePublication()->firstOrFail();
        
        // Get related more-publications
        $relatedMorePublications = Publication::active()->morePublication()->where('id', '!=', $morePublication->id)->ordered()->limit(10)->get();

        // Get more-publication FAQs
        $faqs = $morePublication->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $morePublication->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $morePublication->getTeamMembersWithRoles();

        return view('more-publications.show', compact('morePublication', 'relatedMorePublications', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search more-publications via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $morePublications = Publication::active()->morePublication()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->ordered()
            ->limit(10)
            ->get(['id', 'title', 'slug', 'excerpt', 'feature_image'])
            ->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt ? \Str::limit($publication->excerpt, 100) : null,
                    'url' => route('more-publication.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $morePublications]);
    }

    /**
     * Get featured more-publications.
     */
    public function featured()
    {
        $featuredMorePublications = Publication::active()->morePublication()->ordered()->limit(8)->get();

        return response()->json([
            'more_publications' => $featuredMorePublications->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('more-publication.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get more-publication statistics.
     */
    public function stats()
    {
        $stats = [
            'total_more_publications' => Publication::morePublication()->count(),
            'active_more_publications' => Publication::active()->morePublication()->count(),
            'total_faqs' => \App\Models\FAQ::whereHas('publication', function ($q) {
                $q->morePublication();
            })->count(),
            'total_table_of_contents' => \App\Models\TableOfContent::whereHas('publication', function ($q) {
                $q->morePublication();
            })->count(),
        ];

        return response()->json($stats);
    }
}
