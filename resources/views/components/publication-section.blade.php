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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                        @foreach ($publications as $index => $publication)
                            <div class="publication-card group" 
                                 data-aos="fade-up" 
                                 data-aos-delay="{{ $index * 100 }}">
                                <!-- Card Container -->
                                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform group-hover:-translate-y-2 border border-gray-100">
                                    <!-- Image Container -->
                                    <div class="relative overflow-hidden h-48 bg-gradient-to-br from-blue-100 to-blue-200">
                                        @if($publication->feature_image)
                                            <img src="{{ $publication->feature_image_url }}" 
                                                 alt="{{ $publication->title }}" 
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <!-- Default Publication Image -->
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-16 h-16 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content Container -->
                                    <div class="p-6">
                                        <!-- Title -->
                                        <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                            <a href="{{ route('publication.show', $publication->slug) }}" class="hover:text-primary">
                                                {{ $publication->title }}
                                            </a>
                                        </h3>
                                        
                                        <!-- Excerpt -->
                                        @if ($publication->excerpt || $publication->description)
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                                {{ $publication->excerpt ?? Str::limit(strip_tags($publication->description), 120) }}
                                            </p>
                                        @endif
                                        
                                        <!-- Footer -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <!-- Author/Status -->
                                            <div class="flex items-center gap-2">
                                                @if($publication->status)
                                                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                    <span class="text-xs text-gray-500">Published</span>
                                                @endif
                                            </div>
                                            
                                            <!-- Read More Link -->
                                            <a href="{{ route('publication.show', $publication->slug) }}" 
                                               class="text-primary hover:text-blue-700 text-sm font-medium flex items-center gap-1 group/link">
                                                Read More
                                                <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
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

        <!-- Custom Styles -->
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
            
            /* Publication card animations */
            .publication-card {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .publication-card:hover {
                transform: translateY(-8px) scale(1.02);
            }
            
            /* Background animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            .absolute.top-1\/3 {
                animation: float 6s ease-in-out infinite;
            }
            
            .absolute.bottom-1\/4 {
                animation: float 8s ease-in-out infinite reverse;
            }
            
            /* Responsive grid adjustments */
            @media (max-width: 640px) {
                .grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
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
            
            /* Card hover effects */
            .publication-card .bg-white {
                transition: all 0.5s ease;
                will-change: transform, box-shadow;
            }
            
            .publication-card:hover .bg-white {
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
            
            /* Image hover effects */
            .publication-card img {
                transition: transform 0.5s ease;
                will-change: transform;
            }
            
            /* Button hover effects */
            .publication-card a[class*="bg-blue"] {
                transition: all 0.3s ease;
                will-change: transform, box-shadow;
            }
            
            .publication-card a[class*="bg-blue"]:hover {
                transform: scale(1.05) translateY(-1px);
                box-shadow: 0 10px 20px rgba(59, 130, 246, 0.4);
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
