<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\AboutUsContentSection;
use Illuminate\Support\Facades\Request;

class AboutUs extends Component
{
    public $contentSections;
    public $intro_home;
    public $why_choose_home;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Determine the page type based on the current route
        $pageType = $this->determinePageType();

        // Fetch active content sections for the specific page type
        $this->contentSections = AboutUsContentSection::active()
            ->forPageType($pageType)
            ->ordered()
            ->get();

        // Fetch specific content for intro_home (order 1) and why_choose_home (order 2)
        // Both should have page type home and be active
        $this->intro_home = AboutUsContentSection::active()
            ->forPageType(AboutUsContentSection::PAGE_TYPE_HOME)
            ->where('order_list', 1)
            ->first();

        $this->why_choose_home = AboutUsContentSection::active()
            ->forPageType(AboutUsContentSection::PAGE_TYPE_HOME)
            ->where('order_list', 2)
            ->first();
    }

    /**
     * Determine the page type based on the current route
     */
    protected function determinePageType(): string
    {
        $currentRoute = Request::path();

        // Check if the current route is the home page
        if ($currentRoute === '/' || $currentRoute === 'home') {
            return AboutUsContentSection::PAGE_TYPE_HOME;
        }

        // Check if the current route contains 'about'
        if (strpos($currentRoute, 'about') !== false) {
            return AboutUsContentSection::PAGE_TYPE_ABOUT;
        }

        // Default to home page type if no match
        return AboutUsContentSection::PAGE_TYPE_HOME;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.about-us', [
            'contentSections' => $this->contentSections,
            'intro_home' => $this->intro_home,
            'why_choose_home' => $this->why_choose_home
        ]);
    }
}
