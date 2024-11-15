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

   <!--Bootstrap-->
   <!--Bootstrap CSS-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <!--Font Awesome-->
   <!-- Font Awesome для иконок -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   <!--CSS-->
   <!-- Основной стиль сайта -->
   <link rel="stylesheet" href="style/style.css">
   <!-- Стиль для панели навигации -->
   <link rel="stylesheet" href="style/navbar.css">
   <!-- Стиль для шапки страницы -->
   <link rel="stylesheet" href="style/header.css">
   <!-- Стиль для карусели изображений -->
   <link rel="stylesheet" href="style/carousel.css">
   <!-- Стиль для подвала сайта -->
   <link rel="stylesheet" href="style/footer.css">
   <!-- Стиль для всплывающих окон -->
   <link rel="stylesheet" href="style/popup.css">

   <!--Адаптация-->
   <!--Пк адаптация-->
   <link rel="stylesheet" href="style/desktop.css">
   <!--Мобильная адаптация-->
   <link rel="stylesheet" href="style/mobile.css">
</head>

<body>
   <!--! Шапка сайта -->
   <!-- Навбар -->
   <?php include('navbar.php'); ?>

   <!-- Шапка с фоновым изображением -->
   <?php include('header.php'); ?>

   <!--! Раздел сайта о нас-->

   <?php include('about_us.php'); ?>

   <!-- Раздел сайта Наши Особенности-->
   <?php include('features.php'); ?>


   <!--! Блок наши услуги-->

   <!-- Раздел "Наши услуги" -->
   <?php include('services.php'); ?>

   <!-- Галерея -->
   <?php include('gallery.php'); ?>

   <!-- Отзывы-->
   <?php include('reviews.php'); ?>

   <!--Подвал-->
   <?php include('footer.php'); ?>

   <!-- Всплывающее сообщение -->
   <?php include('popup.php'); ?>


   <!-- Подключите jQuery и Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

   <!-- Подключение Bootstrap js-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- Подключение папки js-->
   <!-- Подключение папки js-->
   <script src="/js/script.js"></script>

</body>

</html>