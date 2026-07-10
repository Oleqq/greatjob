export function initMobileMenu() {
	const toggle = document.querySelector(".header__burger");
	const menu = document.querySelector(".header-menu");
	const close = document.querySelector(".header-menu__close");
	if (!toggle || !menu || !close) return;

	const setMenuState = (isOpen) => {
		document.body.classList.toggle("header-menu-is-open", isOpen);
		toggle.setAttribute("aria-expanded", String(isOpen));
		toggle.setAttribute("aria-label", isOpen ? "Закрыть меню" : "Открыть меню");
		menu.setAttribute("aria-hidden", String(!isOpen));
	};

	toggle.addEventListener("click", () => setMenuState(!document.body.classList.contains("header-menu-is-open")));
	close.addEventListener("click", () => setMenuState(false));

	menu.querySelectorAll("a").forEach((link) => link.addEventListener("click", () => setMenuState(false)));
	document.addEventListener("keydown", (event) => {
		if (event.key === "Escape") setMenuState(false);
	});
}
