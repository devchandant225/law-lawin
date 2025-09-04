<!-- Modern Practice Areas Section -->
<section class="relative py-20 bg-gradient-to-b from-gray-900 via-blue-900 to-gray-900 overflow-hidden" id="practice-areas">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.4) 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>
    
    <!-- Animated Background Elements -->
    <div class="absolute top-20 right-10 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
    <div class="absolute bottom-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <!-- Section Tag -->
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-2 bg-white/20 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.6562 20.875H10.7188C10.5115 20.875 10.3128 20.9573 10.1663 21.1038C10.0198 21.2503 9.9375 21.449 9.9375 21.6562C9.9375 21.8635 10.0198 22.0622 10.1663 22.2087C10.3128 22.3552 10.5115 22.4375 10.7188 22.4375H21.6562C21.8635 22.4375 22.0622 22.3552 22.2087 22.2087C22.3552 22.0622 22.4375 21.8635 22.4375 21.6562C22.4375 21.449 22.3552 21.2503 22.2087 21.1038C22.0622 20.9573 21.8635 20.875 21.6562 20.875Z" />
                        <path d="M13.8056 16.9688C13.1943 16.9695 12.6083 17.2126 12.1761 17.6448C11.7439 18.0771 11.5007 18.6631 11.5 19.2744V20.0938H20.875V19.2744C20.8743 18.6631 20.6311 18.0771 20.1989 17.6448C19.7667 17.2126 19.1807 16.9695 18.5694 16.9688H13.8056Z" />
                    </svg>
                </div>
                <span class="text-lg font-semibold text-white tracking-wide">{{ $sectionSubtitle }}</span>
            </div>
            
            <!-- Section Title -->
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up" data-aos-delay="200">
                {!! $sectionTitle !!}
            </h2>
            
            <!-- Section Description -->
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                Expert legal representation across diverse practice areas with proven track record and client satisfaction
            </p>
        </div>
        
        @if($practices->isNotEmpty())
            <!-- Practice Areas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach($practices->take(4) as $index => $practice)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                        <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/20 transition-all duration-500 transform hover:-translate-y-2 overflow-hidden h-full">
                            <!-- Image Container -->
                            <div class="relative h-48 overflow-hidden rounded-t-2xl">
                                @if($practice->feature_image)
                                    <img src="{{ $practice->feature_image_url }}" 
                                         alt="{{ $practice->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 flex items-center justify-center">
                                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7 10 0"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                
                                <!-- Practice Icon -->
                                <div class="absolute -bottom-6 left-6">
                                    <div class="w-12 h-12 bg-white rounded-full shadow-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
                                        @php
                                            $practiceComponent = app('App\View\Components\PracticeSection');
                                            $iconClass = $practiceComponent->getPracticeIcon($practice->title);
                                        @endphp
                                        <i class="{{ $iconClass }} text-blue-600 text-lg"></i>
                                        @if(empty($iconClass) || $iconClass === 'icon-law')
                                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9l-6.91.74L12 16l-3.09-6.26L2 9l6.91-.74L12 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Content Container -->
                            <div class="p-6 pt-10 flex flex-col h-[calc(100%-12rem)]">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-white mb-3 group-hover:text-blue-300 transition-colors duration-300">
                                    <a href="{{ route('practice.show', $practice->slug) }}" class="block">
                                        {{ $practice->title }}
                                    </a>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-300 leading-relaxed mb-6 flex-grow">
                                    {{ Str::limit(strip_tags($practice->excerpt ?? $practice->description), 120) }}
                                </p>
                                
                                <!-- More Details Button -->
                                <div class="mt-auto">
                                    <a href="{{ route('practice.show', $practice->slug) }}" 
                                       class="inline-flex items-center text-blue-300 font-semibold hover:text-white transition-colors duration-300 group/btn">
                                        <span>More Details</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Hover Glow Effect -->
                            <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/10 to-purple-500/10 blur-xl"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16" data-aos="fade-up">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">No Practice Areas Available</h3>
                <p class="text-gray-300 max-w-md mx-auto">We're expanding our legal expertise. Please check back soon for our comprehensive practice areas!</p>
            </div>
        @endif
        
        @if($showViewAll && $practices->isNotEmpty())
            <!-- View All Button -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('practices.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group">
                    <span class="mr-3">View All Practice Areas</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
