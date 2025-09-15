<!-- Modern Banner Carousel -->
    <div class="banner-carousel relative h-screen">
        @if (count($sliders) > 0)
            @foreach ($sliders as $index => $slider)
                <div class="carousel-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out"
                    data-slide="{{ $index }}">
                    <!-- Background Image -->
                    <div class="absolute inset-0">
                        <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}"
                            class="w-full h-full object-cover object-right lg:object-center">
                        <!-- Dark overlay for better text readability -->
                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent lg:from-black/60 lg:via-black/30 lg:to-transparent"></div>
                    </div>

                    <!-- Content Container -->
                    <div class="relative z-10 h-full flex items-center">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center h-full min-h-[600px]">
                                <!-- Left Content -->
                                <div class="slide-content transform translate-y-8 opacity-0 transition-all duration-1000 ease-out">
                                    <!-- Title -->
                                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                                        Building a <span class="text-secondary">{{ $slider->title }}</span>
                                        <br>Future
                                    </h1>

                                    <!-- Description -->
                                    <p class="text-lg sm:text-xl text-gray-200 mb-8 leading-relaxed max-w-lg">
                                        {{ $slider->description }}
                                    </p>

                                    <!-- CTA Buttons -->
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <a href="{{ $slider->button_link ?? '/contact' }}"
                                            class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-primary rounded-lg hover:bg-primary/90 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                            <span class="mr-2">Apply Now</span>
                                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                        <a href="/about/introduction"
                                            class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-secondary rounded-lg hover:bg-secondary/90 transition-all duration-300 shadow-lg">
                                            About Us
                                        </a>
                                    </div>
                                </div>

                                <!-- Right Content - Image Area (handled by background image) -->
                                <div class="hidden lg:block">
                                    <!-- This space is for the person image which comes from the background -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-black/50 to-transparent">
                    </div>
                </div>
            @endforeach
        @endif

        @if (count($sliders) > 1)
            <!-- Navigation Dots -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
                <div class="flex space-x-3">
                    @foreach ($sliders as $index => $slider)
                        <button
                            class="dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75' }}"
                            data-slide="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button
                class="prev-btn absolute left-4 sm:left-8 top-1/2 transform -translate-y-1/2 z-20 w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all duration-300 group"
                aria-label="Previous slide">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 transform group-hover:-translate-x-1 transition-transform duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button
                class="next-btn absolute right-4 sm:right-8 top-1/2 transform -translate-y-1/2 z-20 w-12 h-12 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all duration-300 group"
                aria-label="Next slide">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 transform group-hover:translate-x-1 transition-transform duration-300"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

    </div>


<style>
    .carousel-slide.active {
        opacity: 1;
    }

    .carousel-slide.active .slide-content {
        transform: translateY(0);
        opacity: 1;
    }

    @media (max-width: 640px) {
        .banner-carousel {
            height: 100vh;
        }
    }

    @media (max-width: 480px) {
        .banner-carousel {
            height: 90vh;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const progressBar = document.querySelector('.progress-bar');

        if (slides.length <= 1) return;

        let currentSlide = 0;
        let isAutoPlay = true;
        let autoPlayInterval;
        const autoPlayDelay = 5000; // 5 seconds

        // Initialize carousel
        function init() {
            showSlide(currentSlide);
            startAutoPlay();
        }

        // Show specific slide
        function showSlide(index) {
            // Remove active class from all slides and dots
            slides.forEach(slide => {
                slide.classList.remove('active');
                const content = slide.querySelector('.slide-content');
                if (content) {
                    content.style.transform = 'translateY(2rem)';
                    content.style.opacity = '0';
                }
            });

            dots.forEach(dot => {
                dot.classList.remove('bg-white', 'scale-125');
                dot.classList.add('bg-white/50');
            });

            // Show current slide
            slides[index].classList.add('active');
            if (dots[index]) {
                dots[index].classList.remove('bg-white/50');
                dots[index].classList.add('bg-white', 'scale-125');
            }

            // Animate content with delay
            setTimeout(() => {
                const content = slides[index].querySelector('.slide-content');
                if (content) {
                    content.style.transform = 'translateY(0)';
                    content.style.opacity = '1';
                }
            }, 300);
        }

        // Next slide
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
            resetProgressBar();
        }

        // Previous slide
        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
            resetProgressBar();
        }

        // Start auto play
        function startAutoPlay() {
            if (!isAutoPlay) return;

            autoPlayInterval = setInterval(() => {
                nextSlide();
            }, autoPlayDelay);

            // Start progress bar animation
            if (progressBar) {
                progressBar.style.width = '0%';
                progressBar.style.transition = `width ${autoPlayDelay}ms linear`;
                setTimeout(() => {
                    progressBar.style.width = '100%';
                }, 100);
            }
        }

        // Stop auto play
        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
            isAutoPlay = false;
        }

        // Reset progress bar
        function resetProgressBar() {
            if (progressBar) {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.transition = `width ${autoPlayDelay}ms linear`;
                    progressBar.style.width = '100%';
                }, 50);
            }
        }

        // Event listeners
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                stopAutoPlay();
                nextSlide();
                // Resume autoplay after 2 seconds
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                stopAutoPlay();
                prevSlide();
                // Resume autoplay after 2 seconds
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            });
        }

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopAutoPlay();
                currentSlide = index;
                showSlide(currentSlide);
                resetProgressBar();
                // Resume autoplay after 2 seconds
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            });
        });

        // Pause on hover
        const bannerSection = document.querySelector('.banner-carousel');
        if (bannerSection) {
            bannerSection.addEventListener('mouseenter', () => {
                stopAutoPlay();
                if (progressBar) {
                    progressBar.style.animationPlayState = 'paused';
                }
            });

            bannerSection.addEventListener('mouseleave', () => {
                isAutoPlay = true;
                startAutoPlay();
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                stopAutoPlay();
                prevSlide();
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            } else if (e.key === 'ArrowRight') {
                stopAutoPlay();
                nextSlide();
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            }
        });

        // Touch/Swipe support for mobile
        let startX = 0;
        let endX = 0;

        bannerSection.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        bannerSection.addEventListener('touchmove', (e) => {
            endX = e.touches[0].clientX;
        });

        bannerSection.addEventListener('touchend', () => {
            const threshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > threshold) {
                stopAutoPlay();
                if (diff > 0) {
                    nextSlide(); // Swipe left - next slide
                } else {
                    prevSlide(); // Swipe right - previous slide
                }
                setTimeout(() => {
                    isAutoPlay = true;
                    startAutoPlay();
                }, 2000);
            }
        });

        // Initialize the carousel
        init();
    });
</script>
