export function initStickyHeader() {
	const header = document.querySelector(".header");
	if (!header) return;

	let frameId = 0;
	const updateState = () => {
		frameId = 0;
		header.classList.toggle("is-stuck", window.scrollY > 8);
	};
	const scheduleUpdate = () => {
		if (frameId) return;
		frameId = requestAnimationFrame(updateState);
	};

	window.addEventListener("scroll", scheduleUpdate, { passive: true });
	updateState();

	return () => {
		window.removeEventListener("scroll", scheduleUpdate);
		if (frameId) cancelAnimationFrame(frameId);
	};
}
