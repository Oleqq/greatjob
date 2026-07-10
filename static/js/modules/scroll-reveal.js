const SCOPE_SELECTOR = ".page > header, .page > section, .page > footer";
const TARGET_SELECTOR = [
	".section-title",
	".hero__title",
	".hero__description",
	".hero__actions",
	".problem-card",
	".problem-card__title",
	".problem-card__description",
	".metrics-card",
	".metrics-card__title",
	".metrics-card__description",
	".step-card",
	".step-card__title",
	".step-card__description",
	".review-card",
	".review-card__title",
	".review-card__text",
	".review-card__meta",
	".pricing-card",
	".pricing-card__header",
	".pricing-card__features",
	".pricing-card__button",
	".service-card",
	".service-card__title",
	".service-card__features",
	".service-card__button",
	".telegram-cta__content",
	".faq-layout",
	".faq-tab",
	".faq-item",
	".site-footer__brand",
	".site-footer__nav",
	".site-footer__channel"
].join(", ");

const isEligible = (element) => element instanceof HTMLElement
	&& !element.hidden
	&& !element.closest("[hidden]")
	&& !element.matches(".swiper-wrapper");

const collectTargets = (scope) => [...scope.querySelectorAll(TARGET_SELECTOR)]
	.filter(isEligible)
	.sort((first, second) => {
		if (first === second) return 0;
		return first.compareDocumentPosition(second) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
	});

const isCard = (element) => element.matches(
	".problem-card, .metrics-card, .step-card, .review-card, .pricing-card, .service-card, .faq-item"
);

const revealTarget = (target, index) => {
	target.dataset.revealItem = isCard(target) ? "card" : target.classList.contains("section-title") ? "title" : "text";
	target.style.setProperty("--reveal-delay", `${Math.min(index * 75, 675)}ms`);
	requestAnimationFrame(() => target.classList.add("is-reveal-visible"));

	const cleanupDelay = Math.min(index * 75, 675) + 760;
	window.setTimeout(() => {
		target.removeAttribute("data-reveal-item");
		target.style.removeProperty("--reveal-delay");
	}, cleanupDelay);
};

export function initScrollReveal() {
	const scopes = [...document.querySelectorAll(SCOPE_SELECTOR)];
	const preparedScopes = scopes.map((scope) => ({
		scope,
		targets: collectTargets(scope),
		activated: false
	}));

	if (!preparedScopes.length) return;

	preparedScopes.forEach(({ targets }) => targets.forEach((target) => {
		target.dataset.revealItem = "pending";
	}));
	document.body.classList.add("has-scroll-reveal");

	const activate = (preparedScope) => {
		if (preparedScope.activated) return;
		preparedScope.activated = true;
		preparedScope.scope.classList.add("animated", "is-reveal-visible");
		preparedScope.scope.dispatchEvent(new CustomEvent("greatjob:reveal"));
		preparedScope.targets.forEach(revealTarget);
	};

	const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	if (reduceMotion) {
		preparedScopes.forEach((preparedScope) => {
			activate(preparedScope);
			preparedScope.targets.forEach((target) => target.removeAttribute("data-reveal-item"));
		});
		return;
	}

	let frameId = 0;
	const checkVisibility = () => {
		frameId = 0;
		const viewportBottom = window.innerHeight * 0.88;

		preparedScopes.forEach((preparedScope) => {
			if (preparedScope.activated) return;
			const rect = preparedScope.scope.getBoundingClientRect();
			if (rect.top <= viewportBottom && rect.bottom >= 0) activate(preparedScope);
		});
	};

	const scheduleVisibilityCheck = () => {
		if (frameId) return;
		frameId = requestAnimationFrame(checkVisibility);
	};

	window.addEventListener("scroll", scheduleVisibilityCheck, { passive: true });
	window.addEventListener("resize", scheduleVisibilityCheck);
	requestAnimationFrame(() => requestAnimationFrame(checkVisibility));

	return () => {
		window.removeEventListener("scroll", scheduleVisibilityCheck);
		window.removeEventListener("resize", scheduleVisibilityCheck);
		if (frameId) cancelAnimationFrame(frameId);
		document.body.classList.remove("has-scroll-reveal");
		preparedScopes.forEach(({ scope, targets }) => {
			scope.classList.remove("animated", "is-reveal-visible");
			targets.forEach((target) => {
				target.removeAttribute("data-reveal-item");
				target.classList.remove("is-reveal-visible");
				target.style.removeProperty("--reveal-delay");
			});
		});
	};
}
