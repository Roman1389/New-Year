document.addEventListener("DOMContentLoaded", () => {
	// Элементы формы
	const phoneInput = document.getElementById("phone-applications")
	const fullNameInput = document.getElementById("fullName")
	const messageInput = document.getElementById("message-applications")
	const form = document.getElementById("quickRequestForm")
	const serviceSelect = document.getElementById("service")
	const errorCyrillic = document.createElement("small")
	const errorFullName = document.createElement("small")
	const errorMessage = document.createElement("small")

	// Инициализация маски ввода телефона
	initializePhoneMask(phoneInput)

	// Валидация полей "ФИО" и "Сообщение"
	initializeFullNameValidation(fullNameInput, errorCyrillic, errorFullName)
	initializeMessageValidation(messageInput, errorMessage)

	// Загрузка услуг из базы данных
	loadServices()

	// Обработчик отправки формы
	form.addEventListener("submit", handleFormSubmit)

	// Обработчик закрытия модального окна
	const modal = document.getElementById("quickRequestModal")
	modal.addEventListener("hidden.bs.modal", () => {
		location.reload() // Перезагрузка страницы при закрытии модального окна
	})

	// Функции инициализации

	/**
	 * Инициализация маски ввода телефона
	 * @param {HTMLInputElement} input
	 */
	function initializePhoneMask(input) {
		$(input).inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	}

	/**
	 * Валидация поля "ФИО"
	 * @param {HTMLInputElement} input
	 * @param {HTMLElement} errorCyrillic
	 * @param {HTMLElement} errorFullName
	 */
	function initializeFullNameValidation(input, errorCyrillic, errorFullName) {
		errorCyrillic.style.color = "red"
		errorCyrillic.style.display = "none"
		errorCyrillic.textContent = "ФИО должно содержать только кириллицу."
		input.insertAdjacentElement("afterend", errorCyrillic)

		errorFullName.style.color = "red"
		errorFullName.style.display = "none"
		errorFullName.textContent =
			"ФИО должно состоять из Фамилии, Имени и Отчества (минимум два слова)."
		input.insertAdjacentElement("afterend", errorFullName)

		input.addEventListener("input", () => {
			const regex = /^[а-яА-ЯёЁ\s]+$/
			const nameParts = input.value.trim().split(/\s+/)

			// Проверка на кириллицу
			if (!regex.test(input.value) && input.value.length > 0) {
				errorCyrillic.style.display = "block"
			} else {
				errorCyrillic.style.display = "none"
			}

			// Проверка на полноту ФИО
			if (nameParts.length < 2 || nameParts.length > 3) {
				errorFullName.style.display = "block"
			} else {
				errorFullName.style.display = "none"
			}
		})
	}

	/**
	 * Валидация поля "Сообщение"
	 * @param {HTMLTextAreaElement} input
	 * @param {HTMLElement} errorMessage
	 */
	function initializeMessageValidation(input, errorMessage) {
		errorMessage.style.color = "red"
		errorMessage.style.display = "none"
		input.insertAdjacentElement("afterend", errorMessage)

		const minLength = 10 // Минимальная длина
		const maxLength = 250 // Максимальная длина

		input.addEventListener("input", () => {
			const messageLength = input.value.length
			const regex = /^[а-яА-ЯёЁ\s.,!?()-]*$/

			// Проверка на кириллицу
			if (!regex.test(input.value)) {
				errorMessage.style.display = "block"
				errorMessage.textContent =
					"Сообщение должно содержать только кириллицу."
			} else if (messageLength < minLength) {
				errorMessage.style.display = "block"
				errorMessage.textContent = `Сообщение должно быть минимум ${minLength} символов.`
			} else if (messageLength > maxLength) {
				errorMessage.style.display = "block"
				errorMessage.textContent = `Сообщение не должно превышать ${maxLength} символов.`
			} else {
				errorMessage.style.display = "none"
			}
		})
	}

	/**
	 * Загрузка услуг из базы данных
	 */
	function loadServices() {
		fetch("backend/site/applications.php?action=get_services")
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					data.services.forEach((service) => {
						const option = document.createElement("option")
						option.value = service.id
						option.textContent = service.title
						option.dataset.title = service.title // Сохраняем название услуги
						serviceSelect.appendChild(option)
					})
				} else {
					console.error("Ошибка при загрузке услуг: " + data.message)
				}
			})
			.catch((error) => {
				console.error("Ошибка загрузки услуг: " + error.message)
			})
	}

	/**
	 * Обработчик отправки формы
	 * @param {Event} e
	 */
	function handleFormSubmit(e) {
		e.preventDefault()

		// Проверка на валидность формы
		if (isFormInvalid()) {
			alert("Пожалуйста, исправьте ошибки в форме.")
			return
		}

		const formData = new FormData(form)
		const selectedService = serviceSelect.options[serviceSelect.selectedIndex]
		const serviceTitle = selectedService.dataset.title // Получаем название услуги

		// Добавляем название услуги в FormData
		formData.append("serviceTitle", serviceTitle)

		// Отправка данных
		fetch("backend/site/applications.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert("Заявка успешно отправлена!")
					const modal = document.getElementById("quickRequestModal")
					if (modal) {
						modal.style.display = "none" // Закрываем модальное окно
					}
					location.reload() // Перезагрузка страницы
				} else {
					alert("Ошибка при отправке заявки: " + data.message)
				}
			})
			.catch((error) => {
				alert("Ошибка отправки: " + error.message)
			})
	}

	/**
	 * Проверка на валидность формы
	 * @returns {boolean}
	 */
	function isFormInvalid() {
		return (
			errorCyrillic.style.display === "block" ||
			errorFullName.style.display === "block" ||
			errorMessage.style.display === "block"
		)
	}
})
