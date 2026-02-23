<div class="more-pub mb-5">
    <!-- More Publications Section -->
    <section class="section-padding background-gray" wire:ignore.self>
        <div class="container">
            @if ($showSearch)
                <!-- Search Section -->
                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <div class="text-center wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="more-publication-search-wrapper">
                                <div class="input-group more-publication-search-box">
                                    <input type="text" wire:model.live.debounce.300ms="search"
                                        class="form-control more-publication-search-input"
                                        placeholder="Search more publications..." aria-label="Search more publications">
                                    <button class="more-publication-search-btn" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row" id="more-publications-container">
                @forelse($morePublications as $index => $morePublication)
                    <div class="col-xl-6 col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="{{ 200 + $index * 100 }}ms"
                        data-wow-duration="1500ms" wire:key="more-publication-{{ $morePublication->id }}">
                        <div class="more-publication-item">
                            <div class="more-publication-item__image">
                                @if ($morePublication->feature_image_url)
                                    <img src="{{ $morePublication->feature_image_url }}"
                                        alt="{{ $morePublication->feature_image_alt ?: $morePublication->title }}">
                                @else
                                    <div class="more-publication-placeholder">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                @endif
                                <div class="more-publication-item__overlay">
                                    <a href="{{ route('more-publication.show', $morePublication->slug) }}"
                                        class="more-publication-item__btn">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="more-publication-item__content">
                                <div class="more-publication-item__meta">
                                    <span class="more-publication-item__date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $morePublication->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="more-publication-item__type">
                                        <i class="fas fa-tag"></i>
                                        More Publication
                                    </span>
                                </div>
                                <h3 class="more-publication-item__title">
                                    <a href="{{ route('more-publication.show', $morePublication->slug) }}">
                                        {{ $morePublication->title }}
                                    </a>
                                </h3>
                                @if ($morePublication->excerpt)
                                    <p class="more-publication-item__text">
                                        {{ Str::limit($morePublication->excerpt, 150) }}
                                    </p>
                                @endif
                                <div class="more-publication-item__bottom">
                                    <a href="{{ route('more-publication.show', $morePublication->slug) }}"
                                        class="procounsel-btn procounsel-btn--two">
                                        <i>Read More</i>
                                        <span>Read More</span>
                                    </a>
                                    @if ($morePublication->tableOfContentsCount() > 0)
                                        <span class="more-publication-sections-count">
                                            <i class="fas fa-list-ol"></i>
                                            {{ $morePublication->tableOfContentsCount() }} Sections
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <div class="no-more-publications-found">
                                <i class="fas fa-search mb-3"></i>
                                <h4>No More Publications Found</h4>
                                <p class="text-muted">
                                    @if ($search)
                                        No more publications match your search criteria "{{ $search }}".
                                    @else
                                        No more publications are currently available.
                                    @endif
                                </p>
                                @if ($search)
                                    <button wire:click="$set('search', '')" class="btn btn-outline-primary">
                                        <i class="fas fa-times me-2"></i>Clear Search
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($showViewAll && $morePublications->count() >= $limit)
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mt-4 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <a href="{{ route('more-publications.index') }}" class="procounsel-btn">
                                <i>View All More Publications</i>
                                <span>View All More Publications</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        .more-pub {
            padding-bottom: 50px;
        }

        /* More Publication Section Styles */
        .more-publication-item {
            background-color: var(--procounsel-white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .more-publication-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .more-publication-item__image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .more-publication-item__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .more-publication-item:hover .more-publication-item__image img {
            transform: scale(1.05);
        }

        .more-publication-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--procounsel-gray) 0%, var(--procounsel-gray2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--procounsel-text);
        }

        .more-publication-item__overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .more-publication-item:hover .more-publication-item__overlay {
            opacity: 1;
        }

        .more-publication-item__btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--procounsel-base);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--procounsel-white);
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            transform: scale(0.8);
        }

        .more-publication-item:hover .more-publication-item__btn {
            transform: scale(1);
            background-color: var(--procounsel-primary);
        }

        .more-publication-item__content {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .more-publication-item__meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: var(--procounsel-text);
        }

        .more-publication-item__date,
        .more-publication-item__type {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .more-publication-item__type {
            background-color: var(--procounsel-gray);
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.8rem;
            color: var(--procounsel-base);
            font-weight: 500;
        }

        .more-publication-item__title {
            font-family: var(--procounsel-heading-font);
            font-size: 1.4rem;
            font-weight: 400;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .more-publication-item__title a {
            color: var(--procounsel-black);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .more-publication-item__title a:hover {
            color: var(--procounsel-base);
        }

        .more-publication-item__text {
            color: var(--procounsel-text);
            line-height: 1.6;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .more-publication-item__bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .more-publication-sections-count {
            color: var(--procounsel-text);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Search Styles */
        .more-publication-search-wrapper {
            max-width: 500px;
            margin: 0 auto;
        }

        .more-publication-search-box {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .more-publication-search-input {
            border: none;
            padding: 15px 25px;
            font-size: 1rem;
            border-radius: 50px 0 0 50px;
            background-color: var(--procounsel-white);
        }

        .more-publication-search-input:focus {
            box-shadow: none;
            border-color: transparent;
            background-color: var(--procounsel-white);
        }

        .more-publication-search-btn {
            background-color: var(--procounsel-base);
            border: none;
            padding: 15px 25px;
            color: var(--procounsel-white);
            border-radius: 0 50px 50px 0;
            transition: background-color 0.3s ease;
        }

        .more-publication-search-btn:hover {
            background-color: var(--procounsel-primary);
        }

        /* No Results Styles */
        .no-more-publications-found {
            padding: 40px 20px;
        }

        .no-more-publications-found i {
            font-size: 4rem;
            color: var(--procounsel-gray2);
        }

        .no-more-publications-found h4 {
            font-family: var(--procounsel-heading-font);
            color: var(--procounsel-black);
            margin-bottom: 15px;
        }

        /* Loading States */
        .more-publication-item.loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .more-publication-item__content {
                padding: 20px;
            }

            .more-publication-item__title {
                font-size: 1.2rem;
            }

            .more-publication-item__bottom {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .more-publication-sections-count {
                text-align: center;
            }
        }

        /* Animation and Transitions */
        .more-publication-item {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Wire Loading */
        [wire\:loading] .more-publication-item {
            opacity: 0.7;
        }

        [wire\:loading.remove] .more-publication-item {
            display: none;
        }

        /* Search Loading State */
        .more-publication-search-box [wire\:loading] {
            opacity: 0.7;
        }
    </style>
</div>
