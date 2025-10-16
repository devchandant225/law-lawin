@extends('layouts.app')

@section('head')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner 
        title="" 
        subtitle="Discover our comprehensive legal practice areas and specialized expertise that provide exceptional legal services across various areas of law"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Practice Areas']
        ]"
    />
      <x-page-section-title title="<span>Practice Areas</span>" />
    <div class="page-wrapper">

    {{-- Main Practices Section --}}
    <section class="py-8 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        
        <div class="container mx-auto px-4 relative z-10">
            @if ($practices->count() > 0)
                {{-- Practices Grid --}}
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                @foreach($practices->take(8) as $index => $practice)
                    <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}" data-aos-duration="800">
                        <div class="relative shadow bg-white rounded-2xl border border-white/10 hover:border-white/20 transition-all duration-500 transform hover:-translate-y-2 overflow-hidden h-full">
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
                            <div class="px-4 py-3 flex flex-col h-[calc(100%-12rem)] text-center">
                                <!-- Title -->
                                <h3 class="text-base font-semibold text-gray-900 mb-3 transition-colors duration-300">
                                    <a href="{{ route('practice.show', $practice->slug) }}" class="block">
                                        {{ $practice->title }}
                                    </a>
                                </h3>
                                <!-- Description -->
                                <p class="text-gray-600 leading-relaxed mb-3 flex-grow text-sm">
                                    {{ Str::limit(strip_tags($practice->excerpt ?? $practice->description), 55) }}
                                </p>
                                <!-- More Details Button -->
                                    <div class="mt-auto">
                                    <a href="{{ route('practice.show', $practice->slug) }}" 
                                       class="relative inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-primary rounded-full overflow-hidden transition-all duration-300 transform hover:scale-105 hover:shadow-lg group/btn">
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

                {{-- Pagination --}}
                @if ($practices->hasPages())
                    <div class="mt-16">
                        <div class="flex justify-center">
                            <nav class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($practices->onFirstPage())
                                    <span class="px-4 py-2 text-gray-400 cursor-not-allowed">‹ Previous</span>
                                @else
                                    <a href="{{ $practices->previousPageUrl() }}" 
                                       class="px-4 py-2 text-primary hover:bg-primary hover:text-white rounded-lg transition-all duration-300">‹ Previous</a>
                                @endif
                    
                                {{-- Pagination Elements --}}
                                @foreach ($practices->getUrlRange(1, $practices->lastPage()) as $page => $url)
                                    @if ($page == $practices->currentPage())
                                        <span class="px-4 py-2 bg-primary text-white rounded-lg font-semibold">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" 
                                           class="px-4 py-2 text-gray-600 hover:bg-primary hover:text-white rounded-lg transition-all duration-300">{{ $page }}</a>
                                    @endif
                                @endforeach
                    
                                {{-- Next Page Link --}}
                                @if ($practices->hasMorePages())
                                    <a href="{{ $practices->nextPageUrl() }}" 
                                       class="px-4 py-2 text-primary hover:bg-primary hover:text-white rounded-lg transition-all duration-300">Next ›</a>
                                @else
                                    <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Next ›</span>
                                @endif
                            </nav>
                        </div>
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-20">
                    <div class="max-w-2xl mx-auto">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary to-primary rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">No Practice <span class="text-primary">Areas</span> Found</h3>
                        
                        <p class="text-gray-600 text-lg leading-relaxed mb-8">
                            @if (request('search'))
                                No practice areas match your search criteria. Try adjusting your search terms or explore all our available practice areas.
                            @else
                                We're working on expanding our legal expertise. Please check back soon for our comprehensive practice areas!
                            @endif
                        </p>
                        
                        @if (request('search'))
                            <a href="{{ route('practices.index') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary to-primary hover:opacity-90 text-white font-semibold rounded-xl transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                View All Practice Areas
                            </a>
                        @endif
                    </div>
                </div>
            @endif
            </div>
        </section>
        
    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%), linear-gradient(-45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%); background-size: 20px 20px;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <p class="text-base font-semibold text-primary mb-3">Get Expert Help</p>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Need Legal <span class="text-primary">Assistance</span>?
                </h2>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed max-w-2xl mx-auto">
                    Contact our experienced team to discuss your legal needs and find the right practice area for your situation.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/contact') }}" 
                       class="inline-flex items-center px-8 py-4 bg-primary text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-primary/90 hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Get Consultation
                    </a>
                    <a href="{{ url('/contact') }}" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-white/10 hover:border-white hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit search form on filter change
            const sortSelect = document.querySelector('select[name="sort"]');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // Enhance search functionality
            const searchForm = document.querySelector('form[action*="practices"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const searchInput = this.querySelector('input[name="search"]');
                    if (searchInput && searchInput.value.trim() === '') {
                        e.preventDefault();
                        window.location.href = '{{ route('practices.index') }}';
                    }
                });
            }
        });
    </script>
@endpush
