import { initFaq } from "./modules/faq.js";
import { initHeroStats } from "./modules/hero-stats.js";
import { initMobileMenu } from "./modules/mobile-menu.js";
import { initReviews } from "./modules/reviews.js";
import { initScrollReveal } from "./modules/scroll-reveal.js";
import { initStickyHeader } from "./modules/sticky-header.js";

document.addEventListener("DOMContentLoaded", () => {
	initScrollReveal();
	initFaq();
	initHeroStats();
	initMobileMenu();
	initReviews();
	initStickyHeader();
});
