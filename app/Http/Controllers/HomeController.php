<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Publication;
use App\View\Components\ServiceSection;
use App\View\Components\TeamSection;

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
    
        
        return view('home', compact('sliders', 'services', 'teams'));
    }
}

