<!-- Модальное окно Поздравление для детей -->
<div class="modal fade" id="modal-3" tabindex="-1" aria-labelledby="childrenGreetingModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="childrenGreetingModalLabel">Поздравление для детей</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="childrenGreetingForm" action="backend/services/children.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="3"> <!-- ID услуги Поздравление для детей -->
               <!-- Скрытое поле для ID пользователя -->
               <input type="hidden" id="userId3" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneChildren" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneChildren" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateChildren" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateChildren" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeChildren" class="form-label">Время</label>
                  <p id="timeMessageChildren" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeChildren" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountChildren" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonChildren">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountChildren" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonChildren">+</button>
                  </div>
               </div>
               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceChildren" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceChildren" name="totalPrice" value="4000" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>