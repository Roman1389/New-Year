<!-- Модальное окно для аренды аниматора -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Шапка -->
         <div class="modal-header bg-light border-0">
            <h5 class="modal-title text-center w-100" id="da-<?= $service['id'] ?>">Аренда аниматора</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>

         <!-- Основное содержимое -->
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_4.png" class="img-fluid mb-3 rounded" alt="Аренда аниматора">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Профессиональные аниматоры создадут для вас незабываемую атмосферу веселья! Они умеют завоевывать внимание и 
               развлекать как детей, так и взрослых, используя яркие костюмы и увлекательные программы. Мы гарантируем, что 
               ваш праздник будет полон радости и смеха!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-star text-warning me-2"></i> Яркие костюмы и образы</li>
                  <li><i class="fas fa-guitar text-primary me-2"></i> Развлекательные программы</li>
                  <li><i class="fas fa-users text-success me-2"></i> Взаимодействие с детьми и взрослыми</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-2">Цена: от 5000 до 8000 р.</p>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">Цена зависит от количества аниматоров: 1 — 5000 р., 2 — 8000 р. Программа рассчитана на 1 час.</p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>