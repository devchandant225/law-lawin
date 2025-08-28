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
                                        <a href="{{ route('team.show', $team->slug) }}">{{ $team->title }}</a>
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
    {{-- Call to Action Section --}}
    <section class="py-16 bg-gradient-to-r from-secondary to-primary">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <div
                    class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                    <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Ready to Work with Our Team?
                </h2>
                <p class="text-xl text-purple-200 mb-8 leading-relaxed">
                    Connect with our experienced legal professionals today. We're here to provide you with expert guidance
                    and personalized legal solutions for your unique needs.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/contact') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl transform transition-all duration-300 hover:bg-gray-100 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30 shadow-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Get Legal Consultation
                    </a>
                    <a href="tel:+1234567890"
                        class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/30 transform transition-all duration-300 hover:bg-white/10 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/30">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Call Us Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #3b82f6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #7c3aed, #2563eb);
        }

        /* Enhanced mobile responsiveness */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endpush
