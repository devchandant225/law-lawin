<div class="blog-posts-section py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest Blog Posts</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Stay updated with our latest insights, stories, and expert opinions</p>
        </div>

        @if($posts->count() > 0)
            <!-- Swiper Container -->
            <div class="swiper blog-swiper mb-8">
                <div class="swiper-wrapper">
                    @foreach($posts as $post)
                        <div class="swiper-slide">
                            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full">
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
                                <div class="p-6 flex flex-col h-full">
                                    <!-- Meta Info -->
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium mr-3">Blog</span>
                                        <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="flex items-center">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $post->created_at->format('M d, Y') }}
                                        </time>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                                        <a href="/blog/{{ $post->slug }}" class="block">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    <!-- Excerpt -->
                                    <p class="text-gray-600 mb-4 line-clamp-3 flex-grow">
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
                        </div>
                    @endforeach
                </div>

                <!-- Navigation buttons -->
                <div class="swiper-button-next text-blue-600 after:text-2xl after:font-bold"></div>
                <div class="swiper-button-prev text-blue-600 after:text-2xl after:font-bold"></div>

                <!-- Pagination -->
                <div class="swiper-pagination mt-8"></div>
            </div>

            <!-- View All Button -->
            @if(!$showAll && $posts->count() >= $limit)
                <div class="text-center">
                    <button wire:click="loadMore" 
                            class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-2"></i>
                        Load More Posts
                    </button>
                </div>
            @else
                <div class="text-center">
                    <a href="/blog" 
                       class="inline-flex items-center px-8 py-3 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-lg transition-colors shadow-lg hover:shadow-xl">
                        <i class="fas fa-th-large mr-2"></i>
                        View All Blog Posts
                    </a>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-blog text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Blog Posts Yet</h3>
                <p class="text-gray-600">Check back later for our latest articles and insights.</p>
            </div>
        @endif
    </div>

    @push('styles')
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <!-- Custom CSS for line-clamp support -->
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
            .swiper-button-next, .swiper-button-prev {
                color: #2563eb;
            }
            .swiper-pagination-bullet-active {
                background: #2563eb;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const swiper = new Swiper('.blog-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            });
        </script>
    @endpush
</div>
