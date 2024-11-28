<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Заказы</title>

   <!-- Подключение стилей -->
   <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
   <link rel="stylesheet" href="../../images/favicon/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" href="../../style/profile.css">
   <link rel="stylesheet" href="../../style/header.css">
   <link rel="stylesheet" href="../../style/navbar.css">
   <link rel="stylesheet" href="../../style/footer.css">
</head>

<body>

   <!-- Навигационная панель -->
   <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container d-flex align-items-center justify-content-between">
         <a class="navbar-brand d-flex align-items-center" href="#">
            <div class="logo-container">
               <img src="../../images/Logo/logo.png" alt="Логотип" class="logo-img">
            </div>
         </a>

         <div class="profile d-flex align-items-center d-lg-none">
            <img src="/<?php echo $userAvatar; ?>" alt="Аватар пользователя" class="rounded-circle me-2" width="40" height="40">
            <div class="profile-name text-nowrap">
               <?php echo $userName; ?>
            </div>
         </div>

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
               <li class="nav-item"><a class="nav-link" href="../../home.php">Главная</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">О нас</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">Особенности</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">Наши услуги</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">Галерея</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">Отзывы</a></li>
               <li class="nav-item"><a class="nav-link" href="../../home.php">Контакты</a></li>
            </ul>
            <div class="profile d-none d-lg-flex align-items-center">
               <img src="/<?php echo $userAvatar; ?>" alt="Аватар пользователя" class="rounded-circle me-2" width="40" height="40">
               <div class="profile-name">
                  <?php echo $userName; ?>
               </div>
            </div>
         </div>
      </div>
   </nav>

   <?php include('../../layouts/site/header.php'); ?>

   <section id="my-orders">
      <div class="container mb-5">
         <div class="d-flex justify-content-center">
            <div class="text-center mb-3">
               <h2 class="section-title mt-5">Заказы</h2>
            </div>
         </div>

         <!-- Табуляция -->
         <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <?php
            $isActive = true;
            if (!empty($categoriesArray)) {
               foreach ($categoriesArray as $categoryId => $categoryName) {
                  $activeClass = $isActive ? 'active' : '';
                  echo "<li class='nav-item' role='presentation'>
                           <button class='nav-link $activeClass' id='{$categoryName}-tab' data-bs-toggle='tab' data-bs-target='#category-$categoryId' type='button' role='tab' aria-controls='category-$categoryId' aria-selected='true' data-category-id='$categoryId'>
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

         <!-- Фильтрация -->
         <div class="row mt-4">
            <!-- Поиск -->
            <div class="col-12 col-md-6">
               <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="Поиск по названию услуги или ФИО" />
               </div>
            </div>

            <!-- Дата и кнопки для ПК -->
            <div class="col-12 col-md-6 mt-3 mt-md-0">
               <div class="input-group">
                  <input type="date" id="dateFilter" class="form-control" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" />
                  <button class="btn btn-success ms-2" id="applyDateFilter">Применить</button>
                  <button class="btn btn-danger ms-2" id="resetDateFilter">Сброс</button>
               </div>
            </div>
         </div>

         <!-- Содержимое заказов -->
         <div class="tab-content mt-4" id="orderTabsContent">
            <?php
            $isActive = true;
            if (!empty($categoriesArray)) {
               foreach ($categoriesArray as $categoryId => $categoryName) {
                  $activeClass = $isActive ? 'show active' : '';
                  echo "<div class='tab-pane fade $activeClass' id='category-$categoryId' role='tabpanel' aria-labelledby='{$categoryName}-tab' data-category-id='$categoryId'>
                            <div class='row' id='orders-list-$categoryId'>";

                  // Проверка наличия заказов
                  if (empty($ordersByCategory[$categoryId])) {
                     echo "<p class='text-center'>В данной категории заказы отсутствуют.</p>";
                  } else {
                     foreach ($ordersByCategory[$categoryId] as $order) {
                        $formattedDate = date("d.m.Y", strtotime($order['order_date']));
                        $formattedTime = date("H:i", strtotime($order['order_time']));
                        echo "<div class='col-12 col-md-4 mb-4'>
                                    <div class='card shadow-sm h-100'>
                                        <img src='/{$order['image_path']}' class='card-img-top' alt='{$order['service_title']}' />
                                        <div class='card-body'>
                                            <h5 class='card-title'>Заказ №{$order['order_id']}</h5>
                                            <p class='card-text'>
                                                <strong>Услуга:</strong> {$order['service_title']}<br>
                                                <strong>ФИО:</strong> {$order['surname']} {$order['user_name']} {$order['patronymic']}<br>
                                                <strong>Телефон:</strong> {$order['phone_number']}<br>
                                                <strong>Дата заказа:</strong><br> {$formattedDate}<br>
                                                <strong>Время заказа:</strong><br> {$formattedTime}<br>
                                                <strong>Статус:</strong> <span class='text-success' id='status-{$order['order_id']}'>{$order['order_status']}</span>
                                            </p>
                                            <div class='input-group mb-3'>
                                                <select class='form-select' id='status-select-{$order['order_id']}'>
                                                    <option value='Создан'>Создан</option>
                                                    <option value='Подтверждён'>Подтверждён</option>
                                                    <option value='Отклонён'>Отклонён</option>
                                                </select>
                                                <button class='btn btn-primary' id='update-status-{$order['order_id']}'>Изменить статус</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                     }
                  }
                  echo "</div>";
                  echo "<nav id='pagination-$categoryId' class='pagination-container'></nav>";
                  echo "<p id='noOrdersMessage-$categoryId' class='text-danger text-center mt-3' style='display: none;'>В выбранной категории на данную дату нет заказов.</p>";
                  echo "</div>";
                  $isActive = false;
               }
            } else {
               echo "<p class='text-center'>Нет заказов для отображения.</p>";
            }
            ?>
         </div>

         <div id="noResults" class="text-danger text-center mt-3" style="display: none;">Заказ не найден.</div>
      </div>
   </section>

   <?php include('../../layouts/user/footer.php'); ?>

   <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

   <script>
      document.addEventListener("DOMContentLoaded", function() {
         const searchInput = document.getElementById('search');
         const dateInput = document.getElementById('dateFilter');
         const applyDateFilterButton = document.getElementById('applyDateFilter');
         const resetDateFilterButton = document.getElementById('resetDateFilter');
         const noResultsMessage = document.getElementById('noResults');

         // Сохраняем исходные заказы для восстановления
         let originalOrders = [];

         searchInput.addEventListener('input', filterOrders);
         applyDateFilterButton.addEventListener('click', filterByDate);
         resetDateFilterButton.addEventListener('click', resetDateFilter);

         function filterOrders() {
            const searchQuery = searchInput.value.toLowerCase();
            const activeTab = document.querySelector('.tab-pane.show.active');
            const orders = activeTab.querySelectorAll('.card');
            const pagination = document.getElementById('pagination-' + activeTab.getAttribute('data-category-id'));

            if (searchQuery === '') {
               orders.forEach(order => {
                  order.style.display = 'block'; // Показываем все заказы
               });
               noResultsMessage.style.display = 'none'; // Скрываем сообщение
               pagination.style.display = 'block'; // Показываем пагинацию
               return;
            }

            let hasResults = false;

            orders.forEach(order => {
               const serviceTitle = order.querySelector('.card-title').textContent.toLowerCase();
               const fullName = order.querySelector('.card-text').textContent.toLowerCase();
               if (serviceTitle.includes(searchQuery) || fullName.includes(searchQuery)) {
                  order.style.display = 'block'; // Показываем заказ
                  hasResults = true;
               } else {
                  order.style.display = 'none'; // Скрываем заказ
               }
            });

            noResultsMessage.style.display = hasResults ? 'none' : 'block'; // Показываем или скрываем сообщение
            pagination.style.display = hasResults ? 'block' : 'none'; // Показываем или скрываем пагинацию
         }

         function filterByDate() {
            const selectedDate = dateInput.value.trim();
            const activeTab = document.querySelector('.tab-pane.show.active');
            const orders = activeTab.querySelectorAll('.card');
            const pagination = document.getElementById('pagination-' + activeTab.getAttribute('data-category-id'));
            let hasResults = false;

            orders.forEach(order => {
               const dateText = order.querySelector('.card-text').textContent;
               const dateMatch = dateText.match(/Дата заказа:\s*([0-9]{2})\.([0-9]{2})\.([0-9]{4})/);
               if (dateMatch) {
                  const [_, day, month, year] = dateMatch;
                  const formattedOrderDate = `${year}-${month}-${day}`;
                  if (selectedDate === formattedOrderDate) {
                     order.style.display = 'block';
                     hasResults = true;
                  } else {
                     order.style.display = 'none';
                  }
               }
            });

            const noOrdersMessage = document.getElementById('noOrdersMessage-' + activeTab.getAttribute('data-category-id'));
            noOrdersMessage.style.display = hasResults ? 'none' : 'block';
            pagination.style.display = hasResults ? 'block' : 'none';
         }

         function resetDateFilter() {
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;

            const activeTab = document.querySelector('.tab-pane.show.active');
            const orders = activeTab.querySelectorAll('.card');
            const pagination = document.getElementById('pagination-' + activeTab.getAttribute('data-category-id'));

            orders.forEach(order => {
               order.style.display = 'block';
            });

            const noOrdersMessage = document.getElementById('noOrdersMessage-' + activeTab.getAttribute('data-category-id'));
            if (noOrdersMessage) {
               noOrdersMessage.style.display = 'none';
            }

            pagination.style.display = 'block';
         }

         loadOrders(1, <?php echo json_encode(array_keys($categoriesArray)); ?>[0]);

         document.querySelectorAll('.nav-link').forEach(tab => {
            tab.addEventListener('click', function() {
               const categoryId = this.getAttribute('data-category-id');
               loadOrders(1, categoryId);
            });
         });

         function loadOrders(page, categoryId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'load_orders.php?page=' + page + '&category_id=' + categoryId, true);
            xhr.onload = function() {
               if (this.status === 200) {
                  const response = JSON.parse(this.responseText);
                  const ordersList = document.getElementById('orders-list-' + categoryId);
                  if (ordersList) {
                     ordersList.innerHTML = response.ordersHtml;
                     originalOrders = ordersList.querySelectorAll('.card');
                  }
                  const pagination = document.getElementById('pagination-' + categoryId);
                  if (pagination) {
                     pagination.innerHTML = response.paginationHtml;
                  }
                  attachStatusUpdateHandlers();
               } else {
                  console.error('Ошибка загрузки данных: ' + this.status);
               }
            };
            xhr.onerror = function() {
               console.error('Ошибка запроса');
            };
            xhr.send();
         }

         function attachStatusUpdateHandlers() {
            const statusButtons = document.querySelectorAll('.change-status');

            statusButtons.forEach(button => {
               button.addEventListener('click', function() {
                  const orderId = this.getAttribute('data-order-id');
                  const currentStatus = this.getAttribute('data-current-status');
                  const statusSelect = document.getElementById('status-select-' + orderId);
                  const newStatus = statusSelect ? statusSelect.value : currentStatus;

                  // Если текущий статус и новый статус одинаковые, ничего не делаем
                  if (currentStatus === newStatus) {
                     alert('Статус уже установлен на: ' + newStatus);
                     return;
                  }

                  const xhr = new XMLHttpRequest();
                  xhr.open('POST', 'update_order_status.php', true);
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onload = function() {
                     if (this.status === 200) {
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                           document.getElementById('status-' + orderId).textContent = newStatus;
                           document.getElementById('status-' + orderId).classList.remove('text-success', 'text-warning', 'text-danger');
                           if (newStatus === 'Создан') {
                              document.getElementById('status-' + orderId).classList.add('text-success');
                           } else if (newStatus === 'Подтверждён') {
                              document.getElementById('status-' + orderId).classList.add('text-warning');
                           } else if (newStatus === 'Отклонён') {
                              document.getElementById('status-' + orderId).classList.add('text-danger');
                           }

                           // Показать alert с сообщением об успешном изменении статуса
                           alert('Статус заказа успешно изменён на: ' + newStatus);
                        } else {
                           alert('Ошибка при обновлении статуса.');
                        }
                     }
                  };
                  xhr.onerror = function() {
                     alert('Ошибка запроса.');
                  };
                  xhr.send('order_id=' + orderId + '&status=' + encodeURIComponent(newStatus));
               });
            });
         }

         document.addEventListener('click', function(e) {
            if (e.target.classList.contains('page-link')) {
               e.preventDefault();
               const categoryId = e.target.closest('.tab-pane').getAttribute('data-category-id');
               const page = e.target.getAttribute('data-page');
               loadOrders(page, categoryId);
               window.scrollTo({
                  top: document.querySelector('#my-orders').offsetTop,
                  behavior: 'smooth'
               });
            }
         });
      });
   </script>

</body>

</html>