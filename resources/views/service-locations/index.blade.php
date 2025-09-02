@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Service Locations - Legal Services by Location'"
        :description="'Find our legal services by location. Comprehensive coverage across different regions and jurisdictions'"
        :keywords="'service locations, legal services, regional coverage, law offices, legal assistance by location'" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Service Locations"
        subtitle="Discover our comprehensive legal services available across different locations and jurisdictions"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Service Locations']]" />
        
    {{-- Service Locations Section --}}
    @livewire('service-location-section', [
        'showViewAll' => true,
        'limit' => 8,
        'showSearch' => true,
        'sectionTitle' => '<span class="">Service Locations</span>',
        'sectionSubtitle' => 'Regional Legal Coverage',
        'sectionDescription' => 'Explore our comprehensive legal service coverage across different locations and jurisdictions, providing expert legal assistance wherever you need it.',
    ])
    
    {{-- Contact Form Section --}}
    <x-publication-contact-form />
@endsection
