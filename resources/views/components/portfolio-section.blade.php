{{-- No props needed since component handles data internally --}}

<section class="relative py-10 bg-white overflow-hidden">
    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-purple-200 rounded-full opacity-20 animate-float-slow">
    </div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-blue-200 rounded-lg opacity-20 animate-float-reverse"
        style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 border-2 border-pink-200 rotate-45 opacity-20 animate-float-slow"
        style="animation-delay: 1s;"></div>

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

        @if ($portfolios->count() > 0)
            <!-- Portfolio Grid -->
            <div class="portfolio-grid mb-12">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                    @foreach ($portfolios->take($limit ?? $portfolios->count()) as $portfolio)
                        <div class="group relative portfolio-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Portfolio Card -->
                            <div class="bg-accent rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl hover:-translate-y-2 border border-gray-100/50">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden aspect-square w-[5rem] h-[5rem] mx-auto mt-4 rounded-lg">
                                    @if ($portfolio->image_url)
                                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" 
                                             class="w-[12rem] h-[10rem] object-contain transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <!-- Default Portfolio Icon -->
                                        <div class="flex items-center justify-center w-full h-full">
                                            <svg class="w-12 h-12 md:w-16 md:h-16 text-[#6f64d3] opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Card Content -->
                                <div class="p-3 md:p-4">
                                    <h3 class="text-sm md:text-base font-semibold text-gray-900 line-clamp-2 group-hover:text-[#6f64d3] transition-colors duration-300 text-center">
                                        {{ $portfolio->title }}
                                    </h3>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- View All Portfolio Button -->
            {{-- @if ($showViewAll)
                <div class="text-center">
                    <a href="{{ route('portfolios.index') }}"
                        class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-[#6f64d3] to-[#8b7ed8] text-white font-semibold text-sm rounded-full transform transition-all duration-300 hover:from-[#5a50a8] hover:to-[#6f64d3] hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#6f64d3] focus:ring-opacity-30">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <span>View All Portfolio</span>
                        <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            @endif --}}
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
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

        0%,
        100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.2;
        }

        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.3;
        }
    }

    @keyframes float-reverse {

        0%,
        100% {
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

    /* Portfolio Card Animation */
    .portfolio-card {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
    }

    .portfolio-card:nth-child(1) { animation-delay: 0.1s; }
    .portfolio-card:nth-child(2) { animation-delay: 0.2s; }
    .portfolio-card:nth-child(3) { animation-delay: 0.3s; }
    .portfolio-card:nth-child(4) { animation-delay: 0.4s; }
    .portfolio-card:nth-child(5) { animation-delay: 0.5s; }
    .portfolio-card:nth-child(6) { animation-delay: 0.6s; }
    .portfolio-card:nth-child(7) { animation-delay: 0.7s; }
    .portfolio-card:nth-child(8) { animation-delay: 0.8s; }
    .portfolio-card:nth-child(9) { animation-delay: 0.9s; }
    .portfolio-card:nth-child(10) { animation-delay: 1.0s; }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Portfolio Grid Responsive */
    .portfolio-grid {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
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
        document.querySelectorAll('.portfolio-card').forEach((card) => {
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



