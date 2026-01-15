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

	/**************************************/
	/* !Tiny Carousels                    */
	/**************************************/
	if ($(".usp-carousel__carousel").length > 0) {
		/* TinySlider */
		var uspSlider = tns({
			container: ".usp-carousel__carousel",
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 3000,
			autoplayButtonOutput: false,
			nav: false,
			responsive: {
				0: {
					items: 1,
					controls: true,
				},
				576: {
					items: 2,
					controls: true,
				},
				768: {
					items: 3,
					controls: false,
				},
				992: {
					items: 4,
					controls: false,
				},
				1300: {
					items: 5,
					controls: false,
				},
				1400: {
					items: 5,
					controls: false,
				},
			},
			controlsText: [
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgLeft}" alt="Previous">
                  <img class="arrow-img hover" src="${carouselData.imgLeftHover}" alt="Previous hover">
                </span>
                <span class="visually-hidden">Prev</span>
                `,
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgRight}" alt="Next">
                  <img class="arrow-img hover" src="${carouselData.imgRightHover}" alt="Next hover">
                </span>
                <span class="visually-hidden">Next</span>
                `,
			],
		});

		uspSlider.events.on("indexChanged", checkVisibility);
		uspSlider.events.on("transitionEnd", checkVisibility);
		setTimeout(checkVisibility, 300);
	}

	if ($(".logo-carousel__carousel").length > 0) {
		/* TinySlider */
		var logoSlider = tns({
			container: ".logo-carousel__carousel",
			mouseDrag: true,
			autoplay: true,
			gutter: 40,
			speed: 1000,
			autoplayTimeout: 2000,
			autoplayButtonOutput: false,
			nav: false,
			controls: false,
			responsive: {
				0: {
					items: 2,
				},
				576: {
					items: 3,
				},
				768: {
					items: 3,
				},
				992: {
					items: 4,
				},
				1200: {
					items: 5,
				},
				1400: {
					items: 6,
				},
			},
		});

		logoSlider.events.on("indexChanged", checkVisibility);
		logoSlider.events.on("transitionEnd", checkVisibility);
		setTimeout(checkVisibility, 300);
	}

	if ($(".reviews-carousel__carousel").length > 0) {
		/* TinySlider */
		var reviewsSlider = tns({
			container: ".reviews-carousel__carousel",
			gutter: 0,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 5000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgLeft}" alt="Previous">
                  <img class="arrow-img hover" src="${carouselData.imgLeftHover}" alt="Previous hover">
                </span>
                <span class="visually-hidden">Prev</span>
                `,
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgRight}" alt="Next">
                  <img class="arrow-img hover" src="${carouselData.imgRightHover}" alt="Next hover">
                </span>
                <span class="visually-hidden">Next</span>
                `,
			],

			responsive: {
				0: {
					items: 1,
				},
				576: {
					items: 2,
				},
				768: {
					items: 2,
				},
				992: {
					items: 2,
				},
				1200: {
					items: 3,
				},
				1400: {
					items: 3,
				},
			},
		});

		reviewsSlider.events.on("indexChanged", checkVisibility);
		reviewsSlider.events.on("transitionEnd", checkVisibility);
		setTimeout(checkVisibility, 300);
	}

	if ($(".blog-carousel__carousel").length > 0) {
		/* TinySlider */
		var blogSlider = tns({
			container: ".blog-carousel__carousel",
			gutter: 0,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 5000,
			autoplayButtonOutput: false,
			nav: false,
			controls: true,
			controlsText: [
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgLeft}" alt="Previous">
                  <img class="arrow-img hover" src="${carouselData.imgLeftHover}" alt="Previous hover">
                </span>
                <span class="visually-hidden">Prev</span>
                `,
				`
                <span class="arrow-wrapper">
                  <img class="arrow-img default" src="${carouselData.imgRight}" alt="Next">
                  <img class="arrow-img hover" src="${carouselData.imgRightHover}" alt="Next hover">
                </span>
                <span class="visually-hidden">Next</span>
                `,
			],

			responsive: {
				0: {
					items: 1,
				},
				576: {
					items: 2,
				},
				768: {
					items: 2,
				},
				992: {
					items: 2,
				},
				1200: {
					items: 3,
					gutter: 20,
				},
				1400: {
					items: 3,
					gutter: 40,
				},
			},
		});

		blogSlider.events.on("indexChanged", checkVisibility);
		blogSlider.events.on("transitionEnd", checkVisibility);
		setTimeout(checkVisibility, 300);
	}

	if ($(".images-carousel").length > 0) {
		/* TinySlider */
		var imagesSlider = tns({
			container: ".images-carousel",
			items: 1,
			mouseDrag: true,
			autoplay: true,
			speed: 1000,
			autoplayTimeout: 5000,
			autoplayButtonOutput: false,
			nav: false,
			controls: false,
		});

		imagesSlider.events.on("indexChanged", checkVisibility);
		imagesSlider.events.on("transitionEnd", checkVisibility);
		setTimeout(checkVisibility, 300);
	}
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

document.addEventListener("DOMContentLoaded", function () {
	const fields = document.querySelectorAll(
		".floating-label .wpcf7-form-control"
	);

	fields.forEach((field) => {
		const wrapper = field.closest(".floating-label");

		const toggleClass = () => {
			let hasValue = false;

			if (field.tagName.toLowerCase() === "select") {
				hasValue = field.selectedIndex > 0; // ignore the first "placeholder" option
			} else {
				hasValue = field.value.trim() !== "";
			}

			wrapper.classList.toggle("has-value", hasValue);
		};

		// Run initially and when field changes
		toggleClass();
		field.addEventListener("input", toggleClass);
		field.addEventListener("change", toggleClass);
		field.addEventListener("blur", toggleClass);
	});
});
