@extends('layouts.app')

@section('content')
    {{-- Page Banner Component --}}
    <x-page-banner 
        title="Privacy Policy" 
        :backgroundImage="asset('contact.jpg')" 
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Privacy Policy']
        ]"
    />

    {{-- Main Content Section --}}
    <div class="bg-white py-12 md:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                
                <div class="prose max-w-none text-gray-700">
                    <p class="text-lg leading-relaxed mb-6">This privacy policy sets out how we use and protect any information that you give us when you use this website. We are committed to ensuring that your privacy is protected.</p>

                    {{-- Section 1 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">1. What we collect</h2>
                        <p>We may collect the following information:</p>
                        <ul class="list-disc list-inside mt-4 space-y-2">
                            <li>Name and job title</li>
                            <li>Contact information including email address</li>
                            <li>Demographic information such as postcode, preferences and interests</li>
                            <li>Other information relevant to customer surveys and/or offers</li>
                        </ul>
                    </div>

                    {{-- Section 2 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">2. What we do with the information we gather</h2>
                        <p>We require this information to understand your needs and provide you with a better service, and in particular for the following reasons:</p>
                        <ul class="list-disc list-inside mt-4 space-y-2">
                            <li>Internal record keeping.</li>
                            <li>We may use the information to improve our products and services.</li>
                            <li>We may periodically send promotional emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>
                            <li>From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, fax or mail. We may use the information to customise the website according to your interests.</li>
                        </ul>
                    </div>

                    {{-- Section 3 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">3. Security</h2>
                        <p>We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online.</p>
                    </div>

                    {{-- Section 4 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">4. How we use cookies</h2>
                        <p>A cookie is a small file which asks permission to be placed on your computer's hard drive. Once you agree, the file is added and the cookie helps analyse web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences.</p>
                    </div>

                    {{-- Section 5 --}}
                    <div class="mt-10">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 border-l-4 border-primary pl-4 mb-4">5. Links to other websites</h2>
                        <p>Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.</p>
                    </div>

                    {{-- Disclaimer Note --}}
                    <div class="mt-12 p-4 bg-gray-100 border-l-4 border-yellow-500 rounded-r-lg">
                        <p class="text-sm italic">This is a boilerplate privacy policy. Please replace the placeholder text with your own privacy policy. It is recommended to consult with a legal professional to ensure your privacy policy is compliant with all applicable laws and regulations.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
