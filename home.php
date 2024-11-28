<?php
session_start();
include('connect.php');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Новогодняя программа</title>
   <!-- Favicon -->
   <link rel="icon" href="images/favicon/favicon.ico" type="image/x-icon">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
   <!-- CSS -->
   <link rel="stylesheet" href="style/style.css">
   <link rel="stylesheet" href="style/navbar.css">
   <link rel="stylesheet" href="style/header.css">
   <link rel="stylesheet" href="style/carousel.css">
   <link rel="stylesheet" href="style/footer.css">
   <link rel="stylesheet" href="style/popup.css">
   <link rel="stylesheet" href="style/desktop.css">
   <link rel="stylesheet" href="style/mobile.css">
</head>

<body>
   <!-- Navbar -->
   <?php include 'layouts/site/navbar.php'; ?>

   <!-- Header -->
   <?php include('layouts/site/header.php'); ?>

   <!-- О нас -->
   <?php include('layouts/site/about_us.php'); ?>

   <!-- Альбом -->
   <?php include('layouts/site/album.php'); ?>

   <!-- Наши особенности -->
   <?php include('layouts/site/features.php'); ?>

   <!-- Наши услуги -->
   <?php include('layouts/site/services.php'); ?>

   <!-- FAQ -->
   <?php include('layouts/site/FAQ.php'); ?>

   <!-- Галерея -->
   <?php include('layouts/site/gallery.php'); ?>

   <!-- Отзывы -->
   <?php include('layouts/site/reviews.php'); ?>

   <!-- Footer -->
   <?php include('layouts/site/footer.php'); ?>

   <!-- Всплывающее сообщение -->
   <?php include('layouts/site/popup.php'); ?>

   <!-- Подключение jQuery -->
   <script src="assets/jQuery/jquery-3.6.0.js"></script>

   <!-- Подключение Inputmask версии 5.0.6 -->
   <script src="assets/inputMask/jquery.inputmask.min.js"></script>

   <!-- Подключение Bootstrap с Popper.js -->
   <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Cкрипты -->
   <!-- Регистрация и авторизация -->
   <script src="/js/auth/registration.js"></script>
   <script src="/js/auth/login.js"></script>

   <!-- Техподдержка -->
   <script src="/js/site/script.js"></script>

   <!-- Пагинация на сайте у Галереи -->
   <script src="/js/site/paginate.js"></script>

   <!-- Услуги на сайте обработка форм услуг -->
   <!-- Моробус -->
   <script src="/js/services/morobus.js"></script>
   <!-- Автобус -->
   <script src="/js/services/bus.js"></script>
   <!-- Детские поздравления в детский сад и школу -->
   <script src="/js/services/children.js"></script>
   <!-- Аренда Аниматоров -->
   <script src="/js/services/animator.js"></script>
   <!-- Поздравление на дом -->
   <script src="/js/services/family.js"></script>
   <!-- Поздравление на улице, во дворе в ТСЖ -->
   <script src="/js/services/street.js"></script>
   <!-- Поздравление в офис или на корпоратив -->
   <script src="/js/services/office.js"></script>
   <!-- Поздравление в офис или на корпоратив -->
   <script src="/js/services/restaurant.js"></script>
   <!-- Случайная встреча -->
   <script src="/js/services/surprise.js"></script>
   <!-- Фотосессия -->
   <script src="/js/services/photosession.js"></script>
   <!-- Онлайн поздравление -->
   <script src="/js/services/online.js"></script>
   <!-- Поздравление по телефону -->
   <script src="/js/services/phone.js"></script>

   <!-- Быстрая заявка без регистрации -->
   <script src="/js/site/applications.js"></script>

   <!-- Быстрая заявка без регистрации -->
   <script src="/js/user/feedback.js"></script>
</body>

</html>