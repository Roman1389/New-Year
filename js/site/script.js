window.onload = function () {
	// Изначально показываем иконку поддержки
	const supportIcon = document.getElementById("supportIcon")
	supportIcon.style.pointerEvents = "auto" // Делаем иконку кликабельной сразу
	supportIcon.style.opacity = 1 // Полностью видимая
	supportIcon.classList.add("show")
	supportIcon.style.display = "block" // Показываем иконку сразу
}

// Закрытие всплывающего сообщения при клике на кнопку
document.getElementById("closePopup").addEventListener("click", function () {
	document.getElementById("popup").classList.remove("show")

	// Показываем иконку поддержки после закрытия всплывающего окна
	setTimeout(function () {
		const supportIcon = document.getElementById("supportIcon")
		supportIcon.classList.remove("hide") // Удаляем класс hide
		supportIcon.classList.add("show") // Добавляем класс show
		supportIcon.style.display = "block" // Показываем иконку
	}, 300) // Задержка для завершения анимации
})

// Показ всплывающего сообщения при клике на иконку техподдержки
document.getElementById("supportIcon").addEventListener("click", function () {
	document.getElementById("popup").classList.add("show")
	const supportIcon = document.getElementById("supportIcon")
	supportIcon.classList.add("hide")

	setTimeout(function () {
		supportIcon.style.display = "none" // Скрываем иконку после открытия окна
	}, 300) // Задержка для плавного скрытия иконки
})
