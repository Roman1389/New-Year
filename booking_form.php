<?php
// booking_form.php

// Начало сессии, если требуется авторизация
session_start();

// Проверка авторизации пользователя (добавьте свою логику)
if (!isset($_SESSION['user_id'])) {
    echo "Пожалуйста, войдите в систему, чтобы продолжить бронирование.";
    exit;
}

// Получение данных об услуге (можно передавать в URL или через POST)
$service_name = isset($_GET['service']) ? htmlspecialchars($_GET['service']) : 'Услуга';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование - <?php echo $service_name; ?></title>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Бронирование услуги: <?php echo $service_name; ?></h2>
        <form action="process_booking.php" method="post">
            <input type="hidden" name="service_name" value="<?php echo $service_name; ?>">
            <div class="mb-3">
                <label for="date" class="form-label">Дата бронирования</label>
                <input type="date" id="date" name="booking_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Время бронирования</label>
                <select id="time" name="booking_time" class="form-control" required>
                    <?php
                    // Генерация времени с интервалом в 1 час с 9 до 23
                    for ($hour = 9; $hour <= 23; $hour++) {
                        $time = sprintf("%02d:00", $hour);
                        echo "<option value=\"$time\">$time</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Подтвердить бронирование</button>
        </form>
    </div>
</body>
</html>