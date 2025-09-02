@extends('layouts.app')

@section('head')
    <x-meta-tags />
@endsection

@section('content')
    {{-- Banner Component --}}
    <x-banner :sliders="$sliders" />

    {{-- About Section with Section Title Component --}}
    <section class="relative bg-white">
        <x-about-us />
    </section>
    {{-- <x-why-choose-us /> --}}
    {{-- Services Section --}}
    <x-service-section :services="$services" :showViewAll="true" :limit="8" sectionTitle="<span class=''>Services</span>"
        sectionSubtitle="Professional Legal Services"
        sectionDescription="We provide comprehensive legal services with expertise and dedication to serve our clients' needs across various practice areas." />

    {{-- Publications Section --}}
    <x-practice-section :showViewAll="true" :limit="8" sectionTitle="<span class=''>Practices</span>"
        sectionSubtitle="Legal Knowledge Base"
        sectionDescription="Explore our comprehensive collection of legal practice, research papers, and expert insights covering various areas of law." />

    {{-- Portfolio Section --}}
    {{-- <x-portfolio-section :portfolios="$portfolios" :showViewAll="true" :limit="10"
        sectionTitle="<span class=''>Our Portfolio</span>"
        sectionSubtitle="Our Latest Work"
        sectionDescription="Explore our diverse portfolio of successful projects and see how we bring ideas to life with creativity and expertise." /> --}}

    {{-- Testimonial Section - Clients We Served --}}
    <x-testimonial-section :portfolios="$portfolios" :limit="8" sectionTitle="<span class=''>Clients We Served</span>"
        sectionSubtitle="Our Happy Clients" />

   {{-- Publications Section --}}
    @livewire('publication-section', [
        'showViewAll' => true, 
        'limit' => 8, 
        'showSearch' => true,
        'sectionTitle' => '<span class="">Publications</span>',
        'sectionSubtitle' => 'Legal Knowledge & Resources',
        'sectionDescription' => 'Explore our comprehensive collection of legal publications, research papers, and expert insights covering various areas of law.'
    ])
    {{-- Team Section --}}
    <x-team-section :teams="$teams" :showViewAll="true" :showSectionHeader="true" :limit="4"
        sectionTitle="<span class=''>Our Team</span>" sectionSubtitle="Meet Our Legal Professionals"
        sectionDescription="Our experienced team of legal experts is dedicated to providing exceptional service and achieving the best outcomes for our clients." />
    <x-process-steps />
    {{-- Contact Section --}}
    <x-contact-section :contactInfo="[
        'address' => 'Fishing Harbour - Jumeira St - Umm Suqeim - Umm Suqeim 2 - Dubai',
        'phone' => '+9779841933745',
        'email' => 'info@lawinpartners.com',
        'workingHours' => [
            'weekdays' => 'Monday - Friday: 9:00 AM - 6:00 PM',
            'weekend' => 'Saturday - Sunday: 8:00 AM - 8:00 PM',
        ],
    ]" sectionTitle="<span class=''>Reach out for the best Legal Advice</span>"
        sectionSubtitle="Get In Touch"
        sectionDescription="We're here to help with any questions you might have. Feel free to reach out to us and we'll get back to you as soon as possible."
        :showSocialLinks="true" />
@endsection
