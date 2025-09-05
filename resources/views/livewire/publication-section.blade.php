<div>
    <section class="relative py-16 bg-gradient-to-b from-primary to-primary/90 overflow-hidden">
        <!-- Decorative blobs -->
        <div class="pointer-events-none absolute -top-10 -right-10 w-80 h-80 bg-accent/20 rounded-full blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-10 -left-10 w-96 h-96 bg-secondary/30 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if ($showSearch)
                <!-- Search Section -->
                <div class="max-w-2xl mx-auto mb-16">
                    <div class="flex shadow-lg rounded-full overflow-hidden bg-white">
                        <input type="text"
                               wire:model.live.debounce.300ms="search"
                               class="flex-1 px-6 py-4 outline-none text-gray-700 placeholder:text-gray-400"
                               placeholder="Search publications..."
                               aria-label="Search publications">
                        <button type="button" class="px-6 bg-secondary text-white hover:bg-accent hover:text-primary transition-colors duration-300">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8" wire:loading.remove.delay>
                    @foreach ($publications as $index => $publication)
                        <div class="group relative bg-secondary rounded-2xl border border-accent/20 hover:border-accent/40 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <!-- Accent top bar -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-accent via-white to-accent opacity-70"></div>

                            <div class="p-6">
                                <h2 class="text-xl font-bold text-white group-hover:text-accent transition-colors duration-300 mb-2">
                                    <a href="{{ route('publication.show', $publication->slug) }}">{{ $publication->title }}</a>
                                </h2>
                            </div>

                            <!-- Hover glow -->
                            <div class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="absolute inset-0 bg-gradient-to-tr from-accent/10 via-white/5 to-accent/20"></div>
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
                       class="inline-flex items-center px-8 py-4 rounded-full bg-secondary text-white font-semibold hover:from-accent hover:to-secondary hover:text-primary transition-all duration-300 shadow-lg hover:shadow-xl">
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
