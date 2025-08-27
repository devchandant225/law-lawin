<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Contact Section Component
 * 
 * This component displays contact information and an optional contact form.
 * It uses the globalProfile from ProfileViewComposerServiceProvider as a fallback
 * when no specific contactInfo is provided.
 * 
 * The component will prioritize contactInfo passed as props, but will fall back
 * to globalProfile data (phone1, phone2, email, address) when available.
 */
class ContactSection extends Component
{
    public $contactInfo;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSocialLinks;
    public $formAction;
    public $showForm;

    /**
     * Create a new component instance.
     * 
     * @param array|null $contactInfo
     * @param string|null $sectionTitle
     * @param string|null $sectionSubtitle
     * @param string|null $sectionDescription
     * @param bool $showSocialLinks
     * @param string|null $formAction
     * @param bool $showForm
     */
    public function __construct(
        $contactInfo = null,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showSocialLinks = true,
        $formAction = null,
        $showForm = true
    ) {
        $this->contactInfo = $contactInfo;
        $this->sectionTitle = $sectionTitle ?? 'Feel Free to <br><span>Write Us Anytime</span>';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Contact With Us';
        $this->sectionDescription = $sectionDescription ?? 'Get in touch with our expert legal team for professional consultation and assistance.';
        $this->showSocialLinks = $showSocialLinks;
        $this->formAction = $formAction ?? route('contact.submit');
        $this->showForm = $showForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-section', [
            'contactInfo' => $this->contactInfo,
            'sectionTitle' => $this->sectionTitle,
            'sectionSubtitle' => $this->sectionSubtitle,
            'sectionDescription' => $this->sectionDescription,
            'showSocialLinks' => $this->showSocialLinks,
            'formAction' => $this->formAction,
            'showForm' => $this->showForm,
        ]);
    }
}
