@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags title="Languages - Legal Language Services"
        description="Explore our comprehensive legal language services and multi-lingual support capabilities."
        keywords="legal languages, multi-lingual services, translation, interpretation" />
@endsection

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Procounsel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/procounsel.css') }}">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Languages - Legal Language Services",
        "description": "Explore our comprehensive legal language services and multi-lingual support capabilities.",
        "url": "{{ url()->current() }}",
        "mainEntity": {
            "@type": "ItemList",
            "numberOfItems": {{ $languages->total() }},
            "itemListElement": [
                @foreach($languages as $index => $language)
                {
                    "@type": "Service",
                    "position": {{ $index + 1 }},
                    "name": "{{ $language->title }}",
                    "description": "{{ $language->excerpt ?? 'Legal language service' }}",
                    "url": "{{ route('languages.show', $language->slug) }}"
                }@if(!$loop->last),@endif
                @endforeach
            ]
        }
    }
    </script>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header background-primary">
        <div class="container">
            <div class="text-center">
                <h1 class="sec-title__title--white">Languages</h1>
                <p class="page-subtitle text-white">
                    Comprehensive legal language services and multi-lingual support
                </p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Languages</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Languages Content Section -->
    <section class="background-gray pt-80 pb-120">
        <div class="container">
            <!-- Page Introduction -->
            <div class="row justify-content-center mb-60">
                <div class="col-lg-8 text-center">
                    <div class="sec-title">
                        <h2 class="sec-title__title text-center">
                            Our Language Services
                        </h2>
                        <p class="sec-title__text">
                            We provide professional legal services in multiple languages to better serve our diverse clients. 
                            Our multilingual capabilities ensure clear communication and understanding throughout your legal journey.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Language Services Section -->
            <div class="row">
                <div class="col-12">
                    <livewire:language-section :per-page="12" />
                </div>
            </div>

            <!-- Contact CTA Section -->
            <div class="row justify-content-center mt-80">
                <div class="col-lg-10">
                    <div class="card language-cta-section" 
                         style="background: linear-gradient(135deg, var(--procounsel-base) 0%, var(--procounsel-primary) 100%);">
                        <div class="card-body text-center p-5">
                            <div class="icon-circle background-white mb-4 mx-auto">
                                <i class="fas fa-globe" style="color: var(--procounsel-base);"></i>
                            </div>
                            <h3 class="cta-title mb-4">Need Services in Your Language?</h3>
                            <p class="cta-description mb-4">
                                Our multilingual team is ready to assist you in your preferred language. 
                                Contact us to discuss your legal needs and language preferences.
                            </p>
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                                <a href="{{ url('/contact') }}" class="procounsel-btn procounsel-btn--white">
                                    <i><i class="fas fa-comments me-2"></i>Contact Us</i>
                                    <span><i class="fas fa-comments me-2"></i>Contact Us</span>
                                </a>
                                <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-info-circle me-2"></i>Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form Component -->
        <x-publication-contact-form />
    </section>
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Card hover animation
            const cards = document.querySelectorAll('.card:not(.no-hover)');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Smooth scrolling for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    
                    if (targetSection) {
                        const headerOffset = 100;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Languages Page Custom Styles */

        /* Page Header Styling */
        .page-header {
            padding: 120px 0 80px;
            position: relative;
            background: linear-gradient(135deg, var(--procounsel-primary) 0%, var(--procounsel-base) 100%);
        }

        .page-header h1 {
            font-family: var(--procounsel-heading-font);
            font-size: 3.5rem;
            font-weight: 400;
            margin-bottom: 20px;
            color: var(--procounsel-white);
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }
        }

        .page-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--procounsel-white);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--procounsel-text-light);
        }

        .breadcrumb-item.active {
            color: var(--procounsel-text-light);
        }

        /* Section Title */
        .sec-title__title {
            font-family: var(--procounsel-heading-font);
            font-size: 3rem;
            font-weight: 400;
            color: var(--procounsel-black);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .sec-title__title {
                font-size: 2.2rem;
            }
        }

        .sec-title__text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--procounsel-text);
            margin-bottom: 0;
        }

        /* Call to Action Section */
        .language-cta-section {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .cta-title {
            font-family: var(--procounsel-heading-font);
            font-size: 2.5rem;
            font-weight: 400;
            color: var(--procounsel-white);
        }

        @media (max-width: 768px) {
            .cta-title {
                font-size: 2rem;
            }
        }

        .cta-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .page-header {
                padding: 80px 0 60px;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .sec-title__title {
                font-size: 2rem;
            }
        }

        /* Card hover effects */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover:not(.no-hover) {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush
