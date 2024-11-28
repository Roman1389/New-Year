<!-- Модальное окно для услуги "Корпоративные поздравления" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>">Корпоративные поздравления</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_7.png" class="img-fluid mb-3 rounded" alt="Корпоративные поздравления">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Хотите сделать корпоративное мероприятие по-настоящему незабываемым? Наши Дед Мороз и Снегурочка подарят 
               вашему коллективу уникальные эмоции, весёлые поздравления и заряд новогоднего настроения! Мы готовы украсить 
               ваш офис или любую корпоративную площадку играми, конкурсами и индивидуальными поздравлениями для сотрудников. 
               Это идеальный способ объединить команду в праздничной атмосфере!
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-glass-cheers text-warning me-2"></i> Персональные поздравления для коллектива</li>
                  <li><i class="fas fa-microphone text-primary me-2"></i> Новогодние игры и конкурсы</li>
                  <li><i class="fas fa-clock text-secondary me-2"></i> Гибкий график по вашему расписанию</li>
                  <li><i class="fas fa-gift text-success me-2"></i> Подарки и сюрпризы для всех участников</li>
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