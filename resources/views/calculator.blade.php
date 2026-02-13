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

    <!-- Content Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg max-w-none text-gray-700">
                    <h2 class="text-3xl font-bold text-accent mb-8 text-center uppercase tracking-wider">COURT FEE CALCULATOR</h2>
                    
                    <p class="mb-6 leading-relaxed">
                        You can estimate court fee budget using the <strong>Lawin and Partners Court Fee Calculator</strong>, the most reliable tool for estimating court submission fees in Nepal for your cases. Designed by the <strong>best lawyers in Nepal</strong>, we have ensured transparency required for your judicial process in district courts, high courts, and the supreme court.
                    </p>
                    
                    <p class="mb-12 leading-relaxed">
                        Our <strong>Court fee calculator for Nepal</strong> helps you determine the mandatory government fees required under the National Civil Procedure (Code) Act, 2017. Whether you are an individual or a business, this tool eliminates guesswork by providing accurate estimates based on current court fee schedules.
                    </p>

                    <div class="bg-gray-50 rounded-3xl p-8 md:p-12 mb-12 border border-gray-100">
                        <h3 class="text-2xl font-bold text-accent mb-6">Applicable nature of Cases for court Fee:</h3>
                        <p class="mb-8 text-lg">Our calculator is optimized to handle a wide range of legal disputes, including:</p>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm border border-gray-50">
                                <span class="flex-shrink-0 w-8 h-8 bg-accent text-white rounded-lg flex items-center justify-center mr-4 font-bold">1</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Family Law:</h4>
                                    <p class="text-sm">Quickly calculate court fees in Nepal for divorce, alimony or child financial costs.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm border border-gray-50">
                                <span class="flex-shrink-0 w-8 h-8 bg-accent text-white rounded-lg flex items-center justify-center mr-4 font-bold">2</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Property Disputes:</h4>
                                    <p class="text-sm">Determine the Ansha (property partition) court fee in Nepal based on property valuation.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm border border-gray-50">
                                <span class="flex-shrink-0 w-8 h-8 bg-accent text-white rounded-lg flex items-center justify-center mr-4 font-bold">3</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Civil & Commercial Litigation:</h4>
                                    <p class="text-sm">Estimates for civil case court fees in Nepal, including contract disputes, debt recovery, and commercial claims.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-white rounded-2xl shadow-sm border border-gray-50">
                                <span class="flex-shrink-0 w-8 h-8 bg-accent text-white rounded-lg flex items-center justify-center mr-4 font-bold">4</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Compensation Claims:</h4>
                                    <p class="text-sm">Calculate fees for torts, medical negligence, or insurance compensation.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-accent mb-6 text-center">Purpose of Fee Calculator</h3>
                        <p class="mb-8 text-center text-lg">As a leading law firm in Nepal, Lawin and Partners is committed to client convenience and transparency and offers:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-accent/5 text-accent rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">1</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Cost Transparency</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-accent/5 text-accent rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">2</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Legal Planning</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-accent/5 text-accent rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">3</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Accuracy</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-accent/5 text-accent rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-accent group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">4</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Efficiency</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-accent rounded-3xl p-8 text-center text-white shadow-xl shadow-accent/20">
                        <p class="text-lg font-medium leading-relaxed">
                            As a premier law firm in Nepal, our expert attorneys are ready to help you navigate your court fee calculation smooth and make your case easy handling each step process with due care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
