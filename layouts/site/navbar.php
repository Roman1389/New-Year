<nav class="navbar navbar-expand-lg navbar-light bg-white my-navbar">
   <div class="container">
      <!-- Логотип -->
      <a class="navbar-brand logo" href="#" title="Логотип"></a>
      <!-- Мобильные кнопки или профиль пользователя -->
      <div class="d-lg-none">
         <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <!-- Профиль пользователя -->
            <div class="user-profile">
               <div class="dropdown">
                  <button class="btn dropdown-toggle d-flex align-items-center" id="userDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false">
                     <?php if (isset($_SESSION['user_avatar'])): ?>
                        <img src="/<?php echo htmlspecialchars($_SESSION['user_avatar']); ?>" alt="Avatar" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                     <?php endif; ?>
                     <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="userDropdownMobile">
                     <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <li><a class="dropdown-item" href="../../backend/admin/profile.php">Заявки</a></li>
                     <?php endif; ?>
                     <li><a class="dropdown-item" href="../../backend/user/profile.php">Мои записи</a></li>

                     <li><a class="dropdown-item" href="logout.php">Выход</a></li>
                  </ul>
               </div>
            </div>
         <?php else: ?>
            <!-- Кнопки для входа/регистрации -->
            <div class="auth-buttons">
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</button>
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginModal">Войти</button>
            </div>
         <?php endif; ?>
      </div>

      <!-- Бургер-меню для мобильных устройств -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
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
            <?php if (!isset($_SESSION['user_name'])): ?>
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</button>
               <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#loginModal">Войти</button>
            <?php endif; ?>
         </div>

         <!-- Кнопка "Позвонить" -->
         <div class="navbar-text">
            <a href="tel:+89108060033" class="btn btn-danger text-white me-2">
               <i class="fas fa-phone fa-flip-horizontal"></i> Позвонить
            </a>
         </div>

         <!-- Профиль пользователя (для ПК) -->
         <div class="navbar-text d-none d-lg-inline-block">
            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_surname'])): ?>
               <div class=" dropdown">
                  <button class="btn dropdown-toggle d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                     <?php if (isset($_SESSION['user_avatar'])): ?>
                        <img src="/<?php echo htmlspecialchars($_SESSION['user_avatar']); ?>" alt="Avatar" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                     <?php endif; ?>
                     <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="userDropdown">
                     <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <li><a class="dropdown-item" href="../../backend/admin/profile.php">Заявки</a></li>
                     <?php endif; ?>
                     <li><a class="dropdown-item" href="../../backend/user/profile.php">Мои записи</a></li>
                     <li><a class="dropdown-item" href="logout.php">Выход</a></li>
                  </ul>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</nav>

<!-- Подключение модальных окон -->
<?php include __DIR__ . '/../modal/auth/register.php'; ?>
<?php include __DIR__ . '/../modal/auth/login.php'; ?>