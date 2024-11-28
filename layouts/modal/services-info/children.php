<!-- Модальное окно для услуги "Поздравления для детей" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Шапка -->
         <div class="modal-header bg-light border-0">
            <h5 class="modal-title text-center w-100" id="da-<?= $service['id'] ?>">Поздравления для детей</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>

         <!-- Основное содержимое -->
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_3.png" class="img-fluid mb-3 rounded" alt="Поздравления для детей">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Наши поздравления — это идеальный способ сделать новогодние праздники в детском саду или школе по-настоящему волшебными!
               Веселые конкурсы, захватывающие игры и подарки, подготовленные с любовью, подарят детям незабываемые эмоции и смех!
               Пусть каждый момент будет полон радости и сюрпризов!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности программы:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-gift text-danger me-2"></i> Подарки для каждого ребенка </li>
                  <li><i class="fas fa-smile-beam text-warning me-2"></i> Игры и конкурсы, которые развеселят всех детей </li>
                  <li><i class="fas fa-clock text-info me-2"></i> Гибкость по времени и месту проведения </li>
                  <li><i class="fas fa-users text-success me-2"></i> Подходит для детских садов и школ </li>
                  <li><i class="fas fa-heart text-danger me-2"></i> Специально адаптировано для детей любого возраста </li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-2">Цена: от 4000 р. / 1 час</p>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">Программа рассчитана на 1 час</p>
         </div>

         <!-- Кнопка "Закрыть" на всю ширину -->
         <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>