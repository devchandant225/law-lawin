<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Profile;

class ContactSection extends Component
{
    public $profile;
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
        $this->profile = Profile::getProfile();
        $this->contactInfo = $contactInfo;
        $this->sectionTitle = $sectionTitle ?? 'Feel Free to <br><span>Write Us Anytime</span>';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Contact With Us';
        $this->sectionDescription = $sectionDescription ?? 'Get in touch with our expert legal team for professional consultation and assistance.';
        $this->showSocialLinks = $showSocialLinks;
        $this->formAction = $formAction ?? route('contact.submit');
        $this->showForm = $showForm;
    }

    /**
     * Get formatted contact information
     */
    public function getContactInfo()
    {
        if ($this->contactInfo) {
            return $this->contactInfo;
        }

        // Return default contact info if profile doesn't exist or is empty
        if (!$this->profile || !$this->profile->exists) {
            return [
                'phones' => [],
                'email' => null,
                'address' => null,
                'social' => []
            ];
        }

        return [
            'phones' => array_filter([
                $this->profile->phone1,
                $this->profile->phone2
            ]),
            'email' => $this->profile->email,
            'address' => $this->profile->address,
            'social' => [
                'facebook' => $this->profile->facebook_link,
                'instagram' => $this->profile->instagram_link,
                'twitter' => $this->profile->twitter_link,
                'linkedin' => $this->profile->linkedin_link,
                'youtube' => $this->profile->youtube_link,
                'whatsapp' => $this->profile->whatsapp,
                'viber' => $this->profile->viber,
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-section', [
            'profile' => $this->profile,
            'contactInfo' => $this->getContactInfo(),
            'sectionTitle' => $this->sectionTitle,
            'sectionSubtitle' => $this->sectionSubtitle,
            'sectionDescription' => $this->sectionDescription,
            'showSocialLinks' => $this->showSocialLinks,
            'formAction' => $this->formAction,
            'showForm' => $this->showForm,
        ]);
    }
}
