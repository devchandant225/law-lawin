{{-- AOS (Animate On Scroll) Library --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Initialize AOS
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false,
            offset: 50,
            delay: 0,
        });
        
        // Refresh AOS on window resize
        window.addEventListener('resize', function() {
            AOS.refresh();
        });
        
        // Refresh AOS on Livewire page load
        document.addEventListener('livewire:load', function() {
            AOS.refresh();
        });
        
        // Refresh AOS on Livewire updates
        document.addEventListener('livewire:update', function() {
            setTimeout(() => {
                AOS.refresh();
            }, 100);
        });
    });
</script>

<style>
    /* Custom AOS enhancements */
    [data-aos] {
        pointer-events: none;
    }
    
    [data-aos].aos-animate {
        pointer-events: auto;
    }
    
    /* Smooth scrolling for better AOS experience */
    html {
        scroll-behavior: smooth;
    }
    
    /* Additional animation delays */
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
