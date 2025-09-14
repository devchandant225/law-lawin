<?php

namespace App\View\Components;

use App\Models\Testimonial as TestimonialModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonial extends Component
{
    public $testimonials;
    public $limit;
    public $showAll;

    /**
     * Create a new component instance.
     */
    public function __construct($limit = 6, $showAll = false)
    {
        $this->limit = $limit;
        $this->showAll = $showAll;
        
        $query = TestimonialModel::active()->ordered();
        
        if (!$showAll) {
            $query = $query->limit($this->limit);
        }
        
        $this->testimonials = $query->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial');
    }
}
