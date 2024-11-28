<?php
header('Content-Type: application/json; charset=utf-8');

// Подключение к базе данных
include '../../connect.php';

// Массив для ответа
$response = [];

// Функция для защиты данных
function sanitize_input($data)
{
   return htmlspecialchars(trim($data ?? ''), ENT_QUOTES, 'UTF-8');
}

// Проверка, запрашиваются ли услуги
if (isset($_GET['action']) && $_GET['action'] === 'get_services') {
   // Получение списка услуг из базы данных
   $services_query = "SELECT id, title FROM services";
   $services_result = mysqli_query($conn, $services_query);

   // Если произошла ошибка при запросе
   if (!$services_result) {
      $response['success'] = false;
      $response['message'] = 'Ошибка при получении списка услуг: ' . mysqli_error($conn);
      echo json_encode($response);
      exit;
   }

   // Массив для услуг
   $services = [];
   while ($row = mysqli_fetch_assoc($services_result)) {
      $services[] = $row;
   }

   // Возвращаем услуги в формате JSON
   echo json_encode(['success' => true, 'services' => $services]);
   exit;
}

// Получение данных из POST
$fullName = sanitize_input($_POST['fullName']);
$service = sanitize_input($_POST['service']);
$serviceTitle = sanitize_input($_POST['serviceTitle']); // Получаем название услуги
$phone = sanitize_input($_POST['phone']);
$message = sanitize_input($_POST['message']);

// Проверка на пустые поля
if (empty($fullName) || empty($service) || empty($phone) || empty($message)) {
   $response['success'] = false;
   $response['message'] = 'Все поля обязательны для заполнения.';
   echo json_encode($response);
   exit;
}

// Проверка валидности ФИО (только кириллица)
if (!preg_match('/^[а-яА-ЯёЁ\s]+$/u', $fullName)) {
   $response['success'] = false;
   $response['message'] = 'ФИО должно содержать только кириллицу.';
   echo json_encode($response);
   exit;
}

// Проверка сообщения на кириллицу
if (!preg_match('/^[а-яА-ЯёЁ\s.,!?()-]+$/u', $message)) {
   $response['success'] = false;
   $response['message'] = 'Сообщение должно содержать только кириллицу.';
   echo json_encode($response);
   exit;
}

// Получение списка услуг для проверки
$services_query = "SELECT id FROM services";
$services_result = mysqli_query($conn, $services_query);
$services_ids = [];
while ($row = mysqli_fetch_assoc($services_result)) {
   $services_ids[] = $row['id'];
}

// Проверка на выбранную услугу
if (!in_array($service, $services_ids)) {
   $response['success'] = false;
   $response['message'] = 'Выбранная услуга не существует.';
   echo json_encode($response);
   exit;
}

// Отправка данных в Telegram
$token = "7217871537:AAFo-onyskuxs6nRmg9NtjKSsAZJL_nRAQ4";
$chatId = "1933906493";

$text = "Новая заявка:\n";
$text .= "ФИО: $fullName\n";
$text .= "Услуга: $serviceTitle\n"; // Используем название услуги
$text .= "Телефон: $phone\n";
$text .= "Сообщение: $message\n";

$url = "https://api.telegram.org/bot$token/sendMessage";
$postFields = [
   'chat_id' => $chatId,
   'text' => $text,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$telegramResponse = curl_exec($ch);
curl_close($ch);

// Проверка успешности отправки в Telegram
if ($telegramResponse) {
   $response['success'] = true;
   $response['message'] = 'Заявка успешно отправлена.';
} else {
   $response['success'] = false;
   $response['message'] = 'Ошибка при отправке заявки в Telegram.';
}

echo json_encode($response);
