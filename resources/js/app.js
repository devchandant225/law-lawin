import './bootstrap';

// Import Swiper
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', () => {
	const btn = document.getElementById('mobile-menu-button');
	const menu = document.getElementById('mobile-menu');
	if (!btn || !menu) return;
	btn.addEventListener('click', () => {
		menu.classList.toggle('hidden');
	});

	// Initialize Banner Swiper
	const bannerSwiper = document.querySelector('.banner-swiper');
	if (bannerSwiper) {
		new Swiper('.banner-swiper', {
			modules: [Navigation, Pagination, Autoplay, EffectFade],
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '"><span class="bullet-inner"></span></span>';
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			speed: 1000,
			on: {
				slideChange: function () {
					// Restart animations on slide change
					const activeSlide = this.slides[this.activeIndex];
					const animatedElements = activeSlide.querySelectorAll('[data-animate]');
					animatedElements.forEach(el => {
						el.style.animation = 'none';
						el.offsetHeight; // Trigger reflow
						el.style.animation = null;
					});
				}
			}
		});
	}

	// Initialize Portfolio Swiper
	const portfolioSwiper = document.querySelector('.portfolioSwiper');
	if (portfolioSwiper) {
		new Swiper('.portfolioSwiper', {
			modules: [Navigation, Pagination, Autoplay],
			slidesPerView: 1,
			spaceBetween: 20,
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			speed: 800,
			effect: 'slide',
			navigation: {
				nextEl: '.portfolio-swiper-next',
				prevEl: '.portfolio-swiper-prev',
			},
			pagination: {
				el: '.portfolio-swiper-pagination',
				clickable: true,
				dynamicBullets: true,
			},
			breakpoints: {
				640: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 25,
				},
				1024: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				1280: {
					slidesPerView: 5,
					spaceBetween: 30,
				},
			},
			on: {
				init: function () {
					// Add entrance animation delay
					this.slides.forEach((slide, index) => {
						slide.style.animationDelay = `${index * 0.1}s`;
					});
				},
				slideChange: function () {
					// Add subtle scale effect during transition
					this.slides.forEach((slide) => {
						slide.style.transform = 'scale(0.95)';
						setTimeout(() => {
							slide.style.transform = 'scale(1)';
						}, 100);
					});
				},
			}
		});

		// Add hover pause functionality
		const swiperContainer = portfolioSwiper;
		swiperContainer.addEventListener('mouseenter', () => {
			if (portfolioSwiper.swiper) {
				portfolioSwiper.swiper.autoplay.stop();
			}
		});

		swiperContainer.addEventListener('mouseleave', () => {
			if (portfolioSwiper.swiper) {
				portfolioSwiper.swiper.autoplay.start();
			}
		});
	}
});
