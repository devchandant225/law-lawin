@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Our Legal Team - Expert Lawyers & Legal Professionals'" :description="'Meet our experienced team of legal professionals. Expert lawyers, attorneys, and legal consultants ready to handle your legal needs with dedication and expertise.'" :keywords="'legal team, lawyers, attorneys, legal professionals, law firm team, legal experts'" :image="asset('images/team-banner.jpg')" type="website" />
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-secondary via-primary to-slate-900 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: 
                radial-gradient(circle at 2px 2px, 2px, transparent 0);
                background-size: 40px 40px;">
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-20 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-indigo-500/15 rounded-full blur-lg animate-pulse"
            style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Breadcrumb -->
                <nav class="mb-8" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 text-purple-300">
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
                            <svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 text-white font-medium">Our Team</span>
                        </li>
                    </ol>
                </nav>

                <!-- Page Title -->
                <div
                    class="inline-flex items-center gap-2 bg-white/10 text-white px-6 py-3 rounded-full text-sm font-semibold mb-6 backdrop-blur-sm">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    Meet Our Professional Team
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-white">
                    Our <span class="">Expert Team</span>
                </h1>

                {{-- <p class="text-xl text-purple-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Meet our dedicated team of legal professionals who bring years of experience, expertise, and passion to serve your legal needs with excellence and integrity.
                </p> --}}


            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 border-b-0 left-0 w-full rotate-180 overflow-hidden">
            <svg class="relative block w-full h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="fill-white"></path>
            </svg>
        </div>
    </section>

    {{-- Team Section with Search --}}
    <x-team-section :teams="$teams" :showViewAll="false" :showSectionHeader="false" :showSearch="true"
        sectionTitle="Our <span class='bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent'>Legal Professionals</span>"
        sectionSubtitle="Expert Team Members"
        sectionDescription="Our diverse team of legal experts combines deep knowledge, innovative thinking, and unwavering commitment to deliver exceptional legal services across various practice areas." />

    {{-- Call to Action Section --}}
    <section class="py-16 bg-gradient-to-r from-secondary to-primary">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <div
                    class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                    <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Ready to Work with Our Team?
                </h2>
                <p class="text-xl text-purple-200 mb-8 leading-relaxed">
                    Connect with our experienced legal professionals today. We're here to provide you with expert guidance
                    and personalized legal solutions for your unique needs.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/contact') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl transform transition-all duration-300 hover:bg-gray-100 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Get Legal Consultation
                    </a>
                    <a href="tel:+1234567890"
                        class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #3b82f6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #7c3aed, #2563eb);
        }

        /* Enhanced mobile responsiveness */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endpush
