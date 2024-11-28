$(document).ready(function () {
	// Инициализация маски для телефона
	initializePhoneMask("#phone_number")

	function initializePhoneMask(input) {
		$(input).inputmask({
			mask: "+7 (999) 999-99-99",
			showMaskOnHover: false,
			showMaskOnFocus: false,
			placeholder: "_",
		})
	}

	// Перехват отправки формы
	$("#registerForm").submit(function (event) {
		event.preventDefault() // Предотвращаем отправку формы

		// Очищаем старые сообщения об ошибках
		$(".error-message").removeClass("text-danger").text("")

		// Получаем данные формы
		var formData = new FormData(this)

		// Отправляем запрос на сервер через AJAX
		$.ajax({
			type: "POST",
			url: $(this).attr("action"), // Указываем URL из action формы
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				// Если успешно, показываем сообщение и закрываем модальное окно
				alert("Регистрация прошла успешно!")
				$("#registerModal").modal("hide")
				location.reload() // Перезагружаем страницу
			},
			error: function (xhr) {
				// Проверка, что ответ содержит ошибки
				try {
					var response = JSON.parse(xhr.responseText)
					if (response.errors) {
						var errors = response.errors

						// Вывод ошибок под соответствующими полями
						$.each(errors, function (field, message) {
							var inputField = $(`[name="${field}"]`) // Находим поле по имени
							var errorMessage = `<span class="error-message text-danger">${message}</span>`
							inputField.addClass("is-invalid") // Добавляем стиль ошибки
							inputField.after(errorMessage) // Добавляем сообщение под полем
						})
					} else {
						// Если в ответе нет ошибок, выводим общую ошибку
						alert("Произошла ошибка. Попробуйте позже.")
					}
				} catch (e) {
					// Если ошибка парсинга JSON или ответ не в правильном формате
					alert("Произошла ошибка при обработке ответа от сервера.")
				}
			},
		})
	})

	// Убираем сообщения об ошибках при изменении полей
	$("input").on("input", function () {
		$(this).removeClass("is-invalid") // Убираем стиль ошибки
		$(this).next(".error-message").remove() // Удаляем сообщение об ошибке
	})

	// Обрабатываем изменение файла
	$("#avatar").on("change", function (event) {
		const file = event.target.files[0] // Получаем выбранный файл

		if (file) {
			const reader = new FileReader() // Создаем FileReader для чтения файла
			reader.onload = function (e) {
				// Если превью уже есть, удаляем старое
				$("#avatarPreviewWrapper").remove()

				// Создаем контейнер с превью изображения и кнопкой удаления
				const avatarPreviewWrapper = $("<div>", {
					class: "d-flex align-items-center me-3",
					id: "avatarPreviewWrapper",
				})

				const avatarPreviewContainer = $("<div>", {
					class: "me-2",
					id: "avatarPreviewContainer",
				}).appendTo(avatarPreviewWrapper)

				const img = $("<img>", {
					id: "avatarPreview",
					src: e.target.result,
					alt: "Превью",
					class: "img-fluid",
					style:
						"max-height: 50px; width: 50px; object-fit: cover; border-radius: 10px;", // Округляем углы
				}).appendTo(avatarPreviewContainer)

				// Создаем кнопку для удаления изображения
				const clearAvatarBtn = $("<button>", {
					type: "button",
					id: "clearAvatar",
					class: "btn btn-danger btn-sm",
					style: "border-radius: 50%; padding: 0.25rem;",
				}).appendTo(avatarPreviewWrapper)

				const icon = $("<i>", {
					class: "fas fa-trash-alt",
				}).appendTo(clearAvatarBtn)

				// Добавляем контейнер в родительский контейнер
				$("#avatarContainer").prepend(avatarPreviewWrapper) // Добавляем в начало контейнера

				// Показываем кнопку очистки и изображение
				$("#avatarPreviewContainer").show() // Показываем контейнер с изображением
				$("#clearAvatar").show() // Показываем кнопку очистки

				// Клик по кнопке очистки
				$("#clearAvatar").on("click", function () {
					$("#avatarPreview").attr("src", "") // Очищаем путь к изображению
					$("#avatar").val("") // Очищаем поле для загрузки
					$("#avatarPreviewWrapper").remove() // Удаляем превью и кнопку очистки
				})
			}
			reader.readAsDataURL(file) // Читаем содержимое файла
		}
	})
})
