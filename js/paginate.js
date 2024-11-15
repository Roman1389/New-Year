// Массивы с изображениями
const galleries = {
	morobus: [
		{ src: "images/Sliders/slide_1.png", alt: "Моробус 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Моробус 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Моробус 3" },
		{ src: "images/Sliders/slide_3.png", alt: "Моробус 4" },
		{ src: "images/Sliders/slide_2.png", alt: "Моробус 5" },
		{ src: "images/Sliders/slide_1.png", alt: "Моробус 6" },
		{ src: "images/Sliders/slide_1.png", alt: "Моробус 7" },
		{ src: "images/Sliders/slide_2.png", alt: "Моробус 8" },
		{ src: "images/Sliders/slide_3.png", alt: "Моробус 9" },
		{ src: "images/Sliders/slide_3.png", alt: "Моробус 10" },
		{ src: "images/Sliders/slide_2.png", alt: "Моробус 11" },
		{ src: "images/Sliders/slide_1.png", alt: "Моробус 12" },
	],
	kids: [
		{ src: "images/Sliders/slide_1.png", alt: "Детские поздравления 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Детские поздравления 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Детские поздравления 3" },
		{ src: "images/Sliders/slide_3.png", alt: "Детские поздравления 4" },
		{ src: "images/Sliders/slide_2.png", alt: "Детские поздравления 5" },
		{ src: "images/Sliders/slide_1.png", alt: "Детские поздравления 6" },
		{ src: "images/Sliders/slide_2.png", alt: "Детские поздравления 7" },
		{ src: "images/Sliders/slide_3.png", alt: "Детские поздравления 8" },
		{ src: "images/Sliders/slide_1.png", alt: "Детские поздравления 9" },
		{ src: "images/Sliders/slide_2.png", alt: "Детские поздравления 10" },
		{ src: "images/Sliders/slide_2.png", alt: "Детские поздравления 11" },
		{ src: "images/Sliders/slide_3.png", alt: "Детские поздравления 12" },
	],
	kindergartens: [
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в детские сады 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в детские сады 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в детские сады 3" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в детские сады 4" },
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в детские сады 5" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в детские сады 6" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в детские сады 7" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в детские сады 8" },
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в детские сады 9" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в детские сады 10" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в детские сады 11" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в детские сады 12" },
	],
	schools: [
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в школы 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в школы 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в школы 3" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в школы 4" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в школы 5" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в школы 6" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в школы 7" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в школы 8" },
		{ src: "images/Sliders/slide_3.png", alt: "Выезды в школы 9" },
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в школы 10" },
		{ src: "images/Sliders/slide_1.png", alt: "Выезды в школы 11" },
		{ src: "images/Sliders/slide_2.png", alt: "Выезды в школы 12" },
	],
	surprise: [
		{ src: "images/Sliders/slide_1.png", alt: "Неожиданная встреча 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Неожиданная встреча 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Неожиданная встреча 3" },
		{ src: "images/Sliders/slide_1.png", alt: "Неожиданная встреча 4" },
		{ src: "images/Sliders/slide_2.png", alt: "Неожиданная встреча 5" },
		{ src: "images/Sliders/slide_3.png", alt: "Неожиданная встреча 6" },
		{ src: "images/Sliders/slide_1.png", alt: "Неожиданная встреча 7" },
		{ src: "images/Sliders/slide_2.png", alt: "Неожиданная встреча 8" },
		{ src: "images/Sliders/slide_3.png", alt: "Неожиданная встреча 9" },
		{ src: "images/Sliders/slide_1.png", alt: "Неожиданная встреча 10" },
		{ src: "images/Sliders/slide_2.png", alt: "Неожиданная встреча 11" },
		{ src: "images/Sliders/slide_3.png", alt: "Неожиданная встреча 12" },
	],
	gifts: [
		{ src: "images/Sliders/slide_1.png", alt: "Вручение подарков 1" },
		{ src: "images/Sliders/slide_2.png", alt: "Вручение подарков 2" },
		{ src: "images/Sliders/slide_3.png", alt: "Вручение подарков 3" },
		{ src: "images/Sliders/slide_1.png", alt: "Вручение подарков 4" },
		{ src: "images/Sliders/slide_2.png", alt: "Вручение подарков 5" },
		{ src: "images/Sliders/slide_3.png", alt: "Вручение подарков 6" },
		{ src: "images/Sliders/slide_1.png", alt: "Вручение подарков 7" },
		{ src: "images/Sliders/slide_2.png", alt: "Вручение подарков 8" },
		{ src: "images/Sliders/slide_3.png", alt: "Вручение подарков 9" },
		{ src: "images/Sliders/slide_1.png", alt: "Вручение подарков 10" },
		{ src: "images/Sliders/slide_2.png", alt: "Вручение подарков 11" },
		{ src: "images/Sliders/slide_3.png", alt: "Вручение подарков 12" },
	],
}

