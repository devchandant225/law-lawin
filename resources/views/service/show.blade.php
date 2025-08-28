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
    <section class="service-details-section">
        <div class="container">
            <div class="row">
                <!-- Main Content - 70% -->
                <div class="col-lg-8 col-md-12">
                    <!-- Service Content Card -->
                    <div class="service-content-card">
                        <div class="service-header">
                            @if ($service->feature_image_url)
                                <div class="service-image">
                                    <img src="{{ $service->feature_image_url }}" alt="{{ $service->title }}" class="img-fluid">
                                </div>
                            @endif
                            <h1 class="service-title">{{ $service->title }}</h1>
                            @if ($service->excerpt)
                                <p class="service-excerpt">{{ $service->excerpt }}</p>
                            @endif
                        </div>
                        
                        <div class="service-description">
                            {!! $service->description !!}
                        </div>
                    </div>

                    <!-- Key Benefits Section -->
                    <div class="benefits-section">
                        <h3 class="benefits-title">
                            <i class="fas fa-check-circle"></i>
                            Key Benefits & Features
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <i class="fas fa-gavel"></i>
                                    </div>
                                    <div class="benefit-content">
                                        <h5>Expert Legal Guidance</h5>
                                        <p>Professional advice from experienced legal experts</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="benefit-content">
                                        <h5>Confidential Service</h5>
                                        <p>Complete privacy and confidentiality guaranteed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <i class="fas fa-bolt"></i>
                                    </div>
                                    <div class="benefit-content">
                                        <h5>Fast Resolution</h5>
                                        <p>Quick and efficient handling of your legal matters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="benefit-item">
                                    <div class="benefit-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="benefit-content">
                                        <h5>Professional Team</h5>
                                        <p>Experienced legal professionals at your service</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - 30% -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-sticky">
                        <!-- More Services -->
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fas fa-list-ul"></i>
                                More Services
                            </h4>
                            <div class="more-services-list">
                                @if ($relatedServices->count() > 0)
                                    @foreach ($relatedServices as $relatedService)
                                        <div class="service-item">
                                            <div class="service-item-image">
                                                @if ($relatedService->feature_image_url)
                                                    <img src="{{ $relatedService->feature_image_url }}" alt="{{ $relatedService->title }}" class="img-fluid">
                                                @else
                                                    <div class="placeholder-image">
                                                        <i class="fas fa-briefcase"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="service-item-content">
                                                <h6><a href="{{ route('service.show', $relatedService->slug) }}">{{ $relatedService->title }}</a></h6>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fas fa-share-alt"></i>
                                Share This Service
                            </h4>
                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="social-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}" target="_blank" class="social-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="social-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($service->title . ' - ' . request()->url()) }}" target="_blank" class="social-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fas fa-envelope"></i>
                                Contact Us
                            </h4>
                            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="fullname">Full Name *</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your full name" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number">
                                </div>
                                
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" value="Inquiry about {{ $service->title }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message" class="form-control" rows="4" placeholder="Write your message here..." required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-contact">
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
@endsection

@push('styles')
    <style>
        /* Service Details Page Styles */
        .service-details-section {
            padding: 60px 0;
            background-color: var(--procounsel-gray);
            font-family: var(--procounsel-font);
        }

        .service-content-card {
            background: var(--procounsel-white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--procounsel-border-color);
        }

        .service-header {
            margin-bottom: 30px;
        }

        .service-image {
            margin-bottom: 25px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .service-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .service-image:hover img {
            transform: scale(1.05);
        }

        .service-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .service-excerpt {
            color: var(--procounsel-text);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .service-description {
            color: var(--procounsel-text-dark);
            line-height: 1.7;
            font-size: 1rem;
        }

        .service-description h2, .service-description h3, .service-description h4 {
            color: var(--procounsel-primary);
            font-family: var(--procounsel-heading-font);
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .service-description p {
            margin-bottom: 15px;
        }

        .service-description ul, .service-description ol {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .service-description li {
            margin-bottom: 8px;
        }

        /* Benefits Section */
        .benefits-section {
            background: linear-gradient(135deg, var(--procounsel-gray) 0%, var(--procounsel-white) 100%);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid var(--procounsel-border-color);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .benefits-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .benefits-title i {
            color: var(--procounsel-base);
        }

        .benefit-item {
            background: var(--procounsel-white);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--procounsel-border-color);
            display: flex;
            align-items: flex-start;
            gap: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .benefit-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .benefit-icon {
            width: 50px;
            height: 50px;
            background: var(--procounsel-base);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .benefit-icon i {
            color: var(--procounsel-white);
            font-size: 1.2rem;
        }

        .benefit-content h5 {
            color: var(--procounsel-primary);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .benefit-content p {
            color: var(--procounsel-text);
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Sidebar Styles */
        .sidebar-sticky {
            position: sticky;
            top: 30px;
        }

        .sidebar-card {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--procounsel-border-color);
        }

        .sidebar-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-title i {
            color: var(--procounsel-base);
        }

        /* More Services Styles */
        .service-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
        }

        .service-item:hover {
            background-color: var(--procounsel-gray);
        }

        .service-item-image {
            width: 80px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .service-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-image i {
            color: var(--procounsel-white);
            font-size: 1.5rem;
        }

        .service-item-content h6 {
            margin: 0 0 8px 0;
            font-size: 1rem;
            line-height: 1.3;
        }

        .service-item-content h6 a {
            color: var(--procounsel-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .service-item-content h6 a:hover {
            color: var(--procounsel-base);
        }

        .service-item-content p {
            color: var(--procounsel-text);
            font-size: 0.85rem;
            line-height: 1.4;
            margin: 0;
        }

        /* Social Share Styles */
        .social-share {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            color: var(--procounsel-white);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: var(--procounsel-white);
            text-decoration: none;
        }

        .social-btn.facebook {
            background-color: #1877f2;
        }

        .social-btn.twitter {
            background-color: #1da1f2;
        }

        .social-btn.linkedin {
            background-color: #0077b5;
        }

        .social-btn.whatsapp {
            background-color: #25d366;
        }

        /* Contact Form Styles */
        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            color: var(--procounsel-primary);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }

        .contact-form .form-control {
            border: 2px solid var(--procounsel-border-color);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: var(--procounsel-white);
            color: var(--procounsel-primary);
        }

        .contact-form .form-control:focus {
            border-color: var(--procounsel-base);
            box-shadow: 0 0 0 0.2rem rgba(199, 149, 74, 0.25);
            outline: none;
        }

        .contact-form .form-control::placeholder {
            color: var(--procounsel-text-gray);
        }

        .btn-contact {
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: var(--procounsel-white);
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-contact:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(199, 149, 74, 0.3);
            color: var(--procounsel-white);
        }

        .btn-contact:focus {
            box-shadow: 0 0 0 0.2rem rgba(199, 149, 74, 0.5);
            outline: none;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .service-details-section {
                padding: 40px 0;
            }
            
            .service-content-card {
                padding: 25px;
                margin-bottom: 25px;
            }
            
            .service-title {
                font-size: 2rem;
            }
            
            .sidebar-card {
                padding: 25px;
                margin-bottom: 20px;
            }
            
            .sidebar-sticky {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .service-content-card {
                padding: 20px;
            }
            
            .service-title {
                font-size: 1.8rem;
            }
            
            .sidebar-card {
                padding: 20px;
            }
            
            .benefit-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .service-item {
                flex-direction: column;
                text-align: center;
            }
            
            .service-item-image {
                width: 100%;
                height: 120px;
            }
        }

        @media (max-width: 575.98px) {
            .service-details-section {
                padding: 30px 0;
            }
            
            .service-content-card {
                padding: 15px;
            }
            
            .sidebar-card {
                padding: 15px;
            }
            
            .service-title {
                font-size: 1.5rem;
            }
            
            .social-btn {
                width: 40px;
                height: 40px;
            }
        }

        /* Custom animations */
        .service-content-card, .sidebar-card {
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
            border-top: 2px solid var(--procounsel-white);
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
