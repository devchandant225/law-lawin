@extends('layouts.app')

@section('head')
    <x-meta-tags title="Our Services - Professional Legal Expertise"
        description="Explore our comprehensive range of professional legal services. Expert legal advice and representation across various practice areas."
        keywords="legal services, law firm services, legal expertise, professional legal advice, legal representation"
        type="website" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Our Services"
        subtitle="Comprehensive legal expertise tailored to meet your specific needs with dedication and professional excellence"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Services']]" />
    {{-- Contact Section Title --}}
    <x-page-section-title title="<span>Our Services</span>" />
    {{-- Services Section --}}
    <x-service-section :services="$services" :showViewAll="false"
        sectionTitle="All Our <span class='text-[#6f64d3]'>Services</span>" sectionSubtitle="Complete Service Portfolio"
        sectionDescription="Discover our full range of professional legal services designed to address your unique legal challenges and requirements." />

    {{-- Call to Action Section --}}
    <section class="py-20 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
        <!-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: 
                linear-gradient(45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%),
                linear-gradient(-45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%);
                background-size: 20px 20px;">
                </div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                        Need Legal <span class="text-[#6f64d3]">Assistance</span>?
                    </h2>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Our experienced legal professionals are ready to provide you with expert guidance and representation. Contact us today to discuss your legal needs.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/contact') }}"
                           class="inline-flex items-center px-8 py-4 bg-[#6f64d3] text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-[#5a50a8] hover:shadow-2xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#6f64d3] focus:ring-opacity-30">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Get Consultation
                        </a>
                        <a href="{{ url('/about/introduction') }}"
                           class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-white font-semibold text-lg rounded-full transform transition-all duration-300 hover:bg-white/10 hover:border-white hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-30">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('styles')
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
@endpush
