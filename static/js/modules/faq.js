import Swiper from "swiper";
import { FreeMode } from "swiper/modules";

export function initFaq() {
	const root = document.querySelector(".faq");
	if (!root) return;

	const tabs = root.querySelectorAll("[data-faq-tab]");
	const panels = root.querySelectorAll("[data-faq-panel]");
	const items = root.querySelectorAll(".faq-item");
	const tabsSlider = root.querySelector(".faq-tabs");

	if (tabsSlider) {
		new Swiper(tabsSlider, {
			modules: [FreeMode],
			freeMode: true,
			slidesPerView: "auto",
			spaceBetween: 8,
			breakpoints: {
				901: {
					enabled: false
				}
			}
		});
	}

	const setItemState = (item, isOpen) => {
		const panel = item.closest(".faq-panel");

		if (isOpen) {
			panel?.querySelectorAll(".faq-item.is-open").forEach((other) => {
				if (other !== item) setItemState(other, false);
			});
		}

		item.classList.toggle("is-open", isOpen);
		item.querySelector(".faq-item__summary").setAttribute("aria-expanded", String(isOpen));
	};

	const activateTab = (tabId) => {
		tabs.forEach((tab) => {
			const isActive = tab.dataset.faqTab === tabId;
			tab.classList.toggle("is-active", isActive);
			tab.setAttribute("aria-selected", String(isActive));
		});

		panels.forEach((panel) => {
			panel.hidden = panel.dataset.faqPanel !== tabId;
		});

		const activePanel = root.querySelector(`[data-faq-panel="${tabId}"]`);
		const activeItems = activePanel?.querySelectorAll(".faq-item") ?? [];
		if (activeItems.length && !activePanel.querySelector(".faq-item.is-open")) {
			setItemState(activeItems[0], true);
		}
	};

	tabs.forEach((tab) => {
		tab.addEventListener("click", () => activateTab(tab.dataset.faqTab));
	});

	items.forEach((item) => {
		const summary = item.querySelector(".faq-item__summary");
		summary.addEventListener("click", () => {
			setItemState(item, !item.classList.contains("is-open"));
		});
	});
}
