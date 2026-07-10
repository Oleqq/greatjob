export function initHeroStats() {
	const stats = [...document.querySelectorAll(".hero-stat")];
	if (!stats.length) return;

	const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	const formatValue = (value) => value.toLocaleString("ru-RU").replace(/\u00a0/g, " ");
	const hero = document.querySelector(".hero");
	let started = false;

	const countUp = (element, target, suffix, delay) => {
		window.setTimeout(() => {
			const start = performance.now();
			const duration = 1500;

			const tick = (now) => {
				const progress = Math.min((now - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = `${formatValue(Math.round(target * eased))}${suffix}`;

				if (progress < 1) {
					requestAnimationFrame(tick);
				}
			};

			requestAnimationFrame(tick);
		}, delay);
	};

	const startCounters = () => {
		if (started) return;
		started = true;

		stats.forEach((stat, index) => {
			const value = stat.querySelector(".hero-stat__value");
			const current = value?.querySelector(".hero-stat__value-current") || value;
			const target = Number(value?.dataset.target);
			const suffix = value?.dataset.suffix || "";
			const delay = index * 180;

			if (!value || !current || Number.isNaN(target)) return;

			if (reduceMotion) {
				stat.classList.add("is-visible");
				current.textContent = `${formatValue(target)}${suffix}`;
				return;
			}

			window.setTimeout(() => stat.classList.add("is-visible"), delay);
			countUp(current, target, suffix, delay + 120);
		});
	};

	if (!hero || hero.classList.contains("is-reveal-visible")) {
		startCounters();
		return;
	}

	hero.addEventListener("greatjob:reveal", startCounters, { once: true });
	window.setTimeout(startCounters, 1200);
}
