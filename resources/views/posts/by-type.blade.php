@extends('layouts.app')

@section('title', ucfirst($type) . ' Posts')

@section('meta')
    <meta name="description" content="Browse our {{ $type }} posts and articles.">
    <meta name="keywords" content="{{ $type }}, posts, articles, legal">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ ucfirst($type) }} Posts</h1>
        <p class="text-gray-600 text-lg">Browse our {{ $type }}-related content and insights.</p>
    </div>

    <!-- Type Navigation -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('posts.index') }}" 
               class="px-4 py-2 rounded-full border {{ !request()->route('type') ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:border-blue-300' }} transition duration-200">
                All Posts
            </a>
            @foreach($types as $typeOption)
                <a href="{{ route('posts.by-type', $typeOption) }}" 
                   class="px-4 py-2 rounded-full border {{ $type == $typeOption ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:border-blue-300' }} transition duration-200">
                    {{ ucfirst($typeOption) }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('posts.by-type', $type) }}" class="flex gap-4 items-end">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search {{ ucfirst($type) }} Posts</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Search by title, content..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex gap-2">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Search
                </button>
                <a href="{{ route('posts.by-type', $type) }}" 
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
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br 
                            @if($type == 'service') from-blue-50 to-blue-100 
                            @elseif($type == 'practice') from-green-50 to-green-100 
                            @elseif($type == 'news') from-red-50 to-red-100 
                            @else from-purple-50 to-purple-100 @endif 
                            flex items-center justify-center">
                            <div class="
                                @if($type == 'service') text-blue-300 
                                @elseif($type == 'practice') text-green-300 
                                @elseif($type == 'news') text-red-300 
                                @else text-purple-300 @endif">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                    @if($type == 'service')
                                        <path d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z" />
                                    @elseif($type == 'practice')
                                        <path d="M16,6L18.29,8.29L13.41,13.17L9.41,9.17L2,16.59L3.41,18L9.41,12L13.41,16L19.71,9.71L22,12V6H16Z" />
                                    @elseif($type == 'news')
                                        <path d="M20,11H4V8H20M20,15H13V13H20M20,19H13V17H20M11,19H4V13H11M20.33,4.67C20.1,4.44 19.83,4.33 19.5,4.33H4.5C4.17,4.33 3.9,4.44 3.67,4.67C3.44,4.9 3.33,5.17 3.33,5.5V18.5C3.33,18.83 3.44,19.1 3.67,19.33C3.9,19.56 4.17,19.67 4.5,19.67H19.5C19.83,19.67 20.1,19.56 20.33,19.33C20.56,19.1 20.67,18.83 20.67,18.5V5.5C20.67,5.17 20.56,4.9 20.33,4.67Z" />
                                    @else
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                    @endif
                                </svg>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-6">
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
                            <span>{{ ceil(str_word_count(strip_tags($post->description)) / 200) }} min read</span>
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
            <h3 class="text-xl font-medium text-gray-900 mb-2">No {{ $type }} posts found</h3>
            <p class="text-gray-500 mb-8">
                @if(request('search'))
                    We couldn't find any {{ $type }} posts matching "{{ request('search') }}".
                @else
                    We don't have any {{ $type }} posts yet.
                @endif
            </p>
            <div class="flex justify-center gap-4">
                @if(request('search'))
                    <a href="{{ route('posts.by-type', $type) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        View All {{ ucfirst($type) }} Posts
                    </a>
                @endif
                <a href="{{ route('posts.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                    Browse All Posts
                </a>
            </div>
        </div>
    @endif
</div>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ ucfirst($type) }} Posts",
  "description": "Browse our {{ $type }} posts and articles.",
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
