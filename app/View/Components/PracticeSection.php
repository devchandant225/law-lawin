<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class PracticeSection extends Component
{
    public $practices;
    public $limit;
    public $showViewAll;
    public $sectionTitle;
    public $sectionSubtitle;

    /**
     * Create a new component instance.
     * 
     * @param int|null $limit
     * @param bool $showViewAll
     * @param string|null $sectionTitle
     * @param string|null $sectionSubtitle
     */
    public function __construct($limit = 8, $showViewAll = false, $sectionTitle = null, $sectionSubtitle = null)
    {
        $this->limit = $limit;
        $this->showViewAll = $showViewAll;
        $this->sectionTitle = $sectionTitle ?? "We're Providing Best <br><span>Service To Clients</span>";
        $this->sectionSubtitle = $sectionSubtitle ?? 'Our Service';
        $this->practices = $this->getPractices($limit);
    }

    /**
     * Get practices for the practice section component
     *
     * @param int|null $limit
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPractices($limit = 8, $status = 'active')
    {
        $query = Post::where('type','practice')
                    ->active()
                    ->orderBy('created_at', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get practices for homepage (limited to 6)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHomePractices()
    {
        return $this->getPractices(8);
    }

    /**
     * Get all practices for practices page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPractices()
    {
        return $this->getPractices();
    }

    /**
     * Get featured practices (you can customize this logic)
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedPractices($limit = 4)
    {
        return Post::where('type','practice')
                  ->active()
                  ->whereNotNull('feature_image')
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get practices with pagination for admin or large lists
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedPractices($perPage = 12)
    {
        return Post::where('type','practice')
                  ->active()
                  ->orderBy('created_at', 'desc')
                  ->paginate($perPage);
    }

    /**
     * Get related practices (exclude current practice)
     *
     * @param string $currentSlug
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedPractices($currentSlug, $limit = 3)
    {
        return Post::where('type','practice')
                  ->active()
                  ->where('slug', '!=', $currentSlug)
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Search practices by title or description
     *
     * @param string $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchPractices($query, $limit = 10)
    {
        return Post::where('type','practice')
                  ->active()
                  ->where(function($q) use ($query) {
                      $q->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->orWhere('excerpt', 'LIKE', "%{$query}%");
                  })
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get practice statistics
     *
     * @return array
     */
    public function getPracticeStats()
    {
        return [
            'total' => Post::ofType('practice')->count(),
            'active' => Post::ofType('practice')->active()->count(),
            'with_images' => Post::ofType('practice')->active()->whereNotNull('feature_image')->count(),
            'recent' => Post::ofType('practice')->active()->where('created_at', '>=', now()->subDays(30))->count(),
        ];
    }

    /**
     * Get recent practices for navigation
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentPractices($limit = 8)
    {
        return Post::where('type','practice')
                  ->active()
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get practice icon class based on title (you can customize this mapping)
     */
    public function getPracticeIcon($title)
    {
        $iconMap = [
            'criminal' => 'icon-criminal-law',
            'family' => 'icon-family-law-1',
            'real estate' => 'icon-real-estate-law',
            'employment' => 'icon-employment-law',
            'business' => 'icon-business-law',
            'immigration' => 'icon-immigration-law',
            'tax' => 'icon-tax-law',
            'personal injury' => 'icon-personal-injury',
            'intellectual property' => 'icon-ip-law',
            'corporate' => 'icon-corporate-law',
            'civil' => 'icon-civil-law',
            'contract' => 'icon-contract-law',
            'property' => 'icon-property-law',
            'banking' => 'icon-banking-law',
            'insurance' => 'icon-insurance-law',
        ];

        $title = strtolower($title);
        foreach ($iconMap as $keyword => $icon) {
            if (strpos($title, $keyword) !== false) {
                return $icon;
            }
        }

        return 'icon-law'; // default icon
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.practice-section', [
            'practices' => $this->practices,
            'showViewAll' => $this->showViewAll,
            'sectionTitle' => $this->sectionTitle,
            'sectionSubtitle' => $this->sectionSubtitle,
        ]);
    }
}
