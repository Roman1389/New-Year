<!-- Модальное окно Аренда аниматоров -->
<div class="modal fade" id="modal-4" tabindex="-1" aria-labelledby="animatorRentalModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="animatorRentalModalLabel">Аренда аниматоров</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="animatorRentalForm" action="backend/services/animator.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="4"> <!-- ID услуги Аренда аниматоров -->
               <!-- Скрытое поле для ID пользователя -->
               <input type="hidden" id="userId4" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneAnimator" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneAnimator" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateAnimator" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateAnimator" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeAnimator" class="form-label">Время</label>
                  <!-- Сообщение, если все время занято -->
                  <p id="timeMessage" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeAnimator" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountAnimator" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonAnimator">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountAnimator" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonAnimator">+</button>
                  </div>
               </div>
               <!-- Поле Персонажи -->
               <div class="mb-3">
                  <label for="animatorCharacter" class="form-label">Выберите персонажа</label>
                  <select class="form-select" id="animatorCharacter" name="animatorCharacter">
                     <option value="" selected disabled>Выберите персонажа</option>
                     <option value="dedMoroz">Дед Мороз</option>
                     <option value="snegurochka">Снегурочка</option>
                     <option value="both">Дед Мороз и Снегурочка</option>
                  </select>
               </div>
               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceAnimator" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceAnimator" name="totalPrice" value="5000" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>