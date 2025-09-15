@extends('layouts.app')

@section('head')
    <title>About Furusato Education Consultancy - Your Gateway to Global Education</title>
    <meta name="description"
        content="Learn about Furusato Education Consultancy, Nepal's trusted partner for study abroad programs in USA, UK, Japan, Australia and more. Expert guidance for your educational journey.">
    <meta name="keywords"
        content="Furusato Education, Study Abroad Nepal, Education Consultancy, USA Study, UK Study, Japan Study, Australia Study">
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="About Furusato Education" subtitle="Your Gateway to Global Education Excellence" :backgroundImage="'https://picsum.photos/1920/1080?random=1'"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'About Us']]" />

    {{-- About Introduction --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                        Empowering Dreams Through Global Education
                    </h2>
                    <div class="w-24 h-1 bg-primary mb-6"></div>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        Located in the heart of Kathmandu, opposite Padmakanya Campus in Bagbazar, Furusato Education Center
                        has been a beacon of hope for countless students aspiring to study abroad. We specialize in
                        providing comprehensive education consultancy services that transform academic dreams into reality.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Our team of experienced counselors and education experts understand the complexities of
                        international education systems. We provide personalized guidance for studying in top destinations
                        including the USA, UK, Japan, Australia, and Canada, ensuring each student finds the perfect
                        academic path for their future.
                    </p>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">500+</div>
                            <div class="text-sm text-gray-600">Students Guided</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-secondary mb-2">5+</div>
                            <div class="text-sm text-gray-600">Countries</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">95%</div>
                            <div class="text-sm text-gray-600">Success Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://picsum.photos/600/400?random=2" alt="Furusato Education Consultancy Office"
                            class="w-full h-auto object-cover">
                    </div>
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg border">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Expert Guidance</div>
                                <div class="text-sm text-gray-600">Since 2020</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <x-mission-vision title="Our Mission & Vision" subtitle="Driving excellence in international education consulting"
        mission="To provide exceptional education consulting services that empower students to achieve their academic dreams abroad. We are committed to delivering personalized guidance, comprehensive support, and expert advice throughout every step of the study abroad journey."
        vision="To become the most trusted and innovative education consultancy in Nepal, recognized for transforming students' lives through quality education opportunities worldwide. We envision a future where every deserving student has access to world-class education regardless of their background." />

    {{-- Why Choose Us --}}
    <x-why-choose-us title="Why Choose Furusato Education?"
        subtitle="Discover what makes us Nepal's premier education consultancy" />

    {{-- Testimonials --}}
    <x-testimonial />

    {{-- CTA Section --}}
    <x-cta-section title="Ready to Start Your Global Education Journey?"
        subtitle="Take the first step towards your international education goals. Our expert counselors are here to guide you every step of the way."
        primaryText="Book Free Consultation" secondaryText="Explore Programs" :primaryUrl="route('contact')" :secondaryUrl="'#programs'" />
@endsection

@push('styles')
    <style>
        /* Custom animations for the about page */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover effects for stats */
        .stat-card:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }
    </style>
@endpush
