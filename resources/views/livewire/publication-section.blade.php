<div>
    <section class="relative py-8 bg-gray-800 overflow-hidden">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if ($showSearch)
                <!-- Search Section -->
                <div class="max-w-2xl mx-auto mb-16">
                    <div class="flex shadow-lg rounded-full overflow-hidden bg-white">
                        <input type="text"
                               wire:model.live.debounce.300ms="search"
                               class="flex-1 px-6 py-2 outline-none text-gray-700 placeholder:text-gray-400"
                               placeholder="Search publications..."
                               aria-label="Search publications">
                        <button type="button" class="px-6 bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    @if(!empty($search))
                        <div class="text-center text-white">
                            <span class="font-medium">{{ $publications->count() }} publication(s) found for "{{ $search }}"</span>
                            <button
                                wire:click="$set('search', '')"
                                type="button"
                                class="ml-2 inline-flex items-center px-3 py-1.5 rounded-full border border-white text-white hover:bg-white hover:text-primary text-sm transition-colors">
                                <i class="fas fa-times mr-2"></i>Clear Search
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            <div wire:loading.delay class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-full border-2 border-white border-t-transparent animate-spin"></div>
            </div>

            @if ($publications->isNotEmpty())
                <!-- Two-column responsive grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3" wire:loading.remove.delay>
                    @foreach ($publications as $index => $publication)
                        <div class="group relative bg-blue-200 rounded-xl border  shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="p-2">
                                <h2 class="text-base font-semibold text-gray-800 group-hover:text-primary transition-colors">
                                    <a href="{{ route('publication.show', $publication->slug) }}">{{$index + 1 . " . " . $publication->title }}</a>
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10" wire:loading.remove.delay>
                    <div class="flex flex-col items-center">
                        <i class="fas fa-file-alt text-5xl text-white/60 mb-4"></i>
                        @if(!empty($search))
                            <h4 class="text-2xl font-semibold text-white mb-2">No publications found for "{{ $search }}"</h4>
                            <p class="text-gray-300">Try searching with different keywords or browse all publications.</p>
                            <button
                                wire:click="$set('search', '')"
                                class="mt-4 inline-flex items-center px-6 py-3 rounded-full bg-secondary text-white hover:bg-accent hover:text-primary transition-colors">
                                <i class="fas fa-undo mr-2"></i>
                                <span>Show All Publications</span>
                            </button>
                        @else
                            <h4 class="text-2xl font-semibold text-white mb-2">No publications available at the moment.</h4>
                            <p class="text-gray-300">Please check back later for our latest publications and resources.</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($showViewAll && $publications->isNotEmpty())
                <div class="text-center mt-10" wire:loading.remove.delay>
                    <a href="{{ route('publications.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-full bg-primary text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-book-open mr-2"></i>
                        <span>View All Publications</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* No additional CSS required; Tailwind classes used for layout and colors */
    </style>
</div>
