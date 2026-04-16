@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags />
@endsection

@section('content')
    <x-page-banner title="COURT FEE CALCULATOR OF NEPAL" subtitle="Calculate your legal expenses and make informed decisions using the most reliable tool in Nepal." :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Calculator']]"
        backgroundImage="assets/images/backgrounds/page-header-contact-bg.jpg" />

    <!-- Calculator Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 md:px-20">
            <div class="bg-white rounded-xl shadow-2xl p-6 md:p-10 border border-gray-100">
                @livewire('calculator')
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-20">
            <div class="max-w-5xl">
                <!-- How Court Fee is Determined Section -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-primary mb-6">How Court Fee is Determined?</h2>
                    <p class="text-gray-700 mb-8 leading-relaxed">
                        The rate of court fee is calculated based on the following criteria as determined by the Section 69 of Chapter of Provisions Relating to Court Fees of National Civil Procedure (Code) Act, 2017 of Nepal.
                    </p>
                    
                    <div class="grid grid-cols-2 w-full md:w-[80%] text-gray-800 border-t border-gray-200">
                        <div class="border-b border-gray-200 px-6 py-4 font-bold bg-gray-100">Amount (NPR)</div>
                        <div class="border-b border-gray-200 px-6 py-4 font-bold bg-gray-100">Court Fee</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">a. Upto 25,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">Rs. 500/- (Five hundred rupees only)</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">b. 25,001 to 50,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">5% of the amount</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">c. 50,001 to 1,00,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">3.5% of the amount</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">d. 1,00,001 to 5,00,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">2% of the amount</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">e. 5,00,001 to 25,00,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">1.5% of the amount</div>
                        
                        <div class="border-b border-gray-200 px-6 py-3">f. More than 25,00,000</div>
                        <div class="border-b border-gray-200 px-6 py-3">1% of the amount</div>
                    </div>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700">
                    <h2 class="text-3xl font-bold text-primary mb-8">About Court Fee Calculator</h2>
                    
                    <p class="mb-6 leading-relaxed">
                        You can estimate court fee budget using the <strong>Lawin and Partners Court Fee Calculator</strong>, the most reliable tool for estimating court submission fees in Nepal for your cases. Designed by the <strong>best lawyers in Nepal</strong>, we have ensured transparency required for your judicial process in district courts, high courts, and the supreme court.
                    </p>
                    
                    <p class="mb-12 leading-relaxed">
                        Our <strong>Court fee calculator for Nepal</strong> helps you determine the mandatory government fees required under the National Civil Procedure (Code) Act, 2017. Whether you are an individual or a business, this tool eliminates guesswork by providing accurate estimates based on current court fee schedules.
                    </p>

                    <div class="bg-white rounded-3xl p-8 md:p-12 mb-12 shadow-sm border border-gray-200">
                        <h3 class="text-2xl font-bold text-primary mb-6">Applicable nature of Cases for court Fee:</h3>
                        <p class="mb-8 text-lg">Our calculator is optimized to handle a wide range of legal disputes, including:</p>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-start p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center mr-4 font-bold">1</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Family Law:</h4>
                                    <p class="text-sm">Quickly calculate court fees in Nepal for divorce, alimony or child financial costs.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center mr-4 font-bold">2</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Property Disputes:</h4>
                                    <p class="text-sm">Determine the Ansha (property partition) court fee in Nepal based on property valuation.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center mr-4 font-bold">3</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Civil & Commercial Litigation:</h4>
                                    <p class="text-sm">Estimates for civil case court fees in Nepal, including contract disputes, debt recovery, and commercial claims.</p>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <span class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center mr-4 font-bold">4</span>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Compensation Claims:</h4>
                                    <p class="text-sm">Calculate fees for torts, medical negligence, or insurance compensation.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-primary mb-6 text-center">Purpose of Fee Calculator</h3>
                        <p class="mb-8 text-center text-lg">As a leading law firm in Nepal, Lawin and Partners is committed to client convenience and transparency and offers:</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-primary/5 text-primary rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">1</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Cost Transparency</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-primary/5 text-primary rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">2</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Legal Planning</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-primary/5 text-primary rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">3</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Accuracy</div>
                            </div>
                            <div class="text-center group">
                                <div class="w-16 h-16 bg-primary/5 text-primary rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="text-xl font-bold">4</span>
                                </div>
                                <div class="text-sm font-bold text-gray-800">Efficiency</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-primary rounded-3xl p-8 text-center text-white shadow-xl shadow-primary/20">
                        <p class="text-lg font-medium leading-relaxed">
                            As a premier law firm in Nepal, our expert attorneys are ready to help you navigate your court fee calculation smooth and make your case easy handling each step process with due care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
