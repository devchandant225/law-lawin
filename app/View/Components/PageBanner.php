<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Page Banner Component
 * 
 * This component displays a page banner with customizable title, breadcrumbs,
 * and background settings.
 */
class PageBanner extends Component
{
    public $title;
    public $breadcrumbs;
    public $backgroundImage;
    public $subtitle;
    public $showBreadcrumbs;

    /**
     * Create a new component instance.
     * 
     * @param string $title Page title
     * @param array|null $breadcrumbs Breadcrumb items [['label' => 'Home', 'url' => '/'], ['label' => 'Current']]
     * @param string|null $backgroundImage Custom background image URL
     * @param string|null $subtitle Optional subtitle
     * @param bool $showBreadcrumbs Whether to show breadcrumbs
     */
    public function __construct(
        $title = 'Page Title',
        $breadcrumbs = null,
        $backgroundImage = null,
        $subtitle = null,
        $showBreadcrumbs = true
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->backgroundImage = $backgroundImage;
        $this->showBreadcrumbs = $showBreadcrumbs;
        
        // Default breadcrumbs if none provided
        $this->breadcrumbs = $breadcrumbs ?? [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => $this->title]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-banner', [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'breadcrumbs' => $this->breadcrumbs,
            'backgroundImage' => $this->backgroundImage,
            'showBreadcrumbs' => $this->showBreadcrumbs,
        ]);
    }
}
