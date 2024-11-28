<?php
// Подключение к базе данных
include_once __DIR__ . '/../../connect.php';

// Начало сессии
session_start();

// Проверка авторизации
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../index.php');
    exit;
}

// Получаем данные пользователя из сессии
$userAvatar = isset($_SESSION['user_avatar']) ? htmlspecialchars($_SESSION['user_avatar']) : 'default-avatar.png';
$userName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Имя';
$userSurname = isset($_SESSION['user_surname']) ? htmlspecialchars($_SESSION['user_surname']) : 'Фамилия';

// Получение всех категорий
$categoriesResult = $conn->query("SELECT * FROM categories");
if (!$categoriesResult) {
    die("Ошибка выполнения запроса к базе данных: " . $conn->error);
}

$categoriesArray = [];
while ($category = $categoriesResult->fetch_assoc()) {
    $categoriesArray[$category['id']] = $category['name'];
}

// Количество заказов на одной странице
$ordersPerPage = 5;

// Получаем текущую страницу из параметра URL, если он есть
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// Для каждой категории получаем заказы с пагинацией
$ordersByCategory = [];
$totalPages = [];

foreach ($categoriesArray as $categoryId => $categoryName) {
    // Получаем общее количество заказов в этой категории
    $countQuery = "SELECT COUNT(*) AS total FROM orders 
                    INNER JOIN services ON orders.service_id = services.id
                    WHERE services.category_id = $categoryId";
    $countResult = $conn->query($countQuery);
    $countData = $countResult->fetch_assoc();
    $totalOrders = $countData['total'];

    // Рассчитываем общее количество страниц
    $totalPages[$categoryId] = ceil($totalOrders / $ordersPerPage);

    // Получаем заказы для текущей страницы в данной категории
    $offset = ($current_page - 1) * $ordersPerPage;

    $ordersResult = $conn->query("
    SELECT 
        orders.*, 
        services.title AS service_title, 
        services.image_path, 
        categories.name AS category_name,
        users.surname, 
        users.name AS user_name, 
        users.patronymic, 
        users.phone_number
    FROM orders
    INNER JOIN services ON orders.service_id = services.id
    INNER JOIN categories ON services.category_id = categories.id
    INNER JOIN users ON orders.user_id = users.id
    WHERE services.category_id = $categoryId
    ORDER BY orders.order_id ASC, orders.order_date DESC
    LIMIT $ordersPerPage OFFSET $offset
");
    if (!$ordersResult) {
        die("Ошибка выполнения запроса к базе данных: " . $conn->error);
    }

    // Группируем заказы по категориям
    while ($order = $ordersResult->fetch_assoc()) {
        $ordersByCategory[$categoryId][] = $order;
    }
}

// Передача данных в шаблон
include '../../layouts/admin/profile.php';

// Закрытие подключения к базе данных
$conn->close();
