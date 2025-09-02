@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Publications - Legal Publications & Resources'" :description="'Browse our comprehensive collection of legal publications, research papers, and resources'" :keywords="'publications, legal resources, law, research'" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Legal Publications"
        subtitle="Explore our comprehensive collection of legal publications, research papers, and professional resources"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Publications']]" />

    <section class="award-one">
        {{-- Publications Section --}}
        <x-publication-section :showViewAll="true" :limit="8" :showSearch="true"
            sectionTitle="<span class=''>Publications</span>" sectionSubtitle="Legal Knowledge & Resources"
            sectionDescription="Explore our comprehensive collection of legal publications, research papers, and expert insights covering various areas of law." />

    </section>
@endsection
