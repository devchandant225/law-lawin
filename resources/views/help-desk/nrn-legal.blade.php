@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<section class="page-banner">
    <div class="container">
        <div class="page-banner__inner">
            <h1>{{ $title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item">Help Desk</li>
                    <li class="breadcrumb-item active" aria-current="page">NRN Legal</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="help-desk-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="help-desk-content">
                    <div class="help-desk-content__inner">
                        <h2>NRN Legal Help Desk</h2>
                        <p class="help-desk-content__text">
                            {{ $description }}. Our dedicated legal team provides comprehensive support and guidance 
                            for Non-Resident Nepalis on various legal matters including but not limited to:
                        </p>
                        
                        <div class="help-desk-services">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-passport"></i>
                                        </div>
                                        <h3>Citizenship Issues</h3>
                                        <p>Legal assistance with citizenship matters, documentation, and related procedures.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <h3>Property Rights</h3>
                                        <p>Guidance on property ownership, inheritance, and real estate transactions.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <h3>Business Setup</h3>
                                        <p>Legal support for establishing and operating businesses in Nepal.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <h3>Banking & Finance</h3>
                                        <p>Legal assistance with banking operations, investments, and financial matters.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="help-desk-contact">
                            <h3>Get Legal Assistance</h3>
                            <p>Contact our NRN Legal Help Desk team for personalized legal consultation and support.</p>
                            <div class="help-desk-contact-info">
                                @if($globalProfile)
                                    @if($globalProfile->phone1)
                                    <div class="contact-info-item">
                                        <i class="fas fa-phone"></i>
                                        <span>Phone: <a href="tel:{{ $globalProfile->phone1 }}">{{ $globalProfile->phone1 }}</a></span>
                                    </div>
                                    @endif
                                    @if($globalProfile->email)
                                    <div class="contact-info-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email: <a href="mailto:{{ $globalProfile->email }}">{{ $globalProfile->email }}</a></span>
                                    </div>
                                    @endif
                                    @if($globalProfile->whatsapp)
                                    <div class="contact-info-item">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp: <a href="https://wa.me/{{ $globalProfile->whatsapp }}">{{ $globalProfile->whatsapp }}</a></span>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-xl-3">
                <div class="help-desk-sidebar">
                    <div class="help-desk-sidebar__item">
                        <h3>Quick Links</h3>
                        <ul class="help-desk-links">
                            <li><a href="{{ route('help-desk.fdi-legal') }}">FDI Legal Help Desk</a></li>
                            <li><a href="{{ route('team.index') }}">Our Legal Team</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            <li><a href="{{ route('services.index') }}">Our Services</a></li>
                        </ul>
                    </div>
                    
                    <div class="help-desk-sidebar__item">
                        <h3>Office Hours</h3>
                        <div class="office-hours">
                            <p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                            <p><strong>Saturday:</strong> 10:00 AM - 4:00 PM</p>
                            <p><strong>Sunday:</strong> Emergency Only</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
