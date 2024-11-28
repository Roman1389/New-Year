<!-- Модальное окно Фотосессия -->
<div class="modal fade" id="modal-10" tabindex="-1" aria-labelledby="photoSessionModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="photoSessionModalLabel">Фотосессия</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="photoSessionForm" action="backend/services/photosession.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="10"> <!-- ID услуги Фотосессия -->
               <input type="hidden" id="userId10" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phonePhoto" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phonePhoto" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="datePhoto" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="datePhoto" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timePhoto" class="form-label">Время</label>
                  <p id="timeMessagePhoto" style="display:none; color: red;"></p>
                  <select class="form-select" id="timePhoto" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountPhoto" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonPhoto">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountPhoto" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonPhoto">+</button>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPricePhoto" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPricePhoto" name="totalPrice" value="4000" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>