@props([
    'publications' => collect(),
    'showViewAll' => true,
    'limit' => 8,
    'sectionTitle' => 'Our Publications',
    'sectionSubtitle' => 'Legal Knowledge & Resources',
    'sectionDescription' =>
        'Explore our comprehensive collection of legal publications, research papers, and expert insights covering various areas of law.',
    'showSearch' => true,
])

<section class="relative py-10 overflow-hidden bg-accent" id="publications-section">
    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-primary rounded-full opacity-20 animate-float-slow">
    </div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-primary rounded-lg opacity-20 animate-float-reverse"
        style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 right-1/4 w-16 h-16 border-2 border-primary rotate-45 opacity-20 animate-float-slow"
        style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-4 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C7.12,19.38 3.5,15.5 3.5,10.82C3.5,8.61 4.14,6.56 5.19,4.93L4.93,5.82Z" />
                </svg>
                {{ $sectionSubtitle }}
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">
                    {!! $sectionTitle !!}
                </span>
            </h2>
            <div class="w-24 h-1 bg-secondary mx-auto rounded-full mb-6"></div>
            {{-- <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto">{{ $sectionDescription }}</p> --}}

            {{-- Search Bar --}}
            @if ($showSearch)
                <div class="max-w-md mx-auto mb-10">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="publication-search"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-300"
                            placeholder="Search publications..." autocomplete="off">
                        <div id="search-spinner" class="absolute inset-y-0 right-0 pr-3 flex items-center hidden">
                            <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div id="search-results"
                        class="absolute z-50 w-full max-w-md mx-auto mt-2 bg-white rounded-xl shadow-lg border border-gray-200 hidden max-h-96 overflow-y-auto">
                        <!-- Search results will be populated here -->
                    </div>
                </div>
            @endif
        </div>

        <div id="publications-container">
            @if ($publications->count() > 0)
                <!-- Publications Grid - 2 Columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @foreach ($publications->take($limit ?? $publications->count()) as $publication)
                        <div class="group relative publication-card-slide" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <!-- Publication Card -->
                            <article
                                class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:-translate-y-2 border border-gray-100/50 backdrop-blur-sm h-full flex flex-col">
                               
                                <!-- Card Content -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <!-- Title -->
                                    <h3
                                        class="text-xl font-bold text-primary mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-300 flex-shrink-0">
                                        {{ $publication->title }}
                                    </h3>

                                    <!-- Excerpt -->
                                    @if ($publication->excerpt)
                                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed flex-1">
                                            {{ $publication->excerpt }}
                                        </p>
                                    @endif


                                    <!-- Details View Link -->
                                    {{-- <a href="{{ route('publication.show', $publication->slug) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-lg transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 flex-shrink-0">
                                        <span>View Details</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a> --}}
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

                <!-- View All Publications Button -->
                @if ($showViewAll)
                    <div class="text-center">
                        <a href="{{ route('publications.index') }}"
                            class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold text-sm rounded-full transform transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-30 group">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span>View More Publications</span>
                            <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Publications Available</h3>
                    <p class="text-gray-600">We're currently updating our publication library. Please check back later.
                    </p>
                </div>
            @endif
        </div>
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
            linear-gradient(to right, #6F64D3 1px, transparent 1px),
            linear-gradient(to bottom, #6F64D3 1px, transparent 1px);
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

    /* Publication Card Slide Animation */
    .publication-card-slide {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }

    .publication-card-slide.aos-animate {
        animation-play-state: running;
    }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Intersection Observer Fallback */
    .publication-card-slide {
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .publication-card-slide.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Search Results Styling */
    .search-result-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .search-result-item:hover {
        background-color: #f9fafb;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    /* Responsive Grid Line Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
        }
    }

    /* Performance Optimization */
    .publication-card-slide {
        will-change: transform, opacity;
    }
</style>

<!-- JavaScript for Search Functionality and Animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('publication-search');
        const searchResults = document.getElementById('search-results');
        const searchSpinner = document.getElementById('search-spinner');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }

                if (query.length === 0) {
                    searchResults.classList.add('hidden');
                    return;
                }

                if (query.length < 2) {
                    return;
                }

                // Show spinner
                searchSpinner.classList.remove('hidden');

                searchTimeout = setTimeout(() => {
                    fetch(`/publications/search?q=${encodeURIComponent(query)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            displaySearchResults(data.results);
                            searchSpinner.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            searchSpinner.classList.add('hidden');
                            searchResults.innerHTML =
                                '<div class="p-4 text-gray-500">Search error occurred</div>';
                            searchResults.classList.remove('hidden');
                        });
                }, 300);
            });

            // Hide search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        }

        function displaySearchResults(results) {
            if (results.length === 0) {
                searchResults.innerHTML = '<div class="p-4 text-gray-500">No publications found</div>';
            } else {
                searchResults.innerHTML = results.map(result => `
                    <div class="search-result-item" onclick="window.location.href='${result.url}'">
                        <div class="flex items-start space-x-3">
                            ${result.image ? `<img src="${result.image}" alt="${result.title}" class="w-12 h-12 object-cover rounded-lg flex-shrink-0">` : `
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>`}
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 truncate">${result.title}</h4>
                                ${result.excerpt ? `<p class="text-sm text-gray-500 mt-1 line-clamp-2">${result.excerpt}</p>` : ''}
                            </div>
                        </div>
                    </div>
                `).join('');
            }
            searchResults.classList.remove('hidden');
        }

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

        // Observe all publication cards
        document.querySelectorAll('.publication-card-slide').forEach((card) => {
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
