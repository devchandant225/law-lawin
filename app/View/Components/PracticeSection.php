<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class PracticeSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get practices for the practice section component
     *
     * @param int|null $limit
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPractices($limit = null, $status = 'active')
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
        return $this->getPractices(6);
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
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $practices = $this->getHomePractices();
        return view('components.practice-section', compact('practices'));
    }
}
