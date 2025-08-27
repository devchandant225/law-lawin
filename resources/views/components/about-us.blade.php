<!-- Modern About Us Section with Grid Background and Enhanced Animations -->
<div class="about-us-wrapper relative overflow-hidden bg-accent">

    <!-- Modern Line Grid Background -->
    <div class="absolute inset-0 bg-grid-pattern opacity-[0.03]"></div>

    <!-- Floating Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-r from-[#6F64D3]/10 to-[#ADA769]/10 rounded-full blur-3xl animate-float">
        </div>
        <div
            class="absolute bottom-20 right-10 w-96 h-96 bg-gradient-to-l from-[#ADA769]/10 to-[#6F64D3]/10 rounded-full blur-3xl animate-float-delay">
        </div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-br from-[#6F64D3]/5 to-[#ADA769]/5 rounded-full blur-2xl animate-pulse-slow">
        </div>
    </div>

    <div class="relative container mx-auto px-4 py-10">
        @if ($contentSections->isNotEmpty())
            <!-- Modern Section Header -->
            <div class="text-center mb-12 animate-fade-in-up">

                <div class="">
                    <span
                        class="inline-block px-4 py-2 text-white bg-secondary text-sm font-semibold rounded-full animate-slide-down">
                        DISCOVER OUR STORY
                    </span>
                </div>
                <div class="flex gap-3 justify-center items-center mt-2">
                    {{-- <div
                        class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-[#6F64D3] to-[#ADA769] rounded-2xl animate-bounce-modern shadow-lg">
                        <svg class="w-10 h-10 text-white animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div> --}}
                    <div>
                        <h1
                            class="text-4xl md:text-4xl lg:text-4xl font-bold bg-primary bg-clip-text text-transparent leading-tight">
                            About Our Company
                        </h1>
                    </div>

                </div>

            </div>

            <!-- Content Sections -->
            <div class="space-y-24 lg:space-y-20">
                @foreach ($contentSections as $index => $section)
                    <div class="about-section animate-fade-in-up" style="animation-delay: {{ $index * 0.3 }}s">

                        <!-- Modern Section Container -->
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                            <!-- Text Content -->
                            <div
                                class="lg:col-span-6 {{ $index % 2 == 0 ? 'order-2 lg:order-1' : 'order-2 lg:order-2' }}">
                                <div class="relative group">

                                    <!-- Modern Title with Animation -->
                                    <div class="relative mb-8">
                                        <h2 class="text-4xl font-black text-primary mb-4 pb-2 animate-text-reveal">
                                            {{ $section->title }}
                                        </h2>
                                        <div class="flex items-center mb-3 w-[8rem]">
                                            <div class="w-[2rem] h-1 bg-secondary rounded-full mr-4 animate-expand">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enhanced Description Content -->
                                    <div class="space-y-8 p-2">
                                        @if ($section->desc_1)
                                            <p class="text-gray-900 text-lg lg:text-xl leading-relaxed font-medium animate-slide-in-left"
                                                style="animation-delay: 0.6s">
                                                {!! $section->desc_1 !!}
                                            </p>
                                        @endif


                                    </div>

                                    <!-- Modern CTA Button -->
                                    {{-- <div class="mt-10 animate-fade-in-up" style="animation-delay: 1s">
                                        <button
                                            class="modern-btn group relative overflow-hidden px-8 py-4 bg-gradient-to-r from-[#6F64D3] to-[#ADA769] text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                            <!-- Button Background Animation -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-[#ADA769] to-[#6F64D3] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            </div>

                                            <!-- Shimmer Effect -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                                            </div>

                                            <div class="relative flex items-center">
                                                <span class="text-sm font-bold uppercase tracking-wider mr-3">Learn
                                                    More</span>
                                                <div
                                                    class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center group-hover:rotate-45 transition-transform duration-300">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Ripple Effect -->
                                            <div
                                                class="absolute inset-0 rounded-2xl opacity-0 group-active:opacity-100">
                                                <div class="absolute inset-0 bg-white/20 rounded-2xl animate-ping">
                                                </div>
                                            </div>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Modern Images Container -->
                            <div
                                class="lg:col-span-6 {{ $index % 2 == 0 ? 'order-1 lg:order-2' : 'order-1 lg:order-1' }}">
                                <div class="relative animate-scale-in" style="animation-delay: 0.4s">
                                    @if ($section->image1)
                                        <!-- Main Image with Modern Effects -->
                                        <div class="relative group cursor-pointer">
                                            <!-- Glow Effect -->
                                            <div
                                                class="absolute -inset-4 bg-gradient-to-r from-[#6F64D3]/20 to-[#ADA769]/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-500">
                                            </div>

                                            <div
                                                class="relative rounded-3xl overflow-hidden shadow-2xl transform group-hover:-rotate-2 transition-all duration-700 border border-white/20">
                                                <img src="{{ asset('storage/' . $section->image1) }}"
                                                    alt="{{ $section->title }}"
                                                    class="w-full h-[24rem] lg:h-[25rem] xl:h-[28rem] object-cover transition-all duration-700 group-hover:scale-110">

                                                <!-- Modern Gradient Overlay -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-[#6F64D3]/10 via-transparent to-[#ADA769]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                </div>

                                                <!-- Geometric Decorations -->
                                                <div
                                                    class="absolute top-6 right-6 w-8 h-8 border-t-3 border-r-3 border-white/70 opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
                                                </div>
                                                <div
                                                    class="absolute bottom-6 left-6 w-8 h-8 border-b-3 border-l-3 border-white/70 opacity-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
                                                </div>

                                                <!-- Modern Scan Line Effect -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                                                </div>
                                            </div>

                                            @if ($index == 0)
                                                <!-- Modern Floating Badge -->
                                                <div
                                                    class="absolute -bottom-6 -left-6 group-hover:scale-110 transition-transform duration-300">
                                                    <div
                                                        class="bg-white backdrop-blur-lg border border-white/20 px-6 py-3 rounded-2xl shadow-xl">
                                                        <div class="flex items-center space-x-3">
                                                            <div
                                                                class="w-3 h-3 bg-gradient-to-r from-[#6F64D3] to-[#ADA769] rounded-full animate-pulse">
                                                            </div>
                                                            <span
                                                                class="text-gray-800 font-bold text-sm">Excellence</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($section->image2)
                                        <!-- Secondary Image with Modern Style -->
                                        <div
                                            class="absolute -bottom-12 -right-12 lg:-bottom-16 lg:-right-16 w-36 h-36 lg:w-56 lg:h-56">
                                            <div class="relative group cursor-pointer">
                                                <!-- Glow for Secondary Image -->
                                                <div
                                                    class="absolute -inset-2 bg-gradient-to-r from-[#ADA769]/30 to-[#6F64D3]/30 rounded-3xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                </div>

                                                <div
                                                    class="relative rounded-3xl overflow-hidden shadow-xl border-4 border-white transform group-hover:rotate-6 transition-all duration-500">
                                                    <img src="{{ asset('storage/' . $section->image2) }}"
                                                        alt="{{ $section->title }}"
                                                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">

                                                    <!-- Secondary Image Modern Overlay -->
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-tr from-[#ADA769]/20 to-[#6F64D3]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Modern Decorative Background Elements -->
                                    <div
                                        class="absolute -z-10 top-12 right-12 w-40 h-40 bg-gradient-to-br from-[#6F64D3]/5 to-[#ADA769]/5 rounded-full blur-3xl animate-pulse-slow">
                                    </div>
                                    <div class="absolute -z-10 -bottom-8 -left-8 w-32 h-32 bg-gradient-to-tr from-[#ADA769]/5 to-[#6F64D3]/5 rounded-full blur-2xl animate-pulse-slow"
                                        style="animation-delay: 1s"></div>

                                    <!-- Floating Geometric Shapes -->
                                    <div
                                        class="absolute -z-10 top-4 left-4 w-4 h-4 bg-gradient-to-r from-[#6F64D3] to-[#ADA769] rounded-full animate-float opacity-20">
                                    </div>
                                    <div
                                        class="absolute -z-10 bottom-8 right-8 w-6 h-6 bg-gradient-to-r from-[#ADA769] to-[#6F64D3] rotate-45 animate-float-delay opacity-20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            @if ($section->desc_2)
                                <p class="text-gray-900 mt-8 text-base lg:text-lg leading-relaxed animate-slide-in-left"
                                    style="animation-delay: 0.8s">
                                    {!! $section->desc_2 !!}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Enhanced Modern Empty State -->
            <div class="text-center py-32 animate-fade-in-up">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-3xl mb-8 shadow-lg">
                    <svg class="w-12 h-12 text-gray-400 animate-pulse" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-700 mb-6">No Content Available</h3>
                <p class="text-gray-500 text-lg max-w-lg mx-auto leading-relaxed">There's no content to display at the
                    moment. Please check back later or contact us for more information.</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* Modern About Us Enhanced Styles */
    .about-us-wrapper {
        min-height: 100vh;
        position: relative;
    }

    /* Advanced Grid Animation */
    @keyframes gridPulse {

        0%,
        100% {
            opacity: 0.3;
        }

        50% {
            opacity: 0.6;
        }
    }

    .about-us-wrapper svg {
        animation: gridPulse 4s ease-in-out infinite;
    }

    /* Modern Floating Animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        25% {
            transform: translateY(-20px) rotate(1deg);
        }

        50% {
            transform: translateY(-10px) rotate(-1deg);
        }

        75% {
            transform: translateY(-30px) rotate(0.5deg);
        }
    }

    @keyframes floatDelay {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        25% {
            transform: translateY(-30px) rotate(-1deg);
        }

        50% {
            transform: translateY(-5px) rotate(1deg);
        }

        75% {
            transform: translateY(-20px) rotate(-0.5deg);
        }
    }

    @keyframes pulseSlow {

        0%,
        100% {
            opacity: 0.3;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(1.05);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-delay {
        animation: floatDelay 8s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulseSlow 4s ease-in-out infinite;
    }

    /* Modern Entrance Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(60px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-80px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(80px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes textReveal {
        from {
            opacity: 0;
            transform: translateY(30px);
            filter: blur(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }

    @keyframes expand {
        from {
            width: 0;
            opacity: 0;
        }

        to {
            width: 100%;
            opacity: 1;
        }
    }

    @keyframes bounceModern {

        0%,
        20%,
        53%,
        80%,
        100% {
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            transform: translate3d(0, 0, 0) scale(1);
        }

        40%,
        43% {
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            transform: translate3d(0, -15px, 0) scale(1.05);
        }

        70% {
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            transform: translate3d(0, -8px, 0) scale(1.02);
        }

        90% {
            transform: translate3d(0, -3px, 0) scale(1.01);
        }
    }

    /* Animation Classes */
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-down {
        animation: slideDown 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-scale-in {
        animation: scaleIn 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-text-reveal {
        animation: textReveal 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-expand {
        animation: expand 0.8s ease-out forwards;
        width: 0;
    }

    .animate-bounce-modern {
        animation: bounceModern 3s infinite;
    }

    /* Modern Button Styles */
    .modern-btn {
        position: relative;
        transform-style: preserve-3d;
        will-change: transform;
    }

    .modern-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.2) 50%, transparent 70%);
        border-radius: inherit;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modern-btn:hover::before {
        opacity: 1;
    }

    .modern-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* Gradient Number Styling */
    .text-gradient-number {
        background: linear-gradient(135deg, #6F64D3, #ADA769, #6F64D3);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Image Hover Effects Enhancement */
    .about-section img {
        filter: brightness(0.95) contrast(1.05) saturate(0.95);
        transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .about-section:hover img {
        filter: brightness(1.05) contrast(1.15) saturate(1.1);
    }

    /* Modern Glassmorphism Effects */
    .backdrop-blur-lg {
        backdrop-filter: blur(16px) saturate(1.8);
        -webkit-backdrop-filter: blur(16px) saturate(1.8);
    }

    /* Enhanced Shadow System */
    .shadow-2xl {
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }



    /* Responsive Enhancements */
    @media (max-width: 1024px) {
        .about-section img {
            height: 22rem;
        }

        .about-section h2 {
            font-size: 2.5rem;
            line-height: 1.1;
        }
    }

    @media (max-width: 768px) {
        .about-us-wrapper {
            min-height: auto;
        }

        .about-section {
            margin-bottom: 3rem;
        }

        .about-section h2 {
            font-size: 2rem;
            line-height: 1.2;
        }

        .about-section img {
            height: 18rem;
        }

        .about-section .absolute[class*="-bottom-12"] {
            bottom: -1.5rem;
            right: -1.5rem;
            width: 5rem;
            height: 5rem;
        }

        .modern-btn {
            padding: 0.875rem 1.5rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 640px) {
        .about-section h1 {
            font-size: 2.5rem;
        }

        .about-section .absolute[class*="text-8xl"] {
            font-size: 4rem;
            top: -2rem;
            left: -1rem;
        }
    }

    /* Performance Optimizations */
    .about-section,
    .about-section img,
    .modern-btn {
        will-change: transform;
        transform: translateZ(0);
    }

    /* Modern Focus States */
    .modern-btn:focus,
    .group:focus {
        outline: 2px solid rgba(59, 130, 246, 0.5);
        outline-offset: 4px;
        border-radius: 1rem;
    }

    /* Border Enhancements */
    .border-t-3 {
        border-top-width: 3px;
    }

    .border-r-3 {
        border-right-width: 3px;
    }

    .border-b-3 {
        border-bottom-width: 3px;
    }

    .border-l-3 {
        border-left-width: 3px;
    }

    /* Text Rendering Optimization */
    .about-section h1,
    .about-section h2,
    .about-section p {
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

    }

    /* Modern Scroll Behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Section Separation with Modern Lines */
    .about-section+.about-section::before {
        content: '';
        position: absolute;
        top: -4rem;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 2px;
        background: linear-gradient(to right, transparent, rgba(59, 130, 246, 0.3) 20%, rgba(147, 51, 234, 0.3) 80%, transparent);
    }

    /* Advanced Loading States */
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .about-section img {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 37%, #f0f0f0 63%);
        background-size: 400% 100%;
        animation: shimmer 1.8s ease-in-out infinite;
    }

    .about-section img[src] {
        animation: none;
        background: none;
    }


    /* Intersection Observer Animation Triggers */
    .about-section[data-animate="true"] {
        opacity: 1;
        transform: translateY(0);
    }

    .about-section[data-animate="false"] {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Modern Tooltip Effects */
    .modern-btn::after {
        content: 'Click to explore more';
        position: absolute;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        z-index: 1000;
    }

    .modern-btn::before {
        content: '';
        position: absolute;
        bottom: 110%;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid rgba(0, 0, 0, 0.9);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modern-btn:hover::after,
    .modern-btn:hover::before {
        opacity: 1;
    }

    /* Enhanced Accessibility */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    }

    /* Print Styles */
    @media print {
        .about-us-wrapper {
            background: white !important;
            color: black !important;
        }

        .animate-fade-in-up,
        .animate-slide-in-left,
        .animate-slide-in-right {
            opacity: 1 !important;
            transform: none !important;
        }

        .modern-btn {
            background: #6F64D3 !important;
            color: white !important;
            box-shadow: none !important;
        }
    }

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {

        .about-section h1,
        .about-section h2 {
            color: #000000;
            text-shadow: none;
        }

        .modern-btn {
            background: #6F64D3 !important;
            border: 2px solid #000000;
        }

        .about-section img {
            filter: contrast(1.2);
        }
    }

    /* Modern Scrollbar Styling */
    .about-us-container::-webkit-scrollbar {
        width: 8px;
    }

    .about-us-container::-webkit-scrollbar-track {
        background: rgba(148, 163, 184, 0.1);
        border-radius: 4px;
    }

    .about-us-container::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #6F64D3, #ADA769);
        border-radius: 4px;
    }

    .about-us-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #5A4CAF, #8E7A55);
    }

    /* Advanced Micro-interactions */
    .about-section:hover .text-gradient-number {
        animation: gradientShift 2s ease-in-out infinite;
    }

    @keyframes gradientShift {

        0%,
        100% {
            background: linear-gradient(135deg, #6F64D3, #ADA769, #6F64D3);
            -webkit-background-clip: text;
            background-clip: text;
        }

        50% {
            background: linear-gradient(135deg, #ADA769, #6F64D3, #ADA769);
            -webkit-background-clip: text;
            background-clip: text;
        }
    }

    /* Content Loading Animation */
    @keyframes contentFadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .about-section p {
        animation: contentFadeIn 0.6s ease-out forwards;
        animation-delay: calc(var(--delay, 0) * 0.1s);
    }

    /* Modern Card Hover Effects */
    .about-section:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    .about-section::before {
        content: '';
        position: absolute;
        inset: -20px;
        background: linear-gradient(45deg,
                rgba(59, 130, 246, 0.05),
                rgba(147, 51, 234, 0.05),
                rgba(99, 102, 241, 0.05));
        border-radius: 2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }


    /* Final Responsive Adjustments */
    @media (max-width: 480px) {
        .about-us-container {
            padding: 1rem;
        }

        .about-section h1 {
            font-size: 2rem;
            line-height: 1.1;
        }

        .about-section .absolute[class*="w-40"] {
            width: 6rem;
            height: 6rem;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
        }
    }

    /* Animation Performance Optimization */
    @media (min-width: 1024px) {
        .about-section {
            contain: layout style paint;
        }
    }
</style>
