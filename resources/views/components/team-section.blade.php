@props([
    'teams' => collect(),
    'showViewAll' => true,
    'limit' => null,
    'sectionTitle' => 'Our Team',
    'sectionSubtitle' => 'Meet Our Professional Team',
    'sectionDescription' => 'Our dedicated team of legal professionals brings years of experience and expertise to serve your legal needs with excellence.',
    'showSearch' => false
])

<section class="relative bg-white overflow-hidden">
    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>
        
    <!-- Floating Geometric Shapes -->
    <div class="absolute top-20 left-10 w-32 h-32 border-2 border-purple-200 rounded-full opacity-20 animate-float-slow"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 border-2 border-blue-200 rounded-lg opacity-20 animate-float-reverse" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 border-2 border-pink-200 rotate-45 opacity-20 animate-float-slow" style="animation-delay: 1s;"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-semibold mb-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                {{ $sectionSubtitle }}
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                {!! $sectionTitle !!}
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full mb-6"></div>
            {{-- <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $sectionDescription }}
            </p> --}}
        </div>

        {{-- Search Bar (only on teams page) --}}
        @if($showSearch)
            <div class="max-w-md mx-auto mb-12">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="teamSearch" 
                           placeholder="Search team members..." 
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 shadow-sm">
                </div>
            </div>
        @endif

        @if($teams->count() > 0)
            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12" id="teamGrid">
                @foreach($teams->take($limit ?? $teams->count()) as $team)
                    <div class="group relative team-card-slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                         data-name="{{ strtolower($team->name) }}" 
                         data-designation="{{ strtolower($team->designation) }}">
                        <!-- Professional Team Member Card -->
                        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 hover:scale-[1.02] group-hover:border-primary/30 backdrop-blur-sm">
                            <!-- Image Container with Professional Styling -->
                            <div class="relative h-72 bg-gradient-to-br from-gray-50 to-gray-100">
                                @if($team->image_url)
                                    <img src="{{ $team->image_url }}" 
                                         alt="{{ $team->name }}" 
                                         class="w-full h-full object-cover object-top transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <!-- Professional Default Avatar -->
                                    <div class="flex items-center justify-center w-full h-full">
                                        <div class="w-24 h-24 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center shadow-lg">
                                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Experience Badge -->
                                {{-- @if($team->experience)
                                    <div class="absolute top-4 left-4 px-2 py-1 bg-white/90 backdrop-blur-sm rounded-lg shadow-sm">
                                        <span class="text-xs font-semibold text-gray-700">{{ $team->experience }}+ Years</span>
                                    </div>
                                @endif --}}
                            </div>

                            <!-- Professional Card Content -->
                            <div class="p-5">
                                <!-- Name with Modern Typography -->
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors duration-300">
                                    {{ $team->name }}
                                </h3>
                                
                                <!-- Designation with Brand Color -->
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $team->designation }}
                                </p>
                                
                                <!-- Modern Contact Info -->
                                <div class="space-y-2.5 mb-5">
                                    @if($team->phone)
                                        <div class="group/contact">
                                            <div class="flex items-center p-2.5 bg-gray-50 rounded-lg hover:bg-primary/5 transition-colors duration-300">
                                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center mr-3 group-hover/contact:bg-primary/20 transition-colors duration-300">
                                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                </div>
                                                <a href="tel:{{ $team->phone }}" class="text-sm font-medium text-gray-700 group-hover/contact:text-primary transition-colors duration-300">{{ $team->phone }}</a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($team->email)
                                        <div class="group/contact">
                                            <div class="flex items-center p-2.5 bg-gray-50 rounded-lg hover:bg-primary/5 transition-colors duration-300">
                                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center mr-3 group-hover/contact:bg-primary/20 transition-colors duration-300">
                                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <a href="mailto:{{ $team->email }}" class="text-sm font-medium text-gray-700 group-hover/contact:text-primary transition-colors duration-300 truncate">{{ $team->email }}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Social Icons and View Profile Button -->
                                <div class="flex items-center justify-between">
                                    <!-- Social Icons -->
                                    <div class="flex space-x-2">
                                        @if($team->facebooklink)
                                            <a href="{{ $team->facebooklink }}" target="_blank" 
                                               class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-all duration-300 hover:scale-110 shadow-sm">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($team->linkedinlink)
                                            <a href="{{ $team->linkedinlink }}" target="_blank" 
                                               class="w-8 h-8 bg-blue-800 text-white rounded-lg flex items-center justify-center hover:bg-blue-900 transition-all duration-300 hover:scale-110 shadow-sm">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if(!$team->facebooklink && !$team->linkedinlink)
                                            <!-- Placeholder for alignment -->
                                            <div class="flex space-x-2">
                                                <div class="w-8 h-8"></div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- View Profile Button -->
                                    <a href="{{ route('team.show', $team->slug) }}" 
                                       class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-lg hover:from-secondary hover:to-primary transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary/25 group/btn">
                                        <span class="flex items-center">
                                            <span class="mr-1.5">View more</span>
                                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Border Animation -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-primary/20 rounded-xl transition-colors duration-500 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>

            <!-- View All Team Button -->
            @if($showViewAll && $teams->count() > ($limit ?? 8))
                <div class="text-center">
                    <a href="{{ route('team.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary to-secondary text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:scale-105 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>View All Team Members</span>
                        <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            @endif

            <!-- No Results Message (for search) -->
            <div id="noResults" class="hidden text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Team Members Found</h3>
                <p class="text-gray-600">Try adjusting your search terms.</p>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Team Members Available</h3>
                <p class="text-gray-600">We're currently updating our team information. Please check back later.</p>
            </div>
        @endif
    </div>
