<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class PublicationController extends Controller
{
    /**
     * Display a listing of publications.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $publications = $query->paginate(12)->withQueryString();

        // Get featured publications for sidebar
        $featuredPublications = Publication::active()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalPublications = Publication::active()->count();

        return view('publications.index', compact('publications', 'featuredPublications', 'totalPublications'));
    }

    /**
     * Display the specified practice.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $publication = Publication::where('slug', $slug)->active()->firstOrFail();
        // Get related publications
        $relatedPublications = Publication::active()->where('id', '!=', $publication->id)->ordered()->limit(10)->get();

        // Get publication FAQs
        $faqs = $publication->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $publication->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $publication->getTeamMembersWithRoles();

        return view('publications.show', compact('publication', 'relatedPublications', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search publications via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $publications = Publication::active()
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
                    'url' => route('publication.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $publications]);
    }

    /**
     * Get featured publications.
     */
    public function featured()
    {
        $featuredPublications = Publication::active()->ordered()->limit(8)->get();

        return response()->json([
            'publications' => $featuredPublications->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('publication.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get publication statistics.
     */
    public function stats()
    {
        $stats = [
            'total_publications' => Publication::count(),
            'active_publications' => Publication::active()->count(),
            'total_faqs' => \App\Models\FAQ::count(),
            'total_table_of_contents' => \App\Models\TableOfContent::count(),
        ];

        return response()->json($stats);
    }
}
