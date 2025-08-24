<?php

namespace App\View\Components;

use App\Models\Team;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class TeamSection extends Component
{
    public $teams;
    public $showViewAll;
    public $limit;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $teams = null,
        $showViewAll = true,
        $limit = null,
        $sectionTitle = 'Our Team',
        $sectionSubtitle = 'Meet Our Professional Team',
        $sectionDescription = 'Our dedicated team of legal professionals brings years of experience and expertise to serve your legal needs with excellence.',
        $showSearch = false
    ) {
        $this->showViewAll = $showViewAll;
        $this->limit = $limit;
        $this->sectionTitle = $sectionTitle;
        $this->sectionSubtitle = $sectionSubtitle;
        $this->sectionDescription = $sectionDescription;
        $this->showSearch = $showSearch;
        
        // Set teams - if not provided, get default teams
        if ($teams === null) {
            if ($limit !== null && $showViewAll) {
                // Homepage context - get limited teams
                $this->teams = Team::active()->ordered()->take($limit)->get();
            } else {
                // Get all teams
                $this->teams = Team::active()->ordered()->get();
            }
        } else {
            $this->teams = $teams;
        }
    }

    /**
     * Get teams for homepage (limited to 8 by default).
     */
    public static function getHomeTeams($limit = 8)
    {
        return Team::active()->ordered()->take($limit)->get();
    }

    /**
     * Get all active teams.
     */
    public static function getAllTeams()
    {
        return Team::active()->ordered()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.team-section');
    }
}
