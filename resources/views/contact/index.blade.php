@extends('layouts.app')

@section('content')
    <x-page-banner 
        title="Contact Us"
        subtitle="Get in touch with our expert legal team for professional consultation and assistance."
        :breadcrumbs="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us']
        ]"
        backgroundImage="assets/images/backgrounds/page-header-contact-bg.jpg"
    />

   {{-- Contact Section --}}
    <x-contact-section :contactInfo="[
        'address' => 'Fishing Harbour - Jumeira St - Umm Suqeim - Umm Suqeim 2 - Dubai',
        'phone' => '+9779841933745',
        'email' => 'info@lawinpartners.com',
        'workingHours' => [
            'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
            'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
        ],
    ]"
        sectionTitle="<span class=''>Reach out for the best Legal Advice</span>"
        sectionSubtitle="Get In Touch"
        sectionDescription="We're here to help with any questions you might have. Feel free to reach out to us and we'll get back to you as soon as possible."
        :showSocialLinks="true" />
    <div class="google-map google-map__contact">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.7498965995605!2d85.32228617453497!3d27.687025526389178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb191b975e3b81%3A0x60674a6cd53cbf4a!2sLawin%20and%20Partners!5e1!3m2!1sen!2snp!4v1756797619262!5m2!1sen!2snp" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
