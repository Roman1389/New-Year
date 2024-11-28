<?php
session_start();
include '../../connect.php'; // Путь к вашему файлу с подключением к БД

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Получаем данные из формы
   $login = htmlspecialchars(trim($_POST['login'] ?? ''));
   $password = $_POST['password'] ?? '';

   // Массив для ошибок
   $errors = [];

   // Проверка на пустые поля
   if (empty($login)) {
      $errors['login'] = "Введите логин.";
   } else if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
      // Проверяем, что логин соответствует формату email
      $errors['login'] = "Некорректный формат логина. Используйте email.";
   } else if (!preg_match('/^[a-zA-Z0-9._@-]+$/', $login)) {
      // Проверяем логин на допустимые символы
      $errors['login'] = "Логин содержит недопустимые символы.";
   }

   if (empty($password)) {
      $errors['password'] = "Введите пароль.";
   } else if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_\-+=]{8,}$/', $password)) {
      // Проверяем, что пароль содержит только допустимые символы
      $errors['password'] = "Пароль должен быть не менее 8 символов и содержать только допустимые символы.";
   }

   // Если есть ошибки, возвращаем их
   if (!empty($errors)) {
      header('Content-Type: application/json');
      http_response_code(422);
      echo json_encode(['errors' => $errors]);
      exit;
   }

   // Поиск пользователя в базе данных
   $stmt = $conn->prepare("SELECT id, name, surname, password_hash, avatar_path, user_role FROM users WHERE login = ?");
   if (!$stmt) {
      header('Content-Type: application/json');
      http_response_code(500);
      echo json_encode(['errors' => ['database' => "Ошибка подготовки запроса: " . $conn->error]]);
      exit;
   }

   $stmt->bind_param("s", $login);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      // Проверяем пароль
      if (password_verify($password, $user['password_hash'])) {
         // Успешная авторизация, сохраняем данные в сессии
         $_SESSION['logged_in'] = true;
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['user_name'] = $user['name'];
         $_SESSION['user_surname'] = $user['surname'];
         $_SESSION['user_avatar'] = $user['avatar_path'] ?? 'images/default-avatar.png'; // Если нет аватара, используем дефолтное изображение
         $_SESSION['user_role'] = $user['user_role'];

         header('Content-Type: application/json');
         echo json_encode(['message' => 'Авторизация успешна!']);
         exit;
      } else {
         $errors['password'] = "Неверный пароль.";
      }
   } else {
      $errors['login'] = "Пользователь с таким логином не найден.";
   }

   $stmt->close();
   $conn->close();

   // Если были ошибки, возвращаем их
   header('Content-Type: application/json');
   http_response_code(422);
   echo json_encode(['errors' => $errors]);
   exit;
}
