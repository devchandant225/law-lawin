<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Publication;
use Livewire\Attributes\On;

class PublicationSection extends Component
{
    public $search = '';
    public $limit;
    public $showViewAll;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;
    public $showSectionHeaders;
    public $publications;

    public function mount(
        $limit = 8,
        $showViewAll = true,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showSearch = true
    ) {
        $this->limit = $limit;
        
        // Hide "View All Publications" button if we're already on the publications page
        $currentUrl = request()->path();
        if ($currentUrl === 'publication') {
            $this->showViewAll = false;
        } else {
            $this->showViewAll = $showViewAll;
        }
        
        $this->sectionTitle = $sectionTitle ?? 'Publications';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Award';
        $this->sectionDescription = $sectionDescription ?? 'Legal Knowledge & Resources';
        $this->showSearch = $showSearch;
        
        $this->loadPublications();
    }

    public function updatedSearch()
    {
        $this->loadPublications();
    }

    public function loadPublications()
    {
        $query = Publication::active()->studyAbroad()->ordered();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                  ->orWhere('description', 'LIKE', "%{$this->search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$this->search}%");
            });
        }

        if ($this->limit) {
            $query->limit($this->limit);
        }

        $this->publications = $query->get();
    }

    public function render()
    {
        return view('livewire.publication-section');
    }
}
