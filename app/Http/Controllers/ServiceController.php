<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\View\Components\ServiceSection;

class ServiceController extends Controller
{
    protected $serviceSection;

    public function __construct()
    {
        $this->serviceSection = new ServiceSection();
    }

    /**
     * Display a listing of all services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all services
        $services = $this->serviceSection->getAllServices();
        
        // Get service statistics
        $serviceStats = $this->serviceSection->getServiceStats();
        
        return view('service.index', compact('services', 'serviceStats'));
    }

    /**
     * Display the specified service.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Find the service by slug
        $service = Post::ofType('service')
                      ->active()
                      ->where('slug', $slug)
                      ->firstOrFail();

        // Get left-right contents associated with this service (post)
        $leftRightContents = $service->leftRightContents()
            ->where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        // Get FAQs associated with this service (post)
        $faqs = $service->postFaqs()
            ->where('status', 'active')
            ->orderBy('created_at', 'asc')
            ->get();

        // Get related services
        $relatedServices = Post::ofType('service')
            ->active()
            ->where('slug', '!=', $slug)
            ->orderBy('created_at', 'desc')
            ->limit($service->layout === 'fullscreen' ? 12 : 6)
            ->get();

        return view('service.show', compact('service', 'leftRightContents', 'faqs', 'relatedServices'));
    }

    /**
     * Search services (API endpoint or for search functionality).
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

        $services = $this->serviceSection->searchServices($query, $limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Services found successfully',
            'data' => $services,
            'query' => $query,
            'count' => $services->count()
        ]);
    }

    /**
     * Get featured services (API endpoint or for featured section).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function featured(Request $request)
    {
        $limit = $request->get('limit', 4);
        $services = $this->serviceSection->getFeaturedServices($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'Featured services retrieved successfully',
            'data' => $services,
            'count' => $services->count()
        ]);
    }

    /**
     * Get service statistics (API endpoint).
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $stats = $this->serviceSection->getServiceStats();

        return response()->json([
            'status' => 'success',
            'message' => 'Service statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
