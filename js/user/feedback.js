document.addEventListener("DOMContentLoaded", function () {
	// Инициализация маски для телефона
	function initializePhoneMask(input) {
		$(input).inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	}

	// Инициализация маски для телефона
	initializePhoneMask("#feedbackPhone")

	// Функция для валидации email
	function validateEmail(email) {
		const emailError = document.getElementById("emailError")
		const emailPattern = /^[a-zA-Z0-9@._-]+$/
		if (!emailPattern.test(email)) {
			emailError.innerText = "Email не может содержать русские символы."
			emailError.style.color = "red" // Яркий красный цвет ошибки
		} else {
			emailError.innerText = ""
		}
	}

	// Функция для валидации сообщения
	function validateMessage(message) {
		const messageError = document.getElementById("messageError")

		// Проверка, что сообщение не содержит латиницы
		const latinPattern = /[a-zA-Z]/
		if (message.length > 0 && latinPattern.test(message)) {
			messageError.innerText = "Сообщение должно содержать только кириллицу."
			messageError.style.color = "red" // Яркий красный цвет ошибки
		} else if (
			message.length > 0 &&
			(message.length < 10 || message.length > 250)
		) {
			messageError.innerText = "Сообщение должно быть от 10 до 250 символов."
			messageError.style.color = "red" // Яркий красный цвет ошибки
		} else {
			messageError.innerText = ""
		}
	}

	// Добавляем обработчики на изменения полей
	document.getElementById("email").addEventListener("input", function () {
		validateEmail(this.value)
	})

	document.getElementById("message").addEventListener("input", function () {
		validateMessage(this.value)
	})

	// Валидация и отправка формы
	const form = document.getElementById("feedbackForm")
	form.addEventListener("submit", function (event) {
		event.preventDefault()

		// Получение значений формы
		let email = document.getElementById("email").value
		let message = document.getElementById("message").value

		// Принудительная проверка полей перед отправкой
		validateEmail(email)
		validateMessage(message)

		// Если есть ошибки, не отправляем форму
		if (
			document.getElementById("emailError").innerText ||
			document.getElementById("messageError").innerText
		) {
			return
		}

		// Отправка формы через AJAX
		const formData = new FormData(form)
		fetch("backend/user/feedback.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => {
				if (!response.ok) {
					throw new Error("Ошибка при получении ответа от сервера")
				}
				return response.json() // Пытаемся распарсить как JSON
			})
			.then((data) => {
				if (data.status === "success") {
					alert(data.message)
					form.reset() // Очищаем форму
				} else {
					alert(data.message) // Сообщение об ошибке
				}
			})
			.catch((error) => {
				console.error("Ошибка:", error)
				alert("Произошла ошибка при отправке отзыва. Попробуйте еще раз.")
			})
	})
})
