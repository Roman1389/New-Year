<!-- Модальное окно для услуги -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header border-0">
            <h5 class="modal-title" id="da-<?= $service['id'] ?>" style="font-size: 1.5rem;"><?= $service['title'] ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>

         <div class="modal-body">
            <input type="hidden" name="service_id" value="<?= $service['id'] ?>">

            <!-- Фото -->
            <img src="images/Sliders/slide_5.png" class="img-fluid mb-3 rounded" alt="Morobus">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Погрузитесь в настоящую сказку вместе с Дедом Морозом и Снегурочкой! Мы создадим
               волшебную атмосферу для детей и взрослых: проведем веселые игры, зажигательные конкурсы и порадуем всех приятными сюрпризами.
               Незабываемые эмоции, яркие фотографии и новогоднее настроение гарантированы! Дед Мороз с
               радостью вручит подготовленные вами подарки, расскажет сказочные истории, а Снегурочка поможет с танцами и песнями,
               чтобы сделать ваш праздник особенным.
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-snowman text-primary me-2"></i> Интерактивные игры и конкурсы для детей и взрослых</li>
                  <li><i class="fas fa-music text-danger me-2"></i> Новогодняя музыкальная программа</li>
                  <li><i class="fas fa-gift text-success me-2"></i> Подарки и сюрпризы для участников</li>
                  <li><i class="fas fa-smile text-warning me-2"></i> Веселая и теплая атмосфера</li>
               </ul>
            </div>

            <!-- Основная цена -->
            <p class="h5 text-danger mb-3">
               Цена: 3300 рублей
            </p>

            <!-- Внимание (текст без прямоугольника) -->
            <p class="text-danger">
               <strong>Внимание!</strong><br>
               На данную услугу будут повышены цены с 30 декабря с 17:00!!!
            </p>

            <!-- Дополнительная информация -->
            <div class="mb-3">
               <p class="text-danger"><strong>Дополнительно:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-map-marker-alt text-danger me-2"></i> Выезд за город — плюс 1500 рублей</li>
                  <li><i class="fas fa-sun text-danger me-2"></i> Проведение на улице — плюс 1000 рублей</li>
               </ul>
            </div>

            <!-- Информация о времени программы -->
            <p class="text-muted mb-3" style="font-size: 0.9rem;">
               Программа рассчитана на 20 минут, что позволяет оптимально сочетать развлечения и сюрпризы в компактном формате.
            </p>
         </div>
         <div class="modal-footer border-0">
            <!-- Кнопка "Закрыть" на всю ширину -->
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>