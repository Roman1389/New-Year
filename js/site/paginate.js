document.addEventListener("DOMContentLoaded", function () {
	const tabs = document.querySelectorAll("#galleryTabContent .tab-pane") // Все табы галереи
	const itemsPerPage = 3 // Количество элементов на странице

	tabs.forEach((tab, index) => {
		const items = tab.querySelectorAll(".col-md-4, .col-lg-4") // Элементы для пагинации
		const totalPages = Math.ceil(items.length / itemsPerPage) // Всего страниц

		// Создаем контейнер для кнопок пагинации
		const paginationContainer = document.createElement("div")
		paginationContainer.classList.add("pagination-container", "mt-3")
		tab.appendChild(paginationContainer)

		let currentPage = 1

		function showPage(page) {
			const start = (page - 1) * itemsPerPage
			const end = page * itemsPerPage

			items.forEach((item, index) => {
				item.style.display = index >= start && index < end ? "block" : "none"
			})

			// Обновляем активные кнопки
			paginationContainer
				.querySelectorAll(".page-btn")
				.forEach((button, index) => {
					button.classList.toggle("active", index + 1 === page)
				})

			// Отключаем стрелки на первой и последней странице
			prevButton.disabled = page === 1
			nextButton.disabled = page === totalPages
		}

		// Создаем стрелки "Назад" и "Вперед"
		const prevButton = document.createElement("button")
		prevButton.innerHTML = "&#8592;" // Unicode стрелка
		prevButton.classList.add("btn", "btn-outline-primary", "mx-1", "round-btn")
		prevButton.disabled = true
		prevButton.addEventListener("click", () => {
			if (currentPage > 1) {
				currentPage--
				showPage(currentPage)
			}
		})
		paginationContainer.appendChild(prevButton)

		// Создаем кнопки для страниц
		for (let i = 1; i <= totalPages; i++) {
			const button = document.createElement("button")
			button.textContent = i
			button.classList.add("btn", "btn-outline-primary", "mx-1", "page-btn")
			if (i === 1) button.classList.add("active") // Первая страница активна по умолчанию
			button.addEventListener("click", () => {
				currentPage = i
				showPage(currentPage)
			})
			paginationContainer.appendChild(button)
		}

		// Создаем кнопку "Вперед"
		const nextButton = document.createElement("button")
		nextButton.innerHTML = "&#8594;" // Unicode стрелка
		nextButton.classList.add("btn", "btn-outline-primary", "mx-1", "round-btn")
		nextButton.addEventListener("click", () => {
			if (currentPage < totalPages) {
				currentPage++
				showPage(currentPage)
			}
		})
		paginationContainer.appendChild(nextButton)

		// Отображаем первую страницу по умолчанию
		showPage(1)
	})
})
