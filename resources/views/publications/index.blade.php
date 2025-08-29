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
        <div class="container">
            @if ($publications->isNotEmpty())
                <div class="row gutter-y-30">
                    @foreach ($publications as $index => $publication)
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="{{ ($index % 2) * 100 }}ms">
                            <div class="award-one__item">
                                <div class="award-one__item__left">
                                    <h2 class="award-one__item__title">
                                        <a
                                            href="{{ route('publication.show', $publication->slug) }}">{{ $publication->title }}</a>
                                    </h2>
                                    {{-- @if ($publication->excerpt || $publication->description)
                                        <p class="award-one__item__text">
                                            {{ $publication->excerpt ?? Str::limit(strip_tags($publication->description), 150) }}
                                        </p>
                                        @endif --}}

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <h4>No publications available at the moment.</h4>
                    <p>Please check back later for our latest publications and resources.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
