@extends('layouts.app')

@section('meta_tags')
    <x-detail-meta-tags :post="$helpDesk" />
@endsection

@section('head')
    <style>


        /* FAQ Custom Transitions */
        .faq-answer {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-answer ol {
            list-style: disc;
        }

        .faq-answer ul {
            list-style: disc;
        }

        .faq-item.active {
            border-color: rgba(15, 140, 202, 0.2);
            box-shadow: 0 25px 50px -12px rgba(15, 140, 202, 0.1);
        }

        .family-helpdesk-table {
            width: 100%;
            border-collapse: collapse;
            margin: 40px 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .family-helpdesk-table thead {
            background-color: #1e3a8a;
            /* Deep blue */
            color: #ffffff;
        }

        .family-helpdesk-table thead th {
            padding: 16px;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
        }

        .family-helpdesk-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.3s ease;
        }

        .family-helpdesk-table tbody tr:hover {
            background-color: #f3f4f6;
        }

        .family-helpdesk-table tbody td {
            padding: 18px 16px;
            font-size: 15px;
            color: #374151;
            vertical-align: top;
            line-height: 1.6;
        }

        .family-helpdesk-table tbody tr:last-child {
            border-bottom: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .family-helpdesk-table thead {
                display: none;
            }

            .family-helpdesk-table,
            .family-helpdesk-table tbody,
            .family-helpdesk-table tr,
            .family-helpdesk-table td {
                display: block;
                width: 100%;
            }

            .family-helpdesk-table tr {
                margin-bottom: 20px;
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                padding: 15px;
            }

            .family-helpdesk-table td {
                padding: 10px 0;
                border: none;
            }

            .family-helpdesk-table td:first-child {
                font-weight: 600;
                color: #1e3a8a;
                margin-bottom: 6px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner :title="$helpDesk->title" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Help Desk', 'url' => route('help-desk.index')],
        ['label' => $helpDesk->title],
    ]" />

    {{-- Main Content Section --}}
    <section id="content-wrapper" class="lg:py-2 py-0 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">

        <div class="container mx-auto px-4 relative z-10 fullscreen-layout">
            @if ($helpDesk->layout === 'fullscreen')
                <!-- Fullscreen Layout -->
                <div class="max-w-7xl mx-auto">
                    <!-- Help Desk Content Card -->
                    <div class="bg-white lg:px-8 px-2 py-8 mb-0">
                        <h1 class="text-4xl font-bold text-primary leading-tight mb-8">
                            {{ $helpDesk->title }}</h1>
                        
                        @if ($helpDesk->feature_image_url)
                            <div class="mb-12 rounded-xl overflow-hidden shadow-sm">
                                <img src="{{ $helpDesk->feature_image_url }}" alt="{{ $helpDesk->feature_image_alt ?: $helpDesk->title }}"
                                    class="w-full h-[50vh] object-cover">
                            </div>
                        @endif

                        <div class="text-gray-800">
                            @if (view()->exists('help-desk.' . $helpDesk->slug))
                                @include('help-desk.' . $helpDesk->slug)
                            @else
                                <div class="prose prose-lg max-w-none">
                                    {!! $helpDesk->content ?: $helpDesk->description !!}
                                </div>
                            @endif
                        </div>

                        <!-- Left-Right Content Sections -->
                        @if ($leftRightContents && $leftRightContents->count() > 0)
                            <div class="mt-16 space-y-20">
                                @foreach ($leftRightContents as $index => $content)
                                    <section>
                                        <div class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-12">
                                            <!-- Image -->
                                            <div class="w-full lg:w-1/2">
                                                @if ($content->image)
                                                    <img src="{{ asset('storage/' . $content->image) }}"
                                                        alt="{{ $content->title }}"
                                                        class="w-full h-80 object-cover rounded-lg shadow-sm">
                                                @else
                                                    <div class="w-full h-80 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100">
                                                        <i class="fas fa-image text-gray-200 text-4xl"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="w-full lg:w-1/2">
                                                <h2 class="text-2xl font-bold mb-4 text-primary">
                                                    {{ $content->title }}
                                                </h2>
                                                @if ($content->description)
                                                    <div class="text-gray-700 leading-relaxed prose prose-sm max-w-none">
                                                        {!! $content->description !!}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Bottom Description -->
                    @if ($helpDesk->bottom_description)
                        <div class="bg-white lg:px-8 px-2 py-8 border-t border-gray-50">
                            <div class="prose prose-lg max-w-none text-gray-700">
                                {!! $helpDesk->bottom_description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Consultation Banner -->
                    <div class="my-16 bg-primary py-16 px-8 rounded-2xl text-white text-center shadow-lg">
                        <div class="max-w-4xl mx-auto">
                            <span class="text-accent font-bold uppercase tracking-widest text-sm mb-4 block">Professional Legal Support</span>
                            <h2 class="text-3xl md:text-5xl font-bold mb-10 leading-tight">Consult with Lawin and Partners Experts</h2>

                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="tel:+9779841933745"
                                    class="bg-white text-primary px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all flex items-center gap-3">
                                    <i class="fas fa-phone-alt"></i> CALL NOW
                                </a>
                                <a href="https://wa.me/9779841933745" target="_blank"
                                    class="bg-[#25D366] text-white px-8 py-4 rounded-lg font-bold hover:opacity-90 transition-all flex items-center gap-3">
                                    <i class="fab fa-whatsapp"></i> WHATSAPP
                                </a>
                                <a href="mailto:info@lawinpartners.com"
                                    class="bg-transparent border-2 border-white/30 text-white px-8 py-4 rounded-lg font-bold hover:bg-white/10 transition-all flex items-center gap-3">
                                    <i class="fas fa-envelope"></i> EMAIL US
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- FAQ Section -->
                    @if ($faqs && $faqs->count() > 0)
                        <div class="mb-20">
                            <h2 class="text-3xl font-bold text-primary mb-10 text-center">Frequently Asked Questions</h2>
                            <div class="grid grid-cols-1 {{ $helpDesk->layout === 'fullscreen' ? 'lg:grid-cols-2' : '' }} gap-6">
                                @foreach ($faqs as $faq)
                                    <div class="faq-item border border-gray-200 rounded-xl overflow-hidden bg-white hover:border-primary transition-colors">
                                        <button class="faq-question w-full text-left px-6 py-5 flex justify-between items-center gap-4 outline-none">
                                            <span class="text-lg font-bold text-gray-900">{{ $faq->question }}</span>
                                            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300 group-[.active]:rotate-180"></i>
                                        </button>
                                        <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-300 ease-in-out bg-gray-50">
                                            <div class="px-6 py-6 border-t border-gray-100">
                                                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <!-- Social Share -->
                    <div class="bg-white border-gray-100 px-8 py-4 mb-4">
                        <h4 class="text-xl font-bold text-primary mb-6">
                            Share This Page
                        </h4>
                        <div class="flex justify-start gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($helpDesk->title) }}"
                                target="_blank"
                                class="w-12 h-12 bg-sky-500 hover:bg-sky-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="w-12 h-12 bg-blue-800 hover:bg-blue-900 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($helpDesk->title . ' - ' . request()->url()) }}"
                                target="_blank"
                                class="w-12 h-12 bg-green-500 hover:bg-green-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    {{-- Contact Section --}}
                    <x-contact-section :contactInfo="[
                        'address' => 'Fishing Harbour - Jumeira St - Umm Suqeim - Umm Suqeim 2 - Dubai',
                        'phone' => '+9779841933745',
                        'email' => 'info@lawinpartners.com',
                        'workingHours' => [
                            'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
                            'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
                        ],
                    ]" :showSocialLinks="true" />
                    <!-- More Help Desk Posts Section -->
                    @if ($relatedHelpDeskPosts->count() > 0)
                        <div class="mb-12">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">More from Help Desk</h2>
                                <a href="{{ route('help-desk.index') }}"
                                    class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-semibold">
                                    View All
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach ($relatedHelpDeskPosts as $relatedPost)
                                    <div
                                        class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                        @if ($relatedPost->feature_image_url)
                                            <img src="{{ $relatedPost->feature_image_url }}"
                                                alt="{{ $relatedPost->feature_image_alt ?: $relatedPost->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div
                                                class="w-full h-48 bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                                                <i class="fas fa-info-circle text-white text-3xl"></i>
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                                <a href="{{ route('help-desk.show', $relatedPost->slug) }}"
                                                    class="hover:text-primary transition-colors">
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm line-clamp-3">
                                                {{ Str::limit(strip_tags($relatedPost->excerpt ?? $relatedPost->description), 100) }}
                                            </p>
                                            <a href="{{ route('help-desk.show', $relatedPost->slug) }}"
                                                class="mt-4 inline-flex items-center gap-1 text-primary hover:underline text-sm font-semibold">
                                                Learn More
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- With Sidebar Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 py-12">
                    <!-- Main Content - 70% -->
                    <div class="lg:col-span-2">
                        <!-- Content Card -->
                        <div class="bg-white mb-12">
                            <div class="mb-10">
                                @if ($helpDesk->feature_image_url)
                                    <div class="mb-8 rounded-xl overflow-hidden shadow-sm">
                                        <img src="{{ $helpDesk->feature_image_url }}" alt="{{ $helpDesk->feature_image_alt ?: $helpDesk->title }}"
                                            class="w-full h-96 object-cover">
                                    </div>
                                @endif
                                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                    {{ $helpDesk->title }}</h1>
                                @if ($helpDesk->excerpt)
                                    <p class="text-xl text-gray-600 leading-relaxed border-l-4 border-primary pl-6 py-2 italic">{{ $helpDesk->excerpt }}</p>
                                @endif
                            </div>

                            <div class="text-gray-800 leading-relaxed">
                                @if (view()->exists('help-desk.' . $helpDesk->slug))
                                    @include('help-desk.' . $helpDesk->slug)
                                @else
                                    <div class="prose prose-lg max-w-none text-gray-700">
                                        {!! $helpDesk->content ?: $helpDesk->description !!}
                                    </div>
                                @endif
                            </div>
                            <!-- Left-Right Content Sections -->
                            @if ($leftRightContents && $leftRightContents->count() > 0)
                                <div class="mt-16 space-y-16">
                                    @foreach ($leftRightContents as $index => $content)
                                        <section>
                                            <div class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-10">
                                                <!-- Image -->
                                                <div class="w-full lg:w-1/2">
                                                    @if ($content->image)
                                                        <img src="{{ asset('storage/' . $content->image) }}"
                                                            alt="{{ $content->title }}"
                                                            class="w-full h-64 md:h-80 object-cover rounded-lg shadow-sm">
                                                    @else
                                                        <div class="w-full h-64 md:h-80 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100">
                                                            <i class="fas fa-image text-gray-200 text-4xl"></i>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Content -->
                                                <div class="w-full lg:w-1/2">
                                                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                                                        {{ $content->title }}
                                                    </h2>
                                                    @if ($content->description)
                                                        <div class="text-gray-700 leading-relaxed prose prose-sm max-w-none">
                                                            {!! $content->description !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </section>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Bottom Description -->
                        @if ($helpDesk->bottom_description)
                            <div class="bg-white border-t border-gray-100 pt-10 mb-12">
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    {!! $helpDesk->bottom_description !!}
                                </div>
                            </div>
                        @endif

                        <!-- Social Share -->
                        <div class="py-10 border-t border-gray-100">
                            <h4 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <i class="fas fa-share-alt text-primary"></i> Share This Page
                            </h4>
                            <div class="flex flex-wrap gap-4">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="w-10 h-10 bg-[#1877F2] hover:opacity-90 rounded-lg flex items-center justify-center text-white transition-all shadow-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($helpDesk->title) }}"
                                    target="_blank"
                                    class="w-10 h-10 bg-[#1DA1F2] hover:opacity-90 rounded-lg flex items-center justify-center text-white transition-all shadow-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="w-10 h-10 bg-[#0A66C2] hover:opacity-90 rounded-lg flex items-center justify-center text-white transition-all shadow-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($helpDesk->title . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="w-10 h-10 bg-[#25D366] hover:opacity-90 rounded-lg flex items-center justify-center text-white transition-all shadow-sm">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar - 30% -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-10">
                            <!-- More Help Desk Posts -->
                            <div class="border border-gray-100 rounded-xl p-6 bg-white shadow-sm">
                                <h4 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-50 flex items-center gap-3">
                                    <i class="fas fa-info-circle text-primary"></i> Help Desk
                                </h4>
                                <div class="space-y-6">
                                    @if ($relatedHelpDeskPosts->count() > 0)
                                        @foreach ($relatedHelpDeskPosts as $relatedPost)
                                            <div class="group">
                                                <h6 class="font-bold text-gray-900 text-sm leading-snug group-hover:text-primary transition-colors mb-2">
                                                    <a href="{{ route('help-desk.show', $relatedPost->slug) }}">
                                                        {{ $relatedPost->title }}
                                                    </a>
                                                </h6>
                                                <p class="text-gray-500 text-xs line-clamp-2">
                                                    {{ Str::limit($relatedPost->excerpt ?? strip_tags($relatedPost->description), 80) }}
                                                </p>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 italic text-center py-4">No other items available</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Form -->
                            <div class="border border-gray-100 rounded-xl p-8 bg-gray-50">
                                <h4 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                    <i class="fas fa-envelope text-primary"></i> Quick Inquiry
                                </h4>
                                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <input type="text" name="fullname" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary text-sm"
                                            placeholder="Full Name *">
                                    </div>
                                    <div>
                                        <input type="email" name="email" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary text-sm"
                                            placeholder="Email Address *">
                                    </div>
                                    <div>
                                        <textarea name="message" rows="4" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary text-sm resize-none"
                                            placeholder="Your Message *"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-primary text-white px-6 py-3 rounded-lg font-bold hover:opacity-90 transition-all shadow-md">
                                        Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                            <!-- Back to Help Desk -->
                            <div class="pt-8 text-center">
                                <a href="{{ route('help-desk.index') }}"
                                    class="inline-flex items-center gap-3 px-8 py-3 border border-primary text-primary hover:bg-primary hover:text-white rounded-lg font-bold transition-all">
                                    <i class="fas fa-arrow-left"></i>
                                    View All Help Desk
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @if ($helpDesk->layout !== 'fullscreen')
        {{-- Contact Section --}}
        <x-contact-section :contactInfo="[
            'address' => 'Fishing Harbour - Jumeira St - Umm Suqeim - Umm Suqeim 2 - Dubai',
            'phone' => '+9779841933745',
            'email' => 'info@lawinpartners.com',
            'workingHours' => [
                'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
                'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
            ],
        ]" :showSocialLinks="true" />
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');

                question.addEventListener('click', function() {
                    const isActive = item.classList.contains('active');

                    // Close all FAQs first
                    faqItems.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        otherAnswer.style.maxHeight = null;
                        otherAnswer.style.opacity = '0';
                    });

                    // If the clicked FAQ wasn't active, open it
                    if (!isActive) {
                        item.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + "px";
                        answer.style.opacity = '1';
                    }
                });
            });
        });
    </script>
@endpush
