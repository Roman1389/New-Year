<?php
session_start();

// Подключение к базе данных
require_once '../../connect.php';

$response = array();

header('Content-Type: application/json'); // Указываем, что возвращаем JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Проверяем, авторизован ли пользователь
   if (!isset($_SESSION['user_id'])) {
      $response['status'] = 'error';
      $response['message'] = 'Пожалуйста, авторизуйтесь для отправки отзыва.';
      echo json_encode($response);
      exit;
   }

   $user_id = $_SESSION['user_id']; // Получаем user_id из сессии
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $message = $_POST['message'];

   // Очистка номера телефона от всех символов, кроме цифр и знака "+"
   $phone = preg_replace("/[^0-9+]/", "", $phone);

   // Проверка на наличие обязательных данных
   if (empty($phone) || empty($email) || empty($message)) {
      $response['status'] = 'error';
      $response['message'] = 'Все поля обязательны для заполнения.';
      echo json_encode($response);
      exit;
   }

   // Вставка отзыва в базу данных
   $stmt = $conn->prepare("INSERT INTO feedback (user_id, phone, email, message) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("isss", $user_id, $phone, $email, $message); // Привязываем параметры

   if ($stmt->execute()) {
      $response['status'] = 'success';
      $response['message'] = 'Ваш отзыв успешно отправлен!';
   } else {
      $response['status'] = 'error';
      $response['message'] = 'Произошла ошибка при отправке отзыва.';
   }

   $stmt->close();
   $conn->close();

   // Отправляем ответ обратно в формате JSON
   echo json_encode($response);
}
