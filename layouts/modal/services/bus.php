<!-- Модальное окно Заказ автобуса -->
<div class="modal fade" id="modal-2" tabindex="-1" aria-labelledby="busOrderModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="busOrderModalLabel">Заказ автобуса</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="busOrderForm" action="backend/services/bus.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id2" value="2"> <!-- ID услуги Заказ автобуса -->
               <input type="hidden" id="userId2" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneBus" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneBus" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateBus" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateBus" name="date" autocomplete="date" required>
               </div>

               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeBus" class="form-label">Время</label>
                  <p id="timeMessageBus" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeBus" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>

               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountBus" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonBus">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountBus" name="peopleCount" value="1" min="1" max="50" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonBus">+</button>
                  </div>
                  <div id="remainingSeatsBus" class="text-danger mt-2" style="font-size: 14px;"></div> <!-- Секция для оставшихся мест -->
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceBus" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceBus" name="totalPrice" value="3500" readonly>
               </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>