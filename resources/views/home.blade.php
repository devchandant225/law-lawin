@extends('layouts.app')

@section('content')
    {{-- Banner Component --}}
    <div class="h-[80vh]">
        <x-banner :sliders="$sliders" />
    </div>

    {{-- Highlight Features Section --}}
    <x-highlight-section />

    {{-- About Section with Section Title Component --}}
    <section class="relative bg-white">
        <x-about-us />
    </section>

    {{-- Why Choose Us Section --}}
    <x-why-choose-us />

    <x-counter-section />
    <x-page-section-title title="<span>Services</span>" />

    <x-service-section :services="$services" :showViewAll="true" :limit="8" />


    {{-- Portfolio Section Title --}}
    <x-page-section-title title="<span>Testimonials</span>" />
    <x-testimonial />



    <x-page-section-title title="<span>Study Abroad</span>" />
    {{-- Publications Section --}}
    {{-- @livewire('publication-section', [
        'showViewAll' => true,
        'limit' => 8,
        'showSearch' => true,
    ]) --}}
    <x-publication-section />

    <x-page-section-title title="<span>Blogs & News</span>" />
    @livewire('blog-posts')

    {{-- Team Section Title --}}
    {{-- <x-page-section-title title="<span>Our Team</span>" /> --}}
    {{-- Team Section --}}
    {{-- <x-team-section :teams="$teams" :showViewAll="true" :showSectionHeader="false" :limit="4" /> --}}

    {{-- Contact Section Title --}}
    <x-page-section-title title="<span>Reach Out for Expert Study Abroad Guidance</span>" />
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
