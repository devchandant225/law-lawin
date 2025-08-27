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
                    <li class="breadcrumb-item active" aria-current="page">FDI Legal</li>
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
                        <h2>FDI Legal Help Desk</h2>
                        <p class="help-desk-content__text">
                            {{ $description }}. Our experienced legal professionals provide comprehensive support 
                            for foreign investors looking to establish and operate businesses in Nepal, covering:
                        </p>
                        
                        <div class="help-desk-services">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <h3>Company Registration</h3>
                                        <p>Complete assistance with foreign company registration, licensing, and compliance procedures.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <h3>Investment Approvals</h3>
                                        <p>Guidance through FDI approval processes, sector-specific requirements, and regulatory compliance.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <h3>Legal Compliance</h3>
                                        <p>Ongoing legal support for tax obligations, labor laws, and regulatory requirements.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-desk-service-item">
                                        <div class="help-desk-service-item__icon">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <h3>Joint Ventures</h3>
                                        <p>Legal structuring and documentation for joint ventures and partnerships with local entities.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fdi-process-steps">
                            <h3>FDI Investment Process</h3>
                            <div class="process-steps">
                                <div class="process-step">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h4>Initial Consultation</h4>
                                        <p>Assessment of investment plans and sector viability</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h4>Documentation</h4>
                                        <p>Preparation of required documents and applications</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h4>Approval Process</h4>
                                        <p>Filing applications with relevant authorities</p>
                                    </div>
                                </div>
                                <div class="process-step">
                                    <div class="step-number">4</div>
                                    <div class="step-content">
                                        <h4>Implementation</h4>
                                        <p>Business setup and ongoing compliance support</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="help-desk-contact">
                            <h3>Start Your FDI Journey</h3>
                            <p>Contact our FDI Legal Help Desk team for expert guidance on foreign direct investment in Nepal.</p>
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
                            <li><a href="{{ route('help-desk.nrn-legal') }}">NRN Legal Help Desk</a></li>
                            <li><a href="{{ route('team.index') }}">Our Legal Team</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            <li><a href="{{ route('services.index') }}">Our Services</a></li>
                        </ul>
                    </div>
                    
                    <div class="help-desk-sidebar__item">
                        <h3>Investment Sectors</h3>
                        <div class="investment-sectors">
                            <ul>
                                <li>Manufacturing</li>
                                <li>Tourism & Hospitality</li>
                                <li>Information Technology</li>
                                <li>Energy & Infrastructure</li>
                                <li>Financial Services</li>
                                <li>Healthcare & Education</li>
                            </ul>
                        </div>
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
