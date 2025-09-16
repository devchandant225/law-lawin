<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProcessSection extends Component
{
    public $processes;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showCTA;
    public $ctaText;
    public $ctaUrl;

    /**
     * Create a new component instance.
     * 
     * @param array|null $processes
     * @param string|null $sectionTitle
     * @param string|null $sectionSubtitle
     * @param string|null $sectionDescription
     * @param bool $showCTA
     * @param string|null $ctaText
     * @param string|null $ctaUrl
     */
    public function __construct(
        $processes = null,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showCTA = true,
        $ctaText = null,
        $ctaUrl = null
    ) {
        $this->processes = $processes ?? $this->getDefaultProcesses();
        $this->sectionTitle = $sectionTitle ?? 'Our Process';
        $this->sectionSubtitle = $sectionSubtitle ?? 'How We Guide You';
        $this->sectionDescription = $sectionDescription ?? 'Your journey to studying abroad made simple with our proven step-by-step process';
        $this->showCTA = $showCTA;
        $this->ctaText = $ctaText ?? 'Start Your Journey';
        $this->ctaUrl = $ctaUrl ?? '/contact';
    }

    /**
     * Get default education consultancy process steps
     *
     * @return array
     */
    private function getDefaultProcesses()
    {
        return [
            [
                'id' => 1,
                'title' => 'Initial Consultation',
                'subtitle' => 'Free Assessment',
                'description' => 'We begin with a comprehensive consultation to understand your academic goals, preferences, and aspirations for studying abroad.',
                'icon' => 'chat',
                'duration' => '1-2 Hours',
                'features' => [
                    'Academic background assessment',
                    'Career goal alignment',
                    'Country preference discussion',
                    'Budget planning guidance'
                ]
            ],
            [
                'id' => 2,
                'title' => 'University Selection',
                'subtitle' => 'Perfect Match',
                'description' => 'Based on your profile, we help you select the most suitable universities and programs that align with your goals and budget.',
                'icon' => 'university',
                'duration' => '1 Week',
                'features' => [
                    'Customized university shortlist',
                    'Program compatibility analysis',
                    'Scholarship opportunity identification',
                    'Application deadline tracking'
                ]
            ],
            [
                'id' => 3,
                'title' => 'Application Preparation',
                'subtitle' => 'Documents Ready',
                'description' => 'Our experts guide you through preparing all necessary documents including SOP, LOR, and academic transcripts.',
                'icon' => 'document',
                'duration' => '2-3 Weeks',
                'features' => [
                    'Statement of Purpose writing',
                    'Letter of Recommendation guidance',
                    'Academic document verification',
                    'Portfolio preparation (if needed)'
                ]
            ],
            [
                'id' => 4,
                'title' => 'Application Submission',
                'subtitle' => 'Submit & Track',
                'description' => 'We handle the complete application submission process and keep you updated on the progress at every step.',
                'icon' => 'send',
                'duration' => '1-2 Days',
                'features' => [
                    'Online application completion',
                    'Document upload assistance',
                    'Application fee payment',
                    'Status tracking and updates'
                ]
            ],
            [
                'id' => 5,
                'title' => 'Visa Processing',
                'subtitle' => 'Legal Support',
                'description' => 'Once you receive admission offers, we provide comprehensive visa processing support to ensure a smooth approval.',
                'icon' => 'passport',
                'duration' => '4-6 Weeks',
                'features' => [
                    'Visa application preparation',
                    'Document checklist completion',
                    'Interview preparation sessions',
                    'Embassy appointment scheduling'
                ]
            ],
            [
                'id' => 6,
                'title' => 'Pre-Departure',
                'subtitle' => 'Ready to Go',
                'description' => 'Final preparations including accommodation, travel arrangements, and orientation to help you start your journey confidently.',
                'icon' => 'plane',
                'duration' => '2-3 Weeks',
                'features' => [
                    'Accommodation assistance',
                    'Flight booking guidance',
                    'Cultural orientation sessions',
                    'Banking and insurance setup'
                ]
            ]
        ];
    }

    /**
     * Get process by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getProcessById($id)
    {
        return collect($this->processes)->firstWhere('id', $id);
    }

    /**
     * Get process statistics
     *
     * @return array
     */
    public function getProcessStats()
    {
        return [
            'total_steps' => count($this->processes),
            'average_duration' => '12-16 weeks',
            'success_rate' => '98%',
            'countries_supported' => '25+'
        ];
    }

    /**
     * Get process icons mapping
     *
     * @return array
     */
    public function getProcessIcons()
    {
        return [
            'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>',
            'university' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>',
            'document' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
            'send' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>',
            'passport' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
            'plane' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7m5 14l-7-7 7-7"></path>'
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.process-section', [
            'processes' => $this->processes,
            'sectionTitle' => $this->sectionTitle,
            'sectionSubtitle' => $this->sectionSubtitle,
            'sectionDescription' => $this->sectionDescription,
            'showCTA' => $this->showCTA,
            'ctaText' => $this->ctaText,
            'ctaUrl' => $this->ctaUrl,
            'processIcons' => $this->getProcessIcons(),
            'stats' => $this->getProcessStats()
        ]);
    }
}
