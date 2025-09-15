@extends('layouts.app')

@section('title', 'Gallery')
@section('meta_description', 'Explore our image gallery showcasing our work, achievements, and memorable moments.')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-gradient-to-r from-primary to-secondary py-20 relative">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in">
                Our Gallery
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 animate-fade-in-delay">
                Discover moments that matter through our curated collection of images
            </p>
            <div class="w-24 h-1 bg-white/30 mx-auto animate-fade-in-delay-2"></div>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full"></div>
        <div class="floating-element absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full delay-1000"></div>
        <div class="floating-element absolute bottom-20 left-20 w-12 h-12 bg-white/10 rounded-full delay-2000"></div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-16 bg-gray-50">
    <!-- Livewire Gallery Component -->
    <livewire:gallery.gallery-component />
</section>

@endsection

@section('styles')
<style>
/* Hero Animations */
.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.2s both;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1s ease-out 0.4s both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating Elements */
.floating-element {
    animation: float 3s ease-in-out infinite;
}

.floating-element.delay-1000 {
    animation-delay: 1s;
}

.floating-element.delay-2000 {
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Masonry Grid */
.masonry-grid {
    column-count: 1;
    column-gap: 1.5rem;
    break-inside: avoid;
}

@media (min-width: 640px) {
    .masonry-grid {
        column-count: 2;
    }
}

@media (min-width: 768px) {
    .masonry-grid {
        column-count: 3;
    }
}

@media (min-width: 1024px) {
    .masonry-grid {
        column-count: 4;
    }
}

@media (min-width: 1280px) {
    .masonry-grid {
        column-count: 5;
    }
}

.masonry-item {
    display: inline-block;
    width: 100%;
    margin-bottom: 1.5rem;
    break-inside: avoid;
}

/* Gallery Card Effects */
.gallery-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
}

.gallery-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
    pointer-events: none;
}

.gallery-card:hover::before {
    opacity: 1;
}

/* Filter Buttons */
.filter-btn {
    color: #6b7280;
    background: transparent;
}

.filter-btn.active {
    color: white;
    background: linear-gradient(135deg, #3b82f6, #9333ea);
}

.filter-btn:hover:not(.active) {
    color: #3b82f6;
    background: #f3f4f6;
}

/* Lightbox Styles */
.lightbox {
    backdrop-filter: blur(10px);
}

.lightbox.active {
    opacity: 1;
    visibility: visible;
}

.lightbox-container img {
    transition: transform 0.3s ease;
}

.lightbox-container img:hover {
    transform: scale(1.02);
}

/* Thumbnail Strip */
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.thumbnail {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0.6;
}

.thumbnail.active {
    opacity: 1;
    border: 2px solid white;
}

.thumbnail:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* Loading Animation */
.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .masonry-grid {
        column-count: 2;
        column-gap: 1rem;
    }
    
    .masonry-item {
        margin-bottom: 1rem;
    }
    
    .lightbox-container {
        padding: 1rem;
    }
    
    #prevBtn, #nextBtn {
        width: 40px;
        height: 40px;
    }
    
    .thumbnail-strip {
        display: none;
    }
}

/* Line Clamp Utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection

@section('scripts')
<!-- AOS (Animate On Scroll) Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<script>
// Initialize AOS for hero section animations
document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
        });
    }
});
</script>
@endsection
