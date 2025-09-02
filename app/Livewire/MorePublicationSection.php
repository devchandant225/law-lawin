<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Publication;
use Livewire\Attributes\On;

class MorePublicationSection extends Component
{
    public $search = '';
    public $limit;
    public $showViewAll;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;
    public $morePublications;

    public function mount(
        $limit = 8,
        $showViewAll = true,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showSearch = true
    ) {
        $this->limit = $limit;
        $this->showViewAll = $showViewAll;
        $this->sectionTitle = $sectionTitle ?? 'More Publications';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Extended Resources';
        $this->sectionDescription = $sectionDescription ?? 'Additional Legal Knowledge & Resources';
        $this->showSearch = $showSearch;
        
        $this->loadMorePublications();
    }

    public function updatedSearch()
    {
        $this->loadMorePublications();
    }

    public function loadMorePublications()
    {
        $query = Publication::active()->morePublication()->ordered();

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

        $this->morePublications = $query->get();
    }

    public function render()
    {
        return view('livewire.more-publication-section');
    }
}
