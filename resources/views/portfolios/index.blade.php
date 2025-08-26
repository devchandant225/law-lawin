@extends('layouts.app')

@section('title', 'Portfolio - Our Work')

@section('content')
{{-- Page Header --}}
<section class="relative bg-gradient-to-r from-primary to-secondary py-16 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 border border-white/20 rounded-full animate-float-slow"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 border border-white/20 rounded-lg animate-float-reverse"></div>
    <div class="absolute top-1/2 right-1/4 w-12 h-12 border border-white/20 rotate-45 animate-float-slow" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                Our <span class="text-yellow-300">Portfolio</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Showcasing our latest projects and creative work
            </p>
            <nav class="flex justify-center">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-300 transition-colors">Home</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-yellow-300">Portfolio</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- Portfolio Content --}}
<section class="relative py-16 bg-accent overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.02]"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        {{-- Filters Section --}}
        <div class="mb-12">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold text-gray-900">All Projects</h2>
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-medium">
                        {{ $portfolios->total() }} Project{{ $portfolios->total() !== 1 ? 's' : '' }}
                    </span>
                </div>
                
                {{-- Search and Filter --}}
                <div class="flex items-center gap-4">
                    <form method="GET" action="{{ route('portfolios.index') }}" class="flex items-center gap-4">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search portfolio..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                            Search
                        </button>
                        
                        @if(request('search'))
                            <a href="{{ route('portfolios.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if($portfolios->count() > 0)
            {{-- Portfolio Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 mb-12">
                @foreach($portfolios as $portfolio)
                    <div class="group relative portfolio-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <!-- Portfolio Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:-translate-y-2 border border-gray-100/50">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden h-64 bg-gradient-to-br from-purple-100 to-blue-100">
                                @if($portfolio->image_url)
                                    <img src="{{ $portfolio->image_url }}" 
                                         alt="{{ $portfolio->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <!-- Default Portfolio Icon -->
                                    <div class="flex items-center justify-center w-full h-full">
                                        <svg class="w-20 h-20 text-[#6f64d3] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Overlay Content -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button onclick="openLightbox('{{ $portfolio->image_url ?: '' }}', '{{ $portfolio->title }}')" 
                                            class="bg-white/20 backdrop-blur-sm text-white p-3 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#6f64d3] transition-colors duration-300">
                                    {{ $portfolio->title }}
                                </h3>
                                
                                <!-- Order Badge -->
                                <div class="inline-flex items-center px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                    Project #{{ $portfolio->order }}
                                </div>
                                
                                <!-- Created Date -->
                                <div class="mt-3 text-xs text-gray-500">
                                    {{ $portfolio->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <!-- Hover Effect Border -->
                            <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#6f64d3] rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                        </div>

                        <!-- Floating Number Badge -->
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-secondary to-secondary text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg transform transition-all duration-300 group-hover:scale-110">
                            {{ str_pad($loop->iteration + (($portfolios->currentPage() - 1) * $portfolios->perPage()), 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center">
                {{ $portfolios->appends(request()->query())->links() }}
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                    @if(request('search'))
                        No Results Found
                    @else
                        No Portfolio Available
                    @endif
                </h3>
                <p class="text-gray-600 mb-6">
                    @if(request('search'))
                        We couldn't find any portfolio matching "{{ request('search') }}".
                    @else
                        We're currently building our portfolio. Please check back later.
                    @endif
                </p>
                @if(request('search'))
                    <a href="{{ route('portfolios.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        View All Portfolio
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

{{-- Image Lightbox Modal --}}
<div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative max-w-4xl max-h-full p-4">
        <img id="lightboxImage" src="" alt="" class="max-w-full max-h-full rounded-lg shadow-2xl">
        <button onclick="closeLightbox()" class="absolute top-2 right-2 bg-white/20 backdrop-blur-sm text-white p-2 rounded-full hover:bg-white/30 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div id="lightboxTitle" class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-sm text-white px-4 py-2 rounded-lg"></div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Line Clamp Utilities */
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    /* Modern Grid Background Pattern */
    .bg-grid-pattern {
        background-image: 
            linear-gradient(to right, #6f64d3 1px, transparent 1px),
            linear-gradient(to bottom, #6f64d3 1px, transparent 1px);
        background-size: 50px 50px;
        background-position: -1px -1px;
    }
    
    /* Float Animations */
    @keyframes float-slow {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.5;
        }
    }
    
    @keyframes float-reverse {
        0%, 100% {
            transform: translateY(0) translateX(0) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateY(20px) translateX(-20px) rotate(-180deg);
            opacity: 0.5;
        }
    }
    
    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
    }
    
    .animate-float-reverse {
        animation: float-reverse 10s ease-in-out infinite;
    }
    
    /* Portfolio Grid Item Animation */
    .portfolio-grid-item {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }
    
    .portfolio-grid-item.aos-animate {
        animation-play-state: running;
    }
    
    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Intersection Observer Fallback */
    .portfolio-grid-item.in-view {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    /* Responsive Grid Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
        }
    }
    
    /* Custom Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }
    
    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        color: #374151;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover {
        background-color: #6f64d3;
        color: white;
        border-color: #6f64d3;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #6f64d3;
        color: white;
        border-color: #6f64d3;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #9ca3af;
        pointer-events: none;
        background-color: #f9fafb;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for grid animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('in-view');
                        entry.target.classList.add('aos-animate');
                    }, index * 50);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });
        
        // Observe all portfolio grid items
        document.querySelectorAll('.portfolio-grid-item').forEach((card) => {
            observer.observe(card);
        });
        
        // Add parallax effect to floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.animate-float-slow, .animate-float-reverse');
            
            shapes.forEach((shape, index) => {
                const speed = 0.3 + (index * 0.05);
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    });
    
    // Lightbox functionality
    function openLightbox(imageUrl, title) {
        if (!imageUrl) return;
        
        const modal = document.getElementById('lightboxModal');
        const image = document.getElementById('lightboxImage');
        const titleEl = document.getElementById('lightboxTitle');
        
        image.src = imageUrl;
        image.alt = title;
        titleEl.textContent = title;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        const modal = document.getElementById('lightboxModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Close lightbox with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
    
    // Close lightbox when clicking outside image
    document.getElementById('lightboxModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>
@endpush
