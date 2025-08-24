@extends('layouts.app')

@section('head')
    <x-meta-tags 
        title="Our Services - Professional Legal Expertise"
        description="Explore our comprehensive range of professional legal services. Expert legal advice and representation across various practice areas."
        keywords="legal services, law firm services, legal expertise, professional legal advice, legal representation"
        type="website"
    />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-[#6f64d3] via-purple-600 to-blue-600 py-20 overflow-hidden">
        <!-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: 
                radial-gradient(circle at 2px 2px, white 2px, transparent 0);
                background-size: 60px 60px;">
            </div>
        </div>

        <!-- Floating Elements --}}
        <div class="absolute top-20 left-20 w-16 h-16 bg-white/20 rounded-full animate-bounce"></div>
        <div class="absolute bottom-20 right-20 w-12 h-12 bg-white/15 rounded-full animate-bounce" style="animation-delay: 1.5s;"></div>
        <div class="absolute top-1/3 right-1/4 w-8 h-8 bg-white/10 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <!-- Breadcrumb --}}
                <nav class="mb-8">
                    <ol class="inline-flex items-center space-x-2 text-purple-200">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-2 text-white">Services</span>
                        </li>
                    </ol>
                </nav>

                <!-- Hero Content --}}
                <div class="mb-4 inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-medium tracking-wide backdrop-blur-sm">
                    Professional Legal Services
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Our <span class="text-yellow-300">Services</span>
                </h1>
                
                <p class="text-xl md:text-2xl mb-8 leading-relaxed text-purple-100">
                    Comprehensive legal expertise tailored to meet your specific needs with dedication and professional excellence
                </p>

                <!-- Stats --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">{{ $serviceStats['active'] }}+</div>
                        <div class="text-purple-100">Active Services</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">100+</div>
                        <div class="text-purple-100">Satisfied Clients</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-3xl font-bold text-yellow-300 mb-2">{{ $serviceStats['recent'] }}+</div>
                        <div class="text-purple-100">Recent Updates</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Shape --}}
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg class="relative block w-full h-20" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </section>

    {{-- Services Section --}}
    <x-service-section 
        :services="$services" 
        :showViewAll="false"
        sectionTitle="All Our <span class='text-[#6f64d3]'>Services</span>"
        sectionSubtitle="Complete Service Portfolio"
        sectionDescription="Discover our full range of professional legal services designed to address your unique legal challenges and requirements."
    />

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
