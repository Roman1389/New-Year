document.addEventListener("DOMContentLoaded", () => {
	const pricePerPerson = 5000 // Начальная цена за аренду персонажа
	const peopleCountInput = document.getElementById("peopleCountAnimator")
	const totalPriceInput = document.getElementById("totalPriceAnimator")
	const minusButton = document.getElementById("minusButtonAnimator")
	const plusButton = document.getElementById("plusButtonAnimator")
	const dateInput = document.getElementById("dateAnimator")
	const timeSelect = document.getElementById("timeAnimator")
	const timeMessage = document.getElementById("timeMessage") // Элемент для сообщения о заблокированном времени
	const animatorCharacterSelect = document.getElementById("animatorCharacter")
	const serviceId = document.querySelector("input[name='service_id']").value
	const userId = document.getElementById("userId4").value
	const form = document.getElementById("animatorRentalForm")

	// Установка диапазона дат и текущей даты
	const today = new Date()
	const formatDate = (date) => {
		const year = date.getFullYear()
		const month = String(date.getMonth() + 1).padStart(2, "0")
		const day = String(date.getDate()).padStart(2, "0")
		return `${year}-${month}-${day}`
	}
	const minDate = formatDate(today)
	const maxDate = formatDate(
		new Date(today.getFullYear(), today.getMonth(), today.getDate() + 7)
	)
	dateInput.min = minDate
	dateInput.max = maxDate
	dateInput.value = minDate // Установка текущего дня по умолчанию

	// Маска для номера телефона
	$(document).ready(function () {
		$("#phoneAnimator").inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	})

	// Функция обновления времени
	function updateAvailableTimes() {
		const selectedDate = dateInput.value
		if (!selectedDate) return

		fetch("backend/services/animator.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				action: "get_free_times",
				service_id: serviceId,
				date: selectedDate,
			}),
		})
			.then((response) => {
				if (!response.ok) {
					// Если сервер вернул ошибку (например, 404 или 500)
					throw new Error(`Ошибка от сервера: ${response.status}`)
				}
				return response.json()
			})
			.then((data) => {
				if (data.success) {
					// Скрываем сообщение о заблокированной дате
					timeMessage.style.display = "none"
					timeSelect.style.display = "block" // Показываем выпадающий список времени

					// Очищаем текущие опции времени
					timeSelect.innerHTML = ""

					// Проверяем, если свободных времени нет
					if (data.free_times.length === 0) {
						// Если нет свободных слотов, показываем сообщение
						timeMessage.textContent = "На выбранную дату все забронировано"
						timeMessage.style.display = "block"
						timeSelect.style.display = "none" // Прячем выпадающий список
					} else {
						// Если есть свободное время, добавляем его в список
						const defaultOption = document.createElement("option")
						defaultOption.value = ""
						defaultOption.textContent = "Выберите время"
						defaultOption.disabled = true
						defaultOption.selected = true
						timeSelect.appendChild(defaultOption)

						// Добавляем доступные опции времени
						data.free_times.forEach((hour) => {
							const option = document.createElement("option")
							option.value = `${hour}:00`
							option.textContent = `${hour}:00`
							timeSelect.appendChild(option)
						})
					}
				} else {
					// Если сервер вернул ошибку с успешным статусом, выводим сообщение
					timeMessage.textContent = data.message || "Произошла ошибка."
					timeMessage.style.display = "block"
					timeSelect.style.display = "none"
				}
			})
			.catch((error) => {
				// Обработка ошибок сетевых запросов
				console.error("Ошибка загрузки времени:", error)
				timeMessage.textContent =
					"Произошла ошибка при загрузке доступных времён."
				timeMessage.style.display = "block"
				timeSelect.style.display = "none" // Прячем выпадающий список
			})
	}

	// Обработчик изменения даты
	dateInput.addEventListener("change", updateAvailableTimes)

	// Автоматическое обновление времени для даты по умолчанию
	updateAvailableTimes()

	// Убираем возможность изменять цену с помощью кнопок
	minusButton.addEventListener("click", () => {
		const count = parseInt(peopleCountInput.value, 10)
		if (count > 1) {
			peopleCountInput.value = count - 1
		}
	})

	plusButton.addEventListener("click", () => {
		const count = parseInt(peopleCountInput.value, 10)
		if (count < 30) {
			peopleCountInput.value = count + 1
		}
	})

	// Обновление итоговой цены на основе выбранного персонажа
	animatorCharacterSelect.addEventListener("change", () => {
		const selectedCharacter = animatorCharacterSelect.value
		if (selectedCharacter === "both") {
			totalPriceInput.value = 8000
		} else if (
			selectedCharacter === "dedMoroz" ||
			selectedCharacter === "snegurochka"
		) {
			totalPriceInput.value = 5000
		} else {
			totalPriceInput.value = 0 // Если персонаж не выбран
		}
	})

	// Обработчик отправки формы
	form.addEventListener("submit", (e) => {
		e.preventDefault()

		const formData = new FormData(form)
		formData.append("action", "submit_order")
		formData.append("user_id", userId) // Добавляем ID пользователя

		fetch("backend/services/animator.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => {
				if (!response.ok) {
					throw new Error(`Ошибка от сервера: ${response.status}`)
				}
				return response.json()
			})
			.then((data) => {
				if (data.order_success) {
					alert(data.order_message || "Заказ успешно отправлен!")
					// Перезагрузка страницы
					location.reload()
				} else {
					alert(
						data.message ||
							"Выбранное время было только что забронировано другой услугой, пожалуйста выберите другое время."
					)
					// Перезагрузка страницы после ошибки
					location.reload() // Обновляем страницу после ошибки
				}
			})
			.catch((error) => {
				console.error("Ошибка отправки:", error)
				alert("Ошибка отправки: " + error.message)
			})
	})
})
