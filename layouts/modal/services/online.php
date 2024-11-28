<!-- Модальное окно Онлайн поздравление -->
<div class="modal fade" id="modal-11" tabindex="-1" aria-labelledby="onlineGreetingModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="onlineGreetingModalLabel">Онлайн поздравление</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="onlineGreetingForm" action="backend/services/onlinegreeting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="11"> <!-- ID услуги Онлайн поздравление -->
               <input type="hidden" id="userId11" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneOnline" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneOnline" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateOnline" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateOnline" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeOnline" class="form-label">Время</label>
                  <p id="timeMessageOnline" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeOnline" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountOnline" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonOnline">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountOnline" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonOnline">+</button>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceOnline" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceOnline" name="totalPrice" value="2000" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>