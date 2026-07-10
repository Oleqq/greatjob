import Swiper from "swiper";
import { A11y, Navigation } from "swiper/modules";

export function initReviews() {
	const slider = document.querySelector(".reviews__slider");
	const section = slider?.closest(".reviews");

	if (!slider || !section) {
		return;
	}

	new Swiper(slider, {
		modules: [A11y, Navigation],
		loop: true,
		grabCursor: true,
		speed: 500,
		spaceBetween: 16,
		slidesPerView: 1,
		navigation: {
			prevEl: section.querySelector(".reviews__button--prev"),
			nextEl: section.querySelector(".reviews__button--next")
		},
		a11y: {
			enabled: true,
			prevSlideMessage: "Предыдущий отзыв",
			nextSlideMessage: "Следующий отзыв"
		},
		breakpoints: {
			768: {
				slidesPerView: 2,
				spaceBetween: 16
			},
			1200: {
				slidesPerView: 4,
				spaceBetween: 24
			}
		}
	});
}
