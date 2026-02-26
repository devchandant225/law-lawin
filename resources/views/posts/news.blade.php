@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags title="News & Updates - Professional Insights"
        description="Stay updated with the latest news, updates and professional insights from our legal experts."
        keywords="legal news, law firm updates, legal insights, news"
        type="website" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="News & Updates"
        subtitle="Stay informed with our latest news, legal updates, and professional insights"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'News']]" />

    {{-- News Section Title --}}
    <x-page-section-title title="<span>Our Latest News</span>" />

    {{-- News Grid Section (Service page design) --}}
    <section class="relative py-8 bg-gray-100 overflow-hidden" id="news">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if($posts->isNotEmpty())
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    @foreach($posts as $index => $post)
                        <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                            <div class="relative bg-white rounded-xl shadow hover:shadow-xl transition-all duration-500 transform overflow-hidden h-full">
                                <!-- Image Container -->
                                <div class="relative h-48 overflow-hidden">
                                    <a href="{{ route('news.show', $post) }}" class="block w-full h-full">
                                        @if($post->feature_image)
                                            <img src="{{ $post->feature_image_url }}" 
                                                 alt="{{ $post->feature_image_alt ?: $post->title }}" 
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            <div class="absolute inset-0 bg-blue-900/20 group-hover:bg-blue-900/30 transition-colors duration-500"></div>
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-newspaper text-blue-300 text-3xl"></i>
                                                </div>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                
                                <!-- Content Container -->
                                <div class="px-6 py-3 flex flex-col h-[calc(100%-12rem)] text-center">
                                    <!-- Date -->
                                    <div class="text-xs text-primary font-medium mb-2">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-base font-semibold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300">
                                        <a href="{{ route('news.show', $post) }}" class="block">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    
                                    <!-- Description -->
                                    <p class="text-gray-600 leading-relaxed mb-4 flex-grow text-sm">
                                        {{ Str::limit(strip_tags($post->excerpt ?? $post->description), 80) }}
                                    </p>
                                    
                                    <!-- Read More Button -->
                                    <div class="mt-auto">
                                        <a href="{{ route('news.show', $post) }}" 
                                           class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-600 bg-blue-100 rounded-full overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-lg group/btn">
                                            <span class="relative z-10">Read More</span>
                                            <svg class="relative z-10 w-4 h-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300" 
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                            
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

                <!-- Pagination -->
                <div class="flex justify-center mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16" data-aos="fade-up">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No News Available</h3>
                    <p class="text-gray-600 max-w-md mx-auto">We're currently working on bringing you the latest news and updates. Please check back soon!</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Call to Action Section (Same as Service Index) --}}
    <section class="py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: 
            linear-gradient(45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%),
            linear-gradient(-45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%);
            background-size: 20px 20px;">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Stay Updated with our <span class="text-[#6f64d3]">Insights</span>
                </h2>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                    Subscribe to our newsletter or follow us on social media to never miss an update on the legal landscape in Nepal.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/contact') }}"
                       class="inline-flex items-center px-8 py-4 bg-[#6f64d3] text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-[#5a50a8] hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#6f64d3] focus:ring-opacity-30">
                        <i class="fas fa-envelope mr-3"></i>
                        Contact Us
                    </a>
                    <a href="{{ url('/') }}"
                       class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-white/10 hover:border-white hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-30">
                        <i class="fas fa-home mr-3"></i>
                        Home
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
