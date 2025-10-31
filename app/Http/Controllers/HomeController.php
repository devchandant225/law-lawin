<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Publication;
use App\Models\Portfolio;
use App\Models\TableOfContent;
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

    public function termsCondition()
    {
        $publication = Publication::where('post_type', 'terms-condition')
            ->where('status', 'active')
            ->first();
        
        if (!$publication) {
            abort(404, 'Terms & Conditions page not found.');
        }
        
        $tableOfContents = TableOfContent::where('publication_id', $publication->id)
            ->where('status', true)
            ->orderBy('order_index', 'asc')
            ->get();
        
        return view('terms-condition', compact('publication', 'tableOfContents'));
    }

    public function privacyPolicy()
    {
        $publication = Publication::where('post_type', 'privacy-policy')
            ->where('status', 'active')
            ->first();
        
        if (!$publication) {
            abort(404, 'Privacy Policy page not found.');
        }
        
        $tableOfContents = TableOfContent::where('publication_id', $publication->id)
            ->where('status', true)
            ->orderBy('order_index', 'asc')
            ->get();
        
        return view('privacy-policy', compact('publication', 'tableOfContents'));
    }

    public function cookiesPolicy()
    {
        $publication = Publication::where('post_type', 'cookies-policy')
            ->where('status', 'active')
            ->first();
        
        if (!$publication) {
            abort(404, 'Cookies Policy page not found.');
        }
        
        $tableOfContents = TableOfContent::where('publication_id', $publication->id)
            ->where('status', true)
            ->orderBy('order_index', 'asc')
            ->get();
        
        return view('cookies-policy', compact('publication', 'tableOfContents'));
    }
}

