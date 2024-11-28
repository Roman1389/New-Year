<?php
session_start();
include '../../connect.php'; // Путь к connect.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы и экранируем их для защиты от XSS
    $surname = htmlspecialchars(trim($_POST['surname'] ?? '')); // Фамилия теперь будет первой
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));         // Имя теперь будет вторым
    $patronymic = htmlspecialchars(trim($_POST['patronymic'] ?? null)); // Отчество может быть пустым
    $phone_number = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
    $login = htmlspecialchars(trim($_POST['login'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Массив для ошибок
    $errors = [];

    // Валидация данных
    if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $name)) {
        $errors['name'] = "Имя должно содержать только буквы кириллицы.";
    }
    if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $surname)) {
        $errors['surname'] = "Фамилия должна содержать только буквы кириллицы.";
    }
    if ($patronymic && !preg_match('/^[а-яА-ЯёЁ\s]+$/u', $patronymic)) {
        $errors['patronymic'] = "Отчество должно содержать только буквы кириллицы.";
    }
    if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $login)) {
        $errors['login'] = "Логин должен быть корректным email-адресом.";
    }
    if (strlen($password) < 8) {
        $errors['password'] = "Пароль должен быть не менее 8 символов.";
    }
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Пароли не совпадают.";
    }

    // Проверка на уникальность логина
    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors['login'] = "Этот логин уже используется.";
    }
    $stmt->close();

    // Если есть ошибки, возвращаем их в формате JSON
    if (!empty($errors)) {
        header('Content-Type: application/json');
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
        exit;
    }

    // Обработка загрузки аватара
    $upload_dir = '../../images/Uploads/profile/'; // Папка для сохранения аватарок
    $avatar_path = 'images/Default-user/default-user.jpg'; // Путь к изображению по умолчанию

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
        $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_ext = pathinfo($avatar_name, PATHINFO_EXTENSION); // Определяем расширение файла

        // Проверяем тип файла
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($avatar_ext), $allowed_types)) {
            $errors['avatar'] = "Допустимы только изображения (jpg, jpeg, png, gif).";
        } else {
            // Определяем следующий номер для имени файла
            $files = glob($upload_dir . 'avatar-*.{' . implode(',', $allowed_types) . '}', GLOB_BRACE);
            $next_number = count($files) + 1;
            $avatar_new_name = 'avatar-' . $next_number . '.' . $avatar_ext;

            // Полный путь для сохранения файла
            $avatar_path = $upload_dir . $avatar_new_name;

            // Перемещаем загруженный файл
            if (!move_uploaded_file($avatar_tmp_name, $avatar_path)) {
                $errors['avatar'] = "Ошибка при загрузке файла. Попробуйте ещё раз.";
            } else {
                // Относительный путь для сохранения в базе
                $avatar_path = str_replace('../../', '', $avatar_path);
            }
        }
    }

    // Ещё раз проверяем на наличие ошибок после обработки аватара
    if (!empty($errors)) {
        header('Content-Type: application/json');
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
        exit;
    }

    // Хеширование пароля
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Подготовка SQL-запроса для регистрации
    $stmt = $conn->prepare("INSERT INTO users (surname, name, patronymic, phone_number, login, password_hash, avatar_path, user_role) VALUES (?, ?, ?, ?, ?, ?, ?, 'user')");
    if (!$stmt) {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['errors' => ['database' => "Ошибка подготовки запроса: " . $conn->error]]);
        exit;
    }

    $stmt->bind_param("sssssss", $surname, $name, $patronymic, $phone_number, $login, $password_hash, $avatar_path);

    if ($stmt->execute()) {
        // Получаем ID последней вставленной записи
        $user_id = $stmt->insert_id;

        // Успешная регистрация, сохраняем данные в сессии
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user_id; // Сохраняем ID пользователя в сессии
        $_SESSION['user_surname'] = $surname; // Сохраняем фамилию
        $_SESSION['user_name'] = $name; // Сохраняем имя
        $_SESSION['user_patronymic'] = $patronymic; // Сохраняем отчество
        $_SESSION['user_avatar'] = $avatar_path ? $avatar_path : 'images/Default-user/default-user.jpg'; // Путь к аватару
        $_SESSION['user_role'] = 'user'; // Устанавливаем роль пользователя

        header('Content-Type: application/json');
        echo json_encode(['message' => 'Регистрация успешна!']);
        exit;
    } else {
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(['errors' => ['database' => "Ошибка выполнения запроса: " . $stmt->error]]);
    }

    $stmt->close();
}
$conn->close();
