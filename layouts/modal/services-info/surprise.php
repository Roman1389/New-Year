<!-- Модальное окно для услуги "Случайная встреча" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">Случайная встреча</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_9.png" class="img-fluid mb-3 rounded" alt="Неожиданная встреча">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Хотите удивить своих близких? Дед Мороз и Снегурочка появятся в неожиданных местах, чтобы создать незабываемую
               атмосферу волшебства. Удивление и радость гарантированы!
               Это может быть парк, супермаркет, офис, подъезд или даже прогулка по улице. Мы подстроимся под ваше желание и
               сделаем момент ярким и незабываемым.
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-surprise text-warning me-2"></i> Неожиданное появление для максимального эффекта</li>
                  <li><i class="fas fa-user-check text-primary me-2"></i> Индивидуальный подход к сценарию</li>
                  <li><i class="fas fa-camera text-danger me-2"></i> Видеосъемка сюрприза в подарок</li>
                  <li><i class="fas fa-heart text-success me-2"></i> Незабываемые эмоции для вас и ваших близких</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: 5500 рублей за 30 минут</p>

            <!-- Информация о времени программы -->
            <p class="text-muted mb-3" style="font-size: 0.85rem;">
               Программа рассчитана на 30 минут.
            </p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>