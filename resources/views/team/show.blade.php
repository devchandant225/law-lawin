@extends('layouts.app')

@section('head')
    <x-meta-tags 
        :title="($team->metatitle ?: $team->name . ' - ' . $team->designation . ' | Legal Professional')" 
        :description="($team->metadescription ?: $team->tagline ?: 'Meet ' . $team->name . ', ' . $team->designation . ' at our law firm. Experienced legal professional ready to help with your legal needs.')" 
        :keywords="($team->metakeywords ?: $team->name . ', ' . $team->designation . ', lawyer, attorney, legal professional')" 
        :image="$team->image_url" 
        type="profile" 
        :post="$team" 
    />
    
    @if($team->googleschema)
        <script type="application/ld+json">
            {!! $team->google_schema_json !!}
        </script>
    @endif
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: 
                radial-gradient(circle at 2px 2px, white 2px, transparent 0);
                background-size: 40px 40px;">
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-purple-500/20 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-32 right-20 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-indigo-500/15 rounded-full blur-lg animate-pulse"
            style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
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
                            <a href="{{ route('team.index') }}"
                                class="ml-2 hover:text-white transition-colors duration-300">Our Team</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-2 text-white font-medium">{{ $team->name }}</span>
                        </li>
                    </ol>
                </nav>

                <!-- Profile Header -->
                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8 mb-8">
                    <!-- Profile Image -->
                    <div class="flex-shrink-0">
                        <div class="relative">
                            @if($team->image_url)
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}" 
                                     class="w-32 h-32 lg:w-48 lg:h-48 rounded-full object-cover border-4 border-white/20 shadow-2xl">
                            @else
                                <div class="w-32 h-32 lg:w-48 lg:h-48 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center border-4 border-white/20 shadow-2xl">
                                    <svg class="w-16 h-16 lg:w-24 lg:h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                </div>
                            @endif
                            @if($team->experience)
                                <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                    {{ $team->experience }}+ Years
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center lg:text-left">
                        <!-- Name & Designation -->
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight bg-gradient-to-r from-white to-purple-200 bg-clip-text text-transparent">
                            {{ $team->name }}
                        </h1>
                        <p class="text-xl md:text-2xl text-purple-300 font-semibold mb-4">{{ $team->designation }}</p>
                        
                        <!-- Tagline -->
                        @if($team->tagline)
                            <p class="text-lg text-purple-200 mb-6 max-w-2xl mx-auto lg:mx-0">{{ $team->tagline }}</p>
                        @endif

                        <!-- Contact & Social -->
                        <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                            @if($team->email)
                                <a href="mailto:{{ $team->email }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-lg hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Email
                                </a>
                            @endif
                            @if($team->phone)
                                <a href="tel:{{ $team->phone }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-lg hover:bg-white/20 transition-all duration-300 backdrop-blur-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Call
                                </a>
                            @endif
                            @if($team->linkedinlink)
                                <a href="{{ $team->linkedinlink }}" target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286z"/>
                                    </svg>
                                    LinkedIn
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
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

    {{-- Main Content Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid xl:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-3">
                    <!-- Biography Section -->
                    @if($team->description)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                About {{ $team->name }}
                            </h2>
                            <div class="prose prose-lg prose-slate max-w-none">
                                <div class="text-gray-700 leading-relaxed">
                                    {!! $team->description !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Professional Details -->
                    <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-3xl shadow-xl border border-purple-100 p-8 lg:p-12 mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Professional Profile
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            @if($team->experience)
                                <div class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Experience</h4>
                                        <p class="text-gray-600 text-sm">{{ $team->experience }}+ years of legal practice</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($team->qualification)
                                <div class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Education</h4>
                                        <p class="text-gray-600 text-sm">{{ $team->qualification }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Specialization</h4>
                                    <p class="text-gray-600 text-sm">{{ $team->designation }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Location</h4>
                                    <p class="text-gray-600 text-sm">Available for consultation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    @if($team->additional_details)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 lg:p-12 mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Additional Information</h3>
                            <div class="prose prose-lg prose-slate max-w-none">
                                <div class="text-gray-700 leading-relaxed">
                                    {!! $team->additional_details !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Call to Action -->
                    <div class="bg-gradient-to-r from-slate-900 to-purple-900 rounded-3xl shadow-2xl p-8 lg:p-12 text-white">
                        <div class="text-center max-w-2xl mx-auto">
                            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold mb-4">Need Legal Assistance?</h3>
                            <p class="text-xl text-purple-200 mb-8 leading-relaxed">
                                Contact {{ $team->name }} directly for expert legal guidance and personalized consultation tailored to your specific needs.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                @if($team->email)
                                    <a href="mailto:{{ $team->email }}"
                                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl transform transition-all duration-300 hover:bg-gray-100 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-xl">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Send Email
                                    </a>
                                @endif
                                @if($team->phone)
                                    <a href="tel:{{ $team->phone }}"
                                        class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        Call Now
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1">
                    <div class="sticky top-8 space-y-8">
                        <!-- Contact Card -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Contact {{ $team->name }}</h4>
                            <div class="space-y-4">
                                @if($team->email)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Email</p>
                                            <a href="mailto:{{ $team->email }}" class="text-sm text-purple-600 hover:text-purple-800">{{ $team->email }}</a>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($team->phone)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Phone</p>
                                            <a href="tel:{{ $team->phone }}" class="text-sm text-blue-600 hover:text-blue-800">{{ $team->phone }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Share Card -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Share Profile</h4>
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
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation) }}"
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
                                <a href="https://wa.me/?text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="bg-green-500 text-white p-3 rounded-xl text-center hover:bg-green-600 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.525 3.488" />
                                    </svg>
                                </a>
                                <a href="viber://forward?text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation . ' - ' . request()->url()) }}"
                                    target="_blank"
                                    class="bg-purple-600 text-white p-3 rounded-xl text-center hover:bg-purple-700 transition-colors duration-300 group">
                                    <svg class="w-5 h-5 mx-auto group-hover:scale-110 transition-transform duration-300"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M11.398.002C9.473.024 5.331.344 3.014 2.467A6.65 6.65 0 0 0 .702 6.698c-.394 2.733-.196 5.783.51 8.427l-1.22 4.478L4.49 18.31c2.212.65 4.56.837 6.908.554 3.952-.477 6.817-3.554 7.523-7.436.901-4.95-.666-9.218-4.487-11.976C13.186.434 11.398.002 11.398.002zm.067 1.697c.017 0 .033.003.05.003 1.662.003 3.105.32 4.429 1.091 3.318 1.93 4.573 5.383 3.783 9.234-.592 2.884-2.849 5.355-5.934 5.745-2.016.253-4.097.046-6.003-.507L4.5 17.915l.936-3.43c-.615-2.36-.777-4.94-.447-7.37.405-2.988 2.208-5.135 4.476-5.416z" />
                                        <path
                                            d="M11.398 3.11c-.51.017-1.09.137-1.643.414-1.245.625-2.171 1.863-2.46 3.237-.21 1.001-.125 2.048.145 3.018.216.775.533 1.508.93 2.188.636 1.09 1.483 2.022 2.498 2.734.637.447 1.341.804 2.091 1.027.377.112.768.17 1.162.17.394 0 .785-.058 1.162-.17.593-.177 1.146-.469 1.618-.856.236-.193.448-.417.618-.673.17-.256.297-.544.367-.856.07-.312.084-.638.04-.963-.044-.325-.132-.64-.26-.93-.128-.29-.297-.553-.505-.777-.208-.224-.454-.408-.723-.541-.269-.133-.564-.216-.865-.244-.301-.028-.605.01-.896.112-.291.102-.567.264-.795.487-.228.223-.408.5-.526.81-.118.31-.175.645-.168.982.007.337.075.67.2.975.125.305.307.582.535.81.228.228.502.408.806.531.304.123.634.189.968.195.334.006.669-.052.983-.171.314-.119.605-.297.853-.524.248-.227.451-.503.594-.814.143-.311.225-.651.242-.998.017-.347-.027-.696-.13-1.02-.103-.324-.266-.624-.478-.877-.212-.253-.472-.458-.765-.6-.293-.142-.616-.22-.942-.23-.326-.01-.654.052-.958.184-.304.132-.581.333-.81.585-.229.252-.409.554-.528.886-.119.332-.177.69-.17 1.05.007.36.077.716.207 1.044.13.328.318.628.554.883.236.255.519.458.833.598.314.14.654.217.999.227.345.01.691-.05 1.016-.177.325-.127.623-.322.873-.572.25-.25.452-.551.592-.884.14-.333.219-.695.232-1.063.013-.368-.048-.738-.18-1.078-.132-.34-.334-.649-.593-.905-.259-.256-.574-.459-.926-.595-.352-.136-.736-.205-1.124-.202-.388.003-.773.078-1.126.22-.353.142-.672.351-.936.612-.264.261-.473.572-.614.912-.141.34-.214.708-.214 1.08 0 .372.073.74.214 1.08.141.34.35.651.614.912.264.261.583.47.936.612.353.142.738.217 1.126.22.388-.003.772-.066 1.124-.202.352-.136.667-.339.926-.595.259-.256.461-.565.593-.905.132-.34.193-.71.18-1.078-.013-.368-.092-.73-.232-1.063-.14-.333-.342-.634-.592-.884-.25-.25-.548-.445-.873-.572-.325-.127-.671-.187-1.016-.177-.345-.01-.685.087-.999.227-.314-.14-.597-.343-.833-.598-.236-.255-.424-.555-.554-.883-.13-.328-.2-.684-.207-1.044-.007-.36.051-.718.17-1.05.119-.332.299-.634.528-.886.229-.252.506-.453.81-.585.304-.132.632-.194.958-.184.326.01.649.088.942.23.293.142.553.347.765.6.212.253.375.553.478.877.103.324.147.673.13 1.02-.017.347-.099.687-.242.998-.143.311-.346.587-.594.814-.248.227-.539.405-.853.524-.314.119-.649.177-.983.171-.334-.006-.664-.072-.968-.195-.304-.123-.578-.303-.806-.531-.228-.228-.41-.505-.535-.81-.125-.305-.193-.638-.2-.975-.007-.337.05-.672.168-.982.118-.31.298-.587.526-.81.228-.223.504-.385.795-.487.291-.102.595-.14.896-.112.301.028.596.111.865.244.269.133.515.317.723.541.208.224.377.487.505.777.128.29.216.605.26.93.044.325.03.651-.04.963-.07.312-.197.6-.367.856-.17.256-.382.48-.618.673-.472.387-1.025.679-1.618.856-.377.112-.768.17-1.162.17z" />
                                    </svg>
                                </a>

                            </div>
                        </div>

                        <!-- Back to Team -->
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                            <a href="{{ route('team.index') }}" 
                               class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-semibold rounded-2xl transform transition-all duration-300 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                </svg>
                                View All Team Members
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Line Clamp Utilities */
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        /* Prose Styling */
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
            @apply text-purple-600 hover:text-purple-800 transition-colors duration-200;
        }

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
    </style>
@endpush
