<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display a listing of active portfolios.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Portfolio::active()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }

        // Paginate results - 25 per page for better grid display (5 columns x 5 rows)
        $portfolios = $query->paginate(25)->appends($request->query());

        return view('portfolios.index', compact('portfolios'));
    }

    /**
     * Get featured portfolios for homepage
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getFeatured(int $limit = 10)
    {
        return Portfolio::active()->ordered()->take($limit)->get();
    }

    /**
     * Get portfolio statistics
     *
     * @return array
     */
    public static function getStats(): array
    {
        return [
            'total' => Portfolio::count(),
            'active' => Portfolio::active()->count(),
            'inactive' => Portfolio::where('status', 'inactive')->count(),
            'recent' => Portfolio::where('created_at', '>=', now()->subDays(30))->count(),
        ];
    }
}
