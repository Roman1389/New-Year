<!-- Модальное окно Сюрприз -->
<div class="modal fade" id="modal-9" tabindex="-1" aria-labelledby="surpriseModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="surpriseModalLabel">Случайная встреча сюрприз</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="surpriseForm" action="backend/services/surprise.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="9"> <!-- ID услуги Сюрприз -->
               <input type="hidden" id="surpriseUserId" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>"> <!-- ID пользователя -->
               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneSurprise" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneSurprise" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateSurprise" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateSurprise" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeSurprise" class="form-label">Время</label>
                  <p id="timeMessageSurprise" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeSurprise" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountSurprise" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonSurprise">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountSurprise" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonSurprise">+</button>
                  </div>
               </div>
               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceSurprise" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceSurprise" name="totalPrice" value="5500" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>