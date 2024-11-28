<?php
// Подключение к базе данных
include_once __DIR__ . '/../../connect.php'; // Путь к файлу connect.php

// Начало сессии
session_start();

// Получение категорий
$categoriesResult = $conn->query("SELECT * FROM categories");

// Проверка на ошибки выполнения запроса
if (!$categoriesResult) {
   die("Ошибка выполнения запроса к базе данных: " . $conn->error);
}

$categoriesArray = [];
while ($category = $categoriesResult->fetch_assoc()) {
   $categoriesArray[$category['id']] = $category['name'];
}

// Получение услуг и группировка по категориям
$servicesResult = $conn->query("SELECT * FROM services");

// Проверка на ошибки выполнения запроса
if (!$servicesResult) {
   die("Ошибка выполнения запроса к базе данных: " . $conn->error);
}

$servicesByCategory = [];
while ($service = $servicesResult->fetch_assoc()) {
   $servicesByCategory[$service['category_id']][] = $service;
}
?>

<section id="services">
   <div class="container mb-5">
      <div class="d-flex justify-content-center">
         <div class="text-center mb-3">
            <h2 class="section-title">Наши услуги</h2>
         </div>
      </div>
      <ul class="nav nav-tabs" id="serviceTabs" role="tablist">
         <?php
         $isActive = true;
         // Проверка на пустоту массива категорий
         if (!empty($categoriesArray)) {
            foreach ($categoriesArray as $categoryId => $categoryName) {
               $activeClass = $isActive ? 'active' : '';
               echo "<li class='nav-item' role='presentation'>
                            <button class='nav-link $activeClass' id='{$categoryName}-tab' data-bs-toggle='tab' data-bs-target='#category-$categoryId' type='button' role='tab' aria-controls='category-$categoryId' aria-selected='true'>
                                {$categoryName}
                            </button>
                          </li>";
               $isActive = false;
            }
         } else {
            echo "<p class='text-center'>Нет категорий для отображения.</p>";
         }
         ?>
      </ul>
      <div class="tab-content mt-4" id="serviceTabsContent">
         <?php
         $isActive = true;
         // Проверка на пустоту массива категорий
         if (!empty($categoriesArray)) {
            foreach ($categoriesArray as $categoryId => $categoryName) {
               $activeClass = $isActive ? 'show active' : '';
               echo "<div class='tab-pane fade $activeClass' id='category-$categoryId' role='tabpanel' aria-labelledby='{$categoryName}-tab'>
                            <div class='row'>";

               // Проверка наличия услуг в категории
               if (!empty($servicesByCategory[$categoryId])) {
                  foreach ($servicesByCategory[$categoryId] as $service) {
                     echo "<div class='col-12 col-md-6 mb-4'>
                                    <div class='card shadow-sm h-100'>
                                        <img src='{$service['image_path']}' class='card-img-top' alt='{$service['title']}'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>{$service['title']}</h5>
                                            <p class='card-text'>{$service['description']}</p>
                                            <div class='d-flex justify-content-between align-items-center mt-3'>
                                                <!-- Цена слева -->
                                                <span class='text-danger fw-bold'>{$service['price']}</span>
                                                
                                                <!-- Кнопки справа -->
                                                <div class='d-flex'>";

                     // Кнопка для открытия модального окна с описанием услуги
                     echo "<button class='btn btn-info ms-2 text-white' data-bs-toggle='modal' data-bs-target='#infoModal-{$service['id']}'>Подробнее</button>";

                     // Проверка авторизации
                     if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        // Пользователь авторизован
                        echo "<button class='btn btn-danger ms-2' data-bs-toggle='modal' data-bs-target='#modal-{$service['id']}'>Заказать</button>";
                     } else {
                        // Пользователь не авторизован
                        echo "<a href='#loginModal' class='btn btn-danger ms-2' data-bs-toggle='modal'>Войти</a>";
                     }

                     echo "</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";

                     // Подключение внешнего модального окна для формы заказа
                     if ($service['id'] == 1) {
                        include __DIR__ . '/../modal/services/morobus.php';
                     }
                     if ($service['id'] == 2) {
                        include __DIR__ . '/../modal/services/bus.php';
                     }
                     if ($service['id'] == 3) {
                        include __DIR__ . '/../modal/services/children.php';
                     }
                     if ($service['id'] == 4) {
                        include __DIR__ . '/../modal/services/animator.php';
                     }
                     if ($service['id'] == 5) {
                        include __DIR__ . '/../modal/services/family.php';
                     }
                     if ($service['id'] == 6) {
                        include __DIR__ . '/../modal/services/street.php';
                     }
                     if ($service['id'] == 7) {
                        include __DIR__ . '/../modal/services/office.php';
                     }
                     if ($service['id'] == 8) {
                        include __DIR__ . '/../modal/services/restaurant.php';
                     }
                     if ($service['id'] == 9) {
                        include __DIR__ . '/../modal/services/surprise.php';
                     }
                     if ($service['id'] == 10) {
                        include __DIR__ . '/../modal/services/photosession.php';
                     }
                     if ($service['id'] == 11) {
                        include __DIR__ . '/../modal/services/online.php';
                     }
                     if ($service['id'] == 12) {
                        include __DIR__ . '/../modal/services/phone.php';
                     }

                     // Подключение внешних модальных окон для просмотра описания

                     if ($service['id'] == 1) {
                        include __DIR__ . '/../modal/services-info/morobus.php';
                     }
                     if ($service['id'] == 2) {
                        include __DIR__ . '/../modal/services-info/bus.php';
                     }
                     if ($service['id'] == 3) {
                        include __DIR__ . '/../modal/services-info/children.php';
                     }
                     if ($service['id'] == 4) {
                        include __DIR__ . '/../modal/services-info/animator.php';
                     }
                     if ($service['id'] == 5) {
                        include __DIR__ . '/../modal/services-info/family.php';
                     }
                     if ($service['id'] == 6) {
                        include __DIR__ . '/../modal/services-info/street.php';
                     }
                     if ($service['id'] == 7) {
                        include __DIR__ . '/../modal/services-info/office.php';
                     }
                     if ($service['id'] == 8) {
                        include __DIR__ . '/../modal/services-info/restaurant.php';
                     }
                     if ($service['id'] == 9) {
                        include __DIR__ . '/../modal/services-info/surprise.php';
                     }
                     if ($service['id'] == 10) {
                        include __DIR__ . '/../modal/services-info/photosession.php';
                     }
                     if ($service['id'] == 11) {
                        include __DIR__ . '/../modal/services-info/online.php';
                     }
                     if ($service['id'] == 12) {
                        include __DIR__ . '/../modal/services-info/phone.php';
                     }
                  }
               } else {
                  echo "<p class='text-center'>Нет услуг в этой категории.</p>";
               }
               echo "</div></div>";
               $isActive = false;
            }
         } else {
            echo "<p class='text-center'>Нет категорий для отображения.</p>";
         }
         ?>
      </div>
   </div>
</section>

<?php
// Закрытие подключения к базе данных
$conn->close();
?>