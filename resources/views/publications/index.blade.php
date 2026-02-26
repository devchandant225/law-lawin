@extends('layouts.app')

@section('meta_tags')
    <x-meta-tags :title="'Publications - Legal Publications & Resources'" :description="'Browse our comprehensive collection of legal publications, research papers, and resources'" :keywords="'publications, legal resources, law, research'" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title=""
        subtitle="Explore our comprehensive collection of legal publications, research papers, and professional resources"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Publications']]" />

    {{-- Publications Section Title --}}
    <x-page-section-title title="<span>Publications</span>" />
    
    {{-- H1 for SEO --}}
    <section class="py-8 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 text-center">
                Publications
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto text-center">
                Browse our comprehensive collection of legal publications, research papers, and expert insights.
            </p>
        </div>
    </section>

    {{-- Publications Section --}}
    @livewire('publication-section', [
        'showViewAll' => true,
        'limit' => 12,
        'showSearch' => true,
        'sectionTitle' => '<span class="">Publications</span>',
        'sectionSubtitle' => 'Legal Knowledge & Resources',
        'sectionDescription' => 'Explore our comprehensive collection of legal publications, research papers, and expert insights covering various areas of law.',
    ])

    {{-- Contact Form Section --}}
    <x-contact-section />
@endsection
