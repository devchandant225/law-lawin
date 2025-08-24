<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Slider;

class Banner extends Component
{
    /**
     * The collection of sliders.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $sliders;

    /**
     * Create a new component instance.
     *
     * @param  \Illuminate\Database\Eloquent\Collection|null  $sliders
     * @return void
     */
    public function __construct($sliders = null)
    {
        // If no sliders are passed, fetch active sliders
        $this->sliders = $sliders ?? Slider::active()->ordered()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner', [
            'sliders' => $this->sliders
        ]);
    }
}
