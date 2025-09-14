<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class StudyAbroadController extends Controller
{
    /**
     * Display a listing of study abroad publications.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->studyAbroad()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $studyAbroadPublications = $query->paginate(12)->withQueryString();

        // Get featured study abroad publications for sidebar
        $featuredStudyAbroad = Publication::active()->studyAbroad()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalStudyAbroad = Publication::active()->studyAbroad()->count();

        return view('study-abroad.index', compact('studyAbroadPublications', 'featuredStudyAbroad', 'totalStudyAbroad'));
    }

    /**
     * Display the specified study abroad publication.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $studyAbroad = Publication::where('slug', $slug)->active()->studyAbroad()->firstOrFail();
        
        // Get related study abroad publications
        $relatedStudyAbroad = Publication::active()->studyAbroad()->where('id', '!=', $studyAbroad->id)->ordered()->limit(10)->get();

        // Get publication FAQs
        $faqs = $studyAbroad->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $studyAbroad->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $studyAbroad->getTeamMembersWithRoles();

        return view('study-abroad.show', compact('studyAbroad', 'relatedStudyAbroad', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search study abroad publications via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $studyAbroadPublications = Publication::active()->studyAbroad()
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
                    'url' => route('study-abroad.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $studyAbroadPublications]);
    }

    /**
     * Get featured study abroad publications.
     */
    public function featured()
    {
        $featuredStudyAbroad = Publication::active()->studyAbroad()->ordered()->limit(8)->get();

        return response()->json([
            'publications' => $featuredStudyAbroad->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('study-abroad.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get study abroad publication statistics.
     */
    public function stats()
    {
        $stats = [
            'total_study_abroad' => Publication::studyAbroad()->count(),
            'active_study_abroad' => Publication::active()->studyAbroad()->count(),
            'total_faqs' => \App\Models\FAQ::count(),
            'total_table_of_contents' => \App\Models\TableOfContent::count(),
        ];

        return response()->json($stats);
    }
}
