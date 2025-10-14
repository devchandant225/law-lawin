{{-- Page Section Title Component --}}
<div class="relative bg-accent py-6 overflow-hidden">
    {{-- Background Pattern/Effects --}}
    {{-- <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full">
            <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="currentColor" fill-opacity="0.3" 
                      d="M0,160L48,176C96,192,192,224,288,229.3C384,235,480,213,576,192C672,171,768,149,864,154.7C960,160,1056,192,1152,202.7C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </div> --}}
    
    {{-- Decorative Elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-8 right-8 w-32 h-32 border border-white/20 rounded-full animate-pulse"></div>
        <div class="absolute bottom-8 left-8 w-24 h-24 border border-white/20 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 border border-white/10 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/4 right-1/4 w-20 h-20 border border-white/10 rounded-full animate-pulse" style="animation-delay: 3s;"></div>
    </div>
    
    {{-- Content Container --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            {{-- Main Title --}}
            <h1 class="text-3xl font-semibold text-white leading-tight tracking-tight uppercase">
                <span class="inline-block transform hover:scale-105 transition-transform duration-300">
                    {!! $title !!}
                </span>
            </h1>
            
            {{-- Optional Breadcrumb or Navigation Hint --}}
            {{-- <div class="text-white/80 text-lg font-medium">
                <span class="hover:text-white transition-colors duration-300 cursor-default">
                    Professional Legal Services
                </span>
            </div> --}}
        </div>
    </div>

</div>

@props([
    'title' => 'Section Title'
])
