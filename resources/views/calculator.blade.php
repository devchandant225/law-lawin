@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Enhanced Banner --}}
    <x-page-banner 
        title="COURT FEE CALCULATOR OF NEPAL" 
        subtitle="A precise tool for estimating judicial costs under the National Civil Procedure (Code) Act, 2017." 
        :breadcrumbs="[['label' => 'Home', 'url' => route('home')], ['label' => 'Calculator']]"
        backgroundImage="assets/images/backgrounds/page-header-contact-bg.jpg" 
    />

    {{-- Main Container --}}
    <div class="bg-[#f8fafc] pb-20">
        {{-- Calculator Section with Floating Card Effect --}}
        <section class="relative z-10 py-12 px-4">
            <div class="container mx-auto max-w-6xl">
                <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
                    @livewire('calculator')
                </div>
            </div>
        </section>

        {{-- Educational Content Section --}}
        <section class="py-16 md:py-24">
            <div class="container mx-auto px-4 md:px-6">
                <div class="max-w-6xl mx-auto">
                    
                    {{-- Grid for Structure and Info --}}
                    <div class="grid lg:grid-cols-12 gap-12 items-start">
                        
                        {{-- Left Column: Fee Structure --}}
                        <div class="lg:col-span-7 space-y-10">
                            <div>
                                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6 flex items-center gap-3">
                                    <span class="w-10 h-1 bg-secondary rounded-full"></span>
                                    How Court Fee is Determined?
                                </h2>
                                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                                    The rate of court fee is calculated based on the following criteria as determined by <span class="text-primary font-semibold">Section 69 of the National Civil Procedure (Code) Act, 2017</span>.
                                </p>
                                
                                <div class="overflow-hidden rounded-2xl border border-gray-200 shadow-sm">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th class="px-6 py-4 font-semibold uppercase tracking-wider text-sm">Amount Range (NPR)</th>
                                                <th class="px-6 py-4 font-semibold uppercase tracking-wider text-sm text-right">Applied Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 text-gray-700">
                                            <tr class="hover:bg-blue-50/30 transition-colors">
                                                <td class="px-6 py-4">Up to 25,000</td>
                                                <td class="px-6 py-4 text-right font-medium">Rs. 500/-</td>
                                            </tr>
                                            <tr class="hover:bg-blue-50/30 transition-colors bg-gray-50/50">
                                                <td class="px-6 py-4">25,001 to 50,000</td>
                                                <td class="px-6 py-4 text-right font-medium text-primary">5% of amount</td>
                                            </tr>
                                            <tr class="hover:bg-blue-50/30 transition-colors">
                                                <td class="px-6 py-4">50,001 to 1,00,000</td>
                                                <td class="px-6 py-4 text-right font-medium text-primary">3.5% of amount</td>
                                            </tr>
                                            <tr class="hover:bg-blue-50/30 transition-colors bg-gray-50/50">
                                                <td class="px-6 py-4">1,00,001 to 5,00,000</td>
                                                <td class="px-6 py-4 text-right font-medium text-primary">2% of amount</td>
                                            </tr>
                                            <tr class="hover:bg-blue-50/30 transition-colors">
                                                <td class="px-6 py-4">5,00,001 to 25,00,000</td>
                                                <td class="px-6 py-4 text-right font-medium text-primary">1.5% of amount</td>
                                            </tr>
                                            <tr class="hover:bg-blue-50/30 transition-colors bg-gray-50/50">
                                                <td class="px-6 py-4 text-primary font-semibold">Above 25,00,001</td>
                                                <td class="px-6 py-4 text-right font-bold text-primary">1% of amount</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Case Categories --}}
                            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                                <h3 class="text-2xl font-bold text-primary mb-6">Applicable nature of Cases:</h3>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    @php
                                        $categories = [
                                            ['title' => 'Family Law', 'desc' => 'Divorce, alimony, and child support financial claims.'],
                                            ['title' => 'Property Disputes', 'desc' => 'Ansha (partition) based on latest property valuation.'],
                                            ['title' => 'Civil & Commercial', 'desc' => 'Contracts, debt recovery, and business claims.'],
                                            ['title' => 'Compensation', 'desc' => 'Torts, medical negligence, and insurance claims.']
                                        ];
                                    @endphp
                                    @foreach($categories as $cat)
                                        <div class="p-5 bg-gray-50 rounded-2xl hover:bg-primary hover:text-white transition-all duration-300 group">
                                            <h4 class="font-bold mb-2 group-hover:text-white">{{ $cat['title'] }}</h4>
                                            <p class="text-sm text-gray-600 group-hover:text-white/90">{{ $cat['desc'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Expert Insight --}}
                        <div class="lg:col-span-5 space-y-8 sticky top-24">
                            <div class="bg-primary rounded-3xl p-8 text-white shadow-xl shadow-primary/20 overflow-hidden relative">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                                <h3 class="text-2xl font-bold mb-6 relative z-10">Professional Transparency</h3>
                                <p class="text-blue-50 text-lg leading-relaxed mb-8 relative z-10">
                                    At Lawin and Partners, we prioritize clarity. Our calculator helps you navigate the financial requirements of the judicial system with confidence.
                                </p>
                                
                                <div class="space-y-4 relative z-10">
                                    @foreach(['Cost Transparency', 'Legal Planning', 'Calculation Accuracy', 'Efficiency'] as $point)
                                        <div class="flex items-center gap-3">
                                            <div class="w-6 h-6 bg-secondary rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <span class="font-medium">{{ $point }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-secondary/5 rounded-3xl p-8 border border-secondary/10 text-center">
                                <h4 class="text-xl font-bold text-gray-900 mb-4">Need Expert Guidance?</h4>
                                <p class="text-gray-600 mb-6 text-sm">Our attorneys specialize in complex litigation and can provide a detailed cost-benefit analysis for your specific case.</p>
                                <a href="{{ route('contact') }}" class="inline-block bg-secondary text-white px-8 py-3 rounded-full font-bold hover:bg-secondary/90 transition-all hover:scale-105">
                                    Book a Consultation
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
