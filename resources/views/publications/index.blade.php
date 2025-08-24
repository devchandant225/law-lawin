@extends('layouts.app')

@section('head')
    <x-meta-tags 
        title="Publications - Professional Legal Resources"
        description="Explore our comprehensive collection of legal publications, research papers, and professional resources."
        keywords="legal publications, law research, legal resources, professional papers"
        type="website"
    />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-emerald-900 via-teal-900 to-slate-900 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: 
                radial-gradient(circle at 2px 2px, white 2px, transparent 0);
                background-size: 40px 40px;">
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-emerald-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-20 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl animate-bounce"></div>
        <div class="absolute top-1/2 right-1/4 w-16 h-16 bg-cyan-500/15 rounded-full blur-lg animate-pulse" style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <!-- Badge -->
                <div class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-emerald-600/30 to-teal-600/30 rounded-full text-sm font-semibold tracking-wide backdrop-blur-sm border border-emerald-500/20 mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Legal Publications
                </div>
                
                <!-- Title -->
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight bg-gradient-to-r from-white to-emerald-200 bg-clip-text text-transparent">
                    Professional Publications
                </h1>
                
                <!-- Description -->
                <p class="text-xl md:text-2xl mb-8 leading-relaxed text-slate-300">
                    Explore our comprehensive collection of legal publications, research papers, and professional resources
                </p>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
                    <div class="bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 p-6">
                        <div class="text-3xl font-bold text-emerald-300">{{ $publicationStats['total'] }}</div>
                        <div class="text-sm text-slate-300">Total Publications</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 p-6">
                        <div class="text-3xl font-bold text-teal-300">{{ $publicationStats['active'] }}</div>
                        <div class="text-sm text-slate-300">Active</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 p-6">
                        <div class="text-3xl font-bold text-cyan-300">{{ $publicationStats['with_images'] }}</div>
                        <div class="text-sm text-slate-300">Featured</div>
                    </div>
                    <div class="bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 p-6">
                        <div class="text-3xl font-bold text-blue-300">{{ $publicationStats['recent'] }}</div>
                        <div class="text-sm text-slate-300">Recent</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg class="relative block w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>
    </section>

    {{-- Main Publications Section --}}
    @if($publications->count() > 0)
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($publications as $publication)
                        <article class="group">
                            <div class="bg-white rounded-3xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl border border-gray-100">
                                <!-- Publication Image -->
                                <div class="relative overflow-hidden h-56 bg-gradient-to-br from-emerald-100 to-teal-100">
                                    @if($publication->feature_image_url)
                                        <img src="{{ $publication->feature_image_url }}" 
                                             alt="{{ $publication->title }}" 
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full">
                                            <svg class="w-20 h-20 text-emerald-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Publication Type Badge -->
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white backdrop-blur-sm">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            Publication
                                        </span>
                                    </div>

                                    <!-- Date Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-sm">
                                            {{ $publication->created_at->format('M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors duration-300">
                                        {{ $publication->title }}
                                    </h3>
                                    
                                    @if($publication->excerpt)
                                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                            {{ $publication->excerpt }}
                                        </p>
                                    @endif

                                    <!-- Meta Info -->
                                    <div class="flex items-center justify-between mb-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"/>
                                            </svg>
                                            {{ $publication->created_at->format('M d, Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ rand(3, 8) }} min read
                                        </span>
                                    </div>

                                    <!-- Read More Button -->
                                    <a href="{{ route('publication.show', $publication->slug) }}" 
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-sm font-semibold rounded-2xl transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                        <span>Read Publication</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        {{-- Empty State --}}
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">No Publications Available</h3>
                    <p class="text-gray-600 mb-8">We're currently updating our publication library. Please check back later for new content.</p>
                    <a href="{{ url('/') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-2xl transform transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-emerald-500/50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
<style>
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
</style>
@endpush
