@props([
    'portfolios' => collect(),
    'sectionTitle' => 'Our Portfolio',
    'sectionSubtitle' => 'Our Latest Work',
    'sectionDescription' => 'Explore our diverse portfolio of successful projects and legal achievements.',
    'showViewAll' => false,
    'limit' => 5
])

<!-- Modern Portfolio Section -->
<section class="relative py-8 bg-white overflow-hidden" id="portfolio">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        @if($portfolios->isNotEmpty())
            <!-- Portfolio Swiper -->
            <div class="portfolio-swiper-container relative" data-aos="fade-up" data-aos-delay="400">
                <div class="swiper portfolioSwiper">
                    <div class="swiper-wrapper">
                        @foreach($portfolios->take($limit) as $index => $portfolio)
                            <div class="swiper-slide">
                                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                                    <!-- Image Container -->
                                    <div class="relative h-60 overflow-hidden rounded-t-2xl">
                                        @if($portfolio->image_url)
                                            <img src="{{ $portfolio->image_url }}" 
                                                 alt="{{ $portfolio->title }}" 
                                                 class="w-full h-full object-contain">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-600 flex items-center justify-center">
                                                <div class="text-center">
                                                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <p class="text-white font-normal text-sm">{{ $portfolio->title }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content Container -->
                                    <div class="px-3 py-2 text-center bg-cyan-100">
                                        <!-- Title -->
                                        <h3 class="text-sm font-normal text-gray-900 mb-2 transition-colors duration-300">
                                            {{ $portfolio->title }}
                                        </h3>                                   
                                        
                                       
                                    </div>
                                 
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
             
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Portfolio Items Available</h3>
                <p class="text-gray-600 max-w-md mx-auto">We're working on showcasing our amazing projects. Please check back soon!</p>
            </div>
        @endif
        
        @if($showViewAll && $portfolios->count() > $limit)
            <!-- View All Button -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('portfolios.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl group">
                    <span class="mr-3">View All Portfolio</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<style>
    /* Custom Swiper Styles */
    .portfolioSwiper {
        padding: 20px 0 60px 0;
    }
    
    .portfolio-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #e5e7eb;
        opacity: 1;
        transition: all 0.3s ease;
        margin: 0 4px;
    }
    
    .portfolio-pagination .swiper-pagination-bullet-active {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        transform: scale(1.2);
    }
    
    .portfolio-pagination .swiper-pagination-bullet:hover {
        background: #9ca3af;
        transform: scale(1.1);
    }
    
    /* Responsive Styles */
    @media (max-width: 640px) {
        .portfolioSwiper {
            padding: 10px 0 40px 0;
        }
    }
    
    /* Animation Delays */
    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper
        const portfolioSwiper = new Swiper('.portfolioSwiper', {
            // Basic settings
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            speed: 800,
            
            // Responsive breakpoints
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: false,
            
            breakpoints: {
                // Mobile landscape
                480: {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                    centeredSlides: true,
                },
                // Tablet
                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                    centeredSlides: false,
                },
                // Desktop small
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                // Desktop large - Show 5 items as requested
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
                // Desktop extra large
                1536: {
                    slidesPerView: 5,
                    spaceBetween: 32,
                }
            },
            
            // Navigation
            navigation: {
                nextEl: '.portfolio-next',
                prevEl: '.portfolio-prev',
            },
            
            // Pagination
            pagination: {
                el: '.portfolio-pagination',
                clickable: true,
                dynamicBullets: true,
                dynamicMainBullets: 5,
            },
            
            // Effects
            effect: 'slide',
            
            // Grab cursor
            grabCursor: true,
            
            // Keyboard control
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Mouse wheel
            mousewheel: {
                enabled: true,
                sensitivity: 1,
                forceToAxis: true,
            },
            
            // Touch settings
            touchRatio: 1,
            touchAngle: 45,
            simulateTouch: true,
            
            // Events
            on: {
                init: function() {
                    console.log('Portfolio Swiper initialized');
                },
                slideChange: function() {
                    // Add any custom slide change logic here
                },
                reachEnd: function() {
                    // Custom logic when reaching the end
                },
            }
        });
        
        // Pause autoplay on hover
        const swiperContainer = document.querySelector('.portfolio-swiper-container');
        if (swiperContainer) {
            swiperContainer.addEventListener('mouseenter', () => {
                portfolioSwiper.autoplay.stop();
            });
            
            swiperContainer.addEventListener('mouseleave', () => {
                portfolioSwiper.autoplay.start();
            });
        }
        
        // AOS refresh after swiper initialization
        if (typeof AOS !== 'undefined') {
            setTimeout(() => {
                AOS.refresh();
            }, 100);
        }
    });
</script>
