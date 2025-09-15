<?php

namespace App\Livewire\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use Livewire\WithPagination;

class GalleryComponent extends Component
{
    use WithPagination;

    public $galleries;
    public $currentImageIndex = 0;
    public $showLightbox = false;
    public $searchTerm = '';
    public $perPage = 20;

    public function mount()
    {
        $this->loadGalleries();
    }

    public function loadGalleries()
    {
        $query = Gallery::query();

        // Apply search filter if search term exists
        if (!empty($this->searchTerm)) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $this->galleries = $query->orderBy('created_at', 'desc')
                                ->take($this->perPage)
                                ->get();
    }

    public function updatedSearchTerm()
    {
        $this->loadGalleries();
    }

    public function openLightbox($index)
    {
        $this->currentImageIndex = $index;
        $this->showLightbox = true;
        $this->dispatch('lightbox-opened');
    }

    public function closeLightbox()
    {
        $this->showLightbox = false;
        $this->dispatch('lightbox-closed');
    }

    public function nextImage()
    {
        $this->currentImageIndex = ($this->currentImageIndex + 1) % $this->galleries->count();
    }

    public function previousImage()
    {
        $this->currentImageIndex = $this->currentImageIndex > 0 
            ? $this->currentImageIndex - 1 
            : $this->galleries->count() - 1;
    }

    public function loadMore()
    {
        $this->perPage += 20;
        $this->loadGalleries();
    }

    public function render()
    {
        return view('livewire.gallery.gallery-component');
    }
}
