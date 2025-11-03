<div class="h-[85px]">
    <div class="absolute top-0 left-0 w-full z-30">
        <!-- Breadcrumb Style Banner with Primary Color Background -->
        <section class="relative h-[200px] flex flex-col justify-between overflow-hidden pt-[4rem] bg-gray-800">
            <!-- Empty space for banner height -->
            <div class="flex-grow"></div>

            <!-- Breadcrumbs at Bottom -->
            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 pb-6">
                @if (isset($showBreadcrumbs) && $showBreadcrumbs && !empty($breadcrumbs))
                    <nav class="opacity-0 animate-fade-in-up"
                        style="animation-delay: 0.4s; animation-fill-mode: forwards;" aria-label="Breadcrumb">
                        <div class="flex items-center space-x-1 text-sm">
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if (!$loop->first)
                                    <svg class="w-4 h-4 text-white/60 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                @if (isset($breadcrumb['url']) && !$loop->last)
                                    <a href="{{ $breadcrumb['url'] }}"
                                        class="text-white/80 hover:text-white transition-colors duration-200 hover:underline">
                                        {{ $breadcrumb['label'] }}
                                    </a>
                                @else
                                    <span class="text-white font-medium">{{ $breadcrumb['label'] }}</span>
                                @endif
                            @endforeach
                        </div>
                    </nav>
                @elseif(!empty($breadcrumbs))
                    <nav class="opacity-0 animate-fade-in-up"
                        style="animation-delay: 0.4s; animation-fill-mode: forwards;" aria-label="Breadcrumb">
                        <div class="flex items-center space-x-1 text-sm">
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if (!$loop->first)
                                    <svg class="w-4 h-4 text-white/60 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                @if (isset($breadcrumb['url']) && !$loop->last)
                                    <a href="{{ $breadcrumb['url'] }}"
                                        class="text-white/80 hover:text-white transition-colors duration-200 hover:underline">
                                        {{ $breadcrumb['label'] }}
                                    </a>
                                @else
                                    <span class="text-white font-medium">{{ $breadcrumb['label'] }}</span>
                                @endif
                            @endforeach
                        </div>
                    </nav>
                @endif
            </div>
        </section>
    </div>
</div>
<!-- Add custom CSS for animations -->
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out;
    }
</style>
