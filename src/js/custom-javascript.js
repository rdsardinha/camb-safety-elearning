// Add your JS customizations here
(function ($) {
	//Sticky Menu
	$(window).scroll(function () {
		var header = $("#wrapper-navbar");
		if ($(this).scrollTop() > 0) {
			header.addClass("sticky-top");
		} else {
			header.removeClass("sticky-top");
		}
	});

	// When the Services menu (dropdown) is opened
	$(document).on("show.bs.dropdown", ".nav-item", function () {
		$("body").css("overflow", "hidden");
	});

	// When the Services menu (dropdown) is closed
	$(document).on("hide.bs.dropdown", ".nav-item", function () {
		$("body").css("overflow", "");
	});

	// Also handle your custom close button
	$(".btn-close-mega").on("click", function () {
		$(".dropdown-menu").removeClass("show");
		$("body").css("overflow", ""); // Restore scroll
	});

	$(".has-dropdown-menu").each(function () {
		const $menuItem = $(this);
		const $toggle = $menuItem.find(".dropdown-toggle");
		const $menu = $menuItem.find(".dropdown-menu");

		if ($toggle.length && $menu.length) {
			$menuItem.addClass("show");
			$toggle.attr("aria-expanded", "true");
			$menu.addClass("show");
		}
	});

	// Fetch all the details element.
	const details = document.querySelectorAll("details");

	// Add the onclick listeners.
	details.forEach((targetDetail) => {
		targetDetail.addEventListener("click", () => {
			// Close all the details that are not targetDetail.
			details.forEach((detail) => {
				if (detail !== targetDetail) {
					detail.removeAttribute("open");
				}
			});
		});
	});
})(jQuery);

function isElementInViewport(el) {
	const rect = el.getBoundingClientRect();
	return (
		rect.top < window.innerHeight &&
		rect.bottom > 0 &&
		rect.left < window.innerWidth &&
		rect.right > 0
	);
}

function checkVisibility() {
	const selectors = [
		".fade-in-bottom",
		".fade-in-left",
		".fade-in-right",
		".fade-in-top",
	];

	selectors.forEach((selector) => {
		document.querySelectorAll(selector).forEach((el) => {
			if (isElementInViewport(el) && !el.classList.contains("visible")) {
				el.classList.add("visible");
			}
		});
	});
}

document.addEventListener("DOMContentLoaded", () => {
	checkVisibility();
	window.addEventListener("scroll", checkVisibility);
	window.addEventListener("resize", checkVisibility);
});

document.querySelectorAll('[data-bs-toggle="pill"]').forEach((tab) => {
	tab.addEventListener("shown.bs.tab", () => {
		setTimeout(checkVisibility, 150);
	});
});
