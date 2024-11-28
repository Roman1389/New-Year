<!-- Модальное окно для услуги "Онлайн поздравление" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">Онлайн поздравление</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_11.png" class="img-fluid mb-3 rounded" alt="Индивидуальное онлайн поздравление">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Сделайте Новый год по-настоящему волшебным! Онлайн поздравление от Деда Мороза и Снегурочки — это уникальная 
               возможность подарить вашему ребенку яркие эмоции и праздничное настроение, не выходя из дома.
               Персональный подход и теплые слова создадут атмосферу настоящего чуда!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-video text-primary me-2"></i> Индивидуальный сценарий поздравления</li>
                  <li><i class="fas fa-smile-beam text-success me-2"></i> Яркие эмоции и радость для детей</li>
                  <li><i class="fas fa-microphone-alt text-warning me-2"></i> Песни, стихи и интерактивные элементы</li>
                  <li><i class="fas fa-clock text-danger me-2"></i> Длительность: 15 минут</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: 2000 рублей</p>
         </div>

         <!-- Кнопка "Закрыть" -->
         <div class="modal-footer border-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>