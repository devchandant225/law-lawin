<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Profile;

class PublicationContactForm extends Component
{
    public $title;
    public $subtitle;
    public $description;
    public $showSocialMedia;
    public $formAction;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = 'Get in Touch with Our Legal Experts',
        $subtitle = 'CONTACT FORM: REACH OUT TO US AT ANY TIME',
        $description = null,
        $showSocialMedia = true,
        $formAction = null
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->description = $description ?? 'Have a question or need legal assistance? Fill out our contact form and our team of experienced lawyers in Kathmandu, Nepal will get back to you promptly.';
        $this->showSocialMedia = $showSocialMedia;
        $this->formAction = $formAction ?? route('contact.submit');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.publication-contact-form');
    }
}
