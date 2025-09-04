<!-- Modern Services Section -->
<section class="relative py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 overflow-hidden" id="services">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-white/50"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute -bottom-8 left-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 left-1/3 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <!-- Section Tag -->
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-white/80 backdrop-blur-sm rounded-full shadow-lg border border-blue-100 mb-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="p-2 bg-blue-600 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.6562 20.875H10.7188C10.5115 20.875 10.3128 20.9573 10.1663 21.1038C10.0198 21.2503 9.9375 21.449 9.9375 21.6562C9.9375 21.8635 10.0198 22.0622 10.1663 22.2087C10.3128 22.3552 10.5115 22.4375 10.7188 22.4375H21.6562C21.8635 22.4375 22.0622 22.3552 22.2087 22.2087C22.3552 22.0622 22.4375 21.8635 22.4375 21.6562C22.4375 21.449 22.3552 21.2503 22.2087 21.1038C22.0622 20.9573 21.8635 20.875 21.6562 20.875Z" />
                        <path d="M13.8056 16.9688C13.1943 16.9695 12.6083 17.2126 12.1761 17.6448C11.7439 18.0771 11.5007 18.6631 11.5 19.2744V20.0938H20.875V19.2744C20.8743 18.6631 20.6311 18.0771 20.1989 17.6448C19.7667 17.2126 19.1807 16.9695 18.5694 16.9688H13.8056Z" />
                    </svg>
                </div>
                <span class="text-lg font-semibold text-gray-700 tracking-wide">{{ $sectionSubtitle }}</span>
            </div>
            
            <!-- Section Title -->
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight" data-aos="fade-up" data-aos-delay="200">
                {!! $sectionTitle !!}
            </h2>
            
            <!-- Section Description -->
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                We provide comprehensive legal services with expert guidance and professional excellence
            </p>
        </div>
        
        @if($services->isNotEmpty())
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach($services->take(8) as $index => $service)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                        <div class="relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden h-full">
                            <!-- Image Container -->
                            <div class="relative h-48 overflow-hidden">
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
                                
                              
                            </div>
                            
                            <!-- Content Container -->
                            <div class="p-6 pt-10 flex flex-col h-[calc(100%-12rem)]">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    <a href="{{ route('service.show', $service->slug) }}" class="block">
                                        {{ $service->title }}
                                    </a>
                                </h3>
                                
                                <!-- Description -->
                                <p class="text-gray-600 leading-relaxed mb-6 flex-grow">
                                    {{ Str::limit(strip_tags($service->excerpt ?? $service->description), 120) }}
                                </p>
                                
                                <!-- Read More Button -->
                                <div class="mt-auto">
                                    <a href="{{ route('service.show', $service->slug) }}" 
                                       class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-300 group/btn">
                                        <span>Read More</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Hover Effect Border -->
                            <div class="absolute inset-0 rounded-2xl ring-2 ring-transparent group-hover:ring-blue-200 transition-all duration-300"></div>
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
                   class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl group">
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
