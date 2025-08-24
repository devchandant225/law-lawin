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
            'contentSections' => $this->contentSections
        ]);
    }
}
