<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Publication;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ServiceLocationSection extends Component
{
    use WithPagination;
    
    public $search = '';
    public $perPage;
    public $showViewAll;
    public $sectionTitle;
    public $sectionSubtitle;
    public $sectionDescription;
    public $showSearch;
    public $serviceLocations;

    public function mount(
        $perPage = 8,
        $showViewAll = true,
        $sectionTitle = null,
        $sectionSubtitle = null,
        $sectionDescription = null,
        $showSearch = true
    ) {
        $this->perPage = $perPage;
        $this->showViewAll = $showViewAll;
        $this->sectionTitle = $sectionTitle ?? 'Service Locations';
        $this->sectionSubtitle = $sectionSubtitle ?? 'Locations';
        $this->sectionDescription = $sectionDescription ?? 'Find Legal Services Near You';
        $this->showSearch = $showSearch;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->perPage += 8;
    }

    public function render()
    {
        $query = Publication::active()->serviceLocation()->ordered();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('title', 'LIKE', "%{$this->search}%")
                  ->orWhere('description', 'LIKE', "%{$this->search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$this->search}%");
            });
        }

        $serviceLocations = $query->paginate($this->perPage);

        return view('livewire.service-location-section', [
            'serviceLocations' => $serviceLocations
        ]);
    }
}
