@props([
    'portfolios' => collect(),
    'showViewAll' => true,
    'limit' => null,
    'sectionTitle' => 'Our Portfolio',
    'sectionSubtitle' => 'Our Latest Work',
    'sectionDescription' => 'Explore our diverse portfolio of successful projects and see how we bring ideas to life.'
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
                {!! $sectionTitle !!}
            </h2>
            <div class="w-24 h-1 bg-secondary mx-auto rounded-full mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">{{ $sectionDescription }}</p>
        </div>

        @if($portfolios->count() > 0)
            <!-- Portfolio Swiper -->
            <div class="portfolio-swiper-container mb-12">
                <div class="swiper portfolioSwiper">
                    <div class="swiper-wrapper">
                        @foreach($portfolios->take($limit ?? $portfolios->count()) as $portfolio)
                            <div class="swiper-slide">
                                <div class="group relative portfolio-card-slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <!-- Portfolio Card -->
                                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm">
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
                                                <button class="bg-white/20 backdrop-blur-sm text-white p-3 rounded-full border border-white/30 hover:bg-white/30 transition-all duration-300">
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
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-[#6f64d3] transition-colors duration-300">
                                                {{ $portfolio->title }}
                                            </h3>
                                            
                                            <!-- Order Badge -->
                                            <div class="inline-flex items-center px-2 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                                Project #{{ $portfolio->order }}
                                            </div>
                                        </div>

                                        <!-- Hover Effect Border -->
                                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-[#6f64d3] rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                                    </div>

                                    <!-- Floating Number Badge -->
                                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-secondary to-secondary text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg transform transition-all duration-300 group-hover:scale-110">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Navigation buttons -->
                    <div class="swiper-button-next portfolio-swiper-next"></div>
                    <div class="swiper-button-prev portfolio-swiper-prev"></div>
                    
                    <!-- Pagination -->
                    <div class="swiper-pagination portfolio-swiper-pagination"></div>
                </div>
            </div>

            <!-- View All Portfolio Button -->
            @if($showViewAll)
                <div class="text-center">
                    <a href="{{ route('portfolios.index') }}" 
                       class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-[#6f64d3] to-[#8b7ed8] text-white font-semibold text-sm rounded-full transform transition-all duration-300 hover:from-[#5a50a8] hover:to-[#6f64d3] hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#6f64d3] focus:ring-opacity-30">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span>View All Portfolio</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Portfolio Available</h3>
                <p class="text-gray-600">We're currently updating our portfolio. Please check back later.</p>
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
    
    /* Portfolio Card Slide Animation */
    .portfolio-card-slide {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }
    
    .portfolio-card-slide.aos-animate {
        animation-play-state: running;
    }
    
    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Swiper Custom Styles */
    .portfolioSwiper {
        padding: 20px 0;
        overflow: visible;
    }
    
    .portfolio-swiper-next,
    .portfolio-swiper-prev {
        background: rgba(111, 100, 211, 0.1);
        backdrop-filter: blur(10px);
        color: #6f64d3;
        border: 2px solid rgba(111, 100, 211, 0.2);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-top: -25px;
        transition: all 0.3s ease;
    }
    
    .portfolio-swiper-next:hover,
    .portfolio-swiper-prev:hover {
        background: #6f64d3;
        color: white;
        transform: scale(1.1);
    }
    
    .portfolio-swiper-next::after,
    .portfolio-swiper-prev::after {
        font-size: 18px;
        font-weight: bold;
    }
    
    .portfolio-swiper-pagination {
        position: relative;
        margin-top: 30px;
    }
    
    .portfolio-swiper-pagination .swiper-pagination-bullet {
        background: rgba(111, 100, 211, 0.3);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .portfolio-swiper-pagination .swiper-pagination-bullet-active {
        background: #6f64d3;
        width: 30px;
        border-radius: 15px;
        transform: scale(1.2);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
        }
        
        .portfolio-swiper-next,
        .portfolio-swiper-prev {
            width: 40px;
            height: 40px;
            margin-top: -20px;
        }
        
        .portfolio-swiper-next::after,
        .portfolio-swiper-prev::after {
            font-size: 14px;
        }
    }
</style>

<!-- Animation Scripts -->
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
        
        // Observe all portfolio cards
        document.querySelectorAll('.portfolio-card-slide').forEach((card) => {
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
