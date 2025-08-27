<?php

namespace App\View\Components;

use App\Models\Portfolio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TestimonialSection extends Component
{
    public Collection $portfolios;
    public string $sectionTitle;
    public string $sectionSubtitle;
    public int $limit;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?Collection $portfolios = null,
        string $sectionTitle = 'Clients We Served',
        string $sectionSubtitle = 'Our Happy Clients',
        int $limit = 8
    ) {
        $this->portfolios = $portfolios ?? Portfolio::active()->ordered()->get();
        $this->sectionTitle = $sectionTitle;
        $this->sectionSubtitle = $sectionSubtitle;
        $this->limit = $limit;
    }

    /**
     * Get portfolios for testimonial display (clients we served)
     *
     * @param int $limit
     * @return Collection
     */
    public static function getTestimonialPortfolios(int $limit = 8): Collection
    {
        return Portfolio::active()
            ->ordered()
            ->whereNotNull('image')
            ->take($limit)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial-section');
    }
}
