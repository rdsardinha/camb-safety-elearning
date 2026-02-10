/* Enhance materials */
document.addEventListener("DOMContentLoaded", () => {
	const currentLessonEl = document.querySelector(
		".course-curriculum .course-item.current",
	);
	const lessonId = currentLessonEl?.dataset.itemId;

	if (!lessonId) {
		console.warn("LearnPress: Lesson ID not found");
		return;
	}

	// Wait for the page to load materials table OR timeout after 2s
	const waitForMaterials = setTimeout(() => {
		const table = document.querySelector(".course-material-table");
		initMaterialLogic(table); // call even if table is null
		toggleComplete(); // ensure button shows if no table
	}, 200); // short timeout, can be increased if materials load slowly

	function initMaterialLogic(table) {
		const completeForm = document.querySelector(
			'form.learn-press-form.form-button[name="learn-press-form-complete-lesson"]',
		);
		if (!completeForm) return;

		// Hide until checkbox logic completes
		completeForm.style.display = "none";

		if (table) {
			// Table exists, inject checkboxes into rows
			const theadRow = table.querySelector("thead tr");
			if (theadRow && !theadRow.querySelector(".lp-material-done-head")) {
				const th = document.createElement("th");
				th.textContent = "Done";
				th.className = "lp-material-done-head";
				theadRow.appendChild(th);
			}

			table.querySelectorAll("tbody tr").forEach((row, index) => {
				if (row.querySelector(".lp-material-checkbox")) return;

				const td = document.createElement("td");
				td.className = "lp-material-checkbox-td";

				const checkbox = document.createElement("input");
				checkbox.type = "checkbox";
				checkbox.className = "lp-material-checkbox";
				checkbox.dataset.materialId = `lesson-${lessonId}-material-${index}`;

				td.appendChild(checkbox);
				row.appendChild(td);

				checkbox.addEventListener("change", () => {
					saveProgress();
					toggleComplete();
				});
			});
		} else {
			// No table: fallback single checkbox
			if (!document.querySelector(".lp-material-checkbox-fallback")) {
				const container = document.createElement("div");
				container.className = "lp-material-checkbox-fallback";
				container.style.marginBottom = "10px";

				const checkbox = document.createElement("input");
				checkbox.type = "checkbox";
				checkbox.className = "lp-material-checkbox";
				checkbox.dataset.materialId = `lesson-${lessonId}-material-0`;

				const label = document.createElement("label");
				label.textContent =
					"By checking this box, you confirm that you have viewed or downloaded all materials for this lesson.";
				label.style.marginLeft = "8px";
				label.style.width = "80%";

				container.appendChild(checkbox);
				container.appendChild(label);

				completeForm.parentNode.insertBefore(container, completeForm);

				checkbox.addEventListener("change", () => {
					saveProgress();
					toggleComplete();
				});
			}
		}

		restoreProgress();
	}

	function restoreProgress() {
		fetch(LP_MATERIAL.ajax_url, {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: new URLSearchParams({
				action: "lp_get_material_progress",
				nonce: LP_MATERIAL.nonce,
				lesson_id: lessonId,
			}),
		})
			.then((res) => res.json())
			.then((data) => {
				if (!data.success || !data.data) return;

				document.querySelectorAll(".lp-material-checkbox").forEach((cb) => {
					if (data.data[cb.dataset.materialId]) cb.checked = true;
				});

				toggleComplete();
			});
	}

	function saveProgress() {
		const progress = {};
		document.querySelectorAll(".lp-material-checkbox").forEach((cb) => {
			if (cb.checked) progress[cb.dataset.materialId] = true;
		});

		fetch(LP_MATERIAL.ajax_url, {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: new URLSearchParams({
				action: "lp_save_material_progress",
				nonce: LP_MATERIAL.nonce,
				lesson_id: lessonId,
				progress: JSON.stringify(progress),
			}),
		});
	}

	function toggleComplete() {
		const completeForm = document.querySelector(
			'form.learn-press-form.form-button[name="learn-press-form-complete-lesson"]',
		);
		if (!completeForm) return;

		const checkboxes = document.querySelectorAll(".lp-material-checkbox");
		if (checkboxes.length === 0) {
			completeForm.style.display = "block";
			return;
		}

		const allDone = [...checkboxes].every((cb) => cb.checked);
		completeForm.style.display = allDone ? "block" : "none";
	}
});

// document.addEventListener("DOMContentLoaded", () => {
// 	/**
// 	 * 1. Get the REAL lesson ID from the side curriculum menu
// 	 * (this is the only reliable lesson identifier)
// 	 */
// 	const currentLessonEl = document.querySelector(
// 		".course-curriculum .course-item.current",
// 	);
// 	const lessonId = currentLessonEl?.dataset.itemId;

