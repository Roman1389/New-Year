<!-- Модальное окно Кафе или ресторан -->
<div class="modal fade" id="modal-8" tabindex="-1" aria-labelledby="restaurantServiceModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="restaurantServiceModalLabel">Кафе или ресторан</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="restaurantServiceForm" action="backend/services/restaurant.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="8"> <!-- ID услуги Кафе или ресторан -->
               <input type="hidden" id="userId8" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneRestaurant" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneRestaurant" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateRestaurant" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateRestaurant" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeRestaurant" class="form-label">Время</label>
                  <p id="timeMessageRestaurant" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeRestaurant" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountRestaurant" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonRestaurant">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountRestaurant" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonRestaurant">+</button>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceRestaurant" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceRestaurant" name="totalPrice" value="5000" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>