@extends('layouts.app')

@section('content')
    {{-- Page Banner Component --}}
    <x-page-banner 
        title="Terms and Conditions" 
        :backgroundImage="asset('publication.jpg')" 
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Terms and Conditions']
        ]"
    />

    {{-- Main Content Section --}}
    <div class="bg-white py-12 md:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                
                {{-- Introduction --}}
                <div class="prose max-w-none text-gray-700">
                    <p class="text-lg leading-relaxed mb-6">Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern our relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.</p>

                    {{-- Section 1 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">1. Introduction</h2>
                        <p>The term '[Your Company Name]' or 'us' or 'we' refers to the owner of the website whose registered office is [Your Address]. Our company registration number is [Your Company Registration Number]. The term 'you' refers to the user or viewer of our website.</p>
                    </div>

                    {{-- Section 2 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">2. Intellectual Property Rights</h2>
                        <p>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</p>
                    </div>

                    {{-- Section 3 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">3. Disclaimer</h2>
                        <p>The information contained in this website is for general information purposes only. The information is provided by [Your Company Name] and while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
                    </div>

                    {{-- Section 4 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">4. Limitation of Liability</h2>
                        <p>In no event will we be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.</p>
                    </div>

                    {{-- Section 5 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">5. Governing Law</h2>
                        <p>Your use of this website and any dispute arising out of such use of the website is subject to the laws of [Your Country].</p>
                    </div>

                    {{-- Disclaimer Note --}}
                    <div class="mt-12 p-4 bg-gray-100 border-l-4 border-yellow-500 rounded-r-lg">
                        <p class="text-sm italic">This is a boilerplate terms and conditions page. Please replace the placeholder text with your own terms and conditions. It is recommended to consult with a legal professional to ensure your terms and conditions are compliant with all applicable laws and regulations.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
