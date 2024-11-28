<!-- Модальное окно для услуги -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Шапка с названием услуги -->
         <div class="modal-header bg-light border-0">
            <h5 class="modal-title text-center w-100" id="da-<?= $service['id'] ?>">
               <?= $service['title'] ?>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_1.png" class="img-fluid mb-3 rounded" alt="Morobus">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Представьте себе волшебный автобус, где оживает настоящая зимняя сказка. В уютной атмосфере "Моробуса" Дед Мороз и
               Снегурочка приглашают вас в захватывающее путешествие с играми, музыкой и невероятными сюрпризами.
               Каждая остановка превращается в праздник, а сани, полные подарков, готовы порадовать каждого гостя.
               Это место, где мечты становятся реальностью, а волшебство — частью каждого мгновения!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-gift text-danger me-2"></i> Интерактивные игры и конкурсы</li>
                  <li><i class="fas fa-music text-primary me-2"></i> Новогодняя музыкальная программа</li>
                  <li><i class="fas fa-box-open text-warning me-2"></i> Подарки для всех участников</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-2">Цена: 3500 рублей за 1 билет</p>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">Программа рассчитана на час</p>
         </div>
         <div class="modal-footer border-0 pt-0">
            <!-- Кнопка "Закрыть" -->
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>