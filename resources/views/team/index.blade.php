@extends('layouts.app')

@section('head')
    <x-meta-tags :title="'Our Legal Team - Expert Lawyers & Legal Professionals'" :description="'Meet our experienced team of legal professionals. Expert lawyers, attorneys, and legal consultants ready to handle your legal needs with dedication and expertise.'" :keywords="'legal team, lawyers, attorneys, legal professionals, law firm team, legal experts'" :image="asset('images/team-banner.jpg')" type="website" />
@endsection

@section('content')
    {{-- Page Banner --}}
    <x-page-banner title="Our Expert Team"
        subtitle="Meet our dedicated team of legal professionals who bring years of experience, expertise, and passion to serve your legal needs with excellence and integrity"
        :breadcrumbs="[['label' => 'Home', 'url' => url('/')], ['label' => 'Our Team']]" />

    {{-- Team Section with Search --}}
    {{-- <x-team-section :teams="$teams" :showViewAll="false" :showSectionHeader="false" :showSearch="true"
        sectionTitle="Our <span class='bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent'>Legal Professionals</span>"
        sectionSubtitle="Expert Team Members"
        sectionDescription="Our diverse team of legal experts combines deep knowledge, innovative thinking, and unwavering commitment to deliver exceptional legal services across various practice areas." /> --}}
    <section class="team-one">
        <div class="container">
            <div class="row gutter-y-30">
                @foreach ($teams as $team)
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>

                            <div class="team-card__image bw-img-anim-left">
                                <div class="team-card__content">
                                    <h3 class="team-card__title">
                                        <a href="{{ route('team.show', $team->slug) }}">{{ $team->name }}</a>
                                    </h3><!-- /.team-card__title -->
                                    <p class="team-card__designation">{{ $team->designation ?: 'Lawyer' }}</p>
                                    <!-- /.team-card__designation -->

                                </div><!-- /.team-card__content -->
                                <div class="team-card__hover">
                                    <span class="team-card__hover__btn"><i class="icon-plus"></i></span>
                                    <div class="team-card__hover__social">
                                        @if ($team->facebooklink)
                                            <a href="{{ $team->facebooklink }}" target="_blank">
                                                <i class="icon-facebook"></i>
                                                <span class="sr-only">Facebook</span>
                                            </a>
                                        @endif
                                        @if ($team->linkedinlink)
                                            <a href="{{ $team->linkedinlink }}" target="_blank">
                                                <i class="icon-linkedin"></i>
                                                <span class="sr-only">LinkedIn</span>
                                            </a>
                                        @endif
                                        @if ($team->email)
                                            <a href="mailto:{{ $team->email }}">
                                                <i class="icon-email"></i>
                                                <span class="sr-only">Email</span>
                                            </a>
                                        @endif
                                        @if (!$team->facebooklink && !$team->linkedinlink && !$team->email)
                                            <!-- Default social links when none are provided -->
                                            <a href="#">
                                                <i class="icon-facebook"></i>
                                                <span class="sr-only">Facebook</span>
                                            </a>
                                        @endif
                                    </div><!-- /.team-card__social -->
                                </div><!-- /.team-card__hover -->
                                @if ($team->image)
                                    <img src="{{ $team->image_url }}" alt="{{ $team->name }}">
                                @else
                                    <img src="{{ asset('assets/images/team/team-1-1.jpg') }}" alt="{{ $team->name }}">
                                @endif
                            </div><!-- /.team-card__image -->
                        </div><!-- /.team-card -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                @endforeach



            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.team-two -->

@endsection

