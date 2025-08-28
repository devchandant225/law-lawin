@extends('layouts.app')

@section('title', 'Practice Areas - ' . config('app.name'))
@section('description', 'Explore our comprehensive practice areas and legal expertise. Our experienced team provides specialized legal services across various areas of law.')

@section('content')
    {{-- Page Banner --}}
    <section class="page-header background-black pt-142 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <nav class="mb-30">
                            <ol class="d-flex justify-content-center align-items-center list-unstyled mb-0" style="gap: 15px;">
                                <li><a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--procounsel-base);">Home</a></li>
                                <li style="color: var(--procounsel-white);">/</li>
                                <li style="color: var(--procounsel-white);">Practice Areas</li>
                            </ol>
                        </nav>
                        <div class="sec-title text-center">
                            <p class="sec-title__tagline" style="color: var(--procounsel-base);">Legal Excellence</p>
                            <h1 class="sec-title__title--white mb-30">Our Practice <span>Areas</span></h1>
                            <p class="procounsel-text-dark" style="font-size: 18px; line-height: 1.7;">
                                Discover our comprehensive legal practice areas and specialized expertise that provide exceptional legal services across various areas of law
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">

        {{-- Filter and Sort Section --}}
        <section class="background-gray">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="bg-white p-4" style="border-radius: 10px; box-shadow: 0px 10px 30px rgba(0,0,0,0.1); border: 1px solid var(--procounsel-border-color);">
                            <form action="{{ route('practices.index') }}" method="GET" class="form-one">
                                <div class="form-one__group">
                                    <div class="form-one__control">
                                        <label for="sort">Sort By</label>
                                        <select name="sort" id="sort" class="bootstrap-select" onchange="this.form.submit()">
                                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-one__control">
                                        <label for="search">Search Practice Areas</label>
                                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search practice areas...">
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-3 mt-30">
                                    <button type="submit" class="procounsel-btn">
                                        <i>Apply Filters</i>
                                        <span>Apply Filters</span>
                                    </button>
                                    @if (request()->hasAny(['search', 'sort']))
                                        <a href="{{ route('practices.index') }}" class="procounsel-btn" style="background-color: var(--procounsel-gray2); color: var(--procounsel-text);">
                                            <i>Clear</i>
                                            <span>Clear</span>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Practices Section --}}
        <section class="pt-120 pb-120">
            <div class="container">
                @if ($practices->count() > 0)
                    {{-- Section Title --}}
                    <div class="text-center mb-80">
                        <div class="sec-title">
                            <p class="sec-title__tagline">Our Expertise</p>
                            <h2 class="sec-title__title">Practice <span>Areas</span></h2>
                            <p style="color: var(--procounsel-text); margin-top: 20px;">
                                Showing {{ $practices->count() }} of {{ $practices->total() }} practice areas
                            </p>
                        </div>
                    </div>
                    
                    {{-- Practices Grid --}}
                    <div class="row gutter-y-60">
                        @foreach ($practices as $index => $practice)
                            <div class="col-lg-4 col-md-6">
                                <div class="blog-card-three" style="height: 100%;">
                                    <div class="blog-card-three__image">
                                        @if ($practice->feature_image)
                                            <img src="{{ $practice->feature_image_url }}" alt="{{ $practice->title }}" style="height: 300px; object-fit: cover;">
                                            <img src="{{ $practice->feature_image_url }}" alt="{{ $practice->title }}" style="height: 300px; object-fit: cover;">
                                        @else
                                            <div style="height: 300px; background: linear-gradient(135deg, var(--procounsel-primary) 0%, var(--procounsel-base) 100%); display: flex; align-items: center; justify-content: center;">
                                                <div class="text-center text-white">
                                                    @php
                                                        $practiceComponent = app('App\View\Components\PracticeSection');
                                                        $iconClass = $practiceComponent->getPracticeIcon($practice->title);
                                                    @endphp
                                                    <i class="{{ $iconClass }}" style="font-size: 60px; color: var(--procounsel-white);"></i>
                                                </div>
                                            </div>
                                        @endif
                                        <a href="{{ route('practice.show', $practice->slug) }}" class="blog-card-three__image__link"></a>
                                    </div>
                                    
                                    <div class="blog-card-three__content p-2">
                                        <h3 class="blog-card-three__title">
                                            <a href="{{ route('practice.show', $practice->slug) }}">{{ $practice->title }}</a>
                                        </h3>
                                        
                                        <div class="blog-card-three__bottom">
                                            <div class="blog-card-three__author">
                                                <div class="blog-card-three__author__info">
                                                    <p class="blog-card-three__author__name" style="margin-bottom: 5px;">
                                                        {{ $practice->excerpt ?? Str::limit(strip_tags($practice->description), 80) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <a href="{{ route('practice.show', $practice->slug) }}" class="procounsel-btn">
                                                <i>Learn More</i>
                                                <span>Learn More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($practices->hasPages())
                        <div class="mt-80">
                            <ul class="post-pagination text-center">
                                {{-- Previous Page Link --}}
                                @if ($practices->onFirstPage())
                                    <li><span style="opacity: 0.5;">‹</span></li>
                                @else
                                    <li><a href="{{ $practices->previousPageUrl() }}">‹</a></li>
                                @endif
                    
                                {{-- Pagination Elements --}}
                                @foreach ($practices->getUrlRange(1, $practices->lastPage()) as $page => $url)
                                    @if ($page == $practices->currentPage())
                                        <li><a href="#" class="active">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                {{-- Next Page Link --}}
                                @if ($practices->hasMorePages())
                                    <li><a href="{{ $practices->nextPageUrl() }}">›</a></li>
                                @else
                                    <li><span style="opacity: 0.5;">›</span></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                    <div class="text-center pt-80 pb-80">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="mb-40" style="font-size: 80px; color: var(--procounsel-base);">
                                    <i class="fas fa-search"></i>
                                </div>
                                
                                <div class="sec-title text-center mb-40">
                                    <h3 class="sec-title__title">No Practice <span>Areas</span> Found</h3>
                                    
                                    <p style="color: var(--procounsel-text); font-size: 16px; margin-top: 20px;">
                                        @if (request('search'))
                                            No practice areas match your search criteria. Try adjusting your search terms.
                                        @else
                                            We're working on adding new practice areas. Check back soon for the latest legal services.
                                        @endif
                                    </p>
                                </div>
                                
                                @if (request('search'))
                                    <a href="{{ route('practices.index') }}" class="procounsel-btn">
                                        <i>View All Practice Areas</i>
                                        <span>View All Practice Areas</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        
        {{-- CTA Section --}}
        <section class="background-black pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <div class="sec-title text-center mb-50">
                                <p class="sec-title__tagline" style="color: var(--procounsel-base);">Get Expert Help</p>
                                <h2 class="sec-title__title--white mb-30">
                                    Need Legal <span>Assistance?</span>
                                </h2>
                                <p class="procounsel-text-dark" style="font-size: 18px; max-width: 600px; margin: 0 auto;">
                                    Contact our experienced team to discuss your legal needs and find the right practice area for your situation.
                                </p>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-4 justify-content-center">
                                <a href="{{ url('/contact') }}" class="procounsel-btn">
                                    <i>Get Consultation</i>
                                    <span>Get Consultation</span>
                                </a>
                                
                                <a href="{{ url('/contact') }}" 
                                   class="procounsel-btn" 
                                   style="background-color: transparent; border: 2px solid var(--procounsel-white); color: var(--procounsel-white);">
                                    <i>Contact Us</i>
                                    <span>Contact Us</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit search form on filter change
            const sortSelect = document.querySelector('select[name="sort"]');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // Enhance search functionality
            const searchForm = document.querySelector('form[action*="practices"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const searchInput = this.querySelector('input[name="search"]');
                    if (searchInput && searchInput.value.trim() === '') {
                        e.preventDefault();
                        window.location.href = '{{ route('practices.index') }}';
                    }
                });
            }
        });
    </script>
@endpush
