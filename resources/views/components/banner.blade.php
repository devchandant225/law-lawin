{{-- Plant Breeding Organization Swiper Banner Component --}}
@if($sliders->count() > 0)
<section class="relative min-h-screen w-full overflow-hidden">
    {{-- Swiper Container --}}
    <div class="swiper banner-swiper h-screen w-full">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide relative group">
                    {{-- Background Image --}}
                    <div class="absolute inset-0 z-10 bg-black/50"></div>
                    <img 
                        src="{{ $slider->image_url }}" 
                        alt="{{ $slider->title }}" 
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                    
                    {{-- Content Overlay --}}
                    <div class="relative z-20 flex items-center justify-center h-full">
                        <div class="container mx-auto px-4 text-center">
                            <div 
                                class="max-w-3xl mx-auto text-white transform transition-all duration-700 
                                       translate-y-10 opacity-0 group-[.swiper-slide-active]:translate-y-0 group-[.swiper-slide-active]:opacity-100"
                            >
                                <h2 
                                    class="text-4xl md:text-6xl font-bold mb-6 tracking-tight 
                                           animate-fade-in-up"
                                >
                                    {{ $slider->title ?? 'Default Slider Title' }}
                                </h2>
                                
                                @if($slider->description)
                                    <p 
                                        class="text-lg md:text-xl mb-8 leading-relaxed 
                                               animate-fade-in-up animation-delay-200"
                                    >
                                        {{ $slider->description }}
                                    </p>
                                @endif
                          
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
     
        {{-- Navigation Buttons --}}
        <div class="swiper-button-prev text-white z-30 !hidden md:!flex"></div>
        <div class="swiper-button-next text-white z-30 !hidden md:!flex"></div>
        
        {{-- Pagination --}}
        <div class="swiper-pagination z-30"></div>
    </div>
</section>

@push('styles')
<link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
/>
<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
        opacity: 0;
    }
    
    .animation-delay-200 {
        animation-delay: 0.2s;
    }
    
    .animation-delay-400 {
        animation-delay: 0.4s;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bannerSwiper = new Swiper('.banner-swiper', {
        loop: true,
        effect: 'fade',
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        fadeEffect: {
            crossFade: true
        },
    });
});
</script>
@endpush
@else
<section class="relative min-h-screen w-full flex items-center justify-center bg-gray-100">
    <div class="text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">No Sliders Available</h2>
        <p class="text-xl text-gray-600">Please add some sliders in the admin panel.</p>
    </div>
</section>
@endif