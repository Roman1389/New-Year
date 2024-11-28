<?php
header('Content-Type: application/json; charset=utf-8');

// Подключение к базе данных
include '../../connect.php';

$response = [];

try {
   if ($conn->connect_error) {
      throw new Exception('Ошибка подключения к базе данных: ' . $conn->connect_error);
   }

   // Определяем действие
   $action = $_POST['action'] ?? '';

   // Получение свободных временных слотов
   if ($action === 'get_free_times') {
      if (!isset($_POST['date'])) {
         throw new Exception('Недостаточно данных для получения времени.');
      }

      $order_date = $_POST['date']; // Дата, на которую проверяем доступность

      // Список доступных часов, например с 9:00 до 22:00
      $available_times = range(9, 22);

      // Получаем текущее время
      $current_time = new DateTime();
      $current_hour = (int) $current_time->format('H');
      $current_minute = (int) $current_time->format('i');
      $current_date = $current_time->format('Y-m-d');

      // Если заказ на сегодняшнюю дату, исключаем уже прошедшие часы
      if ($order_date === $current_date) {
         // Оставляем только те часы, которые больше или равны текущему времени
         $available_times = array_filter($available_times, function ($hour) use ($current_hour, $current_minute) {
            return $hour > $current_hour || ($hour == $current_hour && $current_minute == 0);
         });
         $available_times = array_values($available_times); // Индексы после фильтрации могут быть не подряд
      }

      // Проверяем, является ли дата 30 или 31 декабря
      if (in_array(date('d.m', strtotime($order_date)), ['30.12', '31.12'])) {
         // Если дата 30 или 31 декабря, добавляем время с 23:00
         $available_times = array_merge($available_times, [23]);
      }

      // Получаем занятые часы для этой даты, исключая заказы со статусом "Отклонён"
      $stmt = $conn->prepare("SELECT HOUR(order_time) AS booked_hour 
                                FROM orders 
                                WHERE order_date = ? AND order_status != 'Отклонён'");
      $stmt->bind_param("s", $order_date);
      $stmt->execute();
      $result = $stmt->get_result();

      $booked_times = [];
      while ($row = $result->fetch_assoc()) {
         $booked_times[] = (int)$row['booked_hour']; // Преобразуем в int
      }

      // Вычисляем свободные часы, исключая занятые
      $free_times = array_diff($available_times, $booked_times);

      $response['success'] = true;
      $response['free_times'] = array_values($free_times); // Индексация для вывода
   }

   // Обработка отправки заказа
   elseif ($action === 'submit_order') {
      if (!isset($_POST['user_id'], $_POST['phone'], $_POST['date'], $_POST['time'], $_POST['peopleCount'])) {
         throw new Exception('Недостаточно данных для оформления заказа.');
      }

      // Получаем данные из формы
      $service_id = $_POST['service_id'];
      $order_date = $_POST['date'];
      $order_time = $_POST['time'];
      $user_id = intval($_POST['user_id']);
      $phone = $_POST['phone'];
      $people_count = intval($_POST['peopleCount']);
      $total_price = $_POST['totalPrice'];

      // Проверка на существование заказа на это время и дату
      $stmt = $conn->prepare("SELECT COUNT(*) AS order_count FROM orders WHERE order_date = ? AND order_time = ? AND order_status != 'Отклонён'");
      $stmt->bind_param("ss", $order_date, $order_time);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      if ($row['order_count'] > 0) {
         throw new Exception('На выбранное время уже существует заказ, пожалуйста выберите другое время.');
      }

      // Получаем название услуги по ID
      $stmt = $conn->prepare("SELECT title FROM services WHERE id = ?");
      $stmt->bind_param("i", $service_id);
      $stmt->execute();
      $service_result = $stmt->get_result();
      $service = $service_result->fetch_assoc();
      $service_title = $service['title'];

      // Получаем ФИО пользователя
      $stmt = $conn->prepare("SELECT name, surname, patronymic FROM users WHERE id = ?");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $user_result = $stmt->get_result();
      $user = $user_result->fetch_assoc();
      $full_name = $user['surname'] . ' ' . $user['name'] . ' ' . $user['patronymic'];

      // Форматируем дату
      $order_date_formatted = date("d.m.Y", strtotime($order_date));

      // Запись заказа в базу данных
      $stmt = $conn->prepare("INSERT INTO orders (service_id, user_id, order_date, order_time, phone, people_count, total_price, order_status)
                              VALUES (?, ?, ?, ?, ?, ?, ?, 'Создан')");
      $stmt->bind_param("iisssds", $service_id, $user_id, $order_date, $order_time, $phone, $people_count, $total_price);

      if ($stmt->execute()) {
         // Получаем ID созданного заказа
         $order_id = $stmt->insert_id;  // Получаем ID последнего вставленного заказа

         // Получаем данные о выбранных дополнительных услугах
         $additional_services = [];
         if (isset($_POST['outOfTown']) && $_POST['outOfTown'] === 'on') {
            $additional_services[] = "Выезд за город (+1500)";
         }
         if (isset($_POST['streetEvent']) && $_POST['streetEvent'] === 'on') {
            $additional_services[] = "Выезд на улицу (+1000)";
         }

         // Формируем сообщение для Telegram
         $message = "Новый заказ:\n";
         $message .= "Заказ: №$order_id\n";  // Добавляем номер заказа
         $message .= "Услуга: $service_title\n";
         $message .= "ФИО: $full_name\n";
         $message .= "Дата: $order_date_formatted\n";
         $message .= "Время: $order_time\n";
         $message .= "Телефон: $phone\n";
         $message .= "Количество человек: $people_count\n";
         $message .= "Итоговая сумма: $total_price руб.\n";

         // Добавляем информацию о дополнительных услугах
         if (!empty($additional_services)) {
            $message .= "Дополнительные услуги: " . implode(", ", $additional_services) . "\n";
         } else {
            $message .= "Дополнительные услуги: Нет\n";
         }

         // Отправка данных в Telegram
         $token = "7217871537:AAFo-onyskuxs6nRmg9NtjKSsAZJL_nRAQ4";
         $chat_id = "1933906493";  // Замените на свой chat_id

         // Формируем запрос для Telegram API
         $url = "https://api.telegram.org/bot$token/sendMessage";
         $post_fields = [
            'chat_id' => $chat_id,
            'text' => $message
         ];

         // Используем cURL для отправки POST-запроса
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Отключаем проверку сертификатов (не рекомендуется в продакшн)

         $response_telegram = curl_exec($ch);
         curl_close($ch);

         // Обрабатываем ответ Telegram API (необязательно)
         $response['order_success'] = true;
         $response['order_message'] = 'Заказ оформлен успешно!';
      } else {
         throw new Exception('Ошибка при добавлении заказа: ' . $stmt->error);
      }
   } else {
      throw new Exception('Неизвестное действие.');
   }
} catch (Exception $e) {
   $response['success'] = false;
   $response['message'] = $e->getMessage();
}

echo json_encode($response);
