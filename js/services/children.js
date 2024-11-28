document.addEventListener("DOMContentLoaded", () => {
	const pricePerPerson = 4000 // Цена за человека
	const peopleCountInput = document.getElementById("peopleCountChildren")
	const totalPriceInput = document.getElementById("totalPriceChildren")
	const minusButton = document.getElementById("minusButtonChildren")
	const plusButton = document.getElementById("plusButtonChildren")
	const dateInput = document.getElementById("dateChildren")
	const timeSelect = document.getElementById("timeChildren")
	const serviceId = document.querySelector("input[name='service_id']").value
	const userId = document.getElementById("userId3").value
	const form = document.getElementById("childrenGreetingForm")
	const timeMessage = document.getElementById("timeMessageChildren") // Элемент для сообщения о занятости времени
	let maxSeats = 30 // Максимальное количество мест для бронирования

	// Маска для номера телефона
	$(document).ready(function () {
		$("#phoneChildren").inputmask({
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

		// Очищаем сообщения о занятости времени перед обновлением
		timeMessage.style.display = "none"

		fetch("backend/services/children.php", {
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
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					timeSelect.innerHTML =
						'<option value="" selected disabled>Выберите время</option>'

					if (data.free_times.length > 0) {
						// Добавляем доступные временные слоты
						data.free_times.forEach((hour) => {
							const option = document.createElement("option")
							option.value = `${hour}:00`
							option.textContent = `${hour}:00`
							timeSelect.appendChild(option)
						})

						// Показываем select, если есть доступные времена
						timeSelect.style.display = "block"
					} else {
						// Если нет доступных времен, показываем сообщение и скрываем select
						timeMessage.textContent = "На выбранную дату все забронировано."
						timeMessage.style.display = "block"
						timeSelect.style.display = "none" // Скрыть select, если нет доступных времен
					}
				} else {
					alert(data.message || "Произошла ошибка.")
				}
			})
			.catch((error) => {
				alert("Ошибка загрузки времени: " + error)
			})
	}

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

	dateInput.min = minDate // Установка минимальной даты
	dateInput.max = maxDate // Установка максимальной даты
	dateInput.value = minDate // Установка текущей даты по умолчанию

	// Обработчик изменения даты
	dateInput.addEventListener("change", updateAvailableTimes)

	// Автоматическое обновление времени для даты по умолчанию
	updateAvailableTimes()

	// Функции изменения количества человек
	minusButton.addEventListener("click", () => {
		const count = parseInt(peopleCountInput.value, 10)
		if (count > 1) {
			peopleCountInput.value = count - 1
		}
	})

	plusButton.addEventListener("click", () => {
		const count = parseInt(peopleCountInput.value, 10)
		if (count < maxSeats) {
			peopleCountInput.value = count + 1
		}
	})

	// Обработчик отправки формы
	form.addEventListener("submit", (e) => {
		e.preventDefault()

		const formData = new FormData(form)
		formData.append("action", "submit_order")
		formData.append("user_id", userId) // Добавляем ID пользователя

		// Устанавливаем цену постоянной
		totalPriceInput.value = pricePerPerson

		fetch("backend/services/children.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
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
				alert("Ошибка отправки: " + error)
			})
	})
})
