<!-- Модальное окно для услуги "Поздравление по телефону" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">Поздравление по телефону</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_12.png" class="img-fluid mb-3 rounded" alt="Поздравление по телефону">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Подарите своему ребенку незабываемый новогодний сюрприз! Дед Мороз лично позвонит, поздравит с Новым годом и 
               расскажет волшебную историю. Это идеальный способ подарить радость и создать праздничное настроение.
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-phone-alt text-primary me-2"></i> Персональное поздравление от Деда Мороза</li>
                  <li><i class="fas fa-smile text-success me-2"></i> Теплые слова и волшебные пожелания</li>
                  <li><i class="fas fa-star text-warning me-2"></i> Незабываемая атмосфера праздника</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: 1000 рублей</p>

            <!-- Длительность -->
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Поздравление длится 10 минут.</p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>