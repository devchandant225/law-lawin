@extends('layouts.app')

@section('head')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="About Us" subtitle="" :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'About Us']]" />
    
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
                        <div class="mt-12 lg:mt-12 rounded-2xl">
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
@push('styles')
    <style>
        h3 {
            color: #70bfce;
        }

        ul {
            list-style: auto;
            padding-left: 18px !important;
        }

        ul li {
            list-style: auto;
        }

        /* Responsive gradient header */
        .publication-gradient-header {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .publication-gradient-header h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .publication-gradient-header p {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 640px) {
            .publication-gradient-header h1 {
                font-size: 2rem !important;
                line-height: 1.2;
            }

            .publication-gradient-header p {
                font-size: 1rem !important;
            }

            .publication-gradient-header .bg-gradient-to-b {
                height: 20rem !important;
            }
        }

        @media (max-width: 480px) {
            .publication-gradient-header h1 {
                font-size: 1.75rem !important;
            }

            .publication-gradient-header .bg-gradient-to-b {
                height: 18rem !important;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #108fcc;
            color: #fff;
            font-weight: 600;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* TOC Full Height Styles */
        .toc-navigation {
            display: flex;
            flex-direction: column;
        }

        .toc-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .toc-nav-link {
            position: relative;
            cursor: pointer;
            user-select: none;
        }

        .toc-nav-link:hover {
            transform: translateX(2px);
            box-shadow: 0 2px 8px rgba(112, 191, 206, 0.3);
        }

        .toc-nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, #d0700b, #d0700b);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .toc-nav-link:hover::before {
            opacity: 1;
        }

        .toc-nav-active {
            background-color: #d0700b !important;
            color: white !important;
            border-left-color: #d0700b !important;
        }

        /* Smooth scrolling behavior */
        html {
            scroll-behavior: smooth;
        }

        /* TOC scrollbar styling */
        .toc-nav::-webkit-scrollbar {
            width: 6px;
        }

        .toc-nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .toc-nav::-webkit-scrollbar-thumb {
            background: #70bfce;
            border-radius: 3px;
        }

        .toc-nav::-webkit-scrollbar-thumb:hover {
            background: #5a9ba8;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 6px;
                padding: 10px;
                background-color: #fff;
            }

            td {
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                color: #2c3e50;
                text-align: left;
            }
        }
    </style>
@endpush