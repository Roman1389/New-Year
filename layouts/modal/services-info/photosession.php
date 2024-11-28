<!-- Модальное окно для услуги "Фотосессия" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">Фотосессия</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_10.png" class="img-fluid mb-3 rounded" alt="Фотосессия">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Сохраните лучшие моменты вашего праздника в профессиональных фотографиях! Мы создадим для вас яркие, эмоциональные и 
               качественные снимки. Дед Мороз и Снегурочка станут частью съемки, добавив волшебства каждому кадру.
               Индивидуальный подход и творческое видение гарантируют, что фотографии станут настоящей частью новогоднего чуда.
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-camera-retro text-primary me-2"></i> Работа профессионального фотографа</li>
                  <li><i class="fas fa-images text-success me-2"></i> Постановочные и репортажные кадры</li>
                  <li><i class="fas fa-magic text-warning me-2"></i> Волшебная атмосфера на снимках</li>
                  <li><i class="fas fa-edit text-danger me-2"></i> Обработка и ретушь лучших фотографий</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: 4000 рублей за 1 час</p>

            <!-- Информация о продолжительности -->
            <p class="text-muted mb-3" style="font-size: 0.85rem;">
               Услуга рассчитана на 1 час фотосъемки.
            </p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>
