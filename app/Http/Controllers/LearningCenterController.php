<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class LearningCenterController extends Controller
{
    /**
     * Display a listing of learning center publications.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->learningCenter()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $learningCenterPublications = $query->paginate(12)->withQueryString();

        // Get featured learning center publications for sidebar
        $featuredLearningCenter = Publication::active()->learningCenter()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalLearningCenter = Publication::active()->learningCenter()->count();

        return view('learning-center.index', compact('learningCenterPublications', 'featuredLearningCenter', 'totalLearningCenter'));
    }

    /**
     * Display the specified learning center publication.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $learningCenter = Publication::where('slug', $slug)->active()->learningCenter()->firstOrFail();
        
        // Get related learning center publications
        $relatedLearningCenter = Publication::active()->learningCenter()->where('id', '!=', $learningCenter->id)->ordered()->limit(10)->get();

        // Get publication FAQs
        $faqs = $learningCenter->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $learningCenter->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $learningCenter->getTeamMembersWithRoles();

        return view('learning-center.show', compact('learningCenter', 'relatedLearningCenter', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search learning center publications via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $learningCenterPublications = Publication::active()->learningCenter()
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
                    'url' => route('learning-center.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $learningCenterPublications]);
    }

    /**
     * Get featured learning center publications.
     */
    public function featured()
    {
        $featuredLearningCenter = Publication::active()->learningCenter()->ordered()->limit(8)->get();

        return response()->json([
            'publications' => $featuredLearningCenter->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('learning-center.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get learning center publication statistics.
     */
    public function stats()
    {
        $stats = [
            'total_learning_center' => Publication::learningCenter()->count(),
            'active_learning_center' => Publication::active()->learningCenter()->count(),
            'total_faqs' => \App\Models\FAQ::count(),
            'total_table_of_contents' => \App\Models\TableOfContent::count(),
        ];

        return response()->json($stats);
    }
}
