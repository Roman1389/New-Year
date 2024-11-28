<!-- Модальное окно для услуги "В кафе или ресторан" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">В кафе или ресторан</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_8.png" class="img-fluid mb-3 rounded" alt="В кафе или ресторан">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Хотите удивить гостей вашего кафе или ресторана? Дед Мороз и Снегурочка превратят ваше заведение в центр 
               новогоднего волшебства. Уникальная программа с конкурсами, играми и поздравлениями подарит вашим гостям море радости и 
               веселья. Мы сделаем ваш вечер незабываемым, создадим праздничную атмосферу и сделаем праздник ярче!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-crown text-warning me-2"></i> Индивидуальный сценарий для вашего заведения</li>
                  <li><i class="fas fa-users text-primary me-2"></i> Подходит для любых компаний и возрастов</li>
                  <li><i class="fas fa-gift text-success me-2"></i> Праздничное настроение и сюрпризы для гостей</li>
                  <li><i class="fas fa-music text-danger me-2"></i> Тематическая музыкальная программа</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: от 5000 рублей за 1 час</p>

            <!-- Информация о времени программы -->
            <p class="text-muted mb-3" style="font-size: 0.85rem;">
               Программа рассчитана на 1 час.
            </p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>
