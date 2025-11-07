@extends('layouts.app')

@section('head')
    <x-meta-tags />
@endsection

@section('content')
    <x-page-banner title="Calculator" subtitle="Calculate your legal expenses and make informed decisions." :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Calculator']]"
        backgroundImage="assets/images/backgrounds/page-header-contact-bg.jpg" />

    <!-- Calculator Section -->
    <section class="py-8 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto px-4">
            @livewire('calculator')
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gradient-to-r from-accent/5 to-accent/10">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-accent mb-6">
                        How Court Fee Calculation Works
                    </h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Understanding the step-by-step process of calculating court fees in Nepal
                    </p>
                </div>

                <!-- Steps Grid -->
                <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                    <!-- Step 1 -->
                    <div class="group">
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full border border-accent/10">
                            <!-- Step Number -->
                            <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent/80 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                1
                            </div>
                            
                            <!-- Step Content -->
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-accent mb-4 group-hover:text-accent/80 transition-colors">
                                    Enter Amount
                                </h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Enter the case value or claim amount for which you need to calculate court fees. Our system supports various case types and amounts.
                                </p>
                            </div>
                            
                            <!-- Decorative Element -->
                            <div class="absolute top-4 right-4 w-8 h-8 bg-accent/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="group">
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full border border-accent/10">
                            <!-- Step Number -->
                            <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent/80 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                2
                            </div>
                            
                            <!-- Step Content -->
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-accent mb-4 group-hover:text-accent/80 transition-colors">
                                    Calculate Fee
                                </h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Our system calculates the fee based on the progressive rate structure set by Nepal's court system, ensuring accuracy and compliance.
                                </p>
                            </div>
                            
                            <!-- Decorative Element -->
                            <div class="absolute top-4 right-4 w-8 h-8 bg-accent/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="group">
                        <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full border border-accent/10">
                            <!-- Step Number -->
                            <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent/80 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                3
                            </div>
                            
                            <!-- Step Content -->
                            <div class="text-center">
                                <h3 class="text-xl font-bold text-accent mb-4 group-hover:text-accent/80 transition-colors">
                                    Get Breakdown
                                </h3>
                                <p class="text-gray-700 leading-relaxed">
                                    View detailed breakdown showing how the total fee is calculated across different amount ranges with complete transparency.
                                </p>
                            </div>
                            
                            <!-- Decorative Element -->
                            <div class="absolute top-4 right-4 w-8 h-8 bg-accent/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="mt-16 text-center">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-accent/20">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-accent">Accurate & Reliable</h3>
                        </div>
                        <p class="text-gray-700 max-w-2xl mx-auto leading-relaxed">
                            Our calculator is regularly updated to reflect the latest court fee structures and regulations in Nepal, ensuring you get the most accurate estimates for your legal proceedings.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
