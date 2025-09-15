@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)

@section('meta')
    <meta name="description" content="{{ $post->meta_description ?: ($post->excerpt ?: Str::limit(strip_tags($post->description), 160)) }}">
    <meta name="keywords" content="{{ $post->meta_keywords ?: 'blog, article' }}">
    
    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->description), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url('/blog/' . $post->slug) }}">
    @if($post->feature_image_url)
        <meta property="og:image" content="{{ $post->feature_image_url }}">
    @endif
    
    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->description), 160) }}">
    @if($post->feature_image_url)
        <meta name="twitter:image" content="{{ $post->feature_image_url }}">
    @endif

    <!-- Google Schema Markup -->
    <script type="application/ld+json">
        {!! $post->google_schema_json !!}
    </script>
@endsection

@push('styles')
    <style>
        .prose {
            max-width: none;
        }
        .prose img {
            border-radius: 12px;
            margin: 2rem 0;
        }
        .social-share-btn {
            transition: all 0.3s ease;
        }
        .social-share-btn:hover {
            transform: translateY(-2px);
        }
        .related-post-card {
            transition: all 0.3s ease;
        }
        .related-post-card:hover {
            transform: translateY(-4px);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section with Featured Image -->
    <section class="relative bg-gray-900">
        @if($post->feature_image_url)
            <div class="absolute inset-0">
                <img src="{{ $post->feature_image_url }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600"></div>
        @endif
        
        <div class="relative container mx-auto px-4 py-24">
            <div class="max-w-4xl mx-auto text-center text-white">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <ol class="flex justify-center items-center space-x-2 text-sm opacity-90">
                        <li><a href="/" class="hover:text-blue-300 transition-colors">Home</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="/blog" class="hover:text-blue-300 transition-colors">Blog</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="opacity-75">{{ Str::limit($post->title, 30) }}</li>
                    </ol>
                </nav>

                <!-- Meta Info -->
                <div class="flex justify-center items-center space-x-6 mb-6 text-sm opacity-90">
                    <span class="bg-blue-600/80 px-4 py-2 rounded-full font-medium">Blog</span>
                    <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ $post->created_at->format('F d, Y') }}
                    </time>
                    <span class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        {{ ceil(str_word_count(strip_tags($post->description)) / 200) }} min read
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold mb-8 leading-tight">
                    {{ $post->title }}
                </h1>

                @if($post->excerpt)
                    <p class="text-xl opacity-90 max-w-3xl mx-auto">
                        {{ $post->excerpt }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Social Share Buttons -->
                <div class="flex justify-center space-x-4 mb-12">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/blog/' . $post->slug)) }}" 
                       target="_blank" 
                       class="social-share-btn bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 shadow-lg">
                        <i class="fab fa-facebook-f"></i>
                        <span>Share</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/blog/' . $post->slug)) }}&text={{ urlencode($post->title) }}" 
                       target="_blank" 
                       class="social-share-btn bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 shadow-lg">
                        <i class="fab fa-twitter"></i>
                        <span>Tweet</span>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('/blog/' . $post->slug)) }}" 
                       target="_blank" 
                       class="social-share-btn bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg flex items-center space-x-2 shadow-lg">
                        <i class="fab fa-linkedin-in"></i>
                        <span>Share</span>
                    </a>
                    <button onclick="copyToClipboard('{{ url('/blog/' . $post->slug) }}')" 
                            class="social-share-btn bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 shadow-lg">
                        <i class="fas fa-link"></i>
                        <span>Copy</span>
                    </button>
                </div>

                <!-- Article Content -->
                <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
                    <div class="prose prose-lg max-w-none">
                        {!! $post->description !!}
                    </div>
                </div>

                <!-- Tags (if you add tags to your posts) -->
                <div class="mt-8 text-center">
                    <div class="inline-flex items-center space-x-2 text-gray-600">
                        <i class="fas fa-tags"></i>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ ucfirst($post->type) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Related Articles</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-{{ min($relatedPosts->count(), 3) }} gap-8">
                        @foreach($relatedPosts as $relatedPost)
                            <article class="related-post-card bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl">
                                <!-- Featured Image -->
                                @if($relatedPost->feature_image_url)
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $relatedPost->feature_image_url }}" 
                                             alt="{{ $relatedPost->title }}" 
                                             class="w-full h-40 object-cover transition-transform duration-300 hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="h-40 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <i class="fas fa-blog text-2xl text-white"></i>
                                    </div>
                                @endif

                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Meta -->
                                    <div class="text-sm text-gray-500 mb-2">
                                        {{ $relatedPost->created_at->format('M d, Y') }}
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition-colors">
                                        <a href="/blog/{{ $relatedPost->slug }}">
                                            {{ $relatedPost->title }}
                                        </a>
                                    </h3>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $relatedPost->excerpt ?: Str::limit(strip_tags($relatedPost->description), 100) }}
                                    </p>

                                    <!-- Read More -->
                                    <a href="/blog/{{ $relatedPost->slug }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors group">
                                        Read More
                                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Blog -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <a href="/blog" 
               class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blog
            </a>
        </div>
    </section>
</div>

@push('scripts')
<script>
    function copyToClipboard(url) {
        navigator.clipboard.writeText(url).then(function() {
            // Show success message
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i><span>Copied!</span>';
            
            setTimeout(() => {
                button.innerHTML = originalText;
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
        });
    }
</script>
@endpush
@endsection
