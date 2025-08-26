@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Publications - Legal Publications & Resources'" :description="'Browse our comprehensive collection of legal publications, research papers, and resources'" :keywords="'publications, legal resources, law, research'" />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-primary to-slate-900 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: 
                radial-gradient(circle at 2px 2px, white 2px, transparent 0);
                background-size: 40px 40px;">
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-secondary/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-20 w-32 h-32 bg-primary/10 rounded-full blur-2xl animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-secondary/15 rounded-full blur-lg animate-pulse" style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-primary/80">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors duration-300 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 text-white font-medium">Publications</span>
                        </li>
                    </ol>
                </nav>

                <div class="text-center text-white">
                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight bg-gradient-to-r from-white to-secondary bg-clip-text text-transparent">
                        Legal Publications
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-xl md:text-2xl text-primary/90 max-w-3xl mx-auto leading-relaxed mb-8">
                        Explore our comprehensive collection of legal publications, research papers, and professional resources
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ $totalPublications }}</div>
                            <div class="text-primary/80 text-sm">Total Publications</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ now()->format('Y') }}</div>
                            <div class="text-primary/80 text-sm">Current Year</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-white mb-2">{{ $publications->count() }}</div>
                            <div class="text-primary/80 text-sm">Showing Now</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full rotate-180 overflow-hidden">
            <svg class="relative block w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-white"></path>
            </svg>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid xl:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-3">
                    <!-- Search and Filter Bar -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                        <form method="GET" action="{{ route('publications.index') }}" class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search publications by title or content..." class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Search
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Publications Grid -->
                    @if($publications->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                            @foreach($publications as $publication)
                                <div class="group">
                                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-2xl border border-gray-100">
                                        <!-- Featured Image -->
                                        <div class="relative overflow-hidden h-48 bg-gradient-to-br from-primary/10 to-secondary/10">
                                            @if($publication->feature_image_url)
                                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full">
                                                    <svg class="w-16 h-16 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <!-- Date Badge -->
                                            <div class="absolute top-3 right-3">
                                                <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-gray-700">
                                                    {{ $publication->created_at->format('M d, Y') }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="p-6">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-300">
                                                {{ $publication->title }}
                                            </h3>

                                            @if($publication->excerpt)
                                                <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                                    {{ $publication->excerpt }}
                                                </p>
                                            @endif

                                            <!-- Metadata -->
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center gap-4">
                                                    @if($publication->faqsCount() > 0)
                                                        <span class="flex items-center gap-1 text-sm text-gray-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ $publication->faqsCount() }} FAQs
                                                        </span>
                                                    @endif
                                                    @if($publication->tableOfContentsCount() > 0)
                                                        <span class="flex items-center gap-1 text-sm text-gray-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                                            </svg>
                                                            {{ $publication->tableOfContentsCount() }} Sections
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <a href="{{ route('publication.show', $publication->slug) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white text-sm font-semibold rounded-xl transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                                <span>Read More</span>
                                                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                </svg>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center">
                            {{ $publications->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">No Publications Found</h3>
                            <p class="text-gray-600 mb-6">
                                @if(request('search'))
                                    No publications match your search criteria. Try adjusting your search terms.
                                @else
                                    No publications are available at the moment. Please check back later.
                                @endif
                            </p>
                            @if(request('search'))
                                <a href="{{ route('publications.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition-colors">
                                    Clear Search
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        <!-- Featured Publications -->
                        @if($featuredPublications->count() > 0)
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 text-primary mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    Featured Publications
                                </h3>
                                <div class="space-y-4">
                                    @foreach($featuredPublications as $featured)
                                        <a href="{{ route('publication.show', $featured->slug) }}" class="block group">
                                            <div class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                                <div class="flex-shrink-0">
                                                    @if($featured->feature_image_url)
                                                        <img src="{{ $featured->feature_image_url }}" alt="{{ $featured->title }}" class="w-16 h-16 object-cover rounded-lg">
                                                    @else
                                                        <div class="w-16 h-16 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                                        {{ $featured->title }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ $featured->created_at->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Call to Action -->
                        <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-4">Need Legal Assistance?</h3>
                            <p class="text-primary/90 mb-6">
                                Get professional legal advice from our experienced team of lawyers.
                            </p>
                            <a href="{{ url('/contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary font-semibold rounded-xl hover:bg-gray-100 transition-colors">
                                Contact Us Today
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
