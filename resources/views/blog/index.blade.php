@extends('layouts.app')

@section('title', 'Blog - Latest Articles & Insights')

@section('meta')
    <meta name="description" content="Explore our latest blog posts, articles, and insights. Stay updated with expert opinions and industry trends.">
    <meta name="keywords" content="blog, articles, insights, news, updates">
@endsection

@push('styles')
    <style>
        .blog-card {
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-8px);
        }
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
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl font-bold mb-6">Our Blog</h1>
                <p class="text-xl opacity-90 mb-8">Discover insights, stories, and expert opinions from our team</p>
                <div class="w-24 h-1 bg-white mx-auto rounded"></div>
            </div>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl">
                            <!-- Featured Image -->
                            @if($post->feature_image_url)
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->feature_image_url }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-blog text-4xl text-white"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Meta Info -->
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium mr-3">Blog</span>
                                    <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="flex items-center">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ $post->created_at->format('M d, Y') }}
                                    </time>
                                </div>

                                <!-- Title -->
                                <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                                    <a href="/blog/{{ $post->slug }}" class="block">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->description), 120) }}
                                </p>

                                <!-- Read More Button -->
                                <div class="mt-auto">
                                    <a href="/blog/{{ $post->slug }}" 
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors group">
                                        Read More
                                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-blog text-3xl text-gray-400"></i>
                    </div>
                    <h2 class="text-3xl font-semibold text-gray-900 mb-4">No Blog Posts Yet</h2>
                    <p class="text-gray-600 text-lg">Check back soon for our latest articles and insights.</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