let currentPage = 1
const itemsPerPage = 6

function loadGallery(page, galleryId) {
	const contentDiv = document.getElementById(
		`gallery-content${galleryId === "morobus" ? "" : `-${galleryId}`}`
	)
	const paginationDiv = document.getElementById(
		`pagination${galleryId === "morobus" ? "" : `-${galleryId}`}`
	)

	// Очищаем контент и пагинацию
	contentDiv.innerHTML = ""
	paginationDiv.innerHTML = ""

	// Выбираем нужную галерею
	const items = galleries[galleryId]

	// Определяем количество страниц
	const totalPages = Math.ceil(items.length / itemsPerPage)
	const startIndex = (page - 1) * itemsPerPage
	const endIndex = Math.min(startIndex + itemsPerPage, items.length)

	// Заполняем контент
	for (let i = startIndex; i < endIndex; i++) {
		const item = items[i]
		const colDiv = document.createElement("div")
		colDiv.className = "col-md-4 mb-3"

		const imgElement = document.createElement("img")
		imgElement.src = item.src
		imgElement.alt = item.alt
		imgElement.className = "img-fluid"
		colDiv.appendChild(imgElement)

		contentDiv.appendChild(colDiv)
	}

	// Создаем пагинацию
	for (let i = 1; i <= totalPages; i++) {
		const li = document.createElement("li")
		li.className = "page-item"
		const a = document.createElement("a")
		a.className = `page-link${i === page ? " active" : ""}`
		a.href = "#"
		a.innerText = i
		a.setAttribute("data-page", i)
		li.appendChild(a)
		paginationDiv.appendChild(li)
	}
}

document.addEventListener("DOMContentLoaded", function () {
	// Загрузка галереи по умолчанию
	loadGallery(currentPage, "morobus")

	// Обработка кликов по вкладкам
	document.getElementById("galleryTab").addEventListener("click", function (e) {
		if (e.target.tagName === "A") {
			e.preventDefault() // Предотвращаем переход по ссылке
			const activeTab = e.target.getAttribute("href").replace("#", "")

			// Устанавливаем активный класс для новой вкладки
			document
				.querySelectorAll(".nav-link")
				.forEach((link) => link.classList.remove("active"))
			e.target.classList.add("active")

			// Загружаем соответствующую галерею
			currentPage = 1 // Сброс страницы
			loadGallery(currentPage, activeTab)
		}
	})

	// Обработка кликов по пагинации
	document.addEventListener("click", function (e) {
		if (e.target.classList.contains("page-link")) {
			e.preventDefault() // Предотвращаем переход по ссылке
			const page = parseInt(e.target.getAttribute("data-page"))
			const activeTab = document
				.querySelector(".nav-link.active")
				.getAttribute("href")
				.replace("#", "")
			currentPage = page
			loadGallery(currentPage, activeTab)
		}
	})
})
