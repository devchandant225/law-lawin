<!-- Our Process Section -->
<section class="py-16 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-primary/5 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0 opacity-5">
        <!-- Geometric Patterns -->
        <div class="absolute top-20 left-10 w-40 h-40">
            <div class="grid grid-cols-6 gap-2 w-full h-full">
                @for($i = 0; $i < 36; $i++)
                    <div class="w-2 h-2 bg-primary rounded-full animate-pulse" style="animation-delay: {{ $i * 0.1 }}s"></div>
                @endfor
            </div>
        </div>
        <div class="absolute bottom-32 right-16 w-32 h-32 border-2 border-secondary/30 rounded-full"></div>
        <div class="absolute top-1/3 right-8 w-20 h-20 border-2 border-primary/30 rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-primary/10 rounded-full text-primary font-medium text-sm mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                {{ $sectionSubtitle }}
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                {{ $sectionTitle }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $sectionDescription }}
            </p>
        </div>

        <!-- Process Steps -->
        <div class="relative">
            <!-- Process Timeline Line -->
            <div class="hidden lg:block absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-primary via-secondary to-primary transform -translate-x-1/2"></div>
            
            <!-- Process Grid -->
            <div class="space-y-12 lg:space-y-20">
                @foreach ($processes as $index => $process)
                    <div class="process-step relative" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <!-- Desktop Layout -->
                        <div class="lg:flex lg:items-center lg:justify-center {{ $index % 2 === 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }}">
                            <!-- Content Side -->
                            <div class="lg:w-5/12 {{ $index % 2 === 0 ? 'lg:pr-12' : 'lg:pl-12' }}">
                                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-700 p-8 group relative overflow-hidden border border-gray-100">
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                    
                                    <!-- Step Number -->
                                    <div class="absolute -top-4 {{ $index % 2 === 0 ? '-right-4' : '-left-4' }} w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ $process['id'] }}
                                    </div>

                                    <!-- Content -->
                                    <div class="relative z-10">
                                        <!-- Header -->
                                        <div class="mb-6">
                                            <div class="flex items-center mb-3">
                                                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-300">
                                                    {{ $process['title'] }}
                                                </h3>
                                            </div>
                                            <div class="flex items-center justify-between mb-4">
                                                <span class="inline-flex items-center px-3 py-1 bg-secondary/10 text-secondary text-xs font-semibold rounded-full">
                                                    {{ $process['subtitle'] }}
                                                </span>
                                                <span class="text-sm text-gray-500 font-medium">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    {{ $process['duration'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 leading-relaxed mb-6">
                                            {{ $process['description'] }}
                                        </p>

                                        <!-- Features -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach ($process['features'] as $feature)
                                                <div class="flex items-start">
                                                    <div class="w-2 h-2 bg-primary rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                                    <span class="text-sm text-gray-700">{{ $feature }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Icon Side -->
                            <div class="lg:w-2/12 flex justify-center mb-8 lg:mb-0">
                                <!-- Desktop Timeline Node -->
                                <div class="hidden lg:block relative">
                                    <div class="w-20 h-20 bg-white rounded-2xl shadow-lg border-4 border-primary/20 flex items-center justify-center group-hover:border-primary/40 transition-all duration-500 group-hover:scale-110">
                                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                {!! $processIcons[$process['icon']] !!}
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Connecting Lines -->
                                    @if ($index < count($processes) - 1)
                                        <div class="absolute top-20 left-1/2 w-1 h-20 bg-gradient-to-b from-primary to-secondary transform -translate-x-1/2"></div>
                                    @endif
                                </div>

                                <!-- Mobile Icon -->
                                <div class="lg:hidden w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center text-white shadow-lg mb-6">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $processIcons[$process['icon']] !!}
                                    </svg>
                                </div>
                            </div>

                            <!-- Empty Space for Balance -->
                            <div class="hidden lg:block lg:w-5/12"></div>
                        </div>

                        <!-- Mobile Connector -->
                        @if ($index < count($processes) - 1)
                            <div class="lg:hidden flex justify-center mt-8">
                                <div class="w-1 h-12 bg-gradient-to-b from-primary to-secondary rounded-full"></div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="mt-20 bg-gradient-to-r from-primary to-secondary rounded-3xl p-8 lg:p-12 text-white" data-aos="fade-up">
            <div class="text-center mb-8">
                <h3 class="text-2xl lg:text-3xl font-bold mb-4">Our Success Track Record</h3>
                <p class="text-white/90 max-w-2xl mx-auto">
                    With years of experience in education consultancy, we've helped thousands of students achieve their dreams
                </p>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold mb-2">{{ $stats['total_steps'] }}</div>
                    <div class="text-white/80 text-sm">Process Steps</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold mb-2">{{ $stats['success_rate'] }}</div>
                    <div class="text-white/80 text-sm">Success Rate</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold mb-2">{{ $stats['countries_supported'] }}</div>
                    <div class="text-white/80 text-sm">Countries</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold mb-2">{{ $stats['average_duration'] }}</div>
                    <div class="text-white/80 text-sm">Avg. Duration</div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        @if ($showCTA)
            <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ $ctaUrl }}" 
                   class="group inline-flex items-center px-8 py-4 bg-white hover:bg-primary text-primary hover:text-white border-2 border-primary font-semibold text-lg rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <span>{{ $ctaText }}</span>
                    <svg class="w-6 h-6 ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <p class="text-gray-600 mt-4 max-w-md mx-auto">
                    Ready to start your study abroad journey? Let's discuss your goals and create a personalized plan
                </p>
            </div>
        @endif
    </div>
