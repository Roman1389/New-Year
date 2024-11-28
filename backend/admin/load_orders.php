<?php
// Подключение к базе данных
include_once __DIR__ . '/../../connect.php';

// Начало сессии
session_start();

// Проверка авторизации (оставляем только если нужно для других целей)
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Если не авторизован, это не критично, просто оставляем возможность вывода всех заказов
    // exit;
}

$ordersPerPage = 3;

// Получаем параметры из запроса
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;

if ($page < 1) {
    $page = 1;
}

// Получаем общее количество заказов в данной категории (для всех пользователей)
$countQuery = $conn->prepare("SELECT COUNT(*) AS total FROM orders 
                INNER JOIN services ON orders.service_id = services.id
                WHERE services.category_id = ?");
$countQuery->bind_param("i", $categoryId);
$countQuery->execute();
$countResult = $countQuery->get_result();
$countData = $countResult->fetch_assoc();
$totalOrders = $countData['total'];

// Рассчитываем общее количество страниц
$totalPages = ceil($totalOrders / $ordersPerPage);
$offset = ($page - 1) * $ordersPerPage;

$ordersQuery = $conn->prepare("
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
    WHERE services.category_id = ?
    ORDER BY orders.order_id ASC, orders.order_date DESC
    LIMIT ? OFFSET ?
");
$ordersQuery->bind_param("iii", $categoryId, $ordersPerPage, $offset);
$ordersQuery->execute();
$ordersResult = $ordersQuery->get_result();

$ordersHtml = '';
if ($totalOrders > 0) {
    while ($order = $ordersResult->fetch_assoc()) {
        $formattedDate = date("d.m.Y", strtotime($order['order_date']));
        $formattedTime = date("H:i", strtotime($order['order_time']));

        $ordersHtml .= "<div class='col-12 col-md-4 mb-4'>
        <div class='card shadow-sm h-100'>
            <img src='/{$order['image_path']}' class='card-img-top' alt='{$order['service_title']}' />
            <div class='card-body'>
                <h5 class='card-title'>Заказ: №{$order['order_id']}</h5>
                <p class='card-text'>
                    <strong>Услуга:</strong> {$order['service_title']}<br>
                    <strong>ФИО:</strong> {$order['surname']} {$order['user_name']} {$order['patronymic']}<br>
                    <strong>Телефон:</strong> {$order['phone_number']}<br>
                    <strong>Дата заказа:</strong><br> {$formattedDate}<br>
                    <strong>Время заказа:</strong><br> {$formattedTime}<br>
                    <strong>Статус:</strong>
                    <span id='status-{$order['order_id']}' class='text-success'>{$order['order_status']}</span>
                    <select id='status-select-{$order['order_id']}' class='form-control'>
                        <option value='Создан' " . ($order['order_status'] == 'Создан' ? 'selected' : '') . ">Создан</option>
                        <option value='Подтверждён' " . ($order['order_status'] == 'Подтверждён' ? 'selected' : '') . ">Подтверждён</option>
                        <option value='Отклонён' " . ($order['order_status'] == 'Отклонён' ? 'selected' : '') . ">Отклонён</option>
                    </select>
                    <button type='button' class='btn btn-primary mt-2 w-100 change-status' data-order-id='{$order['order_id']}' data-current-status='{$order['order_status']}'>Изменить статус</button>
                </p>
            </div>
        </div>
    </div>";
    }
} else {
    // Сообщение о том, что заказы отсутствуют
    $ordersHtml .= "<div class='col-12 text-center'>
                        <p class='text-danger'>В данной категории заказы отсутствуют.</p>
                    </div>";
}

// Генерация HTML для пагинации
$paginationHtml = '';
if ($totalPages > 1) {
    $paginationHtml .= "<nav>
                            <ul class='pagination justify-content-center'>";

    // Кнопка "Назад"
    if ($page > 1) {
        $paginationHtml .= "<li class='page-item'>
                                <a class='page-link' href='#' data-page='" . ($page - 1) . "' aria-label='Назад'>
                                    <span aria-hidden='true'>&laquo;</span>
                                </a>
                            </li>";
    }

    // Номера страниц
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $page) ? 'active' : '';
        $paginationHtml .= "<li class='page-item $activeClass'>
                                <a class='page-link' href='#' data-page='$i'>$i</a>
                            </li>";
    }

    // Кнопка "Вперед"
    if ($page < $totalPages) {
        $paginationHtml .= "<li class='page-item'>
                                <a class='page-link' href='#' data-page='" . ($page + 1) . "' aria-label='Вперед'>
                                    <span aria-hidden='true'>&raquo;</span>
                                </a>
                            </li>";
    }

    $paginationHtml .= "</ul>
                        </nav>";
}

// Возвращаем данные в формате JSON
echo json_encode(['ordersHtml' => $ordersHtml, 'paginationHtml' => $paginationHtml]);

// Закрытие подключения к базе данных
$conn->close();