</section>

<style>
    /* Define CSS custom properties for primary and secondary colors */
    :root {
        --primary-color: #6f64d3;
        --secondary-color: #8b7ed8;
    }
    
    .text-primary { color: var(--primary-color) !important; }
    .bg-primary { background-color: var(--primary-color) !important; }
    .border-primary { border-color: var(--primary-color) !important; }
    .ring-primary { --tw-ring-color: var(--primary-color) !important; }
    .from-primary { --tw-gradient-from: var(--primary-color) !important; }
    .to-secondary { --tw-gradient-to: var(--secondary-color) !important; }
    .bg-primary\/10 { background-color: rgb(111 100 211 / 0.1) !important; }
    
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
            linear-gradient(to right, var(--primary-color) 1px, transparent 1px),
            linear-gradient(to bottom, var(--primary-color) 1px, transparent 1px);
        background-size: 50px 50px;
        background-position: -1px -1px;
    }
    
    /* Float Animations */
    @keyframes float-slow {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.2;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.3;
        }
    }
    
    @keyframes float-reverse {
        0%, 100% {
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
    
    /* Team Card Slide Animation */
    .team-card-slide {
        opacity: 0;
        transform: translateY(30px);
        animation: slideUp 0.6s ease-out forwards;
        animation-play-state: paused;
    }
    
    .team-card-slide.aos-animate {
        animation-play-state: running;
    }
    
    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Intersection Observer Fallback */
    .team-card-slide {
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .team-card-slide.in-view {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Responsive Grid Line Adjustments */
    @media (max-width: 768px) {
        .bg-grid-pattern {
            background-size: 30px 30px;
        }
    }
</style>

<!-- Team Search and Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('teamSearch');
        const teamGrid = document.getElementById('teamGrid');
        const noResults = document.getElementById('noResults');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const teamCards = teamGrid.querySelectorAll('.team-card-slide');
                let visibleCount = 0;
                
                teamCards.forEach(function(card) {
                    const name = card.getAttribute('data-name');
                    const designation = card.getAttribute('data-designation');
                    
                    if (name.includes(searchTerm) || designation.includes(searchTerm)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Show/hide no results message
                if (visibleCount === 0 && searchTerm !== '') {
                    noResults.classList.remove('hidden');
                    teamGrid.style.display = 'none';
                } else {
                    noResults.classList.add('hidden');
                    teamGrid.style.display = 'grid';
                }
            });
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
        
        // Observe all team cards
        document.querySelectorAll('.team-card-slide').forEach((card) => {
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
