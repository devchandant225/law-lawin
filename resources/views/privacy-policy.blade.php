@extends('layouts.app')

@section('head')
    <x-meta-tags :title="$publication->metatitle ?: $publication->title . ' - Privacy Policy'" :description="$publication->metadescription ?: $publication->excerpt" :keywords="$publication->metakeywords" :image="$publication->feature_image_url" type="article" :post="$publication" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Procounsel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/procounsel.css') }}">

    @if ($publication->google_schema_json)
        <script type="application/ld+json">{!! $publication->google_schema_json !!}</script>
    @endif
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner :title="$publication->title" :breadcrumbs="[
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Privacy Policy'],
    ]" />

    <!-- Main Content Section -->
    <section class="pt-3">
        <div class="px-3">
            <div class="flex flex-wrap -mx-4">
                <!-- Main Content (Full width) -->
                <div class="w-full px-4">
                    <!-- Privacy Policy Header -->
                    <div class="publication-header-card bg-white overflow-hidden">
                        @if ($publication->feature_image_url)
                            <div class="publication-image-wrapper">
                                <img src="{{ $publication->feature_image_url }}" alt="{{ $publication->title }}"
                                    class="w-full h-[28rem] object-fill publication-feature-image">
                            </div>
                        @else
                            <!-- Gradient Background with Text when no image -->
                            <div class="publication-gradient-header">
                                <div class="bg-gradient-to-b from-accent to-yellow-500 h-[28rem] w-full flex items-center justify-center relative overflow-hidden">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 opacity-20">
                                        <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl opacity-30 animate-pulse"></div>
                                        <div class="absolute bottom-10 right-10 w-40 h-40 bg-white rounded-full blur-3xl opacity-20 animate-pulse delay-1000"></div>
                                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-60 h-60 bg-white rounded-full blur-3xl opacity-10"></div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
                                        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-tight drop-shadow-lg">
                                            {{ $publication->title }}
                                        </h1>
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="py-3 px-2">
                            <h2 class="publication-summary-title text-xl font-semibold text-accent mb-2">
                                {{ $publication->title }}</h2>
                            @if ($publication->description)
                                <div class="publication-content text-gray-700 leading-relaxed">
                                    {!! $publication->description !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Legal Assistance Section -->
                    <section class="bg-accent rounded-lg shadow-xl overflow-hidden cta-section mt-10 p-6">
                        @php
                            // Use globalProfile for contact info like in contact-section.blade.php
                            $phoneNumbers = [];
                            if ($globalProfile) {
                                $phoneNumbers = array_filter([
                                    $globalProfile->phone1 ?? null,
                                    $globalProfile->phone2 ?? null,
                                ]);
                            }
                            $primaryPhone = !empty($phoneNumbers) ? $phoneNumbers[0] : null;
                            $emailAddress = $globalProfile->email ?? null;
                            
                            // Clean phone number for links (remove any formatting)
                            $cleanPhone = $primaryPhone ? preg_replace('/[^0-9+]/', '', $primaryPhone) : null;
                        @endphp
                        
                        <div class="text-left">
                            <h3 class="text-xl font-bold text-white mb-3 underline decoration-white">
                                For quick legal assistance:
                            </h3>
                            
                            <div class="text-white text-base mb-4">
                                @if ($primaryPhone)
                                    <p class="mb-2">
                                        <span class="font-medium">You can directly call to our legal expert:</span> 
                                        <a href="tel:{{ $cleanPhone }}" class="font-bold hover:underline">{{ $primaryPhone }}</a>
                                    </p>
                                @endif
                                <p class="mb-4">
                                    <span class="font-medium">Even can call or drop a text through What's app , Viber, Telegram and We Chat at the same number.</span>
                                </p>
                            </div>

                            <!-- Messaging App Icons -->
                            <div class="flex items-center gap-3 mb-4">
                                @if ($globalProfile && $globalProfile->whatsapp)
                                    <a href="{{ $globalProfile->whatsapp }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                                        <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                                    </a>
                                @elseif ($cleanPhone)
                                    <a href="https://wa.me/{{ ltrim($cleanPhone, '+') }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                                        <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                                    </a>
                                @endif
                                
                                @if ($globalProfile && $globalProfile->viber)
                                    <a href="{{ $globalProfile->viber }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                                        <i class="fab fa-viber text-purple-600 text-2xl"></i>
                                    </a>
                                @elseif ($cleanPhone)
                                    <a href="viber://chat?number={{ $cleanPhone }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                                        <i class="fab fa-viber text-purple-600 text-2xl"></i>
                                    </a>
                                @endif
                                
                                @if ($cleanPhone)
                                    <a href="https://t.me/{{ ltrim($cleanPhone, '+') }}" target="_blank" class="bg-white p-3 rounded-lg hover:scale-105 transition-transform duration-200">
                                        <i class="fab fa-telegram text-blue-500 text-2xl"></i>
                                    </a>
                                @endif
                            </div>

                            @if ($emailAddress)
                                <div class="text-white text-base">
                                    <p class="mb-2">
                                        <span class="font-medium">Also can do email on :</span> 
                                        <a href="mailto:{{ $emailAddress }}" class="font-bold hover:underline text-white">{{ $emailAddress }}</a>
                                        @if ($globalProfile && $globalProfile->email2)
                                            , <a href="mailto:{{ $globalProfile->email2 }}" class="font-bold hover:underline text-white">{{ $globalProfile->email2 }}</a>
                                        @endif
                                    </p>
                                </div>
                            @endif
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
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Responsive gradient header */
        .publication-gradient-header {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .publication-gradient-header h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .publication-gradient-header p {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 640px) {
            .publication-gradient-header h1 {
                font-size: 2rem !important;
                line-height: 1.2;
            }
            
            .publication-gradient-header p {
                font-size: 1rem !important;
            }
            
            .publication-gradient-header .bg-gradient-to-b {
                height: 20rem !important;
            }
        }
        
        @media (max-width: 480px) {
            .publication-gradient-header h1 {
                font-size: 1.75rem !important;
            }
            
            .publication-gradient-header .bg-gradient-to-b {
                height: 18rem !important;
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
            background-color: cyan;
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