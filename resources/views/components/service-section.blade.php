<!-- Modern Services Section -->
<section class="relative py-8 bg-gray-100 overflow-hidden" id="services">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        @if($services->isNotEmpty())
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach($services as $index => $service)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                        <div class="relative bg-white rounded-xl shadow hover:shadow-xl transition-all duration-500 transform overflow-hidden h-full">
                            <!-- Image Container -->
                            <div class="relative h-48 overflow-hidden">
                                <a href="{{ route('service.show', $service->slug) }}" class="block w-full h-full">
                                    @if($service->feature_image)
                                        <img src="{{ $service->feature_image_url }}" 
                                             alt="{{ $service->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-blue-900/20 group-hover:bg-blue-900/30 transition-colors duration-500"></div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2L13.09 8.26L19 9L13.09 9.74L12 16L10.91 9.74L5 9L10.91 8.26L12 2Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </a>
                                
                              
                            </div>
                            
                            <!-- Content Container -->
                            <div class="px-6 py-3 flex flex-col h-[calc(100%-12rem)] text-center">
                                <!-- Title -->
                                <h3 class="text-base font-semibold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300">
                                    <a href="{{ route('service.show', $service->slug) }}" class="block">
                                        {{ $service->title }}
                                    </a>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-600 leading-relaxed mb-4 flex-grow text-sm">
                                    {{ Str::limit(strip_tags($service->excerpt ?? $service->description), 50) }}
                                </p>
                                
                                <!-- Read More Button -->
                                <div class="mt-auto">
                                    <a href="{{ route('service.show', $service->slug) }}" 
                                       class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-600 bg-blue-100 rounded-full overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-lg group/btn">
                                        <!-- Button Content -->
                                        <span class="relative z-10">Read More</span>
                                        <svg class="relative z-10 w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                        
                                        <!-- Shine Effect -->
                                        <div class="absolute inset-0 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300">
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 translate-x-full group-hover/btn:translate-x-[-200%] transition-transform duration-700 ease-out"></div>
                                        </div>
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
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Services Available</h3>
                <p class="text-gray-600 max-w-md mx-auto">We're working hard to bring you the best legal services. Please check back soon!</p>
            </div>
        @endif
        
        @if($showViewAll && $services->isNotEmpty())
            <!-- View All Button -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('services.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-600 font-semibold rounded-full transition-all duration-300 transform group">
                    <span class="mr-3">View All Services</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
