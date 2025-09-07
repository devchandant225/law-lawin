<div class="h-[200px]">
    <div class="absolute top-0 left-0 w-full z-30">
        <!-- Modern Page Banner with Tailwind CSS -->
        <section class="relative h-[300px]  flex items-center justify-center overflow-hidden pt-[4rem]">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ $backgroundImage ?? 'https://picsum.photos/1920/1080?random=2' }}');">
            </div>

            <!-- Primary Color Overlay with Gradient -->
            <div class="absolute inset-0 bg-accent/70"></div>

            <!-- Content Container -->
            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center mt-[5rem] mb-[3rem]">

                <!-- Breadcrumbs -->
                @if (isset($showBreadcrumbs) && $showBreadcrumbs && !empty($breadcrumbs))
                    <nav class="opacity-0 animate-fade-in-up"
                        style="animation-delay: 0.6s; animation-fill-mode: forwards;" aria-label="Breadcrumb">
                        <div
                            class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 text-sm sm:text-base">
                            @foreach ($breadcrumbs as $breadcrumb)
                                <div class="flex items-center">
                                    @if (!$loop->first)
                                        <svg class="w-4 h-4 text-blue-200 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    @if (isset($breadcrumb['url']) && !$loop->last)
                                        <a href="{{ $breadcrumb['url'] }}"
                                            class="text-white hover:text-white transition-colors duration-200 hover:underline">
                                            {{ $breadcrumb['label'] }}
                                        </a>
                                    @else
                                        <span class="text-white font-medium">{{ $breadcrumb['label'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </nav>
                @elseif(!empty($breadcrumbs))
                    <nav class="opacity-0 animate-fade-in-up"
                        style="animation-delay: 0.6s; animation-fill-mode: forwards;" aria-label="Breadcrumb">
                        <div
                            class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 text-sm sm:text-base">
                            @foreach ($breadcrumbs as $breadcrumb)
                                <div class="flex items-center">
                                    @if (!$loop->first)
                                        <svg class="w-4 h-4 text-blue-200 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    @if (isset($breadcrumb['url']) && !$loop->last)
                                        <a href="{{ $breadcrumb['url'] }}"
                                            class="text-blue-200 hover:text-white transition-colors duration-200 hover:underline">
                                            {{ $breadcrumb['label'] }}
                                        </a>
                                    @else
                                        <span class="text-white font-medium">{{ $breadcrumb['label'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </nav>
                @endif

                <h1 class="text-3xl font-bold text-white mt-4 leading-tight">
                    <span class="block opacity-0 animate-fade-in-up"
                        style="animation-delay: 0.2s; animation-fill-mode: forwards;">
                        {{ $title }}
                    </span>
                </h1>
            </div>

            <!-- Bottom Wave Decoration -->
            {{-- <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
                <svg class="relative block w-full h-12 md:h-16 lg:h-20" data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path
                        d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                        class="fill-white"></path>
                </svg>
            </div> --}}
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
