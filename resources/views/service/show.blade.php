@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$service->meta_title ?: $service->title . ' - Professional Legal Service'" :description="$service->meta_description ?: $service->excerpt" :keywords="$service->meta_keywords" :image="$service->feature_image_url" type="service" :post="$service" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner 
        :title="$service->title" 
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Service', 'url' => route('services.index')],
            ['label' => $service->title]
        ]"
    />

    {{-- Main Content Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content - 70% -->
                <div class="lg:w-2/3 w-full">
                    <!-- Service Content Card -->
                    <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-10 mb-8 border border-gray-200 animate-fade-in-up">
                        <div class="mb-8">
                            @if ($service->feature_image_url)
                                <div class="mb-6 rounded-2xl overflow-hidden group">
                                    <img src="{{ $service->feature_image_url }}" alt="{{ $service->title }}" class="w-full h-72 object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @endif
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-blue-900 mb-4 leading-tight">{{ $service->title }}</h1>
                            @if ($service->excerpt)
                                <p class="text-gray-700 text-lg leading-relaxed">{{ $service->excerpt }}</p>
                            @endif
                        </div>
                        
                        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                            {!! $service->description !!}
                        </div>
                    </div>

                    <!-- Key Benefits Section -->
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-6 sm:p-10 border border-gray-200 shadow-lg animate-fade-in-up">
                        <h3 class="flex items-center gap-4 text-2xl sm:text-3xl font-semibold text-blue-900 mb-8">
                            <i class="fas fa-check-circle text-primary"></i>
                            Key Benefits & Features
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-gavel text-white text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-blue-900 font-semibold mb-2 text-lg">Expert Legal Guidance</h5>
                                    <p class="text-gray-600 text-sm leading-relaxed">Professional advice from experienced legal experts</p>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-shield-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-blue-900 font-semibold mb-2 text-lg">Confidential Service</h5>
                                    <p class="text-gray-600 text-sm leading-relaxed">Complete privacy and confidentiality guaranteed</p>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-bolt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-blue-900 font-semibold mb-2 text-lg">Fast Resolution</h5>
                                    <p class="text-gray-600 text-sm leading-relaxed">Quick and efficient handling of your legal matters</p>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-users text-white text-lg"></i>
                                </div>
                                <div>
                                    <h5 class="text-blue-900 font-semibold mb-2 text-lg">Professional Team</h5>
                                    <p class="text-gray-600 text-sm leading-relaxed">Experienced legal professionals at your service</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - 30% -->
                <div class="lg:w-1/3 w-full">
                    <div class="lg:sticky lg:top-8 space-y-6">
                        <!-- More Services -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 animate-fade-in-up">
                            <h4 class="flex items-center gap-3 text-xl font-semibold text-blue-900 mb-6">
                                <i class="fas fa-list-ul text-primary"></i>
                                More Services
                            </h4>
                            <div class="space-y-4">
                                @if ($relatedServices->count() > 0)
                                    @foreach ($relatedServices as $relatedService)
                                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                                            <div class="w-20 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                                @if ($relatedService->feature_image_url)
                                                    <img src="{{ $relatedService->feature_image_url }}" alt="{{ $relatedService->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-primary to-blue-900 flex items-center justify-center">
                                                        <i class="fas fa-briefcase text-white text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="font-semibold text-blue-900 hover:text-primary transition-colors duration-300 leading-tight">
                                                    <a href="{{ route('service.show', $relatedService->slug) }}">{{ $relatedService->title }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 animate-fade-in-up">
                            <h4 class="flex items-center gap-3 text-xl font-semibold text-blue-900 mb-6">
                                <i class="fas fa-share-alt text-primary"></i>
                                Share This Service
                            </h4>
                            <div class="flex justify-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}" target="_blank" class="w-11 h-11 bg-sky-500 rounded-xl flex items-center justify-center text-white hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="w-11 h-11 bg-blue-700 rounded-xl flex items-center justify-center text-white hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($service->title . ' - ' . request()->url()) }}" target="_blank" class="w-11 h-11 bg-green-500 rounded-xl flex items-center justify-center text-white hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200 animate-fade-in-up">
                            <h4 class="flex items-center gap-3 text-xl font-semibold text-blue-900 mb-6">
                                <i class="fas fa-envelope text-primary"></i>
                                Contact Us
                            </h4>
                            <form class="space-y-5" action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="fullname" class="block text-blue-900 font-semibold text-sm mb-2">Full Name *</label>
                                    <input type="text" id="fullname" name="fullname" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-primary focus:ring-4 focus:ring-primary/25 outline-none transition-all duration-300" placeholder="Enter your full name" required>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-blue-900 font-semibold text-sm mb-2">Email *</label>
                                    <input type="email" id="email" name="email" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-primary focus:ring-4 focus:ring-primary/25 outline-none transition-all duration-300" placeholder="Enter your email" required>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-blue-900 font-semibold text-sm mb-2">Phone</label>
                                    <input type="tel" id="phone" name="phone" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-primary focus:ring-4 focus:ring-primary/25 outline-none transition-all duration-300" placeholder="Enter your phone number">
                                </div>
                                
                                <div>
                                    <label for="subject" class="block text-blue-900 font-semibold text-sm mb-2">Subject *</label>
                                    <input type="text" id="subject" name="subject" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-primary focus:ring-4 focus:ring-primary/25 outline-none transition-all duration-300" placeholder="Enter subject" value="Inquiry about {{ $service->title }}" required>
                                </div>
                                
                                <div>
                                    <label for="message" class="block text-blue-900 font-semibold text-sm mb-2">Message *</label>
                                    <textarea id="message" name="message" rows="4" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-primary focus:ring-4 focus:ring-primary/25 outline-none transition-all duration-300 resize-none" placeholder="Write your message here..." required></textarea>
                                </div>
                                
                                <button type="submit" class="bg-primary hover:bg-primary/90 w-full text-white font-semibold py-3 px-6 rounded-xl hover:-translate-y-0.5 hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-paper-plane"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <x-cta-section 
        :title="'Need Help with ' . $service->title . '?'"
        :subtitle="'Our experienced legal team is ready to assist you. Contact us today for professional guidance and expert advice.'"
        :primaryText="'Get Free Consultation'"
        :secondaryText="'View All Services'"
        :primaryUrl="route('contact')"
        :secondaryUrl="route('services.index')"
    />
@endsection

@push('styles')
    <style>
        /* Custom animation for fade in up effect */
        .animate-fade-in-up {
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

        /* Enhanced prose styling for service description */
        .prose h2, .prose h3, .prose h4 {
            @apply text-blue-900 font-bold mt-6 mb-4;
        }

        .prose p {
            @apply mb-4;
        }

        .prose ul, .prose ol {
            @apply pl-5 mb-4;
        }

        .prose li {
            @apply mb-2;
        }

        /* Form loading state */
        .btn-loading {
            @apply pointer-events-none opacity-70;
        }

        .btn-loading::after {
            content: "";
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endpush
