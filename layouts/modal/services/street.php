<!-- Модальное окно Заказать на улицу, во двор, в ТСЖ -->
<div class="modal fade" id="modal-6" tabindex="-1" aria-labelledby="streetServiceModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="streetServiceModalLabel">Заказать на улицу, во двор, в ТСЖ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="streetServiceForm" action="backend/services/street.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="6"> <!-- ID услуги Заказать на улицу, во двор, в ТСЖ -->
               <!-- Скрытое поле для ID пользователя -->
               <input type="hidden" id="userId6" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneStreet" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneStreet" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateStreet" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateStreet" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeStreet" class="form-label">Время</label>
                  <p id="timeMessageStreet" style=" display:none; color: red;"></p>
                  <select class="form-select" id="timeStreet" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountStreet" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonStreet">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountStreet" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonStreet">+</button>
                  </div>
               </div>
               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceStreet" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceStreet" name="totalPrice" value="5000" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>