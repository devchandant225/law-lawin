<!-- Testimonials Section -->
<section class="py-16 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-5">
        <svg class="absolute top-10 left-10 w-32 h-32 text-primary" fill="currentColor" viewBox="0 0 100 100">
            <path d="M40 20c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24zM10 50c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24z"/>
        </svg>
        <svg class="absolute bottom-10 right-10 w-24 h-24 text-secondary" fill="currentColor" viewBox="0 0 100 100">
            <path d="M40 20c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24zM10 50c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24z"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                Client Testimonials
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                What Our <span class="text-primary">Clients</span> Say
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Discover why clients trust us with their most important legal matters through their own words.
            </p>
        </div>

        @if($testimonials->count() > 0)
            <!-- Testimonials Slider -->
            <div class="testimonial-swiper relative">
                <div class="swiper-container overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 mx-2 relative overflow-hidden">
                                    <!-- Quote Icon -->
                                    <div class="absolute top-6 right-6 opacity-10">
                                        <svg class="w-16 h-16 text-primary" fill="currentColor" viewBox="0 0 100 100">
                                            <path d="M40 20c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24zM10 50c0-8 6-12 12-12s12 4 12 12c0 8-4 16-12 24-8-8-12-16-12-24z"/>
                                        </svg>
                                    </div>

                                    <!-- Rating Stars -->
                                    <div class="flex items-center gap-1 mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-500">{{ $testimonial->rating }}/5</span>
                                    </div>

                                    <!-- Testimonial Content -->
                                    <blockquote class="text-gray-700 text-lg leading-relaxed mb-6 relative z-10">
                                        "{{ $testimonial->desc }}"
                                    </blockquote>

                                    <!-- Author Info -->
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <img src="{{ $testimonial->image_url }}" 
                                                 alt="{{ $testimonial->name }}" 
                                                 class="w-14 h-14 rounded-full object-cover border-4 border-primary/10">
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-primary rounded-full border-2 border-white flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 text-lg">{{ $testimonial->name }}</h4>
                                            <p class="text-primary font-medium">{{ $testimonial->profession }}</p>
                                        </div>
                                    </div>

                                    <!-- Decorative Element -->
                                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-secondary"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-center gap-4 mt-8">
                    <button class="testimonial-prev w-12 h-12 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:text-primary hover:border-primary transition-all duration-300 group">
                        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Pagination Dots -->
                    <div class="testimonial-pagination flex gap-2"></div>
                    
                    <button class="testimonial-next w-12 h-12 rounded-full bg-white shadow-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:text-primary hover:border-primary transition-all duration-300 group">
                        <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
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
        background: #e5e7eb;
        opacity: 1;
        transition: all 0.3s ease;
    }
    
    .testimonial-swiper .swiper-pagination-bullet-active {
        background: var(--primary-color, #3B82F6);
        transform: scale(1.2);
    }
    
    .testimonial-card {
        height: auto;
        min-height: 320px;
    }
    
    @media (max-width: 768px) {
        .testimonial-card {
            min-height: 280px;
        }
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
