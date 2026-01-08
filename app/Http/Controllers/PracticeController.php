<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\LeftRightContent;
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
        $practices = Post::ofType('practice')->active()->orderBy('created_at', 'desc')->get();

        // Get practice statistics
        $practiceStats = [
            'total' => Post::ofType('practice')->count(),
            'active' => Post::ofType('practice')->active()->count(),
            'with_images' => Post::ofType('practice')->active()->whereNotNull('feature_image')->count(),
            'recent' => Post::ofType('practice')->active()->where('created_at', '>=', now()->subDays(30))->count(),
        ];

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
        $relatedPractices = Post::ofType('practice')
            ->active()
            ->where('slug', '!=', $slug)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

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

        $practices = Post::ofType('practice')
            ->active()
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

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
        $practices = Post::ofType('practice')
            ->active()
            ->whereNotNull('feature_image')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

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
        $stats = [
            'total' => Post::ofType('practice')->count(),
            'active' => Post::ofType('practice')->active()->count(),
            'with_images' => Post::ofType('practice')->active()->whereNotNull('feature_image')->count(),
            'recent' => Post::ofType('practice')->active()->where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Practice statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
