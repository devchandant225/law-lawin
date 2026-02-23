@extends('layouts.app')

@section('title', 'Posts')

@section('meta')
    <meta name="description" content="Browse our collection of posts including services, practices, news, and blog articles.">
    <meta name="keywords" content="posts, articles, services, news, blog, legal">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Posts</h1>
        <p class="text-gray-600 text-lg">Discover our latest articles, services, news, and insights.</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Posts</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Search by title, content..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="min-w-48">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Filter by Type</label>
                <select id="type" 
                        name="type" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    @foreach($types as $typeOption)
                        <option value="{{ $typeOption }}" {{ request('type') == $typeOption ? 'selected' : '' }}>
                            {{ ucfirst($typeOption) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex gap-2">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Filter
                </button>
                <a href="{{ route('posts.index') }}" 
                   class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($posts as $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Featured Image -->
                    @if($post->feature_image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $post->feature_image_url }}" 
                                 alt="{{ $post->feature_image_alt ?: $post->title }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                            <div class="text-blue-300">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                </svg>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <!-- Post Type Badge -->
                        <div class="mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                @if($post->type == 'service') bg-blue-100 text-blue-800
                                @elseif($post->type == 'practice') bg-green-100 text-green-800
                                @elseif($post->type == 'news') bg-red-100 text-red-800
                                @elseif($post->type == 'help_desk') bg-cyan-100 text-cyan-800
                                @else bg-purple-100 text-purple-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $post->type)) }}
                            </span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 transition duration-200">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <!-- Excerpt -->
                        @if($post->excerpt)
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                        @else
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->description), 150) }}</p>
                        @endif
                        
                        <!-- Meta Information -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <time datetime="{{ $post->created_at->toISOString() }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time>
                            <span>{{ str_word_count(strip_tags($post->description)) }} min read</span>
                        </div>
                        
                        <!-- Read More Button -->
                        <a href="{{ route('posts.show', $post) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition duration-200">
                            Read More 
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Posts Found -->
        <div class="text-center py-16">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No posts found</h3>
            <p class="text-gray-500 mb-8">We couldn't find any posts matching your criteria.</p>
            <a href="{{ route('posts.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                View All Posts
            </a>
        </div>
    @endif
</div>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Posts",
  "description": "Browse our collection of posts including services, practices, news, and blog articles.",
  "url": "{{ request()->url() }}",
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": {{ $posts->count() }},
    "itemListElement": [
      @foreach($posts as $index => $post)
      {
        "@type": "ListItem",
        "position": {{ $index + 1 }},
        "item": {
          "@type": "{{ $post->getSchemaType() }}",
          "name": "{{ $post->title }}",
          "url": "{{ route('posts.show', $post) }}",
          "datePublished": "{{ $post->created_at->toISOString() }}",
          @if($post->feature_image)
          "image": "{{ $post->feature_image_url }}",
          @endif
          "description": "{{ $post->excerpt ?: Str::limit(strip_tags($post->description), 160) }}"
        }
      }{{ !$loop->last ? ',' : '' }}
      @endforeach
    ]
  }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
