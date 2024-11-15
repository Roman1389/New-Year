<?php
// Подключаем базу данных
include('connect.php');

// Проверяем, отправлена ли форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $phone_number = $_POST['phone_number'];
    $login = $_POST['login']; // Используем столбец login
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверка, совпадают ли пароль и подтверждение пароля
    if ($password === $confirm_password) {
        // Хэшируем пароль
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Проверка, существует ли уже пользователь с таким именем пользователя
        $check_stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $check_stmt->bind_param("s", $login);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
        } else {
            // Обработка загружаемого файла
            $photo = $_FILES['photo'];
            $photoPath = 'uploads/' . 'avatar_' . uniqid() . '.jpg';

            if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
                // Подготавливаем SQL-запрос с использованием password_hash
                $stmt = $conn->prepare("INSERT INTO users (name, surname, patronymic, phone_number, login, password_hash, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $name, $surname, $patronymic, $phone_number, $login, $password_hash, $photoPath);

                // Выполняем запрос и проверяем результат
                if ($stmt->execute()) {
                    // Сохранение пути к фото в сессии
                    session_start();
                    $_SESSION['logged_in'] = true;
                    $_SESSION['photo_path'] = $photoPath; // Сохранение пути к фотографии
                    header("Location: home.php"); // Перенаправление на главную страницу
                    exit();
                } else {
                    echo "Ошибка: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Ошибка при загрузке файла.";
            }
        }
        $check_stmt->close();
    } else {
        echo "Пароли не совпадают. Пожалуйста, попробуйте снова.";
    }
}

$conn->close();
?>