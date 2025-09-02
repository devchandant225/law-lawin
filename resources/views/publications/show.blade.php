@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$publication->metatitle ?: $publication->title . ' - Legal Publication'" :description="$publication->metadescription ?: $publication->excerpt" :keywords="$publication->metakeywords" :image="$publication->feature_image_url" type="article" :post="$publication" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Procounsel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/procounsel.css') }}">

    @if ($publication->google_schema_json)
        <script type="application/ld+json">{!! $publication->google_schema_json !!}</script>
    @endif
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header background-black">
        <div class="container">
            <div class="text-center">
                <h1 class="sec-title__title--white">{{ $publication->title }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('publications.index') }}">Publications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($publication->title, 40) }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="background-gray pt-80 pb-120">
        <div style="padding: 0 12px;" class="">
            <div class="row">
                <!-- Sidebar - Table of Contents (Hidden on Mobile) -->
                <div class="col-lg-3 d-none d-lg-block">
                    @if ($tableOfContents->count() > 0)
                        <!-- Table of Contents Navigation -->
                        <div class="toc-sidebar-sticky">
                            <div class="card toc-navigation">
                                <div class="card-header background-base text-white">
                                    <h5 class="mb-0 d-flex align-items-center">
                                        <i class="fas fa-list-ol me-2"></i>
                                        Contents
                                    </h5>
                                </div>
                                <div class="card-body p-0">
                                    <nav class="toc-nav">
                                        @foreach ($tableOfContents as $content)
                                            <a href="#toc-section-{{ $content->id }}"
                                                class="toc-nav-link d-flex align-items-center text-decoration-none p-3 border-bottom"
                                                data-target="toc-section-{{ $content->id }}">
                                                <span
                                                    class="toc-number d-flex align-items-center justify-content-center me-3">
                                                    {{ $content->order_index ?? $loop->iteration }}
                                                </span>
                                                <span class="flex-fill">{{ Str::limit($content->title, 25) }}</span>
                                            </a>
                                        @endforeach
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main Content (Full width on mobile, 8/12 on desktop) -->
                <div class="col-12 col-lg-9">
                    <!-- Publication Header -->
                    <div class="publication-header-card card mb-40">
                        @if ($publication->feature_image_url)
                            <div class="publication-image-wrapper">
                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}"
                                    class="card-img-top publication-feature-image">
                            </div>
                        @endif
                        <div class="card-body p-4 p-md-5">
                            <h2 class="publication-summary-title mb-3">{{ $publication->title }}</h2>
                            @if ($publication->description)
                                <div class="publication-content">
                                    {!! $publication->description !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Table of Contents Content Sections -->
                    @if ($tableOfContents->count() > 0)
                        @foreach ($tableOfContents as $content)
                            <section id="toc-section-{{ $content->id }}" class="card toc-content-section mb-30">
                                <div class="card-body p-4 p-md-5">
                                    <div class="d-flex align-items-start mb-4">
                                        <div class="toc-section-number background-base text-white me-4">
                                            {{ $content->order_index ?? $loop->iteration }}
                                        </div>
                                        <div class="flex-fill">
                                            <h3 class="content-title mb-3">{{ $content->title }}</h3>
                                            @if ($content->description)
                                                <div class="toc-content">
                                                    {!! $content->description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endforeach
                    @endif

                    <!-- Team Members Section -->
                    @if (!empty($teamMembers) && count($teamMembers) > 0)
                        <section id="team-section" class="card team-section mt-40">
                            <div class="card-header background-primary text-white text-center">
                                <h3 class="mb-0">
                                    <i class="fas fa-users me-2"></i>
                                    Contributing Team Members
                                </h3>
                                <p class="mb-0 mt-2" style="color: rgb(39, 37, 37);">Meet the experts who contributed to
                                    this publication</p>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="row g-3">
                                    @foreach ($teamMembers as $member)
                                        <div class="col-md-4">
                                            <div class="team-member-item card h-100">
                                                <div class="card-body align-items-center">
                                                    <div class="me-3 flex-shrink-0">
                                                        @if ($member['image_url'])
                                                            <img src="{{ $member['image_url'] }}"
                                                                alt="{{ $member['name'] }}" class="team-member-avatar">
                                                        @else
                                                            <div
                                                                class="team-member-avatar-placeholder background-gray2 rounded-circle d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-user"
                                                                    style="color: var(--procounsel-base);"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-fill">
                                                        <h6 class="member-name">{{ $member['name'] }}</h6>
                                                        @if ($member['designation'])
                                                            <p class="text-muted small mb-2">{{ $member['designation'] }}
                                                            </p>
                                                        @endif
                                                        <div class="text-right">
                                                            <a href="{{ '/team' . '/' . $member['slug'] }}"
                                                                class="procounsel-btn procounsel-btn--two">
                                                                <i>View
                                                                    Details</i>
                                                                <span>View
                                                                    Details</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    <!-- FAQs Section -->
                    @if ($faqs->count() > 0)
                        <section id="faqs-section" class="card faq-section mt-40">
                            <div class="card-header background-primary text-white text-center">
                                <h3 class="mb-0">
                                    <i class="fas fa-question-circle me-2"></i>
                                    Frequently Asked Questions
                                </h3>
                                <p class="mb-0 mt-2" style="color: rgb(39, 37, 37);">Common questions about this publication
                                </p>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="accordion" id="faqAccordion">
                                    @foreach ($faqs as $faq)
                                        <div class="accordion-item mb-3">
                                            <h6 class="accordion-header" id="faq-heading-{{ $faq->id }}">
                                                <button
                                                    class="accordion-button collapsed faq-toggle d-flex align-items-center"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#faq-{{ $faq->id }}" aria-expanded="false"
                                                    aria-controls="faq-{{ $faq->id }}">
                                                    <i class="fas fa-question-circle me-3"
                                                        style="color: var(--procounsel-base);"></i>
                                                    {{ $faq->question }}
                                                </button>
                                            </h6>
                                            <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="faq-heading-{{ $faq->id }}"
                                                data-bs-parent="#faqAccordion">
                                                <div class="accordion-body background-gray">
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    <!-- Call to Action Section -->
                    <section class="card cta-section mt-40"
                        style="background: linear-gradient(135deg, var(--procounsel-primary) 0%, var(--procounsel-base) 100%);">
                        <div class="card-body text-center p-5">
                            <div class="icon-circle background-base mb-4 mx-auto">
                                <i class="fas fa-comments" style="color: var(--procounsel-white);"></i>
                            </div>
                            <h3 class="cta-title mb-4">Need More Information?</h3>
                            <p class="cta-description mb-4">
                                Have questions about this publication or need specific legal guidance? Our experienced team
                                is here to help.
                            </p>
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                                <a href="{{ url('/contact') }}" class="procounsel-btn">
                                    <i><i class="fas fa-phone me-2"></i>Get In Touch</i>
                                    <span><i class="fas fa-phone me-2"></i>Get In Touch</span>
                                </a>
                                <a href="{{ route('publications.index') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-book me-2"></i>More Publications
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth Scrolling for TOC Links
            const tocLinks = document.querySelectorAll('.toc-nav-link');
            const sections = document.querySelectorAll('[id^="toc-section-"], #team-section, #faqs-section');

            tocLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target') || this.getAttribute('href')
                        .substring(1);
                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {
                        // Remove active state from all links
                        tocLinks.forEach(l => {
                            l.classList.remove('toc-nav-active');
                        });

                        // Add active state to clicked link
                        this.classList.add('toc-nav-active');

                        // Smooth scroll to section with offset for fixed header
                        const headerOffset = 100;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Hide mobile TOC after clicking
                        if (window.innerWidth < 992) {
                            const collapse = bootstrap.Collapse.getInstance(document.getElementById(
                                'tocNavigation'));
                            if (collapse) {
                                collapse.hide();
                            }
                        }
                    }
                });
            });

            // Intersection Observer for Active TOC Item
            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -70% 0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Remove active state from all links
                        tocLinks.forEach(link => {
                            link.classList.remove('toc-nav-active');
                        });

                        // Find and activate corresponding TOC link
                        const correspondingLink = document.querySelector(
                            `[data-target="${entry.target.id}"], [href="#${entry.target.id}"]`);
                        if (correspondingLink) {
                            correspondingLink.classList.add('toc-nav-active');
                        }
                    }
                });
            }, observerOptions);

            // Observe all sections
            sections.forEach(section => {
                observer.observe(section);
            });

            // Mobile TOC Chevron Animation
            const tocToggleBtn = document.getElementById('tocToggle');
            const tocChevron = document.getElementById('tocChevron');

            if (tocToggleBtn && tocChevron) {
                tocToggleBtn.addEventListener('click', function() {
                    tocChevron.classList.toggle('rotated');
                });
            }

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
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Publication Page Custom Styles */

        /* Page Header Styling */
        .page-header {
            padding: 120px 0 80px;
            position: relative;
            background: linear-gradient(135deg, var(--procounsel-primary) 0%, var(--procounsel-black) 100%);
        }

        .page-header h1 {
            font-family: var(--procounsel-heading-font);
            font-size: 3rem;
            font-weight: 400;
            margin-bottom: 20px;
            color: var(--procounsel-white);
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }
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
            color: var(--procounsel-base);
        }

        .breadcrumb-item.active {
            color: var(--procounsel-text-dark);
        }

        /* Main Content Styles */
        .publication-header-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: var(--procounsel-white);
        }

        .publication-feature-image {
            height: 470px;
            object-fit: cover;
            width: 100%;
        }

        .publication-summary-title {
            font-family: var(--procounsel-heading-font);
            font-size: 2.2rem;
            font-weight: 400;
            color: var(--procounsel-black);
            margin-bottom: 20px;
        }

        .publication-excerpt p {
            font-size: 1.1rem;
            color: var(--procounsel-text);
            line-height: 1.8;
            margin-bottom: 0;
        }

        .publication-content {
            color: var(--procounsel-text);
            line-height: 1.8;
            font-size: 16px;
        }

        .publication-content h2 {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-black);
            font-size: 1.8rem;
            font-weight: 400;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .publication-content h3 {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-black);
            font-size: 1.5rem;
            font-weight: 400;
            margin-top: 25px;
            margin-bottom: 12px;
        }

        /* Table of Contents Sidebar - Sticky Functionality */
        .toc-sidebar-sticky {
            position: sticky;
            top: 30px;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .toc-navigation {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            background-color: var(--procounsel-white);
            max-height: calc(100vh - 100px);
            overflow: hidden;
        }

        .toc-nav-link {
            color: var(--procounsel-text);
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .toc-nav-link:hover {
            background-color: var(--procounsel-gray);
            color: var(--procounsel-black);
            border-left-color: var(--procounsel-base);
            transform: translateX(5px);
        }

        .toc-nav-link.toc-nav-active {
            background-color: var(--procounsel-base);
            color: var(--procounsel-white);
            border-left-color: var(--procounsel-primary);
            font-weight: 600;
        }

        .toc-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--procounsel-gray2);
            color: var(--procounsel-text);
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .toc-nav-link:hover .toc-number {
            background-color: var(--procounsel-primary);
            color: var(--procounsel-white);
        }

        .toc-nav-active .toc-number {
            background-color: var(--procounsel-white);
            color: var(--procounsel-base);
        }

        /* TOC Content Sections */
        .toc-content-section {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background-color: var(--procounsel-white);
        }

        .toc-content-section:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }

        .toc-section-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .content-title {
            font-family: var(--procounsel-heading-font);
            font-size: 1.8rem;
            font-weight: 400;
            color: var(--procounsel-black);
        }

        .toc-content {
            color: var(--procounsel-text);
            line-height: 1.8;
            font-size: 16px;
        }

        .toc-content h2 {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-black);
            font-size: 1.6rem;
            font-weight: 400;
            margin-top: 25px;
            margin-bottom: 12px;
        }

        .toc-content h3 {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-black);
            font-size: 1.4rem;
            font-weight: 400;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        /* Team Members Section */
        .team-section {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            background-color: var(--procounsel-white);
        }

        .team-member-item {
            background-color: var(--procounsel-gray);
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .team-member-item:hover {
            background-color: var(--procounsel-gray2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .team-member-avatar {
            width: 100%;
            height: 24rem;
            object-fit: cover;
            border: 3px solid var(--procounsel-white);
        }

        .team-member-avatar-placeholder {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .member-name {
            font-family: var(--procounsel-heading-font);
            font-size: 24px;
            padding: 8px 0 0 0;
            font-weight: 400;
            color: var(--procounsel-base);
        }

        /* FAQ Section */
        .faq-section {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            background-color: var(--procounsel-white);
        }

        .accordion-item {
            border: 1px solid var(--procounsel-border-color);
            border-radius: 8px;
            overflow: hidden;
        }

        .accordion-button {
            background-color: var(--procounsel-white);
            border: none;
            color: var(--procounsel-black);
            font-weight: 500;
            padding: 20px;
            font-family: var(--procounsel-font);
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--procounsel-gray);
            color: var(--procounsel-black);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(199, 149, 74, 0.25);
            border-color: var(--procounsel-base);
        }

        .accordion-body {
            padding: 20px;
            line-height: 1.8;
            color: var(--procounsel-text);
        }

        /* Call to Action Section */
        .cta-section {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
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

        /* Mobile Responsive */
        #tocChevron.rotated {
            transform: rotate(180deg);
        }

        /* Card Section Headers */
        .card-header {
            border-bottom: 1px solid var(--procounsel-border-color);
            padding: 20px;
        }

        .card-header h3 {
            font-family: var(--procounsel-heading-font);
            font-weight: 400;
            font-size: 1.6rem;
        }

        /* Smooth Transitions */
        * {
            scroll-behavior: smooth;
        }

        /* Hover Effects */
        .card:not(.no-hover) {
            transition: all 0.3s ease;
        }

        /* Content Typography */
        .publication-content p,
        .toc-content p {
            margin-bottom: 15px;
        }

        .publication-content ul,
        .publication-content ol,
        .toc-content ul,
        .toc-content ol {
            margin-bottom: 15px;
            padding-left: 30px;
        }

        .publication-content li,
        .toc-content li {
            margin-bottom: 5px;
        }

        /* Custom Scrollbar for TOC */
        .toc-nav {
            max-height: 400px;
            overflow-y: auto;
        }

        .toc-nav::-webkit-scrollbar {
            width: 6px;
        }

        .toc-nav::-webkit-scrollbar-track {
            background: var(--procounsel-gray2);
        }

        .toc-nav::-webkit-scrollbar-thumb {
            background: var(--procounsel-base);
            border-radius: 3px;
        }

        .toc-nav::-webkit-scrollbar-thumb:hover {
            background: var(--procounsel-primary);
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .publication-summary-title {
                font-size: 1.8rem;
            }

            .content-title {
                font-size: 1.5rem;
            }

            .toc-section-number {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        @media (max-width: 767px) {
            .page-header {
                padding: 80px 0 60px;
            }

            .icon-circle {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: var(--procounsel-base);
            color: #fff;
            font-weight: 600;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
                width: 100%;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 6px;
                padding: 10px;
                background-color: #fff;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                color: #2c3e50;
                text-align: left;
            }
        }
    </style>
@endpush
