<!-- Модальное окно Моробус -->
<div class="modal fade" id="modal-1" tabindex="-1" aria-labelledby="morobusModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="morobusModalLabel">Заказать Моробус</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="morobusForm" action="backend/services/morobus.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="1"> <!-- Замените 1 на нужный ID услуги -->
               <!-- Поле ФИО -->
               <!-- Скрытое поле для ID пользователя -->
               <input type="hidden" id="userId" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phone" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="date" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="date" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="time" class="form-label">Время</label>
                  <p id="timeMessageMorobus" style="display:none; color: red;"></p>
                  <select class="form-select" id="time" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCount" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButton">-</button>
                     <input type="number" class="form-control text-center" id="peopleCount" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButton">+</button>
                  </div>
                  <div id="remainingSeats" class="text-danger mt-2" style="font-size: 14px;"></div> <!-- Секция для оставшихся мест -->
               </div>
               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPrice" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPrice" name="totalPrice" value="3500" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>