@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Study Abroad Programs - International Education & Legal Guidance'" :description="'Explore our comprehensive study abroad programs and legal guidance for international education opportunities'" :keywords="'study abroad, international education, legal guidance, programs'" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Study Abroad Programs"
        subtitle="Explore comprehensive study abroad programs with expert legal guidance for international education opportunities"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Study Abroad']]" />
    
    {{-- Study Abroad Section --}}
    <section class="pt-0">
        <div class="px-3">
            <div class="flex flex-wrap -mx-4">
                <!-- Main Content -->
                <div class="w-full lg:w-3/4 px-4">
                    <!-- Search and Results Info -->
                    <div class="bg-white rounded-lg shadow-lg mb-6 p-6">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Study Abroad Programs</h2>
                                <p class="text-gray-600">
                                    Showing {{ $studyAbroadPublications->count() }} of {{ $totalStudyAbroad }} programs
                                </p>
                            </div>
                            
                            <!-- Search Form -->
                            <div class="lg:w-1/3">
                                <form method="GET" action="{{ route('study-abroad.index') }}" class="flex">
                                    <input type="search" name="search" value="{{ request('search') }}" 
                                        placeholder="Search programs..." 
                                        class="flex-1 rounded-l-lg border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                                    <button type="submit" 
                                        class="px-6 py-2 bg-primary text-white rounded-r-lg hover:bg-primary-dark transition-colors">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Programs Grid -->
                    @if($studyAbroadPublications->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            @foreach($studyAbroadPublications as $program)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    @if($program->feature_image_url)
                                        <div class="h-48 bg-gray-200 overflow-hidden">
                                            <img src="{{ $program->feature_image_url }}" 
                                                alt="{{ $program->title }}" 
                                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                        </div>
                                    @endif
                                    
                                    <div class="p-6">
                                        <div class="flex items-center mb-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-plane mr-1"></i>
                                                Study Abroad
                                            </span>
                                            <span class="ml-auto text-sm text-gray-500">
                                                {{ $program->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-primary transition-colors">
                                            <a href="{{ route('study-abroad.show', $program->slug) }}">
                                                {{ $program->title }}
                                            </a>
                                        </h3>
                                        
                                        @if($program->excerpt)
                                            <p class="text-gray-600 mb-4 line-clamp-3">
                                                {{ Str::limit($program->excerpt, 150) }}
                                            </p>
                                        @endif
                                        
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('study-abroad.show', $program->slug) }}" 
                                                class="inline-flex items-center text-primary hover:text-primary-dark font-medium">
                                                Learn More
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                            
                                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                @if($program->faqs()->where('status', 'active')->count() > 0)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-question-circle mr-1"></i>
                                                        {{ $program->faqs()->where('status', 'active')->count() }} FAQs
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="flex justify-center">
                            {{ $studyAbroadPublications->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                            <i class="fas fa-plane text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No Study Abroad Programs Found</h3>
                            <p class="text-gray-600">
                                @if(request('search'))
                                    We couldn't find any programs matching "{{ request('search') }}".
                                    <a href="{{ route('study-abroad.index') }}" class="text-primary hover:underline">View all programs</a>
                                @else
                                    Check back later for new study abroad opportunities.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/4 px-4 mt-8 lg:mt-0">
                    <!-- Featured Programs -->
                    @if($featuredStudyAbroad->count() > 0)
                        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                Featured Programs
                            </h3>
                            <div class="space-y-4">
                                @foreach($featuredStudyAbroad as $featured)
                                    <div class="flex space-x-3">
                                        @if($featured->feature_image_url)
                                            <img src="{{ $featured->feature_image_url }}" 
                                                alt="{{ $featured->title }}" 
                                                class="w-16 h-16 rounded-lg object-cover">
                                        @else
                                            <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-plane text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <h4 class="font-medium text-sm text-gray-900 hover:text-primary">
                                                <a href="{{ route('study-abroad.show', $featured->slug) }}">
                                                    {{ Str::limit($featured->title, 60) }}
                                                </a>
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $featured->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Statistics -->
                    <div class="bg-gradient-to-br from-primary to-primary-dark text-white rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Program Statistics
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Total Programs:</span>
                                <span class="font-bold">{{ $totalStudyAbroad }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>This Month:</span>
                                <span class="font-bold">{{ \App\Models\Publication::studyAbroad()->whereMonth('created_at', now()->month)->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="bg-accent text-white rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-3">Need Legal Guidance?</h3>
                        <p class="text-sm mb-4 opacity-90">
                            Get expert legal advice for your study abroad journey.
                        </p>
                        <a href="{{ route('contact') }}" 
                            class="inline-flex items-center justify-center w-full px-4 py-2 bg-white text-accent rounded-lg hover:bg-gray-100 transition-colors font-medium">
                            Contact Us
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <x-contact-section />
@endsection
