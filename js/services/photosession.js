document.addEventListener("DOMContentLoaded", () => {
	const pricePerPerson = 4000 // Фиксированная цена за фотосессию
	const peopleCountInput = document.getElementById("peopleCountPhoto")
	const totalPriceInput = document.getElementById("totalPricePhoto")
	const minusButton = document.getElementById("minusButtonPhoto")
	const plusButton = document.getElementById("plusButtonPhoto")
	const dateInput = document.getElementById("datePhoto")
	const timeSelect = document.getElementById("timePhoto")
	const serviceId = document.querySelector("input[name='service_id']").value
	const userId = document.getElementById("userId10").value
	const form = document.getElementById("photoSessionForm")
	const timeMessage = document.getElementById("timeMessagePhoto")
	const maxSeats = 30

	$(document).ready(function () {
		$("#phonePhoto").inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	})

	function updateAvailableTimes() {
		const selectedDate = dateInput.value
		if (!selectedDate) return

		timeMessage.style.display = "none"

		fetch("backend/services/photosession.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				action: "get_free_times",
				date: selectedDate,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					timeSelect.innerHTML =
						'<option value="" selected disabled>Выберите время</option>'

					if (data.free_times.length > 0) {
						data.free_times.forEach((hour) => {
							const option = document.createElement("option")
							option.value = `${hour}:00`
							option.textContent = `${hour}:00`
							timeSelect.appendChild(option)
						})

						timeSelect.style.display = "block"
					} else {
						timeMessage.textContent = "На выбранную дату все забронировано."
						timeMessage.style.display = "block"
						timeSelect.style.display = "none"
					}
				} else {
					timeMessage.textContent = "Ошибка загрузки доступных времен."
					timeMessage.style.display = "block"
					timeSelect.style.display = "none"
				}
			})
			.catch(() => {
				timeMessage.textContent = "Ошибка загрузки доступных времен."
				timeMessage.style.display = "block"
				timeSelect.style.display = "none"
			})
	}

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
	dateInput.value = minDate

	dateInput.addEventListener("change", updateAvailableTimes)

	updateAvailableTimes()

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

	form.addEventListener("submit", (e) => {
		e.preventDefault()

		const formData = new FormData(form)
		formData.append("action", "submit_order")
		formData.append("user_id", userId)

		totalPriceInput.value = pricePerPerson

		fetch("backend/services/photosession.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.order_success) {
					alert(data.order_message || "Заказ успешно отправлен!")
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
			.catch(() => {
				alert("Ошибка отправки заказа. Пожалуйста, попробуйте снова.")
			})
	})
})
