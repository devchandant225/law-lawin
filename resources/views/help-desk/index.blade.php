@extends('layouts.app')

@section('title', 'Legal Help Desk - Lawin and Partners')

@section('meta_tags')
    <x-meta-tags title="Legal Help Desk - Lawin and Partners" 
                 description="Access our comprehensive legal help desk for guidance on court marriage, divorce, criminal law, and foreign investment in Nepal." 
                 keywords="legal help desk, nepal law, court marriage help, divorce assistance, criminal law guidance" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Legal Help Desk" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Help Desk'],
    ]" />

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    How Can We Assist You?
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed">
                    Our Legal Help Desk provides rapid-response guidance and comprehensive resources for various legal matters in Nepal. Select a category below to get started.
                </p>
            </div>

            <!-- Help Desk Categories List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach($posts as $post)
                    <div class="group border-b border-gray-100 pb-12 transition-all">
                        <div class="flex flex-col md:flex-row gap-8">
                            {{-- Feature Image --}}
                            <div class="w-full md:w-1/3 aspect-[4/3] overflow-hidden rounded-lg shadow-sm">
                                @if($post->feature_image_url)
                                    <img src="{{ $post->feature_image_url }}" alt="{{ $post->feature_image_alt ?: $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-50 flex items-center justify-center border border-gray-100">
                                        <i class="fas fa-info-circle text-gray-200 text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-2/3 flex flex-col justify-center">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs font-bold text-accent uppercase tracking-widest">Legal Guidance</span>
                                </div>

                                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors">
                                    <a href="{{ route('help-desk.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>

                                <p class="text-gray-600 mb-6 line-clamp-2 leading-relaxed">
                                    {{ $post->excerpt ?: Str::limit(strip_tags($post->description), 150) }}
                                </p>

                                <div>
                                    <a href="{{ route('help-desk.show', $post->slug) }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                                        ACCESS HELP DESK <i class="fas fa-chevron-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- Urgent Assistance Banner --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Need Urgent Legal Assistance?</h2>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">Our experts are available 24/7 to provide immediate support for your legal emergencies.</p>
                
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="tel:+9779841933745" class="bg-primary text-white px-10 py-4 rounded-lg font-bold hover:opacity-90 transition-all shadow-md flex items-center gap-3">
                        <i class="fas fa-phone-alt"></i> CALL 24/7
                    </a>
                    <a href="/contact" class="bg-white text-primary border-2 border-primary px-10 py-4 rounded-lg font-bold hover:bg-primary hover:text-white transition-all flex items-center gap-3">
                        CONTACT US
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
