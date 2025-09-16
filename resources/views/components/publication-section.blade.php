<!-- Publications Section -->
        <section class="py-16 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-blue-50 relative overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute inset-0 opacity-5">
                <!-- Dot pattern -->
                <div class="absolute top-20 left-20 w-32 h-32">
                    <div class="grid grid-cols-8 gap-1 w-full h-full">
                        @for($i = 0; $i < 64; $i++)
                            <div class="w-1 h-1 bg-blue-400 rounded-full"></div>
                        @endfor
                    </div>
                </div>
                <!-- Circle patterns -->
                <div class="absolute bottom-1/4 right-10 w-24 h-24 border-2 border-blue-200 rounded-full"></div>
                <div class="absolute top-1/3 right-32 w-16 h-16 border-2 border-orange-200 rounded-full"></div>
            </div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                @if ($publications->isNotEmpty())
                    <!-- Publications Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8 mb-12">
                        @foreach ($publications as $index => $publication)
                            <div class="publication-card group" 
                                 data-aos="fade-up" 
                                 data-aos-delay="{{ $index * 100 }}">
                                <!-- Modern Card Container -->
                                <div class="relative bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-700 overflow-hidden group-hover:-translate-y-3 group-hover:scale-[1.02] border border-gray-50 backdrop-blur-sm">
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10 pointer-events-none"></div>
                                    
                                    <!-- Image Container -->
                                    <div class="relative overflow-hidden h-52 bg-gradient-to-br from-primary/10 via-primary/5 to-transparent">
                                        @if($publication->feature_image)
                                            <img src="{{ $publication->feature_image_url }}" 
                                                 alt="{{ $publication->title }}" 
                                                 class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:brightness-110">
                                        @else
                                            <!-- Modern Default Icon -->
                                            <div class="w-full h-full flex items-center justify-center relative">
                                                <div class="relative">
                                                    <!-- Background Circle -->
                                                    <div class="w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                                        <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                                                        </svg>
                                                    </div>
                                                    <!-- Floating Dots -->
                                                    <div class="absolute -top-2 -right-2 w-3 h-3 bg-primary/40 rounded-full animate-pulse"></div>
                                                    <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-primary/30 rounded-full animate-pulse" style="animation-delay: 0.5s"></div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Modern Overlay Gradient -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    </div>
                                    
                                    <!-- Content Container -->
                                    <div class="relative p-6 z-20">
                                        <!-- Category Badge -->
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary/10 text-primary mb-3 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                                            </svg>
                                            Study Abroad
                                        </div>
                                        
                                        <!-- Title -->
                                        <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-300">
                                            <a href="{{ route('publication.show', $publication->slug) }}" class="hover:text-primary">
                                                {{ $publication->title }}
                                            </a>
                                        </h3>
                                        
                                        <!-- Excerpt -->
                                        @if ($publication->excerpt || $publication->description)
                                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                                {{ $publication->excerpt ?? Str::limit(strip_tags($publication->description), 120) }}
                                            </p>
                                        @endif
                                        
                                        <!-- Modern Button -->
                                        <div class="flex items-center">
                                            <a href="{{ route('publication.show', $publication->slug) }}" 
                                               class="group/btn inline-flex items-center px-5 py-2.5 bg-gray-50 hover:bg-primary text-gray-700 hover:text-white text-sm font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-primary/25">
                                                <span>Read More</span>
                                                <svg class="w-4 h-4 ml-2 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Bottom Accent Line -->
                                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary/20 via-primary to-primary/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- View All Button -->
                    {{-- @if ($showViewAll)
                        <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                            <a href="{{ route('publications.index') }}" 
                               class="inline-flex items-center gap-3 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                <span>View All Publications</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    @endif --}}
                @else
                    <!-- No Publications State -->
                    <div class="text-center py-16" data-aos="fade-up">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">No Publications Available</h3>
                        <p class="text-gray-600 max-w-md mx-auto">We're working on bringing you the latest publications and insights. Please check back later for updates.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- AOS CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Modern Custom Styles -->
        <style>
            /* Line clamp utilities */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            /* Modern Publication card animations */
            .publication-card {
                transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
                will-change: transform, box-shadow;
            }
            
            .publication-card:hover {
                transform: translateY(-12px) scale(1.02);
            }
            
            /* Modern Card Container Effects */
            .publication-card > div {
                transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
                will-change: transform, box-shadow, filter;
            }
            
            .publication-card:hover > div {
                box-shadow: 
                    0 32px 64px -12px rgba(0, 0, 0, 0.1),
                    0 0 0 1px rgba(255, 255, 255, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
            }
            
            /* Enhanced Image Effects */
            .publication-card img {
                transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
                will-change: transform, filter;
            }
            
            .publication-card:hover img {
                transform: scale(1.1) rotate(1deg);
                filter: brightness(1.1) saturate(1.2);
            }
            
            /* Modern Button Effects */
            .group\/btn {
                position: relative;
                overflow: hidden;
                isolation: isolate;
            }
            
            .group\/btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, var(--tw-bg-opacity) 0%, transparent 50%, var(--tw-bg-opacity) 100%);
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: -1;
            }
            
            .group\/btn:hover::before {
                opacity: 0.1;
            }
            
            /* Background floating animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-15px) rotate(2deg); }
            }
            
            @keyframes floatReverse {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-10px) rotate(-1deg); }
            }
            
            .absolute.top-1\/3 {
                animation: float 8s ease-in-out infinite;
            }
            
            .absolute.bottom-1\/4 {
                animation: floatReverse 10s ease-in-out infinite;
            }
            
            /* Pulse animation for default icon dots */
            @keyframes customPulse {
                0%, 100% {
                    opacity: 1;
                    transform: scale(1);
                }
                50% {
                    opacity: 0.7;
                    transform: scale(1.1);
                }
            }
            
            .animate-pulse {
                animation: customPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            
            /* Responsive grid adjustments with modern spacing */
            @media (max-width: 640px) {
                .grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }
                
                .publication-card:hover {
                    transform: translateY(-6px) scale(1.01);
                }
            }
            
            @media (min-width: 641px) and (max-width: 768px) {
                .md\:grid-cols-2 {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            
            @media (min-width: 769px) and (max-width: 1023px) {
                .lg\:grid-cols-3 {
                    grid-template-columns: repeat(3, 1fr);
                }
            }
            
            @media (min-width: 1280px) {
                .xl\:grid-cols-4 {
                    grid-template-columns: repeat(4, 1fr);
                }
            }
            
            /* Backdrop blur support for modern browsers */
            @supports (backdrop-filter: blur(10px)) {
                .backdrop-blur-sm {
                    backdrop-filter: blur(4px);
                }
            }
            
            /* Modern glassmorphism effect */
            .publication-card:hover > div {
                background: rgba(255, 255, 255, 0.9);
            }
            
            @supports (backdrop-filter: blur(10px)) {
                .publication-card:hover > div {
                    background: rgba(255, 255, 255, 0.8);
                    backdrop-filter: blur(10px);
                }
            }
        </style>
        
        <!-- AOS JavaScript -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50,
                    disable: 'mobile'
                });
            });
        </script>