</section>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Modern Process Section Styles -->
<style>
    /* Process Step Animations */
    .process-step {
        transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .process-step:hover {
        transform: translateY(-4px);
    }

    /* Timeline Effects */
    @keyframes pulse-line {
        0%, 100% {
            opacity: 0.5;
            transform: scaleY(1);
        }
        50% {
            opacity: 1;
            transform: scaleY(1.05);
        }
    }

    .process-step:hover + .process-step::before {
        animation: pulse-line 2s ease-in-out infinite;
    }

    /* Card Hover Effects */
    .process-step .group:hover {
        transform: translateY(-8px) scale(1.02);
    }

    /* Icon Animation */
    .process-step .group:hover svg {
        animation: bounce-icon 1s ease-in-out infinite;
    }

    @keyframes bounce-icon {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-6px);
        }
        60% {
            transform: translateY(-3px);
        }
    }

    /* Gradient Animation */
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .process-step .group:hover .absolute.inset-0 {
        background: linear-gradient(135deg, rgba(var(--primary-rgb), 0.1), transparent, rgba(var(--secondary-rgb), 0.1));
        background-size: 200% 200%;
        animation: gradient-shift 3s ease infinite;
    }

    /* Step Number Hover */
    .process-step:hover .absolute.-top-4 {
        transform: rotate(10deg) scale(1.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    /* Feature List Animation */
    .process-step .group:hover .flex.items-start {
        animation: slide-in-left 0.5s ease-out forwards;
    }

    @keyframes slide-in-left {
        from {
            opacity: 0.8;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Statistics Counter Animation */
    .text-3xl {
        transition: all 0.3s ease;
    }

    .text-3xl:hover {
        transform: scale(1.1);
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    }

    /* Responsive Improvements */
    @media (max-width: 1024px) {
        .process-step .group:hover {
            transform: translateY(-4px) scale(1.01);
        }
    }

    @media (max-width: 640px) {
        .process-step .group:hover {
            transform: translateY(-2px);
        }
        
        .text-4xl {
            font-size: 2rem;
        }
        
        .text-5xl {
            font-size: 2.5rem;
        }
    }

    /* Background Pattern Animation */
    .absolute.top-20 .grid > div {
        animation: twinkle 3s ease-in-out infinite;
    }

    @keyframes twinkle {
        0%, 100% {
            opacity: 0.3;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }

    /* CTA Button Enhancement */
    .group.inline-flex:hover {
        box-shadow: 0 20px 40px rgba(var(--primary-rgb), 0.3);
    }
</style>

<!-- AOS JavaScript -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            disable: 'mobile'
        });

        // Counter Animation for Statistics
        const counters = document.querySelectorAll('.text-3xl, .text-4xl');
        const animateCounters = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = counter.innerText;
                    
                    // Only animate if it contains numbers
                    if (/\d/.test(target)) {
                        let current = 0;
                        const increment = target.match(/\d+/)[0] / 20;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target.match(/\d+/)[0]) {
                                counter.innerText = target;
                                clearInterval(timer);
                            } else {
                                counter.innerText = target.replace(/\d+/, Math.floor(current));
                            }
                        }, 100);
                    }
                    
                    observer.unobserve(counter);
                }
            });
        };

        const counterObserver = new IntersectionObserver(animateCounters, {
            threshold: 0.7
        });

        counters.forEach(counter => {
            if (counter.closest('.grid.grid-cols-2')) {
                counterObserver.observe(counter);
            }
        });
    });
</script>
