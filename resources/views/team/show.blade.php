@extends('layouts.app')

@section('head')
    <x-meta-tags 
        :title="($team->metatitle ?: $team->name . ' - ' . $team->designation . ' | Legal Professional')" 
        :description="($team->metadescription ?: $team->tagline ?: 'Meet ' . $team->name . ', ' . $team->designation . ' at our law firm. Experienced legal professional ready to help with your legal needs.')" 
        :keywords="($team->metakeywords ?: $team->name . ', ' . $team->designation . ', lawyer, attorney, legal professional')" 
        :image="$team->image_url" 
        type="profile" 
        :post="$team" 
    />
    
    @if($team->googleschema)
        <script type="application/ld+json">
            {!! $team->google_schema_json !!}
        </script>
    @endif
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner 
        :title="$team->name" 
        :subtitle="$team->tagline"
        :breadcrumbs="[
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Our Team', 'url' => route('team.index')],
            ['label' => $team->name]
        ]"
    />

    {{-- Main Content Section --}}
    <section class="team-details-section">
        <div class="container">
            <div class="row">
                <!-- Main Content - 70% -->
                <div class="col-lg-8 col-md-12">
                    <!-- Team Member Profile Card -->
                    <div class="team-content-card">
                        <div class="team-header">
                            <div class="row align-items-center">
                                <!-- Profile Image -->
                                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                                    <div class="team-image">
                                        @if($team->image_url)
                                            <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="img-fluid">
                                        @else
                                            <div class="placeholder-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Profile Info -->
                                <div class="col-lg-8">
                                    <h1 class="team-name">{{ $team->name }}</h1>
                                    <h3 class="team-designation">{{ $team->designation }}</h3>
                                    
                                    @if($team->tagline)
                                        <p class="team-tagline">{{ $team->tagline }}</p>
                                    @endif
                                    
                                    <!-- Quick Contact -->
                                    <div class="team-contact-buttons">
                                        @if($team->email)
                                            <a href="mailto:{{ $team->email }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                                                <i class="fas fa-envelope"></i> Email
                                            </a>
                                        @endif
                                        @if($team->phone)
                                            <a href="tel:{{ $team->phone }}" class="btn btn-outline-success btn-sm me-2 mb-2">
                                                <i class="fas fa-phone"></i> Call
                                            </a>
                                        @endif
                                        @if($team->linkedinlink)
                                            <a href="{{ $team->linkedinlink }}" target="_blank" class="btn btn-outline-info btn-sm mb-2">
                                                <i class="fab fa-linkedin-in"></i> LinkedIn
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Biography Section -->
                    @if($team->description)
                        <div class="team-bio-section">
                            <h3 class="bio-title">
                                <i class="fas fa-user-circle"></i>
                                About {{ $team->name }}
                            </h3>
                            <div class="team-description">
                                {!! $team->description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Professional Profile Section -->
                    <div class="professional-section">
                        <h3 class="professional-title">
                            <i class="fas fa-briefcase"></i>
                            Professional Profile
                        </h3>
                        <div class="row">
                            @if($team->experience)
                                <div class="col-md-6">
                                    <div class="professional-item">
                                        <div class="professional-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="professional-content">
                                            <h5>Experience</h5>
                                            <p>{{ $team->experience }}+ years of legal practice</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($team->qualification)
                                <div class="col-md-6">
                                    <div class="professional-item">
                                        <div class="professional-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="professional-content">
                                            <h5>Education</h5>
                                            <p>{{ $team->qualification }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-6">
                                <div class="professional-item">
                                    <div class="professional-icon">
                                        <i class="fas fa-gavel"></i>
                                    </div>
                                    <div class="professional-content">
                                        <h5>Specialization</h5>
                                        <p>{{ $team->designation }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="professional-item">
                                    <div class="professional-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="professional-content">
                                        <h5>Availability</h5>
                                        <p>Available for consultation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    @if($team->additional_details)
                        <div class="additional-details-section">
                            <h3 class="additional-title">
                                <i class="fas fa-info-circle"></i>
                                Additional Information
                            </h3>
                            <div class="team-additional-details">
                                {!! $team->additional_details !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar - 30% -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-sticky">
                        <!-- Other Team Members -->
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fas fa-users"></i>
                                Our Team
                            </h4>
                            <div class="other-team-members">
                                @php
                                    $otherTeamMembers = App\Models\Team::active()->where('id', '!=', $team->id)->ordered()->take(4)->get();
                                @endphp
                                @if($otherTeamMembers->count() > 0)
                                    @foreach($otherTeamMembers as $member)
                                        <div class="team-member-item">
                                            <div class="team-member-image">
                                                @if($member->image_url)
                                                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="img-fluid">
                                                @else
                                                    <div class="placeholder-image">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="team-member-content">
                                                <h6><a href="{{ route('team.show', $member) }}">{{ $member->name }}</a></h6>
                                                <p>{{ $member->designation }}</p>
                                                @if($member->tagline)
                                                    <small>{{ Str::limit($member->tagline, 60) }}</small>
                                                @endif
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
                                Share Profile
                            </h4>
                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="social-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation) }}" target="_blank" class="social-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="social-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode('Meet ' . $team->name . ' - ' . $team->designation . ' - ' . request()->url()) }}" target="_blank" class="social-btn whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fas fa-envelope"></i>
                                Contact {{ $team->name }}
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
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" value="Consultation request for {{ $team->name }}" required>
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

                        <!-- Back to Team -->
                        <div class="sidebar-card text-center">
                            <a href="{{ route('team.index') }}" class="btn btn-outline-primary btn-back">
                                <i class="fas fa-arrow-left"></i>
                                View All Team Members
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Team Details Page Styles */
        .team-details-section {
            padding: 60px 0;
            background-color: var(--procounsel-gray);
            font-family: var(--procounsel-font);
        }

        .team-content-card {
            background: var(--procounsel-white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--procounsel-border-color);
        }

        .team-header {
            margin-bottom: 30px;
        }

        .team-image {
            position: relative;
            margin-bottom: 20px;
        }

        .team-image img {
            width: 200px;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            border: 4px solid var(--procounsel-border-color);
            transition: transform 0.3s ease;
        }

        .team-image:hover img {
            transform: scale(1.05);
        }

        .placeholder-avatar {
            width: 200px;
            height: 250px;
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid var(--procounsel-border-color);
        }

        .placeholder-avatar i {
            color: var(--procounsel-white);
            font-size: 4rem;
        }

        .team-name {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .team-designation {
            color: var(--procounsel-base);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .team-tagline {
            color: var(--procounsel-text);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .team-contact-buttons .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .team-contact-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Biography Section */
        .team-bio-section {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--procounsel-border-color);
        }

        .bio-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .bio-title i {
            color: var(--procounsel-base);
        }

        .team-description {
            color: var(--procounsel-text-dark);
            line-height: 1.7;
            font-size: 1rem;
        }

        .team-description h2, .team-description h3, .team-description h4 {
            color: var(--procounsel-primary);
            font-family: var(--procounsel-heading-font);
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .team-description p {
            margin-bottom: 15px;
        }

        .team-description ul, .team-description ol {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .team-description li {
            margin-bottom: 8px;
        }

        .team-description a {
            color: var(--procounsel-base);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .team-description a:hover {
            color: var(--procounsel-primary);
        }

        /* Professional Section */
        .professional-section {
            background: linear-gradient(135deg, var(--procounsel-gray) 0%, var(--procounsel-white) 100%);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid var(--procounsel-border-color);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .professional-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .professional-title i {
            color: var(--procounsel-base);
        }

        .professional-item {
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

        .professional-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .professional-icon {
            width: 50px;
            height: 50px;
            background: var(--procounsel-base);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .professional-icon i {
            color: var(--procounsel-white);
            font-size: 1.2rem;
        }

        .professional-content h5 {
            color: var(--procounsel-primary);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .professional-content p {
            color: var(--procounsel-text);
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Additional Details Section */
        .additional-details-section {
            background: var(--procounsel-white);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--procounsel-border-color);
        }

        .additional-title {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-primary);
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .additional-title i {
            color: var(--procounsel-base);
        }

        .team-additional-details {
            color: var(--procounsel-text-dark);
            line-height: 1.7;
            font-size: 1rem;
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

        /* Team Members Styles */
        .team-member-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease;
        }

        .team-member-item:hover {
            background-color: var(--procounsel-gray);
        }

        .team-member-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .team-member-image img {
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

        .team-member-content h6 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            line-height: 1.3;
        }

        .team-member-content h6 a {
            color: var(--procounsel-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .team-member-content h6 a:hover {
            color: var(--procounsel-base);
        }

        .team-member-content p {
            color: var(--procounsel-base);
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0 0 5px 0;
        }

        .team-member-content small {
            color: var(--procounsel-text);
            font-size: 0.8rem;
            line-height: 1.4;
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

        .btn-back {
            background: transparent;
            color: var(--procounsel-primary);
            border: 2px solid var(--procounsel-primary);
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--procounsel-primary);
            color: var(--procounsel-white);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 34, 58, 0.3);
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .team-details-section {
                padding: 40px 0;
            }
            
            .team-content-card {
                padding: 25px;
                margin-bottom: 25px;
            }
            
            .team-name {
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
            .team-content-card {
                padding: 20px;
            }
            
            .team-name {
                font-size: 1.8rem;
            }
            
            .sidebar-card {
                padding: 20px;
            }
            
            .professional-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .team-member-item {
                flex-direction: column;
                text-align: center;
            }
            
            .team-member-image {
                width: 100px;
                height: 100px;
                align-self: center;
            }
        }

        @media (max-width: 575.98px) {
            .team-details-section {
                padding: 30px 0;
            }
            
            .team-content-card {
                padding: 15px;
            }
            
            .sidebar-card {
                padding: 15px;
            }
            
            .team-name {
                font-size: 1.5rem;
            }
            
            .social-btn {
                width: 40px;
                height: 40px;
            }
            
            .team-image img, .placeholder-avatar {
                width: 150px;
                height: 180px;
            }
        }

        /* Custom animations */
        .team-content-card, .sidebar-card {
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

        /* Team-specific styling differences */
        .team-member-item {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .team-member-item:hover {
            border-left-color: var(--procounsel-base);
        }

        /* Team-specific professional icon styling */
        .professional-icon {
            background: linear-gradient(135deg, var(--procounsel-base), var(--procounsel-primary));
        }
    </style>
@endpush
