<!-- Модальное окно для услуги "На улицу, во двор, ТСЖ" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">На улицу, во двор, ТСЖ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_6.png" class="img-fluid mb-3 rounded" alt="Поздравление на улице">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Волшебный праздник с Дедом Морозом и Снегурочкой прямо на улице или во дворе! Мы создадим яркую атмосферу, которая 
               объединит жителей вашего дома или ТСЖ. В программе: песни, танцы, забавные игры и поздравления для всех — от малышей до 
               взрослых. Это идеальный способ сделать ваш двор настоящим новогодним островком счастья и веселья!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-snowman text-primary me-2"></i> Поздравления от Деда Мороза и Снегурочки</li>
                  <li><i class="fas fa-music text-danger me-2"></i> Музыкальное сопровождение и танцы</li>
                  <li><i class="fas fa-gift text-success me-2"></i> Подарки и сюрпризы для участников</li>
                  <li><i class="fas fa-star text-warning me-2"></i> Новогодняя атмосфера и декорации</li>
                  <li><i class="fas fa-users text-secondary me-2"></i> Участие всех жителей</li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-3">Цена: от 5000 рублей за 30 минут</p>

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