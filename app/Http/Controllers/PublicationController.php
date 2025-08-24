<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\View\Components\PublicationSection;

class PublicationController extends Controller
{
    protected $publicationSection;

    public function __construct()
    {
        $this->publicationSection = new PublicationSection();
    }

    /**
     * Display a listing of all publications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all publications
        $publications = $this->publicationSection->getAllPublications();
        
        // Get publication statistics
        $publicationStats = $this->publicationSection->getPublicationStats();
        
        return view('publications.index', compact('publications', 'publicationStats'));
    }

    /**
     * Display the specified publication.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Find the publication by slug
        $publication = Post::ofType('publication')
                          ->active()
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Get related publications
        $relatedPublications = $this->publicationSection->getRelatedPublications($publication->slug, 3);

        return view('publication.show', compact('publication', 'relatedPublications'));
    }

    /**
     * Search publications (API endpoint or for search functionality).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $limit = $request->get('limit', 10);

        if (empty($query)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search query is required',
                'data' => []
            ], 400);
        }

        $publications = $this->publicationSection->searchPublications($query, $limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Publications found successfully',
            'data' => $publications,
            'query' => $query,
            'count' => $publications->count()
        ]);
    }

    /**
     * Get featured publications (API endpoint or for featured section).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 4);
        $publications = $this->publicationSection->getFeaturedPublications($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Featured publications retrieved successfully',
            'data' => $publications,
            'count' => $publications->count()
        ]);
    }

    /**
     * Get publication statistics (API endpoint).
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $stats = $this->publicationSection->getPublicationStats();

        return response()->json([
            'status' => 'success',
            'message' => 'Publication statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
