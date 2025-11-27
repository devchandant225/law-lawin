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
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content - 70% -->
                <div class="lg:w-8/12 w-full">
                    <!-- Service Content Card -->
                    <div class="bg-white rounded-3xl shadow p-8 mb-8 animate-fade-in">
                        <div class="mb-8">
                            @if ($service->feature_image_url)
                                <div class="mb-6 rounded-2xl overflow-hidden relative group">
                                    <img src="{{ $service->feature_image_url }}" alt="{{ $service->title }}" class="w-full h-[450px] object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @endif
                            <h1 class="text-4xl font-bold text-primary mb-4 leading-tight">{{ $service->title }}</h1>
                            @if ($service->excerpt)
                                <p class="text-gray-700 text-lg leading-relaxed">{{ $service->excerpt }}</p>
                            @endif
                        </div>
                        
                        <div class="prose prose-lg max-w-none">
                            {!! $service->description !!}
                        </div>
                    </div>

                    <!-- Key Benefits Section -->
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 shadow animate-fade-in">
                        <h3 class="text-2xl font-semibold text-primary mb-8 flex items-center gap-4">
                            <i class="fas fa-check-circle bg-primary"></i>
                            Key Benefits & Features
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0 mb-4">
                                    <i class="fas fa-gavel text-white text-xl"></i>
                                </div>
                                <h5 class="text-lg font-semibold text-primary mb-2">Expert Legal Guidance</h5>
                                <p class="text-gray-600 text-sm leading-relaxed">Professional advice from experienced legal experts</p>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0 mb-4">
                                    <i class="fas fa-shield-alt text-white text-xl"></i>
                                </div>
                                <h5 class="text-lg font-semibold text-primary mb-2">Confidential Service</h5>
                                <p class="text-gray-600 text-sm leading-relaxed">Complete privacy and confidentiality guaranteed</p>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0 mb-4">
                                    <i class="fas fa-bolt text-white text-xl"></i>
                                </div>
                                <h5 class="text-lg font-semibold text-primary mb-2">Fast Resolution</h5>
                                <p class="text-gray-600 text-sm leading-relaxed">Quick and efficient handling of your legal matters</p>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center flex-shrink-0 mb-4">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                                <h5 class="text-lg font-semibold text-primary mb-2">Professional Team</h5>
                                <p class="text-gray-600 text-sm leading-relaxed">Experienced legal professionals at your service</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - 30% -->
                <div class="lg:w-4/12 w-full">
                    <div class="sticky top-8 space-y-6">
                        <!-- More Services -->
                        <div class="bg-white rounded-3xl p-6 shadow animate-fade-in">
                            <h4 class="text-xl font-semibold text-primary mb-6 flex items-center gap-3">
                                <i class="fas fa-list-ul bg-primary"></i>
                                More Services
                            </h4>
                            <div class="space-y-4">
                                @if ($relatedServices->count() > 0)
                                    @foreach ($relatedServices as $relatedService)
                                        <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                                            <div class="w-20 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                                @if ($relatedService->feature_image_url)
                                                    <img src="{{ $relatedService->feature_image_url }}" alt="{{ $relatedService->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-primary flex items-center justify-center">
                                                        <i class="fas fa-briefcase text-white text-xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="text-base font-semibold text-primary mb-1 leading-tight">
                                                    <a href="{{ route('service.show', $relatedService->slug) }}" class="transition-colors duration-200">{{ $relatedService->title }}</a>
                                                </h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="bg-white rounded-3xl p-6 shadow animate-fade-in">
                            <h4 class="text-xl font-semibold text-primary mb-6 flex items-center gap-3">
                                <i class="fas fa-share-alt bg-primary"></i>
                                Share This Service
                            </h4>
                            <div class="flex justify-center gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-white hover:bg-blue-700 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}" target="_blank" class="w-12 h-12 rounded-xl bg-blue-400 flex items-center justify-center text-white hover:bg-blue-500 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="w-12 h-12 rounded-xl bg-blue-700 flex items-center justify-center text-white hover:bg-blue-800 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($service->title . ' - ' . request()->url()) }}" target="_blank" class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center text-white hover:bg-green-600 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="bg-white rounded-3xl p-6 shadow animate-fade-in">
                            <h4 class="text-xl font-semibold text-primary mb-6 flex items-center gap-3">
                                <i class="fas fa-envelope bg-primary"></i>
                                Contact Us
                            </h4>
                            <form class="space-y-4" action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="fullname" class="block text-sm font-semibold text-primary mb-2">Full Name *</label>
                                    <input type="text" id="fullname" name="fullname" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/25 transition-all duration-200 bg-white text-gray-800" placeholder="Enter your full name" required>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-primary mb-2">Email *</label>
                                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/25 transition-all duration-200 bg-white text-gray-800" placeholder="Enter your email" required>
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-primary mb-2">Phone</label>
                                    <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/25 transition-all duration-200 bg-white text-gray-800" placeholder="Enter your phone number">
                                </div>
                                
                                <div>
                                    <label for="subject" class="block text-sm font-semibold text-primary mb-2">Subject *</label>
                                    <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/25 transition-all duration-200 bg-white text-gray-800" placeholder="Enter subject" value="Inquiry about {{ $service->title }}" required>
                                </div>
                                
                                <div>
                                    <label for="message" class="block text-sm font-semibold text-primary mb-2">Message *</label>
                                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/25 transition-all duration-200 bg-white text-gray-800 resize-none" placeholder="Write your message here..." required></textarea>
                                </div>
                                
                                <button type="submit" class="w-full py-3 font-semibold text-white bg-gradient-to-r from-primary to-secondary rounded-xl hover:shadow-lg transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
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

@push('styles')
    <style>
        /* Custom animations */
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
        
        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Loading animation for form submission */
        .btn-contact.loading {
            pointer-events: none;
            opacity: 0.7;
        }
        
        .btn-contact.loading::after {
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
        
        /* Custom prose styling for service description */
        .prose h2, .prose h3, .prose h4 {
            color: text-primary;
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 1em;
        }
        
        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.7;
        }
        
        .prose ul, .prose ol {
            padding-left: 1.5em;
            margin-bottom: 1.5em;
        }
        
        .prose li {
            margin-bottom: 0.5em;
        }
    </style>
@endpush
