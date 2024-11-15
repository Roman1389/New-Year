<nav class="navbar navbar-expand-lg navbar-light bg-white my-navbar">
   <div class="container">
      <!-- Логотип -->
      <a class="navbar-brand p-0" href="#">
         <img src="images/Logo/logo.png" alt="Логотип">
      </a>

      <!-- Мобильные кнопки (только на мобильных экранах) -->
      <div class="auth-buttons d-lg-none">
         <?php if (!isset($_SESSION['logged_in'])): ?>
            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</button>
            <button class="btn btn-outline-danger">Войти</button>
         <?php endif; ?>
      </div>

      <!-- Бургер-меню для мобильных устройств -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
         aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
         <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Меню и кнопки -->
      <div class="collapse navbar-collapse" id="navbarNav">
         <!-- Пункты меню -->
         <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="#">Главная</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">О нас</a></li>
            <li class="nav-item"><a class="nav-link" href="#features">Особенности</a></li>
            <li class="nav-item"><a class="nav-link" href="#services">Наши услуги</a></li>
            <li class="nav-item"><a class="nav-link" href="#gallery">Галерея</a></li>
            <li class="nav-item"><a class="nav-link" href="#reviews">Отзывы</a></li>
            <li class="nav-item"><a class="nav-link" href="#contacts">Контакты</a></li>
         </ul>

         <!-- Десктопные кнопки (только на больших экранах) -->
         <div class="auth-buttons d-none d-lg-flex align-items-center">
            <?php if (!isset($_SESSION['logged_in'])): ?>
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</button>
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginModal">Войти</button>
            <?php endif; ?>
         </div>

         <div class="navbar-text pl-0 d-lg-inline-block">
            <?php
               session_start(); // Начинаем сессию
               if (isset($_SESSION['photo_path'])) {
                   // Отображаем аватар, если он загружен
                   echo '<img src="' . $_SESSION['photo_path'] . '" alt="Аватар" class="rounded-circle" style="width: 40px; height: 40px;">';
               }
            ?>
            <a href="tel:+1234567890" class="btn btn-danger text-white">
               <i class="fas fa-phone fa-flip-horizontal"></i> Позвонить
            </a>
         </div>
      </div>
   </div>
</nav>

   <!-- Модальное окно для формы регистрации -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <!-- Форма регистрации -->
            <form action="register.php" method="POST" enctype="multipart/form-data">
               <div class="mb-3">
                  <label for="name" class="form-label">Имя</label>
                  <input type="text" class="form-control" id="name" name="name" required>
               </div>
               <div class="mb-3">
                  <label for="surname" class="form-label">Фамилия</label>
                  <input type="text" class="form-control" id="surname" name="surname" required>
               </div>
               <div class="mb-3">
                  <label for="patronymic" class="form-label">Отчество</label>
                  <input type="text" class="form-control" id="patronymic" name="patronymic">
               </div>
               <div class="mb-3">
                  <label for="photo" class="form-label">Фото</label>
                  <input type="file" class="form-control" id="photo" name="photo">
               </div>
               <div class="mb-3">
                  <label for="phone_number" class="form-label">Номер телефона</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" required>
               </div>
               <div class="mb-3">
                  <label for="login" class="form-label">Логин</label>
                  <input type="text" class="form-control" id="login" name="login" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Пароль</label>
                  <input type="password" class="form-control" id="password" name="password" required>
               </div>
               <div class="mb-3">
                  <label for="confirm_password" class="form-label">Подтвердите пароль</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
               </div>
               <button type="submit" class="btn btn-danger">Зарегистрироваться</button>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Модальное окно для входа -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Вход</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>