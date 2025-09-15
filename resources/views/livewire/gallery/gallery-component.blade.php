<div>
    <!-- Search and Filter Section -->
    <div class="container mx-auto px-4 mb-8">
        <div class="max-w-4xl mx-auto">
            <!-- Search Bar -->
            <div class="flex flex-col md:flex-row gap-4 items-center justify-center mb-6">
                <div class="relative flex-1 max-w-md">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Search gallery..."
                        class="w-full px-4 py-3 pl-12 bg-white rounded-full border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all duration-300"
                    >
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    @if($searchTerm)
                        <button 
                            wire:click="$set('searchTerm', '')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    @endif
                </div>

            </div>

            <!-- Gallery Stats -->
            @if($galleries->count() > 0)
                <div class="text-center mb-8">
                    <div class="inline-flex items-center px-6 py-3 bg-white rounded-full shadow-sm">
                        <i class="fas fa-images text-primary mr-3"></i>
                        <span class="text-gray-700 font-medium">{{ $galleries->count() }} Images in Gallery</span>
                        @if($searchTerm)
                            <span class="ml-2 text-sm text-gray-500">(filtered)</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Gallery Grid -->
    @if($galleries->count() > 0)
        <div class="container mx-auto px-4">
            <div class="masonry-grid" id="masonry-grid">
                @foreach($galleries as $index => $gallery)
                    <div class="masonry-item gallery-image-item" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ ($index % 6) * 100 }}"
                         data-index="{{ $index }}">
                        <div class="gallery-card group cursor-pointer overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden">
                                <img src="{{ $gallery->image_url }}" 
                                     alt="{{ $gallery->alt_text }}" 
                                     class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy"
                                     wire:click="openLightbox({{ $index }})">
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                        <h3 class="text-lg font-semibold mb-2">{{ $gallery->title }}</h3>
                                        @if($gallery->description)
                                            <p class="text-sm text-gray-200 opacity-90 line-clamp-2">
                                                {{ Str::limit($gallery->description, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    <!-- View Icon -->
                                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-50 group-hover:scale-100">
                                        <i class="fas fa-expand text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if($galleries->count() >= $perPage)
                <div class="text-center mt-12">
                    <button 
                        wire:click="loadMore"
                        class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-full font-semibold hover:from-primary/90 hover:to-secondary/90 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center"
                        wire:loading.attr="disabled"
                        wire:target="loadMore"
                    >
                        <span wire:loading.remove wire:target="loadMore">
                            <i class="fas fa-plus mr-2"></i> Load More Images
                        </span>
                        <span wire:loading wire:target="loadMore">
                            <i class="fas fa-spinner fa-spin mr-2"></i> Loading...
                        </span>
                    </button>
                </div>
            @endif
        </div>

        <!-- Lightbox Modal -->
        @if($showLightbox && $galleries->count() > 0)
            <div class="lightbox fixed inset-0 bg-black/95 z-50 flex items-center justify-center opacity-100 visible transition-all duration-300">
                <div class="lightbox-container relative max-w-7xl max-h-full p-4">
                    <!-- Navigation Arrows -->
                    <button 
                        wire:click="previousImage"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-300 z-10"
                    >
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <button 
                        wire:click="nextImage"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-300 z-10"
                    >
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <!-- Close Button -->
                    <button 
                        wire:click="closeLightbox"
                        class="absolute top-4 right-4 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-all duration-300 z-10"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <!-- Image Container -->
                    <div class="flex items-center justify-center h-full">
                        <div class="relative">
                            @if(isset($galleries[$currentImageIndex]))
                                <img src="{{ $galleries[$currentImageIndex]->image_url }}" 
                                     alt="{{ $galleries[$currentImageIndex]->alt_text }}" 
                                     class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                                
                                <!-- Image Info -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white rounded-b-lg">
                                    <h3 class="text-xl font-semibold mb-2">{{ $galleries[$currentImageIndex]->title }}</h3>
                                    <p class="text-gray-200 text-sm">{{ $galleries[$currentImageIndex]->description ?? '' }}</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <span class="text-xs text-gray-300">{{ $currentImageIndex + 1 }} of {{ $galleries->count() }}</span>
                                        <div class="flex space-x-2">
                                            <a href="{{ $galleries[$currentImageIndex]->image_url }}" 
                                               download="{{ $galleries[$currentImageIndex]->title }}.jpg"
                                               target="_blank"
                                               class="px-3 py-1 bg-white/20 hover:bg-white/30 rounded text-xs transition-colors duration-300">
                                                <i class="fas fa-download mr-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Thumbnail Strip -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2">
                    <div class="flex space-x-2 p-2 bg-white/10 backdrop-blur-sm rounded-full max-w-2xl overflow-x-auto scrollbar-hide">
                        @php
                            $start = max(0, $currentImageIndex - 5);
                            $end = min($galleries->count(), $currentImageIndex + 6);
                        @endphp
                        @for($i = $start; $i < $end; $i++)
                            @if(isset($galleries[$i]))
                                <img src="{{ $galleries[$i]->image_url }}" 
                                     alt="{{ $galleries[$i]->alt_text }}"
                                     class="thumbnail w-10 h-10 object-cover rounded cursor-pointer transition-all duration-300 {{ $i == $currentImageIndex ? 'opacity-100 border-2 border-white' : 'opacity-60 hover:opacity-100' }}"
                                     wire:click="$set('currentImageIndex', {{ $i }})">
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="container mx-auto px-4">
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <div class="mb-8">
                        <i class="fas fa-images text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-4">
                        @if($searchTerm)
                            No images found
                        @else
                            No Images Yet
                        @endif
                    </h3>
                    <p class="text-gray-500 mb-8">
                        @if($searchTerm)
                            Try adjusting your search terms or filters.
                        @else
                            Our gallery is being curated. Please check back soon for amazing images!
                        @endif
                    </p>
                    @if($searchTerm)
                        <button 
                            wire:click="$set('searchTerm', '')"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-full font-semibold hover:from-primary/90 hover:to-secondary/90 transition-all duration-300 mr-4"
                        >
                            <i class="fas fa-times mr-2"></i> Clear Search
                        </button>
                    @endif
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-full font-semibold hover:from-primary/90 hover:to-secondary/90 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Loading Indicator -->
    <div wire:loading.delay wire:target="loadGalleries,updatedSearchTerm" 
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-lg p-4 z-50">
        <div class="flex items-center space-x-3">
            <i class="fas fa-spinner fa-spin text-primary"></i>
            <span class="text-gray-600">Loading images...</span>
        </div>
    </div>

    @script
    <script>
        // Keyboard navigation for lightbox
        document.addEventListener('keydown', function(e) {
            if (!$wire.showLightbox) return;
            
            switch(e.key) {
                case 'Escape':
                    $wire.closeLightbox();
                    break;
                case 'ArrowRight':
                    $wire.nextImage();
                    break;
                case 'ArrowLeft':
                    $wire.previousImage();
                    break;
            }
        });

        // Initialize AOS when component loads
        document.addEventListener('livewire:navigated', function () {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });

        // Handle lightbox body scroll
        $wire.on('lightbox-opened', () => {
            document.body.style.overflow = 'hidden';
        });

        $wire.on('lightbox-closed', () => {
            document.body.style.overflow = 'auto';
        });

        // Touch/Swipe support for mobile lightbox
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', function(e) {
            if (!$wire.showLightbox) return;
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', function(e) {
            if (!$wire.showLightbox) return;
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    $wire.nextImage(); // Swipe left - next image
                } else {
                    $wire.previousImage(); // Swipe right - previous image
                }
            }
        }
    </script>
    @endscript
</div>
