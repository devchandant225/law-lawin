<?php

namespace App\View\Components;

use App\Models\Portfolio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PortfolioSection extends Component
{
    public $portfolios;
    public $showViewAll;
    public $limit;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $portfolios = null,
        $showViewAll = true,
        $limit = 10,
        $sectionTitle = 'Our Portfolio',
        $sectionSubtitle = 'Discover Our Work',
        $sectionDescription = 'Explore our comprehensive portfolio showcasing our successful projects and professional achievements.',
        $showSearch = false
    ) {
        $this->showViewAll = $showViewAll;
        $this->limit = $limit;
        $this->sectionTitle = $sectionTitle;
        $this->sectionSubtitle = $sectionSubtitle;
        $this->sectionDescription = $sectionDescription;
        $this->showSearch = $showSearch;

        // Set portfolios - if not provided, get default portfolios
        $this->portfolios = $portfolios ?? $this->getDefaultPortfolios();
    }

    /**
     * Get default portfolios (homepage context).
     */
    private function getDefaultPortfolios()
    {
        return $this->showViewAll && $this->limit
            ? Portfolio::active()->ordered()->take($this->limit)->get()
            : Portfolio::active()->ordered()->get();
    }

    /**
     * Get portfolios for homepage (limited to 10 by default).
     */
    public static function getHomePortfolios($limit = 10)
    {
        return Portfolio::active()->ordered()->take($limit)->get();
    }

    /**
     * Get all active portfolios.
     */
    public static function getAllPortfolios()
    {
        return Portfolio::active()->ordered()->get();
    }

    /**
     * Get portfolios with specific limit.
     */
    public static function getPortfolios($limit = null)
    {
        $query = Portfolio::active()->ordered();

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Get featured portfolios (you can customize this logic).
     */
    public static function getFeaturedPortfolios($limit = 6)
    {
        return Portfolio::active()
            ->ordered()
            ->whereNotNull('image')
            ->take($limit)
            ->get();
    }

    /**
     * Get portfolios with pagination for portfolio page or large lists.
     */
    public static function getPaginatedPortfolios($perPage = 12)
    {
        return Portfolio::active()
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * Search portfolios by title.
     */
    public static function searchPortfolios($query, $limit = 20)
    {
        return Portfolio::active()
            ->where('title', 'LIKE', "%{$query}%")
            ->ordered()
            ->take($limit)
            ->get();
    }

    /**
     * Get portfolio statistics.
     */
    public static function getPortfolioStats()
    {
        return [
            'total'       => Portfolio::count(),
            'active'      => Portfolio::active()->count(),
            'with_images' => Portfolio::active()->whereNotNull('image')->count(),
            'inactive'    => Portfolio::where('status', 'inactive')->count(),
        ];
    }

    /**
     * Get recent portfolios (created within last 30 days).
     */
    public static function getRecentPortfolios($limit = 5)
    {
        return Portfolio::active()
            ->where('created_at', '>=', now()->subDays(30))
            ->ordered()
            ->take($limit)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portfolio-section');
    }
}
