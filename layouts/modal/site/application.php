<!-- Модальное окно заявки -->
<div class="modal fade" id="quickRequestModal" tabindex="-1" aria-labelledby="quickRequestModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="quickRequestModalLabel">Оставьте заявку</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="quickRequestForm" action="backend/site/applications.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <!-- Поле ФИО -->
               <div class="mb-3">
                  <label for="fullName" class="form-label">ФИО</label>
                  <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Введите ваше ФИО" required>
                  <small class="error-message" id="errorFullName"></small>
                  <small class="error-message" id="errorCyrillic"></small>
               </div>

               <!-- Поле Услуга -->
               <div class="mb-3">
                  <label for="service" class="form-label">Услуга</label>
                  <select class="form-select" id="service" name="service" required>
                  </select>
               </div>

               <!-- Поле Номер телефона -->
               <div class="mb-3">
                  <label for="phone" class="form-label">Номер телефона</label>
                  <input type="tel" class="form-control" id="phone-applications" name="phone" placeholder="Введите номер телефона" autocomplete="tel" required>
               </div>

               <!-- Поле Сообщение -->
               <div class="mb-3">
                  <label for="message" class="form-label">Сообщение</label>
                  <textarea class="form-control" id="message-applications" name="message" rows="3" required></textarea>
                  <small class="error-message" id="errorMessage"></small>
               </div>

               <button type="submit" class="btn btn-danger w-100">Отправить заявку</button>
            </form>
         </div>
      </div>
   </div>
</div>