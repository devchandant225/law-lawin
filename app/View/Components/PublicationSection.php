<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Publication;

class PublicationSection extends Component
{
    public $publications;
    public $limit;
    public $showViewAll;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;

    /**
     * Create a new component instance.
     * 
     * @param int|null $limit
     * @param bool $showViewAll
     * @param string|null $sectionTitle
     * @param string|null $sectionSubtitle
     * @param string|null $sectionDescription
     * @param bool $showSearch
     */
    public function __construct(
        $publications = null,
        $limit = 8,
        $showViewAll = true,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showSearch = false
    ) {
        $this->limit = $limit;
        $this->showViewAll = $showViewAll;
        $this->sectionTitle = $sectionTitle ?? 'Publications';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Award';
        $this->sectionDescription = $sectionDescription ?? 'Legal Knowledge & Resources';
        $this->showSearch = $showSearch;
        
        // Set publications - if not provided, get default publications
        if ($publications === null) {
            $this->publications = $this->getPublications($limit);
        } else {
            $this->publications = $publications;
        }
    }

    /**
     * Get publications for the publication section component
     * Now specifically fetches only study-abroad post type
     *
     * @param int|null $limit
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublications($limit = 8, $status = 'active')
    {
        $query = Publication::active()->studyAbroad()->ordered();

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get publications for homepage (limited to 8 by default)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHomePublications()
    {
        return $this->getPublications(8);
    }

    /**
     * Get all publications for publications page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPublications()
    {
        return $this->getPublications();
    }

    /**
     * Get featured publications (you can customize this logic)
     * Now specifically fetches only study-abroad post type
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeaturedPublications($limit = 4)
    {
        return Publication::active()
                  ->studyAbroad()
                  ->whereNotNull('feature_image')
                  ->ordered()
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get publications with pagination for admin or large lists
     * Now specifically fetches only study-abroad post type
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedPublications($perPage = 12)
    {
        return Publication::active()
                  ->studyAbroad()
                  ->ordered()
                  ->paginate($perPage);
    }

    /**
     * Get related publications (exclude current publication)
     * Now specifically fetches only study-abroad post type
     *
     * @param string $currentSlug
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedPublications($currentSlug, $limit = 3)
    {
        return Publication::active()
                  ->studyAbroad()
                  ->where('slug', '!=', $currentSlug)
                  ->ordered()
                  ->limit($limit)
                  ->get();
    }

    /**
     * Search publications by title or description
     * Now specifically searches only study-abroad post type
     *
     * @param string $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchPublications($query, $limit = 10)
    {
        return Publication::active()
                  ->studyAbroad()
                  ->where(function($q) use ($query) {
                      $q->where('title', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->orWhere('excerpt', 'LIKE', "%{$query}%");
                  })
                  ->ordered()
                  ->limit($limit)
                  ->get();
    }

    /**
     * Get publication statistics
     * Now specifically provides stats for study-abroad post type
     *
     * @return array
     */
    public function getPublicationStats()
    {
        return [
            'total' => Publication::studyAbroad()->count(),
            'active' => Publication::active()->studyAbroad()->count(),
            'with_images' => Publication::active()->studyAbroad()->whereNotNull('feature_image')->count(),
            'recent' => Publication::active()->studyAbroad()->where('created_at', '>=', now()->subDays(30))->count(),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.publication-section', [
            'publications' => $this->publications,
            'showViewAll' => $this->showViewAll,
            'sectionTitle' => $this->sectionTitle,
            'sectionSubtitle' => $this->sectionSubtitle,
            'sectionDescription' => $this->sectionDescription,
            'showSearch' => $this->showSearch,
        ]);
    }
}
