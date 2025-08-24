<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share navigation data with all views
        View::composer(['layouts.header', 'layouts.partials.navigation', '*'], function ($view) {
            // Get services for navigation dropdown
            $navServices = $this->getNavigationServices();

            // Get publications for navigation dropdown
            $navPublications = $this->getNavigationPublications();

            // Get other navigation items if needed
            $navPracticeAreas = $this->getNavigationPracticeAreas();

            $view->with([
                'navServices' => $navServices,
                'navPublications' => $navPublications,
                'navPracticeAreas' => $navPracticeAreas,
            ]);
        });
    }

    /**
     * Get services for navigation dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationServices()
    {
        return cache()->remember('nav_services', 3600, function () {
            return Post::where('type', 'service')->active()->orderBy('title', 'asc')->select('id', 'title', 'slug', 'excerpt')->get();
        });
    }

    /**
     * Get publications for navigation dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationPublications()
    {
        return cache()->remember('nav_publications', 3600, function () {
            return Post::where('type', 'publication')->active()->orderBy('created_at', 'desc')->select('id', 'title', 'slug', 'excerpt')->get();
        });
    }

    /**
     * Get practice areas for navigation dropdown (if needed)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationPracticeAreas()
    {
        return cache()->remember('nav_practice_areas', 3600, function () {
            return Post::where('type', 'practice')->active()->orderBy('title', 'asc')->select('id', 'title', 'slug', 'excerpt')->get();
        });
    }

    /**
     * Clear navigation cache
     *
     * @return void
     */
    public static function clearNavigationCache()
    {
        cache()->forget('nav_services');
        cache()->forget('nav_publications');
        cache()->forget('nav_practice_areas');
    }
}
