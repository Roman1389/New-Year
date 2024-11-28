<!-- Модальное окно Поздравления в офисе или на корпоративе -->
<div class="modal fade" id="modal-7" tabindex="-1" aria-labelledby="officeGreetingModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="officeGreetingModalLabel">Поздравления в офисе или на корпоративе</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="officeGreetingForm" action="backend/services/office.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="7"> <!-- ID услуги Поздравления в офисе или на корпоративе -->
               <input type="hidden" id="userId7" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneOffice" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneOffice" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateOffice" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateOffice" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeOffice" class="form-label">Время</label>
                  <p id="timeMessageOffice" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeOffice" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountOffice" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonOffice">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountOffice" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonOffice">+</button>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceOffice" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceOffice" name="totalPrice" value="5000" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>