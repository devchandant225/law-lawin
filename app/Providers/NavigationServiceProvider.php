<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Publication;
use App\Models\Team;

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
        View::composer(['layouts.header', 'layouts.new-header', 'layouts.partials.navigation', '*'], function ($view) {
            // Get services for navigation dropdown
            $navServices = $this->getNavigationServices();

            // Get publications for navigation dropdown
            $navPublications = $this->getNavigationPublications();

            // Get practice areas for navigation dropdown
            $navPracticeAreas = $this->getNavigationPracticeAreas();

            // Get news for navigation dropdown
            $navNews = $this->getNavigationNews();

            // Get team members for navigation dropdown
            $navTeamMembers = $this->getNavigationTeamMembers();

            // Get help desk navigation items
            $navHelpDeskItems = $this->getNavigationHelpDeskItems();

            $view->with([
                'navServices' => $navServices,
                'navPublications' => $navPublications,
                'navPracticeAreas' => $navPracticeAreas,
                'navNews' => $navNews,
                'navTeamMembers' => $navTeamMembers,
                'navHelpDeskItems' => $navHelpDeskItems,
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
            return Post::where('type', 'service')->active()->orderBy('orderposition', 'asc')->select('id', 'title', 'slug', 'excerpt')->get();
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
            return Publication::active()->ordered()->select('id', 'title', 'slug', 'excerpt')->limit(10)->get();
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
            return Post::where('type', 'practice')->active()->orderBy('orderposition', 'asc')->select('id', 'title', 'slug', 'excerpt')->get();
        });
    }

    /**
     * Get news for navigation dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationNews()
    {
        return cache()->remember('nav_news', 3600, function () {
            return Post::where('type', 'news')->active()->orderBy('created_at', 'desc')->select('id', 'title', 'slug', 'excerpt')->limit(10)->get();
        });
    }

    /**
     * Get team members for navigation dropdown
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationTeamMembers()
    {
        return cache()->remember('nav_team_members', 3600, function () {
            return Team::active()->ordered()->select('id', 'name', 'slug', 'designation', 'image')->limit(10)->get();
        });
    }

    /**
     * Get help desk navigation items
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getNavigationHelpDeskItems()
    {
        return cache()->remember('nav_help_desk', 3600, function () {
            return Post::where('type', 'help_desk')->active()->orderBy('orderposition', 'asc')->select('id', 'title', 'slug', 'excerpt')->get();
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
        cache()->forget('nav_news');
        cache()->forget('nav_team_members');
        cache()->forget('nav_help_desk');
    }
}
