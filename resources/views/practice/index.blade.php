@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner
        title=""
        subtitle="Discover our comprehensive legal practice areas and specialized expertise that provide exceptional legal services across various areas of law"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Practice Areas']
        ]"
    />

      <x-page-section-title title="<span>Practice Areas</span>" />

    {{-- H1 for SEO --}}
    <section class="py-8 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 text-center">
                Practice Areas
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto text-center">
                Discover our comprehensive legal practice areas and specialized expertise.
            </p>
        </div>
    </section>

    <div class="page-wrapper">

    {{-- Main Practices Section --}}
    <x-practice-section :practices="$practices" :showViewAll="false"
        sectionTitle="All Practice <span class='text-primary'>Areas</span>" sectionSubtitle="Complete Practice Portfolio"
        sectionDescription="Discover our full range of professional legal practice areas designed to address your unique legal challenges and requirements." />
        
    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%), linear-gradient(-45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%); background-size: 20px 20px;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <p class="text-base font-semibold text-primary mb-3">Get Expert Help</p>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Need Legal <span class="text-primary">Assistance</span>?
                </h2>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed max-w-2xl mx-auto">
                    Contact our experienced team to discuss your legal needs and find the right practice area for your situation.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/contact') }}" 
                       class="inline-flex items-center px-8 py-4 bg-primary text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-primary/90 hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-primary focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Get Consultation
                    </a>
                    <a href="{{ url('/contact') }}" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-white/10 hover:border-white hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

