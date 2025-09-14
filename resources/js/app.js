import './bootstrap';
import { Swiper } from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/autoplay';
import 'swiper/css/effect-fade';

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Hero Swiper
    const heroSwiper = new Swiper('.hero-swiper', {
        modules: [Navigation, Pagination, Autoplay, EffectFade],
        loop: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        speed: 1000,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            nextEl: '.hero-nav-next',
            prevEl: '.hero-nav-prev',
        },
        pagination: {
            el: '.hero-pagination',
            clickable: true,
            bulletClass: 'swiper-pagination-bullet',
            bulletActiveClass: 'swiper-pagination-bullet-active',
        },
        // Responsive breakpoints
        breakpoints: {
            320: {
                // Mobile
                autoplay: {
                    delay: 5000,
                },
            },
            768: {
                // Tablet
                autoplay: {
                    delay: 6000,
                },
            },
            1024: {
                // Desktop
                autoplay: {
                    delay: 7000,
                },
            }
        },
        // Accessibility
        a11y: {
            prevSlideMessage: 'Previous slide',
            nextSlideMessage: 'Next slide',
        },
        // Keyboard navigation
        keyboard: {
            enabled: true,
        },
        // Mouse wheel control
        mousewheel: {
            forceToAxis: true,
        },
    });

    // Sticky Header Functionality
    const header = document.querySelector('header');
    const heroSection = document.querySelector('#home');
    
    if (header && heroSection) {
        // Add overlay class initially if we're at the top
        if (window.scrollY === 0) {
            header.classList.add('header-overlay');
            header.classList.add('absolute', 'top-0', 'left-0', 'right-0', 'z-50');
        }

        // Handle scroll events
        let ticking = false;
        
        function updateHeader() {
            const heroHeight = heroSection.offsetHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop <= 100) {
                // At the top - overlay mode
                header.classList.add('header-overlay');
                header.classList.remove('header-sticky');
                header.classList.add('absolute', 'top-0', 'left-0', 'right-0', 'z-50');
                header.classList.remove('sticky', 'top-0');
            } else {
                // Scrolled down - sticky mode
                header.classList.remove('header-overlay');
                header.classList.add('header-sticky');
                header.classList.remove('absolute', 'left-0', 'right-0');
                header.classList.add('sticky', 'top-0', 'z-50');
            }
            
            ticking = false;
        }
        
        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestTick, { passive: true });
        
        // Handle resize events
        window.addEventListener('resize', function() {
            requestTick();
        }, { passive: true });
        
        // Initial call
        updateHeader();
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 0;
                const offsetTop = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Handle mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-nav__toggler');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            // Add your mobile menu toggle logic here
            console.log('Mobile menu toggle clicked');
        });
    }

    // Pause autoplay on hover (desktop only)
    if (window.innerWidth >= 1024) {
        const heroSwiperEl = document.querySelector('.hero-swiper');
        if (heroSwiperEl) {
            heroSwiperEl.addEventListener('mouseenter', () => {
                heroSwiper.autoplay.stop();
            });
            
            heroSwiperEl.addEventListener('mouseleave', () => {
                heroSwiper.autoplay.start();
            });
        }
    }

    // Add loading animation
    const slides = document.querySelectorAll('.swiper-slide');
    slides.forEach((slide, index) => {
        if (index === 0) {
            slide.classList.add('animate-fade-in');
        }
    });
    
    // Listen to slide change events
    heroSwiper.on('slideChangeTransitionEnd', function() {
        slides.forEach(slide => slide.classList.remove('animate-fade-in'));
        slides[this.activeIndex].classList.add('animate-fade-in');
    });
});
