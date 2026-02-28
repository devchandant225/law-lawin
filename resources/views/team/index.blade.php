@extends('layouts.app')

@section('meta_tags')
    @if ($post)
        <x-meta-tags :title="$post->meta_title ?: $post->title" :description="$post->meta_description" :keywords="$post->meta_keywords" :image="$post->feature_image_url ?: asset('images/team-banner.jpg')" type="website" />
    @else
        <x-meta-tags :title="'Our Legal Team - Expert Lawyers & Legal Professionals'" :description="'Meet our experienced team of legal professionals. Expert lawyers, attorneys, and legal consultants ready to handle your legal needs with dedication and expertise.'" :keywords="'legal team, lawyers, attorneys, legal professionals, law firm team, legal experts'" :image="asset('images/team-banner.jpg')" type="website" />
    @endif
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 text-center">
                {{ $post ? $post->title : 'Our Team' }}
            </h1>
            <div class="prose prose-lg max-w-4xl mx-auto text-center text-gray-600">
                @if ($post)
                    {!! $post->description !!}
                @else
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto text-center">
                        Meet our experienced team of legal professionals dedicated to providing you with expert legal solutions.
                    </p>
                @endif
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">


            @if ($teams->isNotEmpty())
                <!-- Team Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 md:gap-x-16 gap-y-4 mb-12 justify-center">
                    @foreach ($teams as $index => $member)
                        <div class="team-card-wrapper w-full max-w-[14rem] mx-auto" data-aos="fade-up" data-aos-duration="800"
                            data-aos-delay="{{ $index * 100 }}">
                            <div
                                class="bg-white rounded-2xl shadow-md transition-all duration-500 group overflow-hidden border border-gray-100 hover:border-primary/30">
                                <!-- Team Member Image -->
                                <a href="{{ route('team.show', $member->slug) }}" class="block">
                                    <div class="relative overflow-hidden">
                                        <div class="bg-gradient-to-br from-accent to-secondary/20">
                                            @if ($member->image)
                                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}"
                                                    class="w-full h-[18rem] object-fit object-center transition-transform duration-700 ease-out group-hover:scale-105">
                                            @else
                                                <img src="{{ asset('assets/images/team/team-1-1.jpg') }}"
                                                    alt="{{ $member->name }}"
                                                    class="w-full h-[18rem] object-contain transition-transform duration-700 ease-out group-hover:scale-105">
                                            @endif
                                        </div>
                                    </div>
                                </a>

                                <!-- Team Member Info -->
                                <div class="px-4 py-2">
                                    <h3
                                        class="font-medium text-lg text-gray-900 group-hover:text-primary transition-colors duration-300">
                                        <a href="{{ route('team.show', $member->slug) }}" class="text-primary">
                                            {{ $member->name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 font-normal text-sm mb-2">
                                        {{ $member->designation ?: 'Legal Professional' }}</p>

                                    <!-- Contact Info -->
                                    <div class="space-y-2 text-xs text-gray-500">
                                        @if ($member->phone)
                                            <div class="flex space-x-2">
                                                <i class="fas fa-phone text-primary"></i>
                                                <a href="tel:{{ $member->phone }}" rel="nofollow"
                                                    class="hover:text-primary transition-colors duration-300">
                                                    {{ $member->phone }}
                                                </a>
                                            </div>
                                        @endif
                                        @if ($member->email)
                                            <div class="flex space-x-2">
                                                <i class="fas fa-envelope text-primary"></i>
                                                <a href="mailto:{{ $member->email }}"
                                                    class="hover:text-primary transition-colors duration-300">
                                                    {{ $member->email }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Social Media Icons (Footer) -->
                                    <div class="flex justify-between space-x-3 mt-2 pt-2 border-t border-gray-100">
                                        <div class="flex space-x-3 w-[50%]">
                                            @if ($member->facebooklink)
                                                <a href="{{ $member->facebooklink }}" target="_blank"
                                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-200 hover:text-gray-800 transition-all duration-300">
                                                    <i class="fab fa-facebook-f text-xs"></i>
                                                </a>
                                            @endif
                                            @if ($member->linkedinlink)
                                                <a href="{{ $member->linkedinlink }}" target="_blank"
                                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-200 hover:text-gray-800 transition-all duration-300">
                                                    <i class="fab fa-linkedin-in text-xs"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <a href="{{ route('team.show', $member->slug) }}"
                                            class="px-2 pt-2 bg-blue-100 text-gray-600 text-xs font-semibold rounded-lg hover:bg-blue-100 transition-all duration-300 hover:scale-105">
                                            View more
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

            @if ($post && $post->bottom_description)
                <div class="mt-12 prose prose-lg max-w-4xl mx-auto text-gray-600">
                    {!! $post->bottom_description !!}
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
