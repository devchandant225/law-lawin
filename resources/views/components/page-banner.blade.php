<!-- Modern Page Banner with Gallery Hero Design -->
<section class="hero-section bg-gradient-to-r from-primary to-secondary py-20 relative overflow-hidden">
    <!-- Background Image (optional) -->
    @if(isset($backgroundImage) && $backgroundImage)
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20"
            style="background-image: url('{{ $backgroundImage }}');">
        </div>
    @endif
    
    <!-- Content Container -->
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="max-w-4xl mx-auto">

            <!-- Breadcrumbs -->
            @if (isset($showBreadcrumbs) && $showBreadcrumbs && !empty($breadcrumbs))
                <nav class="animate-fade-in-delay-2 mb-4" aria-label="Breadcrumb">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 text-sm sm:text-base">
                        @foreach ($breadcrumbs as $breadcrumb)
                            <div class="flex items-center">
                                @if (!$loop->first)
                                    <svg class="w-4 h-4 text-white/70 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                @if (isset($breadcrumb['url']) && !$loop->last)
                                    <a href="{{ $breadcrumb['url'] }}"
                                        class="text-white/90 hover:text-white transition-colors duration-200 hover:underline">
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
                <nav class="animate-fade-in-delay-2 mb-4" aria-label="Breadcrumb">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 text-sm sm:text-base">
                        @foreach ($breadcrumbs as $breadcrumb)
                            <div class="flex items-center">
                                @if (!$loop->first)
                                    <svg class="w-4 h-4 text-white/70 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                @if (isset($breadcrumb['url']) && !$loop->last)
                                    <a href="{{ $breadcrumb['url'] }}"
                                        class="text-white/90 hover:text-white transition-colors duration-200 hover:underline">
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

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in">
                {{ $title }}
            </h1>
            
            <!-- Subtitle (optional) -->
            @if(isset($subtitle) && $subtitle)
                <p class="text-xl md:text-2xl text-white/90 mb-8 animate-fade-in-delay">
                    {{ $subtitle }}
                </p>
            @endif
            
            <!-- Decorative Line -->
            <div class="w-24 h-1 bg-white/30 mx-auto animate-fade-in-delay-2"></div>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="floating-element absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full"></div>
        <div class="floating-element absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full delay-1000"></div>
        <div class="floating-element absolute bottom-20 left-20 w-12 h-12 bg-white/10 rounded-full delay-2000"></div>
        <div class="floating-element absolute top-32 right-40 w-8 h-8 bg-white/10 rounded-full delay-500"></div>
        <div class="floating-element absolute bottom-32 right-10 w-14 h-14 bg-white/10 rounded-full delay-1500"></div>
    </div>
</section>
<!-- Enhanced Animations and Styles -->
<style>
/* Hero Animations */
.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.2s both;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1s ease-out 0.4s both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating Elements */
.floating-element {
    animation: float 3s ease-in-out infinite;
}

.floating-element.delay-500 {
    animation-delay: 0.5s;
}

.floating-element.delay-1000 {
    animation-delay: 1s;
}

.floating-element.delay-1500 {
    animation-delay: 1.5s;
}

.floating-element.delay-2000 {
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-element {
        display: none;
    }
}
</style>