// 	if (!lessonId) {
// 		console.warn("LearnPress: Lesson ID not found");
// 		return;
// 	}

// 	/**
// 	 * 2. Wait ONLY for the materials table to exist
// 	 * (no accordions, no fallbacks)
// 	 */
// 	const waitForMaterials = setInterval(() => {
// 		const table = document.querySelector(".course-material-table");
// 		if (!table) return;

// 		clearInterval(waitForMaterials);
// 		initMaterialLogic(table);
// 	}, 100);

// 	/**
// 	 * 3. Inject checkbox column + listeners
// 	 */
// 	function initMaterialLogic(table) {
// 		const completeForm = document.querySelector(
// 			'form.learn-press-form.form-button[name="learn-press-form-complete-lesson"]',
// 		);

// 		// Hide Complete button until conditions are met
// 		if (completeForm) completeForm.style.display = "none";

// 		// Add "Done" header once
// 		const theadRow = table.querySelector("thead tr");
// 		if (theadRow && !theadRow.querySelector(".lp-material-done-head")) {
// 			const th = document.createElement("th");
// 			th.textContent = "Done";
// 			th.className = "lp-material-done-head";
// 			theadRow.appendChild(th);
// 		}

// 		// Add checkbox cell to each material row
// 		table.querySelectorAll("tbody tr").forEach((row, index) => {
// 			// Prevent duplicate injection
// 			if (row.querySelector(".lp-material-checkbox")) return;

// 			const materialId = `lesson-${lessonId}-material-${index}`;

// 			const td = document.createElement("td");
// 			td.className = "lp-material-checkbox-td";

// 			const checkbox = document.createElement("input");
// 			checkbox.type = "checkbox";
// 			checkbox.className = "lp-material-checkbox";
// 			checkbox.dataset.materialId = materialId;

// 			td.appendChild(checkbox);
// 			row.appendChild(td);

// 			checkbox.addEventListener("change", () => {
// 				saveProgress();
// 				toggleComplete();
// 			});
// 		});

// 		restoreProgress();
// 	}

// 	/**
// 	 * 4. Restore saved progress from user meta
// 	 */
// 	function restoreProgress() {
// 		fetch(LP_MATERIAL.ajax_url, {
// 			method: "POST",
// 			headers: { "Content-Type": "application/x-www-form-urlencoded" },
// 			body: new URLSearchParams({
// 				action: "lp_get_material_progress",
// 				nonce: LP_MATERIAL.nonce,
// 				lesson_id: lessonId,
// 			}),
// 		})
// 			.then((res) => res.json())
// 			.then((data) => {
// 				if (!data.success || !data.data) return;

// 				document.querySelectorAll(".lp-material-checkbox").forEach((cb) => {
// 					if (data.data[cb.dataset.materialId]) {
// 						cb.checked = true;
// 					}
// 				});

// 				toggleComplete();
// 			});
// 	}

// 	/**
// 	 * 5. Save progress to user meta
// 	 */
// 	function saveProgress() {
// 		const progress = {};

// 		document.querySelectorAll(".lp-material-checkbox").forEach((cb) => {
// 			if (cb.checked) {
// 				progress[cb.dataset.materialId] = true;
// 			}
// 		});

// 		fetch(LP_MATERIAL.ajax_url, {
// 			method: "POST",
// 			headers: { "Content-Type": "application/x-www-form-urlencoded" },
// 			body: new URLSearchParams({
// 				action: "lp_save_material_progress",
// 				nonce: LP_MATERIAL.nonce,
// 				lesson_id: lessonId,
// 				progress: JSON.stringify(progress),
// 			}),
// 		});
// 	}

// 	/**
// 	 * 6. Show Complete Lesson ONLY when all are checked
// 	 */
// 	function toggleComplete() {
// 		const completeForm = document.querySelector(
// 			'form.learn-press-form.form-button[name="learn-press-form-complete-lesson"]',
// 		);
// 		if (!completeForm) return;

// 		// Get all material checkboxes (if any)
// 		const checkboxes = document.querySelectorAll(".lp-material-checkbox");

// 		// If no checkboxes exist (no table or empty table), show the button
// 		if (checkboxes.length === 0) {
// 			completeForm.style.display = "block";
// 			return;
// 		}

// 		// Show button only if ALL checkboxes are checked
// 		const allDone = [...checkboxes].every((cb) => cb.checked);
// 		completeForm.style.display = allDone ? "block" : "none";
// 	}
// });
