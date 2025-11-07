@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Our Legal Team - Expert Lawyers & Legal Professionals'" :description="'Meet our experienced team of legal professionals. Expert lawyers, attorneys, and legal consultants ready to handle your legal needs with dedication and expertise.'" :keywords="'legal team, lawyers, attorneys, legal professionals, law firm team, legal experts'" :image="asset('images/team-banner.jpg')" type="website" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title=""
        subtitle="Meet our dedicated team of legal professionals who bring years of experience, expertise, and passion to serve your legal needs with excellence and integrity"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Our Team']]" />
    {{-- Contact Section Title --}}
    <x-page-section-title title="<span>Our Team</span>" />
    {{-- Modern Team Section with Tailwind CSS --}}
    <section class="py-8 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">

        <div class="container mx-auto px-4 relative z-10">


            @if ($teams->isNotEmpty())
                <!-- Team Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mb-12 justify-items-center">
                    @foreach ($teams as $index => $member)
                        <div class="team-card-wrapper w-full max-w-xs" data-aos="fade-up" data-aos-duration="800"
                            data-aos-delay="{{ $index * 100 }}">
                            <div
                                class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 group overflow-hidden border border-gray-100 hover:border-primary/30 h-full flex flex-col">
                                <!-- Team Member Image -->
                                <a href="{{ route('team.show', $member->slug) }}" class="block flex-shrink-0">
                                    <div class="relative overflow-hidden">
                                        <div class="bg-gradient-to-br from-accent to-secondary/20">
                                            @if ($member->image)
                                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}"
                                                    class="w-full h-48 sm:h-56 md:h-64 lg:h-72 object-cover object-center transition-transform duration-700 group-hover:scale-105">
                                            @else
                                                <img src="{{ asset('assets/images/team/team-1-1.jpg') }}"
                                                    alt="{{ $member->name }}"
                                                    class="w-full h-48 sm:h-56 md:h-64 lg:h-72 object-cover object-center transition-transform duration-700 group-hover:scale-105">
                                            @endif
                                        </div>
                                    </div>
                                </a>

                                <!-- Team Member Info -->
                                <div class="px-4 py-3 sm:px-6 sm:py-4 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <h3 class="font-semibold text-lg sm:text-xl text-gray-900 group-hover:text-primary transition-colors duration-300 mb-1">
                                            <a href="{{ route('team.show', $member->slug) }}" class="text-primary hover:text-primary/80">
                                                {{ $member->name }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 font-medium text-sm sm:text-base mb-3">
                                            {{ $member->designation ?: 'Legal Professional' }}
                                        </p>

                                        <!-- Contact Info -->
                                        <div class="space-y-2 text-xs sm:text-sm text-gray-500">
                                            @if ($member->phone)
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-phone text-primary flex-shrink-0"></i>
                                                    <a href="tel:{{ $member->phone }}"
                                                        class="hover:text-primary transition-colors duration-300 truncate">
                                                        {{ $member->phone }}
                                                    </a>
                                                </div>
                                            @endif
                                            @if ($member->email)
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-envelope text-primary flex-shrink-0"></i>
                                                    <a href="mailto:{{ $member->email }}"
                                                        class="hover:text-primary transition-colors duration-300 truncate">
                                                        {{ $member->email }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Social Media Icons & View More Button -->
                                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                        <div class="flex space-x-2">
                                            @if ($member->facebooklink)
                                                <a href="{{ $member->facebooklink }}" target="_blank"
                                                    class="w-8 h-8 bg-blue-50 hover:bg-blue-100 rounded-full flex items-center justify-center text-blue-600 hover:text-blue-700 transition-all duration-300 hover:scale-110">
                                                    <i class="fab fa-facebook-f text-sm"></i>
                                                </a>
                                            @endif
                                            @if ($member->linkedinlink)
                                                <a href="{{ $member->linkedinlink }}" target="_blank"
                                                    class="w-8 h-8 bg-blue-50 hover:bg-blue-100 rounded-full flex items-center justify-center text-blue-600 hover:text-blue-700 transition-all duration-300 hover:scale-110">
                                                    <i class="fab fa-linkedin-in text-sm"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <a href="{{ route('team.show', $member->slug) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-accent hover:bg-accent/90 text-white text-xs font-semibold rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-md">
                                            <span>View more</span>
                                            <i class="fas fa-arrow-right ml-1 text-[10px]"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-3xl text-gray-400"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-4">No team members available at the moment.</h4>
                    <p class="text-gray-600 max-w-md mx-auto">Please check back later to meet our amazing team of legal
                        professionals.</p>
                </div>
            @endif
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-blue-400/30 rounded-full blur-3xl opacity-60 animate-pulse"></div>
        <div
            class="absolute bottom-10 right-10 w-32 h-32 bg-blue-600/20 rounded-full blur-3xl opacity-40 animate-pulse delay-1000">
        </div>
    </section>

@endsection
