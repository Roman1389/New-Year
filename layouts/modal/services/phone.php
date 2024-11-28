<!-- Модальное окно Поздравление по телефону -->
<div class="modal fade" id="modal-12" tabindex="-1" aria-labelledby="phoneGreetingModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="phoneGreetingModalLabel">Поздравление по телефону</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="phoneGreetingForm" action="backend/services/phone.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="12"> <!-- ID услуги Поздравление по телефону -->
               <input type="hidden" id="userId12" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phonePhone" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phonePhone" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="datePhone" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="datePhone" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timePhone" class="form-label">Время</label>
                  <p id="timeMessagePhone" style="display:none; color: red;"></p>
                  <select class="form-select" id="timePhone" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountPhone" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonPhone">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountPhone" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonPhone">+</button>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPricePhone" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPricePhone" name="totalPrice" value="1000" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>