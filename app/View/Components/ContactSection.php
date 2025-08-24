<?php

namespace App\View\Components;

use App\Models\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactSection extends Component
{
    public $profile;
    public $showContactForm;

    /**
     * Create a new component instance.
     */
    public function __construct($showContactForm = true)
    {
        $this->profile = Profile::getProfile();
        $this->showContactForm = $showContactForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.contact-section');
    }
}
