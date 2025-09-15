<!-- Testimonials Section -->
<section class="py-16 lg:py-24 bg-gradient-to-br from-blue-50 via-white to-gray-50 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-5">
        <!-- Dot pattern -->
        <div class="absolute top-20 right-20 w-32 h-32">
            <div class="grid grid-cols-8 gap-1 w-full h-full">
                @for($i = 0; $i < 64; $i++)
                    <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                @endfor
            </div>
        </div>
        <!-- Circle patterns -->
        <div class="absolute top-1/4 left-10 w-24 h-24 border-2 border-orange-200 rounded-full"></div>
        <div class="absolute bottom-1/3 right-32 w-16 h-16 border-2 border-blue-200 rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="max-w-4xl mx-auto mb-16 text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Testimonials
                </div>
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                What Our <span class="text-blue-600">Community</span> Says
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Welcome to our testimonial section, where members of our university community share their experiences and insights about life at Forbid Edu Career. We invite you to join us and be part of our inspiring journey of...
            </p>
        </div>

        @if($testimonials->count() > 0)
            <!-- Testimonials Slider -->
            <div class="testimonial-swiper relative">
                <!-- Previous Button - Left Side -->
                <button class="testimonial-prev absolute left-4 top-1/2 -translate-y-1/2 z-10 w-14 h-14 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:text-blue-600 hover:border-blue-300 hover:shadow-xl transition-all duration-300 group">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <!-- Next Button - Right Side -->
                <button class="testimonial-next absolute right-4 top-1/2 -translate-y-1/2 z-10 w-14 h-14 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:text-blue-600 hover:border-blue-300 hover:shadow-xl transition-all duration-300 group">
                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <div class="swiper-container overflow-hidden mx-16">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-500 mx-3 relative border border-gray-100 group">
                                    <!-- Profile Image with Quote Badge -->
                                    <div class="flex justify-center mb-6">
                                        <div class="relative">
                                            <img src="{{ $testimonial->image_url }}" 
                                                 alt="{{ $testimonial->name }}" 
                                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                                            <!-- Red Quote Badge -->
                                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Testimonial Content -->
                                    <blockquote class="text-gray-700 text-center leading-relaxed mb-6 relative z-10 font-medium">
                                        "{{ $testimonial->desc }}"
                                    </blockquote>

                                    <!-- Rating Stars -->
                                    <div class="flex items-center justify-center gap-1 mb-6">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>

                                    <!-- Author Info -->
                                    <div class="text-center">
                                        <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $testimonial->name }}</h4>
                                        <p class="text-gray-500 text-sm font-medium">{{ $testimonial->profession }}</p>
                                    </div>

                                    <!-- Hover Effect Border -->
                                    <div class="absolute inset-0 rounded-3xl border-2 border-transparent group-hover:border-blue-100 transition-all duration-500"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Pagination Dots - Bottom Center -->
                <div class="flex items-center justify-center mt-8">
                    <div class="testimonial-pagination flex gap-2"></div>
                </div>
            </div>
        @else
            <!-- No Testimonials State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-6">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No testimonials yet</h3>
                <p class="text-gray-600">Client testimonials will appear here once they are added.</p>
            </div>
        @endif
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Custom Styles -->
<style>
    .testimonial-swiper .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #d1d5db;
        opacity: 1;
        transition: all 0.3s ease;
        border-radius: 50%;
    }
    
    .testimonial-swiper .swiper-pagination-bullet-active {
        background: #3b82f6;
        transform: scale(1.3);
    }
    
    .testimonial-card {
        height: auto;
        min-height: 400px;
        backdrop-filter: blur(10px);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px) scale(1.02);
    }
    
    @media (max-width: 1024px) {
        .testimonial-card {
            min-height: 380px;
        }
    }
    
    @media (max-width: 768px) {
        .testimonial-card {
            min-height: 350px;
            margin: 0 10px;
        }
        
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
    
    @media (max-width: 640px) {
        .testimonial-card {
            min-height: 320px;
            padding: 1.5rem;
        }
        
        /* Hide navigation arrows on mobile for better UX */
        .testimonial-prev,
        .testimonial-next {
            display: none;
        }
        
        .swiper-container {
            margin: 0 !important;
        }
    }
    
    /* Navigation button positioning */
    .testimonial-prev,
    .testimonial-next {
        z-index: 20;
        backdrop-filter: blur(10px);
    }
    
    @media (max-width: 768px) {
        .testimonial-prev {
            left: 2px;
        }
        
        .testimonial-next {
            right: 2px;
        }
        
        .swiper-container {
            margin-left: 3rem;
            margin-right: 3rem;
        }
    }
    
    @media (min-width: 769px) {
        .testimonial-prev {
            left: 1rem;
        }
        
        .testimonial-next {
            right: 1rem;
        }
    }
    
    /* Custom animation for slide transitions */
    .swiper-slide-active .testimonial-card {
        opacity: 1;
        transform: scale(1);
    }
    
    .swiper-slide:not(.swiper-slide-active) .testimonial-card {
        opacity: 0.7;
        transform: scale(0.95);
    }
    
    /* Background animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .absolute.top-1\/4 {
        animation: float 6s ease-in-out infinite;
    }
    
    .absolute.bottom-1\/3 {
        animation: float 8s ease-in-out infinite reverse;
    }
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Testimonial Swiper Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const testimonialSwiper = new Swiper('.testimonial-swiper .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: {{ $testimonials->count() > 3 ? 'true' : 'false' }},
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            pagination: {
                el: '.testimonial-pagination',
                clickable: true,
                bulletClass: 'inline-block w-3 h-3 rounded-full cursor-pointer transition-all duration-300',
                bulletActiveClass: 'bg-primary',
                renderBullet: function (index, className) {
                    return `<span class="${className} bg-gray-300 hover:bg-gray-400 mx-1"></span>`;
                },
            },
            navigation: {
                nextEl: '.testimonial-next',
                prevEl: '.testimonial-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            effect: 'slide',
            speed: 600,
            on: {
                init: function() {
                    // Custom initialization
                    this.update();
                },
                slideChange: function() {
                    // Add animation to active slide
                    const activeSlide = this.slides[this.activeIndex];
                    const card = activeSlide?.querySelector('.testimonial-card');
                    if (card) {
                        card.style.transform = 'scale(1.02)';
                        setTimeout(() => {
                            card.style.transform = 'scale(1)';
                        }, 300);
                    }
                }
            }
        });
        
        // Pause autoplay on hover
        const swiperContainer = document.querySelector('.testimonial-swiper');
        if (swiperContainer) {
            swiperContainer.addEventListener('mouseenter', () => {
                testimonialSwiper.autoplay.stop();
            });
            
            swiperContainer.addEventListener('mouseleave', () => {
                testimonialSwiper.autoplay.start();
            });
        }
    });
</script>
