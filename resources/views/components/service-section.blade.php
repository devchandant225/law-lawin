@props([
    'services' => collect(),
    'showViewAll' => true,
    'limit' => null,
    'sectionTitle' => 'Our Services',
    'sectionSubtitle' => 'Professional Legal Services',
    'sectionDescription' => 'We provide comprehensive legal services with expertise and dedication to serve our clients\' needs.'
])

<section class="relative py-10 bg-white overflow-hidden">
    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>
        
    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-purple-200 rounded-full opacity-20 animate-float-slow"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-blue-200 rounded-lg opacity-20 animate-float-reverse" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 border-2 border-pink-200 rotate-45 opacity-20 animate-float-slow" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" />
                </svg>
                {{ $sectionSubtitle }}
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Our
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
                    {!! $sectionTitle !!}</span>
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full mb-6"></div>
        </div>

        @if($services->count() > 0)
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                @foreach($services->take($limit ?? $services->count()) as $service)
                    <div class="group relative service-card-slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Service Card -->
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden h-48 bg-gradient-to-br from-purple-100 to-blue-100">
                                @if($service->feature_image_url)
                                    <img src="{{ $service->feature_image_url }}" 
                                         alt="{{ $service->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <!-- Default Service Icon -->
                                    <div class="flex items-center justify-center w-full h-full">
                                        <svg class="w-20 h-20 text-[#6f64d3] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#6f64d3] transition-colors duration-300">
                                    {{ $service->title }}
                                </h3>
                                
                                <!-- Excerpt -->
                                @if($service->excerpt)
                                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                        {{ $service->excerpt }}
                                    </p>
                                @endif

                                <!-- Modern Button -->
                                <a href="{{ route('service.show', $service->slug) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#6f64d3] to-[#8b7ed8] text-white text-sm font-medium rounded-lg transform transition-all duration-300 hover:from-[#5a50a8] hover:to-[#6f64d3] hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#6f64d3] focus:ring-opacity-50">
                                    <span>Learn More</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>

                            <!-- Hover Effect Border -->
                            <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#6f64d3] rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                        </div>

                        <!-- Floating Number Badge -->
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-[#6f64d3] to-[#8b7ed8] text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg transform transition-all duration-300 group-hover:scale-110">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Services Button -->
            @if($showViewAll && $services->count() > ($limit ?? 8))
                <div class="text-center">
                    <a href="{{ route('services.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#6f64d3] to-[#8b7ed8] text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:from-[#5a50a8] hover:to-[#6f64d3] hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#6f64d3] focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span>View All Services</span>
                        <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Services Available</h3>
                <p class="text-gray-600">We're currently updating our services. Please check back later.</p>
            </div>
        @endif
    </div>
</section>

<style>
    /* Line Clamp Utilities */
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
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
    
    /* Animated Grid Lines */
    .grid-lines-horizontal {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(to right, transparent, rgba(111, 100, 211, 0.1) 50%, transparent);
        background-size: 200% 1px;
        background-position: 0 0;
        animation: slideHorizontal 20s linear infinite;
    }
    
    .grid-lines-vertical {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(to bottom, transparent, rgba(111, 100, 211, 0.1) 50%, transparent);
        background-size: 1px 200%;
        background-position: 0 0;
        animation: slideVertical 15s linear infinite;
    }
    
    /* Sliding Animations */
    @keyframes slideHorizontal {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 200% 0;
        }
    }
    
    @keyframes slideVertical {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 0 200%;
        }
    }
    
    /* Gradient Shift Animation */
    @keyframes gradient-shift {
        0%, 100% {
            opacity: 0.3;
            transform: translateX(0) translateY(0);
        }
        25% {
            opacity: 0.5;
            transform: translateX(10px) translateY(-10px);
        }
        50% {
            opacity: 0.3;
            transform: translateX(-10px) translateY(10px);
        }
        75% {
            opacity: 0.5;
            transform: translateX(5px) translateY(5px);
        }
    }
    
    .animate-gradient-shift {
        animation: gradient-shift 15s ease-in-out infinite;
    }
    
    /* Float Animations */
    @keyframes float-slow {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.2;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.3;
        }
    }
    
    @keyframes float-reverse {
        0%, 100% {
            transform: translateY(0) translateX(0) rotate(0deg);
            opacity: 0.2;
        }
        50% {
            transform: translateY(20px) translateX(-20px) rotate(-180deg);
            opacity: 0.3;
        }
    }
    
    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
    }
    
    .animate-float-reverse {
        animation: float-reverse 10s ease-in-out infinite;
    }
    
    /* Service Card Slide Animation */
    .service-card-slide {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }
    
    .service-card-slide.aos-animate {
        animation-play-state: running;
    }
    
    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Intersection Observer Fallback */
    .service-card-slide {
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .service-card-slide.in-view {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Hover Effects Enhancement */
    .group:hover .service-card-slide {
        z-index: 10;
    }
    
    /* Responsive Grid Line Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
        }
    }
    
    /* Performance Optimization */
    .grid-lines-horizontal,
    .grid-lines-vertical {
        will-change: background-position;
        transform: translateZ(0);
        backface-visibility: hidden;
    }
    
    .service-card-slide {
        will-change: transform, opacity;
    }
</style>

<!-- Add Intersection Observer Script for Sliding Animation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for slide animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('in-view');
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });
        
        // Observe all service cards
        document.querySelectorAll('.service-card-slide').forEach((card) => {
            observer.observe(card);
        });
        
        // Add parallax effect to floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.animate-float-slow, .animate-float-reverse');
            
            shapes.forEach((shape, index) => {
                const speed = 0.5 + (index * 0.1);
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    });
</script>
