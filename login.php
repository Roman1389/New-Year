<?php
// Подключаем базу данных
include('connect.php');
session_start(); // Начинаем сессию

// Проверяем, отправлена ли форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Подготавливаем запрос для получения пользователя по логину
    $stmt = $conn->prepare("SELECT password_hash, photo_path FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    // Проверяем, найден ли пользователь
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password_hash, $photo_path);
        $stmt->fetch();

        // Проверяем правильность пароля
        if (password_verify($password, $password_hash)) {
            // Успешный вход
            $_SESSION['logged_in'] = true; // Устанавливаем сессию
            $_SESSION['photo_path'] = $photo_path; // Сохраняем путь к фотографии
            header("Location: home.php"); // Перенаправляем на главную страницу
            exit();
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }

    $stmt->close();
}

$conn->close();
