@extends('layouts.app')

@section('head')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="About Us" subtitle="" :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'About Us']]" />
    {{-- Publications Section Title --}}
    {{-- About Us Content Sections --}}
    @if ($aboutContent->isNotEmpty())
        @foreach ($aboutContent as $content)
            <section class="relative py-8 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
                <!-- Decorative Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div
                        class="absolute top-0 left-0 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-xl animate-blob">
                    </div>
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-secondary rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000">
                    </div>
                    <div
                        class="absolute -bottom-8 left-20 w-96 h-96 bg-primary/70 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000">
                    </div>
                </div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center">
                        {{-- Image Section --}}
                        @if ($content->image1)
                            <div class="relative {{ $loop->even ? 'order-2 lg:order-1' : 'order-2 lg:order-2' }}">
                                <div class="relative">
                                    <div class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">
                                        <img src="{{ asset('storage/' . $content->image1) }}" alt="{{ $content->title }}"
                                            class="w-full h-[30rem] object-cover rounded">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 rounded-3xl pointer-events-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Content Section --}}
                        <div class="space-y-8 {{ $loop->even ? 'order-1 lg:order-2' : 'order-1 lg:order-1' }}">
                            {{-- Section Header --}}
                            <div class="space-y-6">
                                {{-- Tagline Badge --}}
                                <div
                                    class="inline-flex items-center space-x-3 px-5 py-2 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-full border border-primary/20">
                                    <span class="text-sm font-semibold text-primary uppercase tracking-wider">About
                                        Us</span>
                                </div>

                                {{-- Main Title --}}
                                @if ($content->title)
                                    <div class="space-y-4">
                                        <h2 class="font-semibold text-gray-800 leading-tight">
                                            <span class="text-primary text-3xl underline">
                                                {{ $content->title }}
                                            </span>
                                        </h2>
                                    </div>
                                @endif
                            </div>

                            {{-- Description Content --}}
                            @if ($content->desc_1)
                                <div class="text-base text-gray-600 max-w-none text-justify">
                                    {!! $content->desc_1 !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Description 2 Section Below --}}
                    @if ($content->desc_2)
                        <div class="mt-12 lg:mt-12 rounded-2xl p-6">
                            <div class="mx-auto">
                                <div class="text-left">
                                    <div class="text-base text-gray-600 mx-auto text-justify">
                                        {!! $content->desc_2 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Second Image Section --}}
                    @if ($content->image2)
                        <div class="mt-12">
                            <div class="relative overflow-hidden rounded-xl p-6 sm:p-8 shadow">
                                <img src="{{ asset('storage/' . $content->image2) }}" alt="{{ $content->title }}"
                                    class="w-full h-[20rem] object-cover rounded">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 rounded-3xl pointer-events-none">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endforeach
    @else
        {{-- Fallback content when no about content is found --}}
        <section class="relative py-16 lg:py-12 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-6">About Us</h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Welcome to our organization. Please check back soon for more information about us.
                </p>
            </div>
        </section>
    @endif

    {{-- Call to Action Section --}}
    <section class="py-16 bg-primary/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Ready to Work with Us?</h3>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary via-secondary to-primary text-white font-semibold rounded-xl hover:from-secondary hover:via-primary hover:to-secondary transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg">
                    <span>Get In Touch</span>
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
                @if (Route::has('team.index'))
                    <a href="{{ route('team.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 border-2 border-primary/30 text-primary font-semibold rounded-xl hover:border-primary hover:text-white hover:bg-primary transition-all duration-300">
                        <span>Meet Our Team</span>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
