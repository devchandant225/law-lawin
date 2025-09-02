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
        <iframe title="template google map"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
            class="map__contact" allowfullscreen></iframe>
    </div>
@endsection
