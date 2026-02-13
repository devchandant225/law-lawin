@extends('layouts.app')

@section('head')
    <x-detail-meta-tags :post="$service" />
    <style>
        #content-wrapper .fullscreen-layout p {
            margin-bottom: 6px !important;
            margin-left: 12px !important;
        }

        #content-wrapper .fullscreen-layout h2 {
            margin-top: 8px !important;
            margin-bottom: 0px !important;
            font-size: 22px !important;
        }

        #content-wrapper .fullscreen-layout h3 {
            margin-bottom: 0px !important;
            font-size: 500 !important;
            font-size: 18px !important;
        }

        #content-wrapper .fullscreen-layout ol {
            padding-left: 16px !important;
            list-style-type: disc;
            margin-left: 16px;
        }

        #content-wrapper .fullscreen-layout ul {
            padding-left: 16px !important;
            list-style-type: disc;
            margin-left: 16px;
        }

        @media and screen (max-width: 768px) {
            #content-wrapper .fullscreen-layout p {
                margin-bottom: 6px !important;
            }

            #content-wrapper .fullscreen-layout h2 {
                margin-bottom: 0px !important;
                font-size: 16px !important;
                color: #108fcc !important;
            }

            #content-wrapper .fullscreen-layout h3 {
                margin-bottom: 0px !important;
                font-size: 500 !important;
                font-size: 12px !important;
                color: #108fcc !important;
            }

            #content-wrapper .fullscreen-layout ol {
                padding-left: 16px !important;
                list-style-type: disc;
            }

            #content-wrapper .fullscreen-layout ul {
                padding-left: 16px !important;
                list-style-type: disc;
            }
        }

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
    </style>
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner :title="$service->title" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Services', 'url' => route('services.index')],
        ['label' => $service->title],
    ]" />

    {{-- Main Content Section --}}
    <section id="content-wrapper" class="lg:py-2 py-0 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">

        <div class="container mx-auto px-4 relative z-10 fullscreen-layout">
            @if ($service->layout === 'fullscreen')
                <!-- Fullscreen Layout -->
                <div class="max-w-7xl mx-auto">
                    <!-- Service Content Card -->
                    <div class="bg-white rounded-2xl lg:px-8 px-2 py-0 mb-0">
                        <h2 class="text-3xl font-bold text-[#0f8cca] leading-tight ml-[8px] ">
                            {{ $service->title }}</h2>
                        <div class="mt-3">
                            @if ($service->feature_image_url)
                                <div class="mb-6 rounded-2xl overflow-hidden group">
                                    <img src="{{ $service->feature_image_url }}" alt="{{ $service->title }}"
                                        class="w-full h-[60vh] object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif

                        </div>

                        <div class="text-justify">
                            {!! $service->content ?: $service->description !!}
                        </div>

                        <!-- Left-Right Content Sections -->
                        @if ($leftRightContents && $leftRightContents->count() > 0)
                            @foreach ($leftRightContents as $index => $content)
                                <section class="mb-12">
                                    <div
                                        class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-8">
                                        <!-- Image -->
                                        <div class="w-full lg:w-1/2">
                                            @if ($content->image)
                                                <img src="{{ asset('storage/' . $content->image) }}"
                                                    alt="{{ $content->title }}"
                                                    class="w-full h-64 md:h-80 object-contain rounded-xl">
                                            @else
                                                <div
                                                    class="w-full h-64 md:h-80 bg-gray-700 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="w-full lg:w-1/2">
                                            <h2 class="text-2xl font-semibold mb-4 text-[#0f8cca] text-center">
                                                {{ $content->title }}
                                            </h2>
                                            @if ($content->description)
                                                <div class="text-justify">
                                                    {!! $content->description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        @endif
                    </div>

                    <!-- Bottom Description -->
                    @if ($service->bottom_description)
                        <div class="bg-white rounded-2xl lg:px-8 px-2 py-0 mb-8">
                            <div class="text-justify">
                                {!! $service->bottom_description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Consultation Banner -->
                    <div
                        class="mb-10 bg-gradient-to-r from-accent to-secondary rounded-[2rem] px-6 py-12 text-white relative overflow-hidden shadow-xl group">
                        <!-- Background patterns -->
                        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <defs>
                                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5" />
                                    </pattern>
                                </defs>
                                <rect width="100" height="100" fill="url(#grid)" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div
                                class="inline-flex items-center gap-2 bg-white/10 border border-white/20 px-6 py-2 rounded-full text-xl font-bold uppercase tracking-widest mb-6">
                                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                Contact our experts
                            </div>
                            <div class="text-4xl md:text-6xl font-black mb-8 leading-tight tracking-tight">
                                Consult Lawin and Partners</div>

                            <div class="flex flex-wrap justify-center gap-4 w-full mt-4">
                                <a href="tel:+9779841933745"
                                    class="whitespace-nowrap bg-white text-accent px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:-translate-y-1 active:scale-95">
                                    <i class="fas fa-phone-alt"></i> CALL NOW
                                </a>
                                <a href="https://wa.me/9779841933745" target="_blank"
                                    class="whitespace-nowrap bg-[#25D366] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#128C7E] transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:-translate-y-1 active:scale-95">
                                    <i class="fab fa-whatsapp"></i> WHATSAPP
                                </a>
                                <a href="viber://chat?number=%2B9779841933745" target="_blank"
                                    class="whitespace-nowrap bg-[#7360f2] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#5949d6] transition-all duration-300 flex items-center justify-center gap-3 shadow-lg hover:-translate-y-1 active:scale-95">
                                    <i class="fab fa-viber"></i> VIBER
                                </a>
                                <a href="mailto:info@lawinpartners.com"
                                    class="whitespace-nowrap bg-accent border-2 border-white/40 text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition-all duration-300 flex items-center justify-center gap-3 backdrop-blur-md shadow-lg hover:border-white active:scale-95">
                                    <i class="fas fa-envelope"></i> EMAIL US
                                </a>
                            </div>
                        </div>
                    </div>


                    <!-- FAQ Section -->
                    @if ($faqs && $faqs->count() > 0)
                        <x-page-section-title title="<span>Frequently Asked Question</span>" />
                        <div
                            class="bg-gradient-to-br from-white to-gray-50/50 rounded-[2.5rem] lg:p-6 lg:mb-16 mb-4 relative overflow-hidden">
                            <!-- Background Decoration -->
                            <div class="absolute -top-24 -right-24 w-64 h-64 bg-accent/5 rounded-full blur-3xl"></div>
                            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>

                            <div
                                class="grid grid-cols-1 {{ $service->layout === 'fullscreen' ? 'lg:grid-cols-2' : '' }} gap-8 relative z-10">
                                @foreach ($faqs as $faq)
                                    <div
                                        class="faq-item group bg-blue-100 border border-blue-100/20 rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:shadow-blue-100/30 hover:scale-[1.02] hover:bg-blue-100/90">
                                        <button
                                            class="faq-question w-full text-left lg:px-8 px-2 py-2 flex justify-between items-center gap-6 outline-none">
                                            <span
                                                class="text-lg font-semibold text-black group-hover:text-black/90 transition-colors duration-300">
                                                {{ $faq->question }}
                                            </span>
                                            <div
                                                class="flex-shrink-0 w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center transition-all duration-500 group-[.active]:bg-white group-hover:bg-white/20">
                                                <svg class="w-6 h-6 text-black group-[.active]:text-accent group-[.active]:rotate-180 transition-all duration-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </button>
                                        <div
                                            class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                                            <div class="px-8 pb-8">
                                                <div
                                                    class="prose prose-lg prose-invert max-w-none text-black leading-relaxed text-justify border-t border-white/10">
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

                            Share This Service
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
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}"
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
                            <a href="https://wa.me/?text={{ urlencode($service->title . ' - ' . request()->url()) }}"
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
                    <!-- More Services Section -->
                    @if ($relatedServices->count() > 0)
                        <div class="mb-12">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">More Services</h2>
                                <a href="{{ route('services.index') }}"
                                    class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-semibold">
                                    View All
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach ($relatedServices as $relatedService)
                                    <div
                                        class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                        @if ($relatedService->feature_image_url)
                                            <img src="{{ $relatedService->feature_image_url }}"
                                                alt="{{ $relatedService->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div
                                                class="w-full h-48 bg-gradient-to-br from-primary to-primary/80 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                                <a href="{{ route('service.show', $relatedService->slug) }}"
                                                    class="hover:text-primary transition-colors">
                                                    {{ $relatedService->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm line-clamp-3">
                                                {{ Str::limit(strip_tags($relatedService->excerpt ?? $relatedService->description), 100) }}
                                            </p>
                                            <a href="{{ route('service.show', $relatedService->slug) }}"
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
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content - 70% -->
                    <div class="lg:col-span-2">
                        <!-- Service Content Card -->
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-8">
                            <div class="mb-8">
                                @if ($service->feature_image_url)
                                    <div class="mb-6 rounded-2xl overflow-hidden group">
                                        <img src="{{ $service->feature_image_url }}" alt="{{ $service->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @endif
                                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                                    {{ $service->title }}</h1>
                                @if ($service->excerpt)
                                    <p class="text-xl text-gray-600 leading-relaxed">{{ $service->excerpt }}</p>
                                @endif
                            </div>

                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                {!! $service->content ?: $service->description !!}
                            </div>
                            <!-- Left-Right Content Sections -->
                            @if ($leftRightContents && $leftRightContents->count() > 0)
                                @foreach ($leftRightContents as $index => $content)
                                    <section class="mb-12">
                                        <div
                                            class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-8">
                                            <!-- Image -->
                                            <div class="w-full lg:w-1/2">
                                                @if ($content->image)
                                                    <img src="{{ asset('storage/' . $content->image) }}"
                                                        alt="{{ $content->title }}"
                                                        class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
                                                @else
                                                    <div
                                                        class="w-full h-64 md:h-80 bg-gray-700 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="w-full lg:w-1/2">
                                                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                                                    {{ $content->title }}
                                                </h2>
                                                @if ($content->description)
                                                    <div
                                                        class="text-gray-700 leading-relaxed text-lg space-y-4 prose prose-lg max-w-none">
                                                        {!! $content->description !!}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            @endif
                        </div>

                        <!-- Bottom Description -->
                        @if ($service->bottom_description)
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    {!! $service->bottom_description !!}
                                </div>
                            </div>
                        @endif

                        <!-- Social Share -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h4 class="flex gap-3 text-xl font-bold text-primary mb-6">
                                Share This Service
                            </h4>
                            <div class="flex justify-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}"
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
                                <a href="https://wa.me/?text={{ urlencode($service->title . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="w-12 h-12 bg-green-500 hover:bg-green-600 rounded-xl flex items-center justify-center text-white hover:scale-110 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar - 30% -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-6">
                            <!-- More Services -->
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                                <h4 class="flex items-center gap-3 text-xl font-bold text-primary mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-primary to-primary rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m7 7 10 0">
                                            </path>
                                        </svg>
                                    </div>
                                    More Services
                                </h4>
                                <div class="space-y-4">
                                    @if ($relatedServices->count() > 0)
                                        @foreach ($relatedServices as $relatedService)
                                            <div
                                                class="group flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 border-l-4 border-transparent hover:border-primary">
                                                <div class="relative flex-shrink-0">
                                                    @if ($relatedService->feature_image_url)
                                                        <img src="{{ $relatedService->feature_image_url }}"
                                                            alt="{{ $relatedService->title }}"
                                                            class="w-16 h-12 rounded-lg object-cover border-2 border-gray-100 group-hover:border-primary/30 transition-colors">
                                                    @else
                                                        <div
                                                            class="w-16 h-12 bg-gradient-to-br from-primary to-primary/80 rounded-lg flex items-center justify-center border-2 border-gray-100 group-hover:border-primary/30 transition-colors">
                                                            <svg class="w-6 h-6 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h6
                                                        class="font-semibold text-gray-900 text-sm leading-tight group-hover:text-primary transition-colors">
                                                        <a href="{{ route('service.show', $relatedService->slug) }}"
                                                            class="block hover:underline">
                                                            {{ $relatedService->title }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-gray-500 text-xs mt-1 leading-tight">
                                                        {{ Str::limit($relatedService->excerpt ?? strip_tags($relatedService->description), 60) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-8 text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                            <p class="text-sm">No related services available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Form -->
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                                <h4 class="flex items-center gap-3 text-xl font-bold text-primary mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-primary to-primary rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    Contact Us
                                </h4>
                                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="fullname" class="block text-sm font-semibold text-gray-700 mb-2">Full
                                            Name
                                            *</label>
                                        <input type="text" id="fullname" name="fullname" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                            placeholder="Enter your full name">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                                            *</label>
                                        <input type="email" id="email" name="email" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                            placeholder="Enter your email">
                                    </div>

                                    <div>
                                        <label for="phone"
                                            class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                                        <input type="tel" id="phone" name="phone"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                            placeholder="Enter your phone number">
                                    </div>

                                    <div>
                                        <label for="subject"
                                            class="block text-sm font-semibold text-gray-700 mb-2">Subject
                                            *</label>
                                        <input type="text" id="subject" name="subject" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                            placeholder="Enter subject" value="Inquiry about {{ $service->title }}">
                                    </div>

                                    <div>
                                        <label for="message"
                                            class="block text-sm font-semibold text-gray-700 mb-2">Message
                                            *</label>
                                        <textarea id="message" name="message" rows="4" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-none"
                                            placeholder="Write your message here..."></textarea>
                                    </div>

                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary hover:opacity-90 text-white px-6 py-4 rounded-xl font-semibold hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Send Message
                                    </button>
                                </form>
                            </div>

                            <!-- Back to Services -->
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                                <a href="{{ route('services.index') }}"
                                    class="inline-flex items-center gap-3 px-6 py-3 border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    View All Services
                                </a>
                            </div>
                        </div>
                    </div>
            @endif
        </div>
    </section>
    @if ($service->layout !== 'fullscreen')
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
