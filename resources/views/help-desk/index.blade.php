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

    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 underline decoration-accent decoration-4 underline-offset-8">
                    How Can We Assist You?
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Our Legal Help Desk provides rapid-response guidance and comprehensive resources for various legal matters in Nepal. Select a category below to get started.
                </p>
            </div>

            <!-- Help Desk Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <div class="group bg-white rounded-[2rem] shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col h-full">
                        {{-- Feature Image --}}
                        <div class="relative h-64 overflow-hidden">
                            @if($post->feature_image_url)
                                <img src="{{ $post->feature_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary to-accent flex items-center justify-center">
                                    <i class="fas fa-info-circle text-white text-5xl opacity-30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-white transition-all duration-500">
                                    @if($post->icon)
                                        <img src="{{ $post->icon_url }}" alt="" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert transition-all">
                                    @else
                                        <i class="fas fa-balance-scale text-sm"></i>
                                    @endif
                                </div>
                                <span class="text-xs font-bold text-accent uppercase tracking-widest">Legal Guidance</span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-600 mb-8 line-clamp-3 leading-relaxed">
                                {{ $post->excerpt ?: Str::limit(strip_tags($post->description), 120) }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-gray-50">
                                <a href="{{ route('help-desk.show', $post->slug) }}" class="inline-flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all duration-300">
                                    ACCESS HELP DESK <i class="fas fa-arrow-right"></i>
                                </a>
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
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-primary rounded-[3rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 text-center md:text-left">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Need Urgent Legal Assistance?</h2>
                        <p class="text-lg opacity-90">Our experts are available 24/7 to provide immediate support for your legal emergencies.</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="tel:+9779841933745" class="bg-white text-primary px-8 py-4 rounded-xl font-bold hover:bg-accent hover:text-white transition-all duration-300 shadow-lg">
                            <i class="fas fa-phone-alt mr-2"></i> CALL 24/7
                        </a>
                        <a href="/contact" class="bg-accent text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-primary transition-all duration-300 shadow-lg border border-white/20">
                            CONTACT US
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
