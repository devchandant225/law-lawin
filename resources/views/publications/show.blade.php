@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$publication->metatitle ?: $publication->title . ' - Legal Publication'" :description="$publication->metadescription ?: $publication->excerpt" :keywords="$publication->metakeywords" :image="$publication->feature_image_url" type="article" :post="$publication" />
    
    @if($publication->google_schema_json)
        <script type="application/ld+json">{!! $publication->google_schema_json !!}</script>
    @endif
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner 
        :title="$publication->title" 
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Publications', 'url' => route('publications.index')],
            ['label' => $publication->title]
        ]"
    />

    {{-- Main Content Section --}}
    <section class="py-10 bg-white">
        <div class="container mx-auto">
            <div class="grid xl:grid-cols-4 gap-3">
                <!-- Main Content -->
                <div class="xl:col-span-3">
                    {{-- Featured Image --}}
                    @if($publication->feature_image_url)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent rounded-3xl"></div>
                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}"
                                    class="w-full h-96 lg:h-[500px] object-cover rounded-3xl shadow-2xl transform transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Excerpt --}}
                    @if($publication->excerpt)
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-3xl shadow-xl border border-primary/10 p-8 lg:p-12 mb-8">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Publication Summary</h3>
                                    <p class="text-lg text-gray-700 leading-relaxed">{{ $publication->excerpt }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Table of Contents --}}
                    @if($tableOfContents->count() > 0)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                </div>
                                Table of Contents
                            </h3>
                            <div class="space-y-3">
                                @foreach($tableOfContents as $content)
                                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <span class="text-blue-600 font-semibold text-sm">{{ $content->orderlist ?? $loop->iteration }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 mb-1">{{ $content->title }}</h4>
                                            @if($content->content)
                                                <p class="text-gray-600 text-sm line-clamp-2">{{ strip_tags($content->content) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Team Members --}}
                    @if(!empty($teamMembers) && count($teamMembers) > 0)
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl shadow-xl border border-purple-100 p-8 lg:p-12 mb-8">
                            <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                Contributing Team Members
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach($teamMembers as $member)
                                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                        <div class="flex-shrink-0">
                                            @if($member['image_url'])
                                                <img src="{{ $member['image_url'] }}" alt="{{ $member['name'] }}" class="w-16 h-16 rounded-full object-cover">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900 mb-1">{{ $member['name'] }}</h4>
                                            @if($member['designation'])
                                                <p class="text-gray-600 text-sm mb-1">{{ $member['designation'] }}</p>
                                            @endif
                                            <p class="text-purple-600 text-sm font-medium">{{ $member['role'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- FAQs Section --}}
                    @if($faqs->count() > 0)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                Frequently Asked Questions
                            </h3>
                            <div class="space-y-4">
                                @foreach($faqs as $faq)
                                    <div class="border border-gray-200 rounded-2xl overflow-hidden">
                                        <button class="w-full text-left p-6 bg-gray-50 hover:bg-gray-100 transition-colors focus:outline-none focus:bg-gray-100"
                                                onclick="toggleFaq({{ $faq->id }})">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-semibold text-gray-900 pr-4">{{ $faq->question }}</h4>
                                                <svg id="faq-icon-{{ $faq->id }}" class="w-5 h-5 text-gray-500 transform transition-transform"
                                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </button>
                                        <div id="faq-content-{{ $faq->id }}" class="hidden p-6 bg-white border-t border-gray-200">
                                            <div class="prose prose-sm max-w-none text-gray-700">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

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
                                Have questions about this publication or need specific legal guidance? Our experienced team is here to help.
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
                                <a href="{{ route('publications.index') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    More Publications
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        {{-- Publication Info Card --}}
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-6">Publication Details</h4>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Published</span>
                                    <span class="font-medium">{{ $publication->created_at->format('M d, Y') }}</span>
                                </div>
                                @if($publication->updated_at->gt($publication->created_at))
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Updated</span>
                                        <span class="font-medium">{{ $publication->updated_at->format('M d, Y') }}</span>
                                    </div>
                                @endif
                                @if($faqs->count() > 0)
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">FAQs</span>
                                        <span class="font-medium">{{ $faqs->count() }}</span>
                                    </div>
                                @endif
                                @if($tableOfContents->count() > 0)
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Sections</span>
                                        <span class="font-medium">{{ $tableOfContents->count() }}</span>
                                    </div>
                                @endif
                                @if(!empty($teamMembers) && count($teamMembers) > 0)
                                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Contributors</span>
                                        <span class="font-medium">{{ count($teamMembers) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Share Card --}}
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Share This Publication</h4>
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
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($publication->title) }}"
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
                        
                        {{-- Related Publications --}}
                        @if($relatedPublications->count() > 0)
                            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                                <h4 class="text-xl font-bold text-gray-900 mb-6">Related Publications</h4>
                                <div class="space-y-4">
                                    @foreach($relatedPublications->take(3) as $related)
                                        <a href="{{ route('publication.show', $related->slug) }}" class="block group">
                                            <div class="flex gap-4 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                                <div class="flex-shrink-0">
                                                    @if($related->feature_image_url)
                                                        <img src="{{ $related->feature_image_url }}" alt="{{ $related->title }}" class="w-16 h-16 object-cover rounded-lg">
                                                    @else
                                                        <div class="w-16 h-16 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                                                        {{ $related->title }}
                                                    </h5>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ $related->created_at->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                
                                @if($relatedPublications->count() > 3)
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <a href="{{ route('publications.index') }}" class="text-primary hover:text-primary/80 font-medium text-sm">
                                            View All Publications →
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function toggleFaq(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
@endpush

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

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #1f2937;
            font-weight: 700;
        }

        .prose h2 {
            @apply text-2xl mt-8 mb-4;
        }

        .prose h3 {
            @apply text-xl mt-6 mb-3;
        }

        .prose p {
            @apply mb-4 leading-relaxed;
        }

        .prose ul,
        .prose ol {
            @apply mb-4 pl-6;
        }

        .prose li {
            @apply mb-2;
        }

        .prose a {
            @apply text-primary hover:text-primary/80 transition-colors duration-200;
        }
    </style>
@endpush
