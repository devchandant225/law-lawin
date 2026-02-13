<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTags extends Component
{
    public $title;
    public $description;
    public $keywords;
    public $image;
    public $type;
    public $post;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $description = null, $keywords = null, $image = null, $type = 'website', $post = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->image = $image;
        $this->type = $type;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.meta-tags');
    }
}
