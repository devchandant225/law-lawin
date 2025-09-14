@extends('layouts.app')

@section('content')
    {{-- Banner Component --}}
    <div class="h-[80vh]">
        <x-banner :sliders="$sliders" />
    </div>

    {{-- About Section with Section Title Component --}}
    <section class="relative bg-white">
        <x-about-us />
    </section>
    {{-- <x-why-choose-us /> --}}
    {{-- Services Section Title --}}
    <x-page-section-title title="<span>Services</span>" />
    {{-- Services Section --}}
    <x-service-section :services="$services" :showViewAll="true" :limit="8" />

    {{-- Practices Section Title --}}
    <x-page-section-title title="<span>Practices</span>" />
    {{-- Practices Section --}}
    <x-practice-section :showViewAll="true" :limit="8" />

    {{-- Portfolio Section Title --}}
    <x-page-section-title title="<span>Our Portfolio</span>" />
    {{-- Portfolio Section --}}
    <x-portfolio-section :portfolios="$portfolios" :showViewAll="true" :limit="10" />

    {{-- Testimonial Section - Clients We Served --}}
    {{-- <x-testimonial-section :portfolios="$portfolios" :limit="8" sectionTitle="<span class=''>Clients We Served</span>"
        sectionSubtitle="Our Happy Clients" /> --}}

    {{-- Publications Section Title --}}
    <x-page-section-title title="<span>Publications</span>" />
    {{-- Publications Section --}}
    @livewire('publication-section', [
        'showViewAll' => true,
        'limit' => 8,
        'showSearch' => true
    ])
    {{-- Team Section Title --}}
    <x-page-section-title title="<span>Our Team</span>" />
    {{-- Team Section --}}
    <x-team-section :teams="$teams" :showViewAll="true" :showSectionHeader="false" :limit="4" />

    {{-- Contact Section Title --}}
    <x-page-section-title title="<span>Reach out for the best Legal Advice</span>" />
    {{-- Contact Section --}}
    <x-contact-section :contactInfo="[
        'address' => 'Fishing Harbour - Jumeira St - Umm Suqeim - Umm Suqeim 2 - Dubai',
        'phone' => '+9779841933745',
        'email' => 'info@lawinpartners.com',
        'workingHours' => [
            'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
            'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
        ],
    ]" :showSocialLinks="true" />
@endsection
