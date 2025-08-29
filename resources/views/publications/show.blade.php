@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$publication->metatitle ?: $publication->title . ' - Legal Publication'" :description="$publication->metadescription ?: $publication->excerpt" :keywords="$publication->metakeywords" :image="$publication->feature_image_url" type="article" :post="$publication" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Procounsel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/procounsel.css') }}">
    
    @if($publication->google_schema_json)
        <script type="application/ld+json">{!! $publication->google_schema_json !!}</script>
    @endif
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header background-base">
        <div class="container">
            <div class="page-header__content">
                <h1>{{ $publication->title }}</h1>
                <nav class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('publications.index') }}">Publications</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($publication->title, 40) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="pt-120 pb-120 background-gray">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-xl-8 col-lg-7">
                    <!-- Featured Image -->
                    @if($publication->feature_image_url)
                        <div class="publication-featured-image mb-50">
                            <div class="publication-image-card">
                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}" class="img-fluid rounded">
                                <div class="publication-image-overlay">
                                    <div class="overlay-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Publication Summary -->
                    @if($publication->excerpt)
                        <div class="publication-summary-card mb-50">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start">
                                        <div class="summary-icon me-4">
                                            <div class="icon-circle background-base">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div class="summary-content flex-grow-1">
                                            <h3 class="publication-summary-title mb-3">Publication Summary</h3>
                                            <div class="publication-excerpt">
                                                <p>{{ $publication->excerpt }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content -->
                    @if($publication->description)
                        <div class="publication-content-card mb-50">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="content-title mb-4">
                                        <span class="block-title__decor me-2"></span>
                                        Publication Content
                                    </h3>
                                    <div class="publication-content">
                                        {!! $publication->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Table of Contents -->
                    @if($tableOfContents->count() > 0)
                        <div class="table-of-contents-card mb-50">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header background-base">
                                    <h3 class="text-white mb-0 d-flex align-items-center">
                                        <div class="toc-icon me-3">
                                            <i class="fas fa-list-ol"></i>
                                        </div>
                                        Table of Contents
                                    </h3>
                                </div>
                                <div class="card-body p-4">
                                    <div class="table-of-contents-list">
                                        @foreach($tableOfContents as $content)
                                            <div class="toc-item d-flex align-items-start mb-3 p-3 rounded">
                                                <div class="toc-number me-3">
                                                    <span class="badge background-base text-white">{{ $content->order_index ?? $loop->iteration }}</span>
                                                </div>
                                                <div class="toc-content flex-grow-1">
                                                    <h5 class="toc-title mb-2">{{ $content->title }}</h5>
                                                    @if($content->description)
                                                        <p class="toc-description mb-0 procounsel-text-dark">{{ Str::limit(strip_tags($content->description), 120) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Team Members -->
                    @if(!empty($teamMembers) && count($teamMembers) > 0)
                        <div class="team-members-card mb-50">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header background-base">
                                    <h3 class="text-white mb-0 d-flex align-items-center">
                                        <div class="team-icon me-3">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        Contributing Team Members
                                    </h3>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gutter-y-30">
                                        @foreach($teamMembers as $member)
                                            <div class="col-md-6">
                                                <div class="team-member-item d-flex align-items-start p-3 rounded">
                                                    <div class="member-image me-3">
                                                        @if($member['image_url'])
                                                            <img src="{{ $member['image_url'] }}" alt="{{ $member['name'] }}" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <div class="member-avatar rounded-circle d-flex align-items-center justify-content-center background-gray" style="width: 60px; height: 60px;">
                                                                <i class="fas fa-user" style="color: var(--procounsel-base);"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="member-info flex-grow-1">
                                                        <h5 class="member-name mb-1" style="color: var(--procounsel-black);">{{ $member['name'] }}</h5>
                                                        @if($member['designation'])
                                                            <p class="member-designation mb-1 small procounsel-text-dark">{{ $member['designation'] }}</p>
                                                        @endif
                                                        <span class="badge" style="background-color: var(--procounsel-base);">{{ $member['role'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- FAQs Section -->
                    @if($faqs->count() > 0)
                        <div class="faqs-card mb-50">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header background-base">
                                    <h3 class="text-white mb-0 d-flex align-items-center">
                                        <div class="faq-icon me-3">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        Frequently Asked Questions
                                    </h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="accordion" id="faqAccordion">
                                        @foreach($faqs as $faq)
                                            <div class="accordion-item border-0">
                                                <h2 class="accordion-header" id="faq-heading-{{ $faq->id }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="faq-collapse-{{ $faq->id }}">
                                                        <i class="fas fa-question me-2" style="color: var(--procounsel-base);"></i>
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body">
                                                        <div class="faq-answer procounsel-text-dark">
                                                            {!! $faq->answer !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Call to Action -->
                    <div class="cta-card mb-50">
                        <div class="card border-0 shadow-lg background-black text-white">
                            <div class="card-body p-5 text-center">
                                <div class="cta-icon mx-auto mb-4">
                                    <div class="icon-circle" style="background-color: rgba(255,255,255,0.1); width: 80px; height: 80px; margin: 0 auto;">
                                        <i class="fas fa-comments" style="color: var(--procounsel-base); font-size: 32px;"></i>
                                    </div>
                                </div>
                                <h3 class="cta-title mb-4">Need More Information?</h3>
                                <p class="cta-description mb-4">
                                    Have questions about this publication or need specific legal guidance? Our experienced team is here to help.
                                </p>
                                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                                    <a href="{{ url('/contact') }}" class="procounsel-btn">
                                        <i class="fas fa-phone me-2">Get In Touch</i>
                                        <span>Get In Touch</span>
                                    </a>
                                    <a href="{{ route('publications.index') }}" class="btn btn-outline-light">
                                        <i class="fas fa-book me-2"></i>
                                        More Publications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-5">
                    <div class="publication-sidebar">
                        <!-- Publication Info Card -->
                        <div class="sidebar-widget mb-40">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header background-base">
                                    <h4 class="text-white mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Publication Details
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="publication-meta">
                                        <div class="meta-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                            <span class="meta-label procounsel-text-dark">Published:</span>
                                            <span class="meta-value fw-bold">{{ $publication->created_at->format('M d, Y') }}</span>
                                        </div>
                                        @if($publication->updated_at->gt($publication->created_at))
                                            <div class="meta-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="meta-label procounsel-text-dark">Updated:</span>
                                                <span class="meta-value fw-bold">{{ $publication->updated_at->format('M d, Y') }}</span>
                                            </div>
                                        @endif
                                        @if($faqs->count() > 0)
                                            <div class="meta-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="meta-label procounsel-text-dark">FAQs:</span>
                                                <span class="meta-value fw-bold">{{ $faqs->count() }}</span>
                                            </div>
                                        @endif
                                        @if($tableOfContents->count() > 0)
                                            <div class="meta-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="meta-label procounsel-text-dark">Sections:</span>
                                                <span class="meta-value fw-bold">{{ $tableOfContents->count() }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($teamMembers) && count($teamMembers) > 0)
                                            <div class="meta-item d-flex justify-content-between align-items-center py-2">
                                                <span class="meta-label procounsel-text-dark">Contributors:</span>
                                                <span class="meta-value fw-bold">{{ count($teamMembers) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share Card -->
                        <div class="sidebar-widget mb-40">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header background-base">
                                    <h4 class="text-white mb-0">
                                        <i class="fas fa-share-alt me-2"></i>
                                        Share This Publication
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="social-share d-flex justify-content-center gap-3">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="social-link facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($publication->title) }}" target="_blank" class="social-link twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="social-link linkedin">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="mailto:?subject={{ urlencode($publication->title) }}&body={{ urlencode('Check out this publication: ' . request()->url()) }}" class="social-link email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Related Publications -->
                        @if($relatedPublications->count() > 0)
                            <div class="sidebar-widget">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header background-base">
                                        <h4 class="text-white mb-0">
                                            <i class="fas fa-book me-2"></i>
                                            Related Publications
                                        </h4>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="related-publications">
                                            @foreach($relatedPublications->take(3) as $related)
                                                <div class="related-item mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                    <a href="{{ route('publication.show', $related->slug) }}" class="text-decoration-none">
                                                        <div class="d-flex align-items-start">
                                                            <div class="related-image me-3">
                                                                @if($related->feature_image_url)
                                                                    <img src="{{ $related->feature_image_url }}" alt="{{ $related->title }}" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                                @else
                                                                    <div class="related-placeholder d-flex align-items-center justify-content-center rounded background-gray" style="width: 60px; height: 60px;">
                                                                        <i class="fas fa-book" style="color: var(--procounsel-base);"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="related-content flex-grow-1">
                                                                <h6 class="related-title mb-1" style="color: var(--procounsel-black); line-height: 1.4;">{{ Str::limit($related->title, 60) }}</h6>
                                                                <small class="related-date procounsel-text-dark">{{ $related->created_at->format('M d, Y') }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @if($relatedPublications->count() > 3)
                                            <div class="text-center mt-3 pt-3 border-top">
                                                <a href="{{ route('publications.index') }}" class="btn btn-sm btn-outline-secondary">
                                                    View All Publications
                                                    <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@push('styles')
    <style>
        /* Publication Page Styles */
        .page-header {
            padding: 120px 0 80px;
            position: relative;
        }
        
        .page-header h1 {
            color: var(--procounsel-white);
            font-family: var(--procounsel-heading-font);
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
        }
        
        .breadcrumb-item a {
            color: var(--procounsel-white);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* Image Styles */
        .publication-image-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .publication-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .publication-image-card:hover .publication-image-overlay {
            opacity: 1;
        }
        
        .overlay-icon {
            color: var(--procounsel-base);
            font-size: 3rem;
        }
        
        /* Icon Circle */
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        /* Publication Content */
        .publication-summary-title,
        .content-title {
            color: var(--procounsel-black);
            font-family: var(--procounsel-heading-font);
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .publication-excerpt p,
        .publication-content {
            color: var(--procounsel-text);
            line-height: 1.8;
        }
        
        .publication-content h2 {
            color: var(--procounsel-black);
            font-family: var(--procounsel-heading-font);
            font-size: 1.5rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .publication-content h3 {
            color: var(--procounsel-black);
            font-family: var(--procounsel-heading-font);
            font-size: 1.3rem;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
        }
        
        /* Table of Contents */
        .toc-item {
            background-color: var(--procounsel-gray);
            transition: all 0.3s ease;
        }
        
        .toc-item:hover {
            background-color: var(--procounsel-gray2);
            transform: translateY(-2px);
        }
        
        .toc-title {
            color: var(--procounsel-black);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        
        /* Team Members */
        .team-member-item {
            background-color: var(--procounsel-gray);
            transition: all 0.3s ease;
        }
        
        .team-member-item:hover {
            background-color: var(--procounsel-gray2);
            transform: translateY(-2px);
        }
        
        .member-name {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        /* Social Share */
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .social-link.facebook { background-color: #3b5998; }
        .social-link.twitter { background-color: #1da1f2; }
        .social-link.linkedin { background-color: #0077b5; }
        .social-link.email { background-color: var(--procounsel-text); }
        
        /* Related Publications */
        .related-item a:hover .related-title {
            color: var(--procounsel-base) !important;
        }
        
        /* Card hover effects */
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        /* Accordion Customization */
        .accordion-button:not(.collapsed) {
            background-color: var(--procounsel-gray);
            color: var(--procounsel-black);
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(199, 149, 74, 0.25);
        }
        
        /* CTA Section */
        .cta-title {
            font-family: var(--procounsel-heading-font);
            font-size: 2.5rem;
            color: var(--procounsel-white);
        }
        
        .cta-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }
    </style>
@endpush
