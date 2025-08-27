@props([
    'practices' => collect(),
    'showViewAll' => true,
    'limit' => 8,
    'sectionTitle' => 'Our practices',
    'sectionSubtitle' => 'Professional Legal practices',
    'sectionDescription' =>
        'Explore our comprehensive collection of legal practices, research papers, and professional resources.',
])

<section class="relative py-10 overflow-hidden bg-accent">
    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>


    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-[#6f64d3] rounded-full opacity-20 animate-float-slow">
    </div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-[#6f64d3] rounded-lg opacity-20 animate-float-reverse"
        style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 right-1/4 w-16 h-16 border-2 border-[#6f64d3] rotate-45 opacity-20 animate-float-slow"
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
                Our
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary">
                    {!! $sectionTitle !!}</span>
            </h2>
            <div class="w-24 h-1 bg-secondary mx-auto rounded-full mb-6"></div>
        </div>

        @if ($practices->count() > 0)
            <!-- practices Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach ($practices->take($limit ?? $practices->count()) as $practice)
                    <div class="group relative practice-card-slide" data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Practice Card -->
                        <article
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden h-48 bg-gradient-to-br from-emerald-100 to-teal-100">
                                @if ($practice->feature_image_url)
                                    <img src="{{ $practice->feature_image_url }}" alt="{{ $practice->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <!-- Default Practice Icon -->
                                    <div class="flex items-center justify-center w-full h-full">
                                        <svg class="w-20 h-20 text-primary opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Date Badge -->
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-sm">
                                        {{ $practice->created_at->format('M Y') }}
                                    </span>
                                </div>

                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-300">
                                    {{ $practice->title }}
                                </h3>

                                <!-- Excerpt -->
                                @if ($practice->excerpt)
                                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                        {{ $practice->excerpt }}
                                    </p>
                                @endif

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between mb-4 text-xs text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z" />
                                        </svg>
                                        {{ $practice->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ rand(3, 8) }} min read
                                    </span>
                                </div>

                                <!-- Modern Button -->
                                <a href="{{ route('practice.show', $practice->slug) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-primary text-white text-sm font-medium rounded-lg transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                                    <span>Read Practice</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>

                            <!-- Hover Effect Border -->
                            <div
                                class="absolute inset-0 border-2 border-transparent group-hover:border-primary rounded-2xl transition-colors duration-300 pointer-events-none">
                            </div>
                        </article>

                        <!-- Floating Number Badge -->
                        <div
                            class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-secondary to-secondary text-white text-xs font-bold rounded-full flex items-center justify-center shadow-lg transform transition-all duration-300 group-hover:scale-110">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All practices Button -->
            {{-- @if ($showViewAll && $practices->count() > ($limit ?? 6)) --}}
                <div class="text-center">
                    <a href="{{ route('practices.index') }}"
                        class="inline-flex items-center px-3 py-2 bg-primary text-white font-semibold text-sm rounded-full transform transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-emerald-600 focus:ring-opacity-30 group">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <span>View All practices</span>
                        <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            {{-- @endif --}}
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No practices Available</h3>
                <p class="text-gray-600">We're currently updating our practice library. Please check back later.</p>
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
            linear-gradient(to right, #059669 1px, transparent 1px),
            linear-gradient(to bottom, #059669 1px, transparent 1px);
        background-size: 50px 50px;
        background-position: -1px -1px;
    }

    /* Animated Grid Lines */
    .grid-lines-horizontal {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(to right, transparent, rgba(5, 150, 105, 0.1) 50%, transparent);
        background-size: 200% 1px;
        background-position: 0 0;
        animation: slideHorizontal 20s linear infinite;
    }

    .grid-lines-vertical {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(to bottom, transparent, rgba(5, 150, 105, 0.1) 50%, transparent);
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

        0%,
        100% {
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

    /* Practice Card Slide Animation */
    .practice-card-slide {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }

    .practice-card-slide.aos-animate {
        animation-play-state: running;
    }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Intersection Observer Fallback */
    .practice-card-slide {
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .practice-card-slide.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Hover Effects Enhancement */
    .group:hover .practice-card-slide {
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

    .practice-card-slide {
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

        // Observe all practice cards
        document.querySelectorAll('.practice-card-slide').forEach((card) => {
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
