document.addEventListener("DOMContentLoaded", () => {
	const pricePerPerson = 3500 // Цена за человека
	const peopleCountInput = document.getElementById("peopleCount")
	const totalPriceInput = document.getElementById("totalPrice")
	const minusButton = document.getElementById("minusButton")
	const plusButton = document.getElementById("plusButton")
	const dateInput = document.getElementById("date")
	const timeSelect = document.getElementById("time")
	const remainingSeatsDiv = document.getElementById("remainingSeats")
	const timeMessage = document.getElementById("timeMessageMorobus") // Элемент для сообщения о занятости времени
	const serviceId = document.querySelector("input[name='service_id']").value
	const userId = document.getElementById("userId").value
	const form = document.getElementById("morobusForm")

	let maxSeats = 0 // Переменная для хранения максимального числа мест

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
	dateInput.value = minDate // Установка текущей даты по умолчанию

	// Маска для номера телефона
	$(document).ready(function () {
		$("#phone").inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	})

	// Обновление доступных временных слотов и оставшихся мест
	function updateAvailableTimes() {
		const selectedDate = dateInput.value
		if (!selectedDate) return

		// Очищаем сообщение о количестве мест перед обновлением
		remainingSeatsDiv.textContent = ""
		timeMessage.style.display = "none" // Скрываем сообщение о занятости времени

		fetch("backend/services/morobus.php", {
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
					const freeTimes = data.free_times
					timeSelect.innerHTML =
						"<option value='' disabled selected>Выберите время</option>" // Добавляем опцию "Выберите время"
					freeTimes.forEach((timeSlot) => {
						const option = document.createElement("option")
						option.value = timeSlot.hour
						option.textContent = `${timeSlot.hour}:00`
						timeSelect.appendChild(option)
					})

					// Если есть доступные временные слоты, активируем выпадающий список
					if (freeTimes.length > 0) {
						timeSelect.disabled = false
						timeSelect.style.display = "inline" // Показываем select
						timeMessage.style.display = "none" // Скрываем сообщение
					} else {
						timeSelect.disabled = true
						timeSelect.style.display = "none" // Скрываем select
						timeMessage.textContent = "На выбранную дату все забронировано."
						timeMessage.style.display = "block" // Показываем сообщение
					}
				}
			})
	}

	// Обновление оставшихся мест при выборе времени
	function updateRemainingSeats() {
		const selectedTime = timeSelect.value
		const selectedDate = dateInput.value
		if (!selectedTime || !selectedDate) return

		// Запрос для получения оставшихся мест
		fetch("backend/services/morobus.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				action: "get_free_times", // Вызываем ту же функцию
				service_id: serviceId,
				date: selectedDate,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					const selectedTimeSlot = data.free_times.find(
						(timeSlot) => timeSlot.hour === parseInt(selectedTime)
					)
					if (selectedTimeSlot) {
						remainingSeatsDiv.textContent = `Осталось мест: ${selectedTimeSlot.remaining_seats}`
						maxSeats = selectedTimeSlot.remaining_seats // Сохраняем максимальное количество мест
						timeMessage.style.display = "none" // Прячем сообщение, если место доступно
						// Обновление доступных мест на кнопках + и -
						updateTotalPrice()
					} else {
						remainingSeatsDiv.textContent = "" // Если слот занят
						timeMessage.textContent =
							"Выбранная дата забронирована, пожалуйста, выберите другую дату."
						timeMessage.style.display = "block"
						maxSeats = 0 // Сбрасываем количество доступных мест
					}
				}
			})
	}

	// Обновление цены в зависимости от количества человек
	function updateTotalPrice() {
		const peopleCount = parseInt(peopleCountInput.value) || 0
		totalPriceInput.value = peopleCount * pricePerPerson
	}

	// Обработчик кнопок + и -
	minusButton.addEventListener("click", () => {
		const currentValue = parseInt(peopleCountInput.value) || 0
		if (currentValue > 1) {
			peopleCountInput.value = currentValue - 1
			updateTotalPrice()
		}
	})

	plusButton.addEventListener("click", () => {
		const currentValue = parseInt(peopleCountInput.value) || 0
		if (currentValue < maxSeats) {
			peopleCountInput.value = currentValue + 1
			updateTotalPrice()
		}
	})

	// Обработчик отправки формы
	form.addEventListener("submit", (event) => {
		event.preventDefault()

		const peopleCount = parseInt(peopleCountInput.value)
		if (peopleCount <= 0) {
			alert("Укажите количество людей!")
			return
		}

		const selectedDate = dateInput.value
		const selectedTime = timeSelect.value

		// Форматируем время перед отправкой
		const formattedTime = selectedTime.padStart(2, "0") + ":00" // Обеспечиваем формат "HH:00"

		fetch("backend/services/morobus.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				action: "submit_order",
				user_id: userId,
				service_id: serviceId,
				phone: $("#phone").val(),
				date: selectedDate,
				time: formattedTime, // Отправляем отформатированное время
				peopleCount: peopleCount,
				totalPrice: totalPriceInput.value,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					if (data.order_success) {
						alert(data.order_message)
					} else {
						alert(data.message)
					}
					// Перезагрузка страницы
					location.reload() // Обновляет страницу после успешной отправки
				} else {
					alert(
						data.message ||
							"Выбранное время было только что забронировано другой услугой, пожалуйста выберите другое время."
					)
					// Перезагрузка страницы после ошибки
					location.reload() // Обновляем страницу после ошибки
				}
			})
	})

	// Инициализация
	updateAvailableTimes()
	dateInput.addEventListener("change", updateAvailableTimes)
	timeSelect.addEventListener("change", updateRemainingSeats)
})
