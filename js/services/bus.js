document.addEventListener("DOMContentLoaded", () => {
	const pricePerPerson = 3500 // Фиксированная цена за человека
	const peopleCountInput = document.getElementById("peopleCountBus")
	const totalPriceInput = document.getElementById("totalPriceBus")
	const minusButton = document.getElementById("minusButtonBus")
	const plusButton = document.getElementById("plusButtonBus")
	const dateInput = document.getElementById("dateBus")
	const timeSelect = document.getElementById("timeBus")
	const remainingSeatsDiv = document.getElementById("remainingSeatsBus")
	const timeMessage = document.getElementById("timeMessageBus")
	const serviceId = document.querySelector("input[name='service_id2']").value
	const userId = document.getElementById("userId2").value
	const form = document.getElementById("busOrderForm")

	let maxSeats = 0 // Переменная для хранения максимального количества мест

	// Маска для номера телефона
	$(document).ready(function () {
		$("#phoneBus").inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	})

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

	// Обновление доступных временных слотов
	function updateAvailableTimes() {
		const selectedDate = dateInput.value
		if (!selectedDate) return

		timeMessage.style.display = "none"
		remainingSeatsDiv.textContent = ""

		fetch("backend/services/bus.php", {
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
						"<option value='' disabled selected>Выберите время</option>" // Заголовок

					if (freeTimes.length > 0) {
						freeTimes.forEach((timeSlot) => {
							const option = document.createElement("option")
							option.value = timeSlot.hour
							option.textContent = `${timeSlot.hour}:00`
							timeSelect.appendChild(option)
						})
						timeSelect.disabled = false
						timeSelect.style.display = "inline" // Показываем select
						timeMessage.style.display = "none" // Скрываем сообщение
					} else {
						timeSelect.disabled = true
						timeSelect.style.display = "none" // Скрываем select
						timeMessage.textContent = "На выбранную дату все забронировано"
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

		fetch("backend/services/bus.php", {
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
					const selectedTimeSlot = data.free_times.find(
						(timeSlot) => timeSlot.hour === parseInt(selectedTime)
					)
					if (selectedTimeSlot) {
						remainingSeatsDiv.textContent = `Осталось мест: ${selectedTimeSlot.remaining_seats}`
						maxSeats = selectedTimeSlot.remaining_seats
						timeMessage.style.display = "none"
						updateTotalPrice()
					} else {
						remainingSeatsDiv.textContent = ""
						timeMessage.textContent =
							"Это время уже занято. Пожалуйста, выберите другое."
						timeMessage.style.display = "block"
						maxSeats = 0
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
		const formattedTime = selectedTime.padStart(2, "0") + ":00"

		fetch("backend/services/bus.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				action: "submit_order",
				user_id: userId,
				service_id: serviceId,
				phone: $("#phoneBus").val(),
				date: selectedDate,
				time: formattedTime,
				peopleCount: peopleCount,
				totalPrice: totalPriceInput.value,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert(data.order_message)
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
	})

	// Инициализация
	updateAvailableTimes()
	dateInput.addEventListener("change", updateAvailableTimes)
	timeSelect.addEventListener("change", updateRemainingSeats)
})
