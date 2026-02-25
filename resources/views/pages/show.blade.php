@extends('layouts.app')

@section('head')
    <x-meta-tags 
        :title="$page->metatitle ?: $page->title"
        :description="$page->metadescription ?: $page->excerpt" 
        :keywords="$page->metakeywords"
        :image="$page->feature_image_url"
        :customSchema="$page->json_ld_schema ? $page->json_ld_schema_formatted : null"
        :post="$page"
    />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-primary to-slate-900 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: 
                radial-gradient(circle at 2px 2px, white 2px, transparent 0);
                background-size: 40px 40px;">
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-secondary/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-20 w-32 h-32 bg-primary/10 rounded-full blur-2xl animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-secondary/15 rounded-full blur-lg animate-pulse"
            style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Breadcrumb -->
            <nav class="mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-primary/80">
                    <li>
                        <a href="{{ url('/') }}" class="hover:text-white transition-colors duration-300 group">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-white font-medium">{{ $page->title }}</span>
                    </li>
                </ol>
            </nav>

            <div class="max-w-4xl">
                <!-- Title -->
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight bg-gradient-to-r from-white to-secondary bg-clip-text text-transparent">
                    {{ $page->title }}
                </h1>
                
                @if($page->excerpt)
                    <!-- Description -->
                    <p class="text-xl text-primary/90 mb-8 leading-relaxed max-w-3xl">
                        {{ $page->excerpt }}
                    </p>
                @endif

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-6 text-primary/80">
                    <span class="flex items-center gap-2">
                        <div class="w-12 h-12 bg-gradient-to-r from-secondary/20 to-primary/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-lg font-semibold text-white">{{ $page->type_name }}</div>
                            <div class="text-sm">Page Type</div>
                        </div>
                    </span>
                    
                    <span class="flex items-center gap-2">
                        <div class="w-12 h-12 bg-gradient-to-r from-secondary/20 to-primary/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-lg font-semibold text-white">{{ $page->created_at->format('M d, Y') }}</div>
                            <div class="text-sm">Published</div>
                        </div>
                    </span>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden rotate-180">
            <svg class="relative block w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="fill-white"></path>
            </svg>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid xl:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-3">
                    {{-- Featured Image --}}
                    @if($page->feature_image_url)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent rounded-3xl"></div>
                                <img src="{{ $page->feature_image_url }}" alt="{{ $page->feature_image_alt ?: $page->title }}"
                                    class="w-full h-96 lg:h-[500px] object-cover rounded-3xl shadow-2xl transform transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Page Content --}}
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                        @if($page->description)
                            <div class="prose prose-lg max-w-none">
                                <div class="text-gray-700 leading-relaxed">
                                    {!! $page->description !!}
                                </div>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Content Coming Soon</h3>
                                <p class="text-gray-600">The content for this page is being prepared and will be available soon.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Call to Action --}}
                    <div class="bg-gradient-to-r from-slate-900 to-primary rounded-3xl shadow-2xl p-8 lg:p-12 text-white">
                        <div class="text-center max-w-2xl mx-auto">
                            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold mb-4">Need More Information?</h3>
                            <p class="text-xl text-primary/90 mb-8 leading-relaxed">
                                Have questions about this page or need specific assistance? Our experienced team is here to help.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ url('/contact') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl transform transition-all duration-300 hover:bg-gray-100 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-xl">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Get In Touch
                                </a>
                                <a href="{{ url('/') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Back to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        {{-- Page Information --}}
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-6">Page Information</h4>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Type</span>
                                    <span class="font-medium">{{ $page->type_name }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Published</span>
                                    <span class="font-medium">{{ $page->created_at->format('M d, Y') }}</span>
                                </div>
                                
                                @if($page->updated_at->gt($page->created_at))
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Updated</span>
                                        <span class="font-medium">{{ $page->updated_at->format('M d, Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Share Card --}}
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Share This Page</h4>
                            <div class="grid grid-cols-3 gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="bg-blue-600 text-white p-3 rounded-xl text-center hover:bg-blue-700 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($page->title) }}"
                                    target="_blank"
                                    class="bg-blue-400 text-white p-3 rounded-xl text-center hover:bg-blue-500 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="bg-blue-800 text-white p-3 rounded-xl text-center hover:bg-blue-900 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .prose p {
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose h2 {
            font-size: 1.875rem;
        }

        .prose h3 {
            font-size: 1.5rem;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }

        .prose li {
            margin-bottom: 0.5rem;
        }

        .prose a {
            color: #3b82f6;
            text-decoration: underline;
        }

        .prose a:hover {
            color: #1d4ed8;
        }
    </style>
@endpush
