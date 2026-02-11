@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)

@section('meta')
    <meta name="description" content="{{ $post->meta_description ?: ($post->excerpt ?: Str::limit(strip_tags($post->description), 160)) }}">
    @if($post->meta_keywords)
        <meta name="keywords" content="{{ $post->meta_keywords }}">
    @endif
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?: ($post->excerpt ?: Str::limit(strip_tags($post->description), 160)) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ request()->url() }}">
    @if($post->feature_image)
        <meta property="og:image" content="{{ $post->feature_image_url }}">
    @endif
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta_description ?: ($post->excerpt ?: Str::limit(strip_tags($post->description), 160)) }}">
    @if($post->feature_image)
        <meta name="twitter:image" content="{{ $post->feature_image_url }}">
    @endif
    
    <!-- Article Meta Tags -->
    <meta property="article:published_time" content="{{ $post->created_at->toISOString() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toISOString() }}">
    <meta property="article:section" content="{{ ucfirst($post->type) }}">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm">
        <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-700">Home</a>
        <span class="mx-2 text-gray-500">/</span>
        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-700">Posts</a>
        <span class="mx-2 text-gray-500">/</span>
        <a href="{{ route('posts.by-type', $post->type) }}" class="text-blue-600 hover:text-blue-700">{{ ucfirst($post->type) }}</a>
        <span class="mx-2 text-gray-500">/</span>
        <span class="text-gray-700">{{ Str::limit($post->title, 30) }}</span>
    </nav>

    <div class="max-w-4xl mx-auto">
        <!-- Article Header -->
        <header class="mb-8">
            <!-- Post Type Badge -->
            <div class="mb-4">
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full
                    @if($post->type == 'service') bg-blue-100 text-blue-800
                    @elseif($post->type == 'practice') bg-green-100 text-green-800
                    @elseif($post->type == 'news') bg-red-100 text-red-800
                    @elseif($post->type == 'help_desk') bg-cyan-100 text-cyan-800
                    @else bg-purple-100 text-purple-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $post->type)) }}
                </span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                {{ $post->title }}
            </h1>
            
            <!-- Excerpt -->
            @if($post->excerpt)
                <div class="text-xl text-gray-600 mb-6 leading-relaxed">
                    {{ $post->excerpt }}
                </div>
            @endif
            
            <!-- Meta Information -->
            <div class="flex flex-wrap items-center text-gray-500 text-sm border-b border-gray-200 pb-6">
                <time datetime="{{ $post->created_at->toISOString() }}" class="flex items-center mr-6">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z" />
                    </svg>
                    {{ $post->created_at->format('F d, Y') }}
                </time>
                
                @if($post->created_at != $post->updated_at)
                    <span class="flex items-center mr-6">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21,10.12H14.22L16.96,7.3C14.23,4.6 9.81,4.5 7.08,7.2C4.35,9.91 4.35,14.28 7.08,17C9.81,19.7 14.23,19.7 16.96,17C18.32,15.65 19,14.08 19,12.1H21C21,14.08 20.12,16.65 18.36,18.39C14.85,21.87 9.15,21.87 5.64,18.39C2.14,14.92 2.11,9.28 5.64,5.81C9.15,2.31 14.85,2.31 18.36,5.81L21,3V10.12M12.5,8V12.25L16,14.33L15.28,15.54L11,13V8H12.5Z" />
                        </svg>
                        Updated {{ $post->updated_at->format('M d, Y') }}
                    </span>
                @endif
                
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z" />
                    </svg>
                    {{ ceil(str_word_count(strip_tags($post->description)) / 200) }} min read
                </span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->feature_image)
            <div class="mb-8">
                <img src="{{ $post->feature_image_url }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto rounded-lg shadow-lg">
            </div>
        @endif

        <!-- Article Content -->
        <article class="prose prose-lg max-w-none">
            <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                {!! nl2br(e($post->description)) !!}
            </div>
        </article>

        <!-- Share Buttons -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Share this post:</h3>
                <div class="flex space-x-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </a>
                    
                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                        Twitter
                    </a>
                    
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
            <div class="mt-16 pt-8 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Related {{ ucfirst($post->type) }} Posts</h3>
                <div class="grid grid-cols-1 md:grid-cols-{{ $relatedPosts->count() == 1 ? '1' : ($relatedPosts->count() == 2 ? '2' : '3') }} gap-6">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition duration-300">
                            @if($relatedPost->feature_image)
                                <div class="h-40 overflow-hidden">
                                    <img src="{{ $relatedPost->feature_image_url }}" 
                                         alt="{{ $relatedPost->title }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('posts.show', $relatedPost) }}" class="hover:text-blue-600 transition duration-200">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h4>
                                
                                @if($relatedPost->excerpt)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $relatedPost->excerpt }}</p>
                                @endif
                                
                                <div class="text-xs text-gray-500">
                                    {{ $relatedPost->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back to Posts -->
        <div class="mt-12 text-center">
            <a href="{{ route('posts.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to All Posts
            </a>
        </div>
    </div>
</div>

<!-- Google Schema JSON-LD -->
@if($post->google_schema)
    {!! $post->google_schema_json !!}
@else
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "{{ match($post->type) { 'service' => 'Service', 'practice' => 'Article', 'news' => 'NewsArticle', 'blog' => 'BlogPosting', default => 'Article' } }}",
      "name": "{{ $post->title }}",
      "headline": "{{ $post->title }}",
      "description": "{{ $post->excerpt ?: Str::limit(strip_tags($post->description), 160) }}",
      "url": "{{ request()->url() }}",
      "datePublished": "{{ $post->created_at->toISOString() }}",
      "dateModified": "{{ $post->updated_at->toISOString() }}"
      @if($post->feature_image)
      ,
      "image": {
        "@type": "ImageObject",
        "url": "{{ $post->feature_image_url }}",
        "width": 1200,
        "height": 630
      }
      @endif
    }
    </script>
@endif

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    font-size: 1.125rem;
    line-height: 1.75;
    color: #374151;
}

.prose p {
    margin-bottom: 1.5rem;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
</style>
@endsection
