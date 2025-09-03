<div>
    <section class="bg-section" style="
        position: relative;
        min-height: 100%;
        background: var(--light-bg);
    ">
        
        <div class="container" style="position: relative; z-index: 1; padding: 25px 0px;">
            {{-- Section Title and Subtitle --}}
            @if(!request()->is('publication') && !request()->is('publications'))
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="text-center wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="sec-title">
                                @if($sectionSubtitle)
                                    <p class="sec-title__tagline">{!! $sectionSubtitle !!}</p>
                                @endif
                                @if($sectionTitle)
                                    <h2 class="sec-title__title">{!! $sectionTitle !!}</h2>
                                @endif
                                @if($sectionDescription)
                                    <p class="sec-title__text">{!! $sectionDescription !!}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @if ($showSearch)
                <!-- Search Section -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="text-center wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="publication-search-wrapper">
                                <div class="input-group publication-search-box">
                                    <input type="text" 
                                           wire:model.live.debounce.300ms="search" 
                                           class="form-control publication-search-input" 
                                           placeholder="Search publications..." 
                                           aria-label="Search publications">
                                    <button class="publication-search-btn" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                
                                @if(!empty($search))
                                    <div class="search-info mt-3 text-center">
                                        <span class="search-results-text">{{ $publications->count() }} publication(s) found for "{{ $search }}"</span>
                                        <button 
                                            wire:click="$set('search', '')"
                                            class="btn btn-outline-primary btn-sm ms-2"
                                            type="button"
                                        >
                                            <i class="fas fa-times me-1"></i>Clear Search
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div wire:loading.delay class="text-center mb-4">
                <div class="spinner-border" style="color: var(--procounsel-base);" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            @if ($publications->isNotEmpty())
                <div class="publication-grid" wire:loading.remove.delay>
                    @foreach ($publications as $index => $publication)
                        <div class="publication-item wow fadeInUp" data-wow-delay="{{ ($index % 4) * 100 }}ms">
                            <div class="award-one__item">
                                <div class="award-one__item__left">
                                    <h2 class="award-one__item__title">
                                        <a href="{{ route('publication.show', $publication->slug) }}">{{ $publication->title }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5" wire:loading.remove.delay>
                    <div class="empty-state">
                        <i class="fas fa-file-alt mb-3"></i>
                        @if(!empty($search))
                            <h4>No publications found for "{{ $search }}"</h4>
                            <p>Try searching with different keywords or browse all publications.</p>
                            <button 
                                wire:click="$set('search', '')"
                                class="procounsel-btn procounsel-btn--two mt-3"
                            >
                                <i>Show All Publications</i>
                                <span>Show All Publications</span>
                            </button>
                        @else
                            <h4>No publications available at the moment.</h4>
                            <p>Please check back later for our latest publications and resources.</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($showViewAll && $publications->isNotEmpty())
                <div class="text-center mt-5" wire:loading.remove.delay>
                    <a href="{{ route('publications.index') }}" class="procounsel-btn procounsel-btn--two">
                        <i>View All Publications</i>
                        <span>View All Publications</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .bg-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Publication Grid Styles */
        .publication-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
        }
        
        /* Make all cards equal height */
        .award-one__item {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .publication-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .publication-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .bg-section {
                min-height: 80vh !important;
            }
            
            .container {
                padding: 60px 15px !important;
            }
        }
        
        @media (max-width: 576px) {
            .publication-grid {
                grid-template-columns: 1fr;
            }
            
            .bg-section {
                min-height: 70vh !important;
            }
            
            .container {
                padding: 40px 15px !important;
            }
        }
        
        /* Modern text styling */
        .sec-title__title {
            color: var(--procounsel-primary) !important;
            font-size: 3rem;
            font-weight: 700;
            text-shadow: none;
            margin-bottom: 2rem;
        }
        
        .sec-title__tagline {
            color: var(--procounsel-base) !important;
            font-weight: 600;
            text-shadow: none;
            margin-bottom: 1rem;
        }
        
        .sec-title__tagline svg {
            fill: var(--procounsel-base);
        }
        
        /* Modern publication cards */
        .award-one__item {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 16px 24px;
            border: 1px solid rgba(111, 100, 211, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(111, 100, 211, 0.1);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .award-one__item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--procounsel-base), rgba(111, 100, 211, 0.7));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        
        .award-one__item:hover::before {
            transform: scaleX(1);
        }
        
        .award-one__item:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(111, 100, 211, 0.2);
        }
        
        .publication-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--procounsel-base), rgba(111, 100, 211, 0.8));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .publication-icon i {
            color: white;
            font-size: 24px;
        }
        
        .award-one__item__title {
            margin-bottom: 1rem;
        }
        
        .award-one__item__title a {
            color: var(--procounsel-primary) !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.25rem;
            line-height: 1.4;
            text-shadow: none;
            transition: color 0.3s ease;
        }
        
        .award-one__item__title a:hover {
            color: var(--procounsel-base) !important;
        }
        
        .award-one__item__text {
            color: var(--procounsel-text) !important;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            text-shadow: none;
        }
        
        .publication-meta {
            border-top: 1px solid rgba(111, 100, 211, 0.1);
            padding-top: 1rem;
        }
        
        .publication-date {
            color: var(--procounsel-text-gray);
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .publication-date i {
            color: var(--procounsel-base);
        }
        
        /* Empty state styling */
        .empty-state {
            padding: 4rem 2rem;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--procounsel-base);
            opacity: 0.6;
        }
        
        .empty-state h4 {
            color: var(--procounsel-primary) !important;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: none;
        }
        
        .empty-state p {
            color: var(--procounsel-text) !important;
            text-shadow: none;
            margin-bottom: 2rem;
        }
        
        /* Search input focus styles */
        .search-input:focus {
            outline: none;
            border-color: var(--procounsel-base) !important;
            box-shadow: 0 0 0 0.25rem rgba(111, 100, 211, 0.25) !important;
        }
        
        .search-box {
            transition: all 0.3s ease;
        }
        
        .search-box:hover {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 15px 40px rgba(111, 100, 211, 0.2) !important;
        }
        
        /* Search results animation */
        .publication-grid {
            transition: opacity 0.3s ease;
        }
        
        /* Smooth transitions for search results */
        [wire\:loading] .publication-grid {
            opacity: 0.5;
        }
        
        /* Search Styles */
        .publication-search-wrapper {
            max-width: 500px;
            margin: 0 auto;
        }

        .publication-search-box {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .publication-search-input {
            border: none;
            padding: 15px 25px;
            font-size: 1rem;
            border-radius: 50px 0 0 50px;
            background-color: var(--procounsel-white);
        }

        .publication-search-input:focus {
            box-shadow: none;
            border-color: transparent;
            background-color: var(--procounsel-white);
            outline: none;
        }

        .publication-search-btn {
            background-color: var(--procounsel-base);
            border: none;
            padding: 15px 25px;
            color: var(--procounsel-white);
            border-radius: 0 50px 50px 0;
            transition: background-color 0.3s ease;
        }

        .publication-search-btn:hover {
            background-color: var(--procounsel-primary);
        }
        
        .search-info {
            color: var(--procounsel-primary);
        }
        
        .search-results-text {
            color: var(--procounsel-primary);
            font-weight: 500;
        }
        
    
        
   
    </style>
</div>
