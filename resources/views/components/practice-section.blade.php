<!-- Modern Practice Areas Section -->
<section class="relative py-20  overflow-hidden" id="practice-areas">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.4) 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        @if($practices->isNotEmpty())
            <!-- Practice Areas Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach($practices->take(8) as $index => $practice)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                        <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 hover:border-white/20 transition-all duration-500 transform hover:-translate-y-2 overflow-hidden h-full">
                            <!-- Image Container -->
                            <div class="relative h-48 overflow-hidden rounded-t-2xl">
                                <a href="{{ route('practice.show', $practice->slug) }}" class="block w-full h-full">
                                    @if($practice->feature_image)
                                        <img src="{{ $practice->feature_image_url }}" 
                                             alt="{{ $practice->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary via-secondary to-primary/80 flex items-center justify-center">
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
                                </a>
                                
                        
                            </div>
                            
                            <!-- Content Container -->
                            <div class="p-6 pt-10 flex flex-col h-[calc(100%-12rem)]">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-white mb-3 transition-colors duration-300">
                                    <a href="{{ route('practice.show', $practice->slug) }}" class="block">
                                        {{ $practice->title }}
                                    </a>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-300 leading-relaxed mb-6 flex-grow">
                                    {{ Str::limit(strip_tags($practice->excerpt ?? $practice->description), 50) }}
                                </p>
                                
                                <!-- More Details Button -->
                                <div class="mt-auto">
                                    <a href="{{ route('practice.show', $practice->slug) }}" 
                                       class="relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-primary bg-white/90 backdrop-blur-sm rounded-full overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-xl group/btn">
                                        <!-- Button Content -->
                                        <span class="relative z-10 group-hover/btn:text-primary transition-colors duration-300">More Details</span>
                                        <svg class="relative z-10 w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-all duration-300 group-hover/btn:text-primary" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                               
                                    </a>
                                </div>
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
