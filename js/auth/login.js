$(document).ready(function () {
	$("#loginForm").submit(function (event) {
		event.preventDefault() // Предотвращаем стандартное действие формы

		// Очищаем старые сообщения об ошибках
		$("#error-message").html("").removeClass("text-danger").hide()

		// Получаем данные формы
		var formData = new FormData(this)

		// Отправляем запрос на сервер через AJAX
		$.ajax({
			type: "POST",
			url: $(this).attr("action"), // URL из action формы
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				alert("Авторизация прошла успешно!")
				window.location.href = "/home.php" // Перенаправление на главную страницу
			},
			error: function (xhr) {
				// Убираем вывод ошибок в консоль
				if (xhr.status === 422) {
					try {
						var response = JSON.parse(xhr.responseText)
						if (response.errors) {
							var errors = response.errors

							// Выводим ошибки под соответствующими полями
							$.each(errors, function (field, message) {
								var inputField = $(`[name="${field}"]`) // Находим поле по имени
								var errorMessage = `<span class="text-danger">${message}</span>`
								inputField.addClass("is-invalid") // Добавляем стиль ошибки
								inputField.after(errorMessage) // Добавляем сообщение под полем
							})
						} else {
							$("#error-message")
								.addClass("text-danger")
								.html("Произошла ошибка. Попробуйте позже.")
								.show()
						}
					} catch (e) {
						$("#error-message")
							.addClass("text-danger")
							.html("Ошибка при обработке ответа от сервера.")
							.show()
					}
				} else {
					$("#error-message")
						.addClass("text-danger")
						.html("Произошла ошибка. Попробуйте позже.")
						.show()
				}
			},
		})
	})

	// Убираем сообщения об ошибках при изменении полей
	$("input").on("input", function () {
		$(this).removeClass("is-invalid") // Убираем стиль ошибки
		$(this).next("span.text-danger").remove() // Удаляем сообщение об ошибке
	})
})
