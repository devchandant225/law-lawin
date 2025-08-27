<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Publication;
use App\Models\Portfolio;
use App\View\Components\ServiceSection;
use App\View\Components\TeamSection;
use App\View\Components\PortfolioSection;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch active sliders ordered by their order list
        $sliders = Slider::active()->ordered()->get();
        
        // Fetch services for homepage (limited to 8)
        $serviceSection = new ServiceSection();
        $services = $serviceSection->getHomeServices();
        
        // Fetch team members for homepage (limited to 8)
        $teams = TeamSection::getHomeTeams(8);
        
        // Fetch portfolios for homepage (limited to 10 for portfolio section, 8 for testimonial)
        $portfolios = PortfolioSection::getHomePortfolios();
        
        return view('home', compact('sliders', 'services', 'teams', 'portfolios'));
    }
}

