@extends('layouts.app')

@section('title', 'Legal Publications - ' . config('app.name'))
@section('description', 'Explore our comprehensive collection of legal publications, research papers, and expert insights covering various areas of law.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50">
    {{-- Hero Section --}}
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600/95 to-blue-600/95"></div>
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" fill="none"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="white" stroke-width="1" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>')] opacity-20"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 text-white mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="font-medium">Legal Knowledge Base</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    Legal <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-yellow-100">Publications</span>
                </h1>
                
                <p class="text-xl text-green-50 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Discover our extensive collection of legal publications, research papers, and expert insights 
                    that provide valuable guidance across various areas of law.
                </p>

                {{-- Search Bar --}}
                <div class="max-w-2xl mx-auto mb-12">
                    <form action="{{ route('publications.index') }}" method="GET" class="relative">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Search publications by title, content, or keywords..." 
                                value="{{ request('search') }}"
                                class="w-full pl-12 pr-24 py-4 rounded-2xl border-0 bg-white/90 backdrop-blur-sm shadow-xl text-gray-800 placeholder-gray-500 focus:bg-white focus:ring-4 focus:ring-green-500/30 transition-all"
                            >
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-green-600 to-blue-600 text-white px-6 py-2 rounded-xl font-medium hover:from-green-700 hover:to-blue-700 transition-all hover:scale-105 shadow-lg">
                                Search
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-white mb-2">{{ $totalPublications ?? 0 }}</div>
                        <div class="text-green-100 text-sm">Total Publications</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-white mb-2">{{ $featuredCount ?? 0 }}</div>
                        <div class="text-green-100 text-sm">Featured</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-white mb-2">{{ date('Y') }}</div>
                        <div class="text-green-100 text-sm">Latest Year</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20">
                        <div class="text-3xl font-bold text-white mb-2">Free</div>
                        <div class="text-green-100 text-sm">Access</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Filter and Sort --}}
            <div class="mb-12">
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                    <form action="{{ route('publications.index') }}" method="GET" class="flex flex-wrap items-center gap-4">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        
                        <div class="flex-1 min-w-48">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                            <select name="sort" class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                            </select>
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit" class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-6 py-3 rounded-xl font-medium hover:from-green-700 hover:to-blue-700 transition-all hover:scale-105 shadow-lg">
                                Apply Filters
                            </button>
                            @if(request()->hasAny(['search', 'sort']))
                            <a href="{{ route('publications.index') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-200 transition-all">
                                Clear
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Publications Grid --}}
            @if($publications->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($publications as $publication)
                    <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 hover:-translate-y-1">
                        {{-- Publication Image --}}
                        @if($publication->featured_image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $publication->featured_image) }}" 
                                 alt="{{ $publication->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            @if($publication->is_featured)
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    Featured
                                </span>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="h-48 bg-gradient-to-br from-green-100 to-blue-100 flex items-center justify-center relative">
                            @if($publication->is_featured)
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    Featured
                                </span>
                            </div>
                            @endif
                            <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        @endif

                        {{-- Publication Content --}}
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-2 text-sm text-green-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $publication->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($publication->reading_time)
                                <div class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $publication->reading_time }} min
                                </div>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ $publication->title }}
                            </h2>

                            @if($publication->excerpt)
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                {{ $publication->excerpt }}
                            </p>
                            @endif

                            {{-- Tags --}}
                            @if($publication->tags && count($publication->tags) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($publication->tags, 0, 3) as $tag)
                                <span class="bg-green-100 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">
                                    {{ $tag }}
                                </span>
                                @endforeach
                                @if(count($publication->tags) > 3)
                                <span class="text-gray-500 text-xs">+{{ count($publication->tags) - 3 }} more</span>
                                @endif
                            </div>
                            @endif

                            {{-- Author & Read More --}}
                            <div class="flex items-center justify-between">
                                @if($publication->author)
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ $publication->author }}</span>
                                </div>
                                @endif
                                
                                <a href="{{ route('publication.show', $publication->slug) }}" 
                                   class="inline-flex items-center gap-2 text-green-600 font-medium hover:text-green-700 transition-colors group/link">
                                    <span>Read More</span>
                                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($publications->hasPages())
                <div class="mt-16">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        {{ $publications->links() }}
                    </div>
                </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No Publications Found</h3>
                        <p class="text-gray-600 mb-8">
                            @if(request('search'))
                                No publications match your search criteria. Try adjusting your search terms.
                            @else
                                We're working on adding new publications. Check back soon for the latest legal insights.
                            @endif
                        </p>
                        @if(request('search'))
                        <a href="{{ route('publications.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-blue-600 text-white px-6 py-3 rounded-xl font-medium hover:from-green-700 hover:to-blue-700 transition-all hover:scale-105 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            View All Publications
                        </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Featured Publications Section --}}
    @if(isset($featuredPublications) && $featuredPublications->count() > 0)
    <section class="py-20 bg-gradient-to-r from-green-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 bg-green-100 text-green-700 rounded-full px-4 py-2 text-sm font-medium mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Featured Publications
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Must-Read Legal Publications
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our most impactful and widely-read publications covering essential legal topics
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPublications->take(6) as $publication)
                <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 hover:-translate-y-1">
                    @if($publication->featured_image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $publication->featured_image) }}" 
                             alt="{{ $publication->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                Featured
                            </span>
                        </div>
                    </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2">
                            {{ $publication->title }}
                        </h3>

                        @if($publication->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                            {{ Str::limit($publication->excerpt, 120) }}
                        </p>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                {{ $publication->created_at->format('M d, Y') }}
                            </div>
                            <a href="{{ route('publication.show', $publication->slug) }}" 
                               class="inline-flex items-center gap-1 text-green-600 font-medium hover:text-green-700 transition-colors group/link">
                                <span>Read</span>
                                <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-blue-600"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="none"><defs><pattern id="dots" width="10" height="10" patternUnits="userSpaceOnUse"><circle cx="5" cy="5" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>')] opacity-30"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Stay Updated with Legal Insights
            </h2>
            <p class="text-xl text-green-50 mb-8 leading-relaxed">
                Subscribe to our newsletter to receive the latest publications and legal updates directly in your inbox.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                <a href="{{ url('/contact') }}" class="bg-white text-green-600 px-8 py-4 rounded-xl font-bold hover:bg-green-50 transition-all hover:scale-105 shadow-lg">
                    Subscribe Now
                </a>
                <a href="{{ url('/contact') }}" class="bg-white/10 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-xl font-bold hover:bg-white/20 transition-all hover:scale-105">
                    Contact Us
                </a>
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
    const searchForm = document.querySelector('form[action*="publications"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="search"]');
            if (searchInput && searchInput.value.trim() === '') {
                e.preventDefault();
                window.location.href = '{{ route("publications.index") }}';
            }
        });
    }
});
</script>
@endpush
