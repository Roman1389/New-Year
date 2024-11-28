<?php
// Параметры подключения
$host = 'localhost'; // Обычно 'localhost'
$dbname = 'NewYear'; // Название базы данных
$username = 'root'; // Имя пользователя базы данных
$password = ''; // Пароль базы данных

// Подключение к базе данных
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Установка кодировки
$conn->set_charset("utf8");
