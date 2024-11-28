<!-- Модальное окно Семейные поздравления -->
<div class="modal fade" id="modal-5" tabindex="-1" aria-labelledby="familyGreetingModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="familyGreetingModalLabel">Выезд на дом</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="familyGreetingForm" action="backend/services/family.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="service_id" value="5"> <!-- ID услуги Семейные поздравления -->
               <!-- Скрытое поле для ID пользователя -->
               <input type="hidden" id="userId5" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phoneFamily" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phoneFamily" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>
               <!-- Поле Дата -->
               <div class="mb-3">
                  <label for="dateFamily" class="form-label">Дата</label>
                  <input type="date" class="form-control" id="dateFamily" name="date" autocomplete="date" required>
               </div>
               <!-- Поле Время -->
               <div class="mb-3">
                  <label for="timeFamily" class="form-label">Время</label>
                  <!-- Сообщение, если все время занято -->
                  <p id="timeMessageFamily" style="display:none; color: red;"></p>
                  <select class="form-select" id="timeFamily" name="time" required>
                     <option value="" selected disabled>Выберите время</option>
                  </select>
               </div>
               <!-- Поле Количество человек -->
               <div class="mb-3">
                  <label for="peopleCountFamily" class="form-label">Количество человек</label>
                  <div class="input-group">
                     <button type="button" class="btn btn-outline-secondary" id="minusButtonFamily">-</button>
                     <input type="number" class="form-control text-center" id="peopleCountFamily" name="peopleCount" value="1" min="1" max="30" readonly>
                     <button type="button" class="btn btn-outline-secondary" id="plusButtonFamily">+</button>
                  </div>
               </div>

               <!-- Выезд за город -->
               <div class="mb-3">
                  <label for="outOfTown" class="form-label">Выезд за город</label>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="outOfTown" name="outOfTown">
                     <label class="form-check-label" for="outOfTown">
                        Дополнительно +1500
                     </label>
                  </div>
               </div>

               <!-- Выезд на улицу -->
               <div class="mb-3">
                  <label for="streetEvent" class="form-label">Выезд на улицу</label>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="streetEvent" name="streetEvent">
                     <label class="form-check-label" for="streetEvent">
                        Дополнительно +1000
                     </label>
                  </div>
               </div>

               <!-- Итоговая цена -->
               <div class="mb-3">
                  <label for="totalPriceFamily" class="form-label">Итоговая цена</label>
                  <input type="text" class="form-control" id="totalPriceFamily" name="totalPrice" value="3300" readonly>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-100">Отправить</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>