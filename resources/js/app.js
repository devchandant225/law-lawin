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
});
