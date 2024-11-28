document.addEventListener("DOMContentLoaded", () => {
	const fixedPrice = 3300 // Фиксированная цена для обычных дней
	const peopleCountInput = document.getElementById("peopleCountFamily")
	const totalPriceInput = document.getElementById("totalPriceFamily")
	const minusButton = document.getElementById("minusButtonFamily")
	const plusButton = document.getElementById("plusButtonFamily")
	const dateInput = document.getElementById("dateFamily")
	const timeSelect = document.getElementById("timeFamily")
	const timeMessage = document.getElementById("timeMessageFamily") // Элемент для сообщения, если времени нет
	const userId = document.getElementById("userId5").value
	const form = document.getElementById("familyGreetingForm")
	const serviceId = document.querySelector("input[name='service_id']").value

	// Чекбоксы для дополнительных услуг
	const outOfTownCheckbox = document.getElementById("outOfTown")
	const streetEventCheckbox = document.getElementById("streetEvent")

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
		new Date(today.getFullYear(), today.getMonth(), today.getDate() + 77)
	)
	dateInput.min = minDate
	dateInput.max = maxDate
	dateInput.value = minDate // Установка текущего дня по умолчанию

	// Маска для номера телефона
	$(document).ready(function () {
		$("#phoneFamily").inputmask({
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

		fetch("backend/services/family.php", {
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
					alert(data.message || "Произошла ошибка.")
				}
			})
			.catch((error) => {
				alert("Ошибка загрузки времени: " + error)
				console.error("Ошибка при загрузке времени:", error) // Логирование ошибки в консоль
			})
	}

	// Обработчик изменения даты
	dateInput.addEventListener("change", updateAvailableTimes)

	// Автоматическое обновление времени для даты по умолчанию
	updateAvailableTimes()

	// Логика изменения количества человек
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

	// Функция для расчета итоговой цены
	function calculateTotalPrice() {
		let totalPrice = fixedPrice // Начальная цена для всех дней, кроме праздников
		const selectedDate = new Date(dateInput.value)
		const hour = new Date(
			`${selectedDate.toDateString()} ${timeSelect.value}`
		).getHours()

		// Проверка на праздничные дни (30 и 31 декабря)
		if (
			(selectedDate.getMonth() === 11 && selectedDate.getDate() === 30) ||
			(selectedDate.getMonth() === 11 && selectedDate.getDate() === 31)
		) {
			if (hour >= 9 && hour < 17) {
				totalPrice = 3300
			} else if (hour >= 17 && hour < 21) {
				totalPrice = 3600
			} else if (hour >= 21 && hour < 23) {
				totalPrice = 4500
			} else if (hour >= 23 && hour < 24) {
				totalPrice = 5000
			}
		} else if (
			selectedDate.getMonth() === 11 &&
			selectedDate.getDate() >= 22 &&
			selectedDate.getDate() <= 29
		) {
			// С 22 по 29 декабря цена фиксированная
			totalPrice = 3300
		}

		// Проверка на выезд за город
		if (outOfTownCheckbox.checked) {
			totalPrice += 1500
		}

		// Проверка на улицу
		if (streetEventCheckbox.checked) {
			totalPrice += 1000
		}

		// Обновляем итоговую цену
		totalPriceInput.value = totalPrice
	}

	// Слушатели изменений для выезда за город и улицы
	outOfTownCheckbox.addEventListener("change", calculateTotalPrice)
	streetEventCheckbox.addEventListener("change", calculateTotalPrice)

	// Обработчик изменения времени
	timeSelect.addEventListener("change", calculateTotalPrice) // Вызов функции для обновления цены при выборе времени

	// Обработчик отправки формы
	form.addEventListener("submit", (e) => {
		e.preventDefault()

		const formData = new FormData(form)
		formData.append("action", "submit_order")
		formData.append("user_id", userId) // Добавляем ID пользователя

		// Отправляем данные с фиксированной ценой
		fetch("backend/services/family.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.order_success) {
					alert(data.order_message || "Заказ успешно отправлен!")

					// Обновление страницы
					location.reload() // Обновление страницы для того, чтобы все изменения были применены
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
				console.error("Ошибка при отправке заказа:", error) // Логирование ошибки в консоль
			})
	})
})
