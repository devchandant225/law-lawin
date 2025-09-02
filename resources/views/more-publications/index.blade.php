@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'More Publications - Additional Legal Resources'"
        :description="'Explore our extended collection of legal publications, research papers, and specialized resources'"
        :keywords="'more publications, legal resources, law, research, additional content'" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="More Legal Publications"
        subtitle="Discover our expanded collection of specialized legal publications, research papers, and professional resources"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'More Publications']]" />
        
    {{-- More Publications Section --}}
    @livewire('more-publication-section', [
        'showViewAll' => true,
        'limit' => 8,
        'showSearch' => true,
        'sectionTitle' => '<span class="">More Publications</span>',
        'sectionSubtitle' => 'Extended Legal Resources',
        'sectionDescription' => 'Explore our comprehensive collection of additional legal publications, specialized research papers, and expert insights covering various specialized areas of law.',
    ])
@endsection
