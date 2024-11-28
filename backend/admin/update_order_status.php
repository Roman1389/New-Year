<?php
// Подключение к базе данных
include_once __DIR__ . '/../../connect.php';

// Начало сессии
session_start();

// Проверка авторизации
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Пользователь не авторизован.']);
    exit;
}

// Проверка, что данные пришли через POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $orderId = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
    $newStatus = isset($_POST['status']) ? $_POST['status'] : ''; // Исправлено с new_status на status

    // Проверяем, что статус валиден
    $validStatuses = ['Создан', 'Подтверждён', 'Отклонён'];
    if (!in_array($newStatus, $validStatuses)) {
        echo json_encode(['success' => false, 'message' => "Ошибка: Невалидный статус."]);
        exit;
    }

    // Обновляем статус в базе данных
    if ($orderId > 0 && !empty($newStatus)) {
        $updateQuery = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $updateQuery->bind_param("si", $newStatus, $orderId);
        $updateQuery->execute();

        if ($updateQuery->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Статус успешно обновлён.']);
        } else {
            echo json_encode(['success' => false, 'message' => "Ошибка при обновлении статуса."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Ошибка: Неверные данные."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Ошибка: Неверный метод запроса."]);
}

// Закрытие подключения к базе данных
$conn->close();
