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
      if (!isset($_POST['date'], $_POST['service_id'])) {
         throw new Exception('Недостаточно данных для получения времени.');
      }

      $order_date = $_POST['date']; // Дата, на которую проверяем доступность
      $service_id = $_POST['service_id']; // ID услуги

      // Получаем все доступные часы с 9 до 23
      $available_times = range(9, 22);

      // Получаем текущее время
      $current_time = new DateTime();
      $current_hour = (int)$current_time->format('H');
      $current_minute = (int)$current_time->format('i');
      $current_date = $current_time->format('Y-m-d');

      // Если заказ на сегодняшнюю дату, исключаем уже прошедшие часы
      if ($order_date === $current_date) {
         $available_times = array_filter($available_times, function ($hour) use ($current_hour, $current_minute) {
            return $hour > $current_hour || ($hour == $current_hour && $current_minute === 0);
         });
         $available_times = array_values($available_times); // Индексы после фильтрации могут быть не подряд
      }

      // Получаем занятые часы для данной даты и услуги
      $stmt = $conn->prepare("
            SELECT HOUR(order_time) AS booked_hour, SUM(people_count) AS total_people
            FROM orders 
            WHERE order_date = ? AND service_id = ? AND order_status != 'Отклонён'
            GROUP BY HOUR(order_time)
        ");
      $stmt->bind_param("si", $order_date, $service_id);
      $stmt->execute();
      $result = $stmt->get_result();

      $service_booked_hours = [];
      while ($row = $result->fetch_assoc()) {
         $service_booked_hours[(int)$row['booked_hour']] = (int)$row['total_people']; // Сохраняем занятые часы и занятые места
      }

      // Получаем занятые часы для всех услуг
      $stmt = $conn->prepare("
            SELECT HOUR(order_time) AS booked_hour
            FROM orders 
            WHERE order_date = ? AND service_id != ? AND order_status != 'Отклонён'
            GROUP BY HOUR(order_time)
        ");
      $stmt->bind_param("si", $order_date, $service_id);
      $stmt->execute();
      $result = $stmt->get_result();

      $booked_hours = [];
      while ($row = $result->fetch_assoc()) {
         $booked_hours[] = (int)$row['booked_hour']; // Сохраняем занятые часы для других услуг
      }

      // Вычисляем доступные часы для услуги с оставшимися местами
      $free_times = [];
      foreach ($available_times as $hour) {
         if (!in_array($hour, $booked_hours)) { // Время должно быть свободно для всех услуг
            $booked_people = $service_booked_hours[$hour] ?? 0; // Забронированные места для данной услуги
            $remaining_seats = 30 - $booked_people; // Максимум 30 мест

            if ($remaining_seats > 0) {
               $free_times[] = [
                  'hour' => $hour,
                  'remaining_seats' => $remaining_seats
               ];
            }
         }
      }

      $response['success'] = true;
      $response['free_times'] = $free_times; // Список доступных времен с оставшимися местами
   }

   // Обработка отправки заказа
   elseif ($action === 'submit_order') {
      if (!isset($_POST['user_id'], $_POST['phone'], $_POST['date'], $_POST['time'], $_POST['peopleCount'], $_POST['service_id'])) {
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

      // Преобразование времени в формат HH:MM:SS, если оно передано в виде HH
      if (strlen($order_time) == 2) {
         $order_time = $order_time . ':00:00'; // HH => HH:00:00
      } elseif (strlen($order_time) == 5) {
         $order_time = $order_time . ':00'; // HH:MM => HH:MM:00
      }

      // Получаем занятие часов для данной услуги
      $stmt = $conn->prepare("
            SELECT COUNT(*) AS order_count 
            FROM orders 
            WHERE order_date = ? AND order_time = ? AND service_id != ? AND order_status != 'Отклонён'
        ");
      $stmt->bind_param("ssi", $order_date, $order_time, $service_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      // Если существует активный заказ для другой услуги, выбрасываем ошибку
      if ($row['order_count'] > 0) {
         throw new Exception('Выбранное время было только что забронировано другой услугой, пожалуйста выберите другое время.');
      }

      // Проверка занятости мест для данной услуги
      $stmt = $conn->prepare("
            SELECT SUM(people_count) AS total_booked 
            FROM orders 
            WHERE order_date = ? AND service_id = ? AND order_time = ? AND order_status != 'Отклонён'
        ");
      $stmt->bind_param("ssi", $order_date, $service_id, $order_time);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

      $total_booked = (int)$row['total_booked']; // Получаем общее количество забронированных мест

      // Проверка на превышение лимита
      if (($total_booked + $people_count) > 30) {
         $remaining_seats = 30 - $total_booked;
         throw new Exception('Не удается оформить заказ. Максимально доступно мест в это время: ' . $remaining_seats . '.');
      }

      // Запись заказа в базу данных с установленным статусом 'Создан'
      $stmt = $conn->prepare("
            INSERT INTO orders (service_id, user_id, order_date, order_time, phone, people_count, total_price, order_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Создан')
        ");
      $stmt->bind_param("iisssds", $service_id, $user_id, $order_date, $order_time, $phone, $people_count, $total_price);

      if ($stmt->execute()) {
         $order_id = $stmt->insert_id; // Получаем ID нового заказа

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

         // Формируем сообщение для Telegram
         $message = "Новый заказ:\n";
         $message .= "Заказ: №$order_id\n";
         $message .= "Услуга: $service_title\n";
         $message .= "ФИО: $full_name\n";
         $message .= "Дата: $order_date_formatted\n";
         $message .= "Время: $order_time\n";
         $message .= "Телефон: $phone\n";
         $message .= "Количество человек: $people_count\n";
         $message .= "Итоговая сумма: $total_price руб.\n";

         // Отправляем сообщение в Telegram
         $token = "7217871537:AAFo-onyskuxs6nRmg9NtjKSsAZJL_nRAQ4"; // Измените на ваш токен
         $chat_id = "1933906493"; // Измените на ваш chat_id
         $url = "https://api.telegram.org/bot$token/sendMessage";

         $post_fields = [
            'chat_id' => $chat_id,
            'text' => $message
         ];

         // Инициализация cURL для отправки сообщения в Telegram
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
         curl_exec($ch);
         curl_close($ch);

         // Успешный ответ
         $response['success'] = true;
         $response['order_success'] = true; // Указываем, что заказ успешен
         $response['order_message'] = 'Заказ оформлен успешно!';
      } else {
         throw new Exception('Ошибка при добавлении заказа: ' . $stmt->error);
      }
   } else {
      throw new Exception('Неизвестное действие.');
   }
} catch (Exception $e) {
   // Сообщение об ошибке
   $response['success'] = false;
   $response['message'] = $e->getMessage();
   error_log($e->getMessage()); // Логирование ошибки
}

echo json_encode($response);
