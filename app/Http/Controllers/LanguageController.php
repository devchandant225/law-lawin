<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class LanguageController extends Controller
{
    /**
     * Display a listing of languages.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->language()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $languages = $query->paginate(12)->withQueryString();

        // Get featured languages for sidebar
        $featuredLanguages = Publication::active()->language()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalLanguages = Publication::active()->language()->count();

        return view('languages.index', compact('languages', 'featuredLanguages', 'totalLanguages'));
    }

    /**
     * Display the specified language.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $language = Publication::where('slug', $slug)->active()->language()->firstOrFail();
        
        // Get related languages
        $relatedLanguages = Publication::active()->language()->where('id', '!=', $language->id)->ordered()->limit(10)->get();

        // Get language FAQs
        $faqs = $language->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $language->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $language->getTeamMembersWithRoles();

        return view('languages.show', compact('language', 'relatedLanguages', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search languages via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $languages = Publication::active()->language()
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
                    'url' => route('language.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $languages]);
    }

    /**
     * Get featured languages.
     */
    public function featured()
    {
        $featuredLanguages = Publication::active()->language()->ordered()->limit(8)->get();

        return response()->json([
            'languages' => $featuredLanguages->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('language.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get language statistics.
     */
    public function stats()
    {
        $stats = [
            'total_languages' => Publication::language()->count(),
            'active_languages' => Publication::active()->language()->count(),
            'total_faqs' => \App\Models\FAQ::whereHas('publication', function ($q) {
                $q->language();
            })->count(),
            'total_table_of_contents' => \App\Models\TableOfContent::whereHas('publication', function ($q) {
                $q->language();
            })->count(),
        ];

        return response()->json($stats);
    }
}
