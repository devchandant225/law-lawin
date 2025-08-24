<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto text-center">
        @if($topTitle)
            <div class="inline-block mb-4 px-4 py-2 bg-purple-100 text-[#6f64d3] rounded-full text-sm font-medium tracking-wide">
                {{ $topTitle }}
            </div>
        @endif

        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight tracking-tight">
            {!! $title !!}
        </h2>

        @if($description)
            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                {{ $description }}
            </p>
        @endif

        @if($ctaLink && $ctaText)
            <a href="{{ $ctaLink }}" class="inline-flex items-center px-8 py-3 bg-[#6f64d3] text-white rounded-lg hover:bg-[#5a50a8] transition-colors duration-300 shadow-lg hover:shadow-xl">
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        @endif
    </div>

    @if($decorative)
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg class="absolute top-0 left-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="#6f64d3" fill-opacity="0.1" d="M0,160L48,176C96,192,192,224,288,229.3C384,235,480,213,576,192C672,171,768,149,864,154.7C960,160,1056,192,1152,202.7C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>
    @endif
</div>

@props([
    'topTitle' => null,
    'title' => null,
    'description' => null,
    'ctaLink' => null,
    'ctaText' => null,
    'decorative' => false
])
