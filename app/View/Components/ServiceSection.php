<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class ServiceSection extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get services for the service section component
     *
     * @param int|null $limit
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getServices($limit = null, $status = 'active')
    {
        $query = Post::ofType('service')
                    ->active()
                    ->orderBy('created_at', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get services for homepage (limited to 8)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHomeServices()
    {
        return $this->getServices(8);
    }

    /**
     * Get all services for services page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllServices()
    {
        return $this->getServices();
    }

    /**
     * Get featured services (you can customize this logic)
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedServices($limit = 4)
    {
        return Post::ofType('service')
                  ->active()
                  ->whereNotNull('feature_image')
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get services with pagination for admin or large lists
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedServices($perPage = 12)
    {
        return Post::ofType('service')
                  ->active()
                  ->orderBy('created_at', 'desc')
                  ->paginate($perPage);
    }

    /**
     * Get related services (exclude current service)
     *
     * @param string $currentSlug
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedServices($currentSlug, $limit = 3)
    {
        return Post::ofType('service')
                  ->active()
                  ->where('slug', '!=', $currentSlug)
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get();
    }

    /**
     * Search services by title or description
     *
     * @param string $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchServices($query, $limit = 10)
    {
        return Post::ofType('service')
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
     * Get service statistics
     *
     * @return array
     */
    public function getServiceStats()
    {
        return [
            'total' => Post::ofType('service')->count(),
            'active' => Post::ofType('service')->active()->count(),
            'with_images' => Post::ofType('service')->active()->whereNotNull('feature_image')->count(),
            'recent' => Post::ofType('service')->active()->where('created_at', '>=', now()->subDays(30))->count(),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-section');
    }
}
