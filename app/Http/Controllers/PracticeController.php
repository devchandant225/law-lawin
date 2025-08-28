<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\View\Components\PracticeSection;

class PracticeController extends Controller
{
    protected $practiceSection;

    public function __construct()
    {
        $this->practiceSection = new PracticeSection();
    }

    /**
     * Display a listing of all practices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all practices
        $practices = $this->practiceSection->getAllPractices();
        
        // Get practice statistics
        $practiceStats = $this->practiceSection->getPracticeStats();
        
        return view('practice.index', compact('practices', 'practiceStats'));
    }

    /**
     * Display the specified practice.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Find the practice by slug
        $practice = Post::ofType('practice')
                          ->active()
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Get related practices
        $relatedPractices = $this->practiceSection->getRelatedPractices($practice->slug, 6);

        return view('practice.show', compact('practice', 'relatedPractices'));
    }

    /**
     * Search practices (API endpoint or for search functionality).
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

        $practices = $this->practiceSection->searchPractices($query, $limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Practices found successfully',
            'data' => $practices,
            'query' => $query,
            'count' => $practices->count()
        ]);
    }

    /**
     * Get featured practices (API endpoint or for featured section).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 4);
        $practices = $this->practiceSection->getFeaturedPractices($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Featured practices retrieved successfully',
            'data' => $practices,
            'count' => $practices->count()
        ]);
    }

    /**
     * Get practice statistics (API endpoint).
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $stats = $this->practiceSection->getPracticeStats();

        return response()->json([
            'status' => 'success',
            'message' => 'Practice statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
