<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\View\View;

class ServiceLocationController extends Controller
{
    /**
     * Display a listing of service-locations.
     */
    public function index(Request $request): View
    {
        $query = Publication::active()->serviceLocation()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Pagination
        $serviceLocations = $query->paginate(12)->withQueryString();

        // Get featured service-locations for sidebar
        $featuredServiceLocations = Publication::active()->serviceLocation()->ordered()->limit(5)->get();

        // Get total count for stats
        $totalServiceLocations = Publication::active()->serviceLocation()->count();

        return view('service-locations.index', compact('serviceLocations', 'featuredServiceLocations', 'totalServiceLocations'));
    }

    /**
     * Display the specified service-location.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug): View
    {
        $serviceLocation = Publication::where('slug', $slug)->active()->serviceLocation()->firstOrFail();
        
        // Get related service-locations
        $relatedServiceLocations = Publication::active()->serviceLocation()->where('id', '!=', $serviceLocation->id)->ordered()->limit(10)->get();

        // Get service-location FAQs
        $faqs = $serviceLocation->faqs()->where('status', 'active')->ordered()->get();

        // Get table of contents
        $tableOfContents = $serviceLocation->orderedTableOfContents()->active()->get();

        // Get team members
        $teamMembers = $serviceLocation->getTeamMembersWithRoles();

        return view('service-locations.show', compact('serviceLocation', 'relatedServiceLocations', 'faqs', 'tableOfContents', 'teamMembers'));
    }

    /**
     * Search service-locations via AJAX.
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $serviceLocations = Publication::active()->serviceLocation()
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
                    'url' => route('service-location.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                ];
            });

        return response()->json(['results' => $serviceLocations]);
    }

    /**
     * Get featured service-locations.
     */
    public function featured()
    {
        $featuredServiceLocations = Publication::active()->serviceLocation()->ordered()->limit(8)->get();

        return response()->json([
            'service_locations' => $featuredServiceLocations->map(function ($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'slug' => $publication->slug,
                    'excerpt' => $publication->excerpt,
                    'url' => route('service-location.show', $publication->slug),
                    'image' => $publication->feature_image_url,
                    'created_at' => $publication->created_at->format('M d, Y'),
                ];
            }),
        ]);
    }

    /**
     * Get service-location statistics.
     */
    public function stats()
    {
        $stats = [
            'total_service_locations' => Publication::serviceLocation()->count(),
            'active_service_locations' => Publication::active()->serviceLocation()->count(),
            'total_faqs' => \App\Models\FAQ::whereHas('publication', function ($q) {
                $q->serviceLocation();
            })->count(),
            'total_table_of_contents' => \App\Models\TableOfContent::whereHas('publication', function ($q) {
                $q->serviceLocation();
            })->count(),
        ];

        return response()->json($stats);
    }
}
