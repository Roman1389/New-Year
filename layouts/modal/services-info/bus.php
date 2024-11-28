<!-- Модальное окно для услуги "Поющий автобус" -->
<div class="modal fade" id="infoModal-<?= $service['id'] ?>" tabindex="-1" aria-labelledby="da-<?= $service['id'] ?>" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Шапка -->
         <div class="modal-header bg-light border-0">
            <h5 class="modal-title text-center w-100" id="da-<?= $service['id'] ?>">Поющий автобус</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>

         <!-- Основное содержимое -->
         <div class="modal-body">
            <!-- Фото -->
            <img src="images/Sliders/slide_2.png" class="img-fluid mb-3 rounded" alt="Поющий автобус">

            <!-- Описание -->
            <p class="text-justify text-muted mb-4" style="font-size: 1.1rem;">
               Погрузитесь в атмосферу зимнего праздника на борту "Поющего автобуса". Уютный маршрут сопровождается
               живым исполнением всеми любимых новогодних песен. Вас ждут теплые эмоции, душевное настроение и
               праздничная магия, которая сделает это путешествие незабываемым.
            </p>

            <!-- Особенности -->
            <div class="mb-3">
               <p><strong>Особенности программы:</strong></p>
               <ul class="list-unstyled">
                  <li><i class="fas fa-music text-primary me-2"></i> Живое исполнение новогодних песен </li>
                  <li><i class="fas fa-smile-beam text-warning me-2"></i> Игры и конкурсы от Деда Мороза и Снегурочки </li>
                  <li><i class="fas fa-gift text-danger me-2"></i> Подарки каждому пассажиру </li>
               </ul>
            </div>

            <!-- Список песен, разделенный на 2 колонки -->
            <div class="mb-3">
               <p><strong>В программе:</strong></p>
               <ul class="list-unstyled" style="column-count: 2; column-gap: 20px; font-size: 0.95rem;">
                  <li>«Три белых коня» </li>
                  <li>«Счастье вдруг в тишине» </li>
                  <li>«Расскажи, Снегурочка, где была» </li>
                  <li>«У леса на опушке» </li>
                  <li>«Кабы не было зимы» </li>
                  <li>«Звенит январская вьюга» </li>
                  <li>«А снег идёт» </li>
                  <li>«Снег кружится» </li>
                  <li>«Вдоль по улице метелица» </li>
                  <li>«В лесу родилась ёлочка </li>
                  <li>и многие другие» </li>
               </ul>
            </div>

            <!-- Цена -->
            <p class="h5 text-danger mb-2">Цена: 3500 рублей за 1 билет</p>
            <p class="text-muted mb-3" style="font-size: 0.9rem;">Программа рассчитана на час</p>
         </div>

         <!-- Кнопка "Закрыть" внизу -->
         <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Закрыть</button>
         </div>
      </div>
   </div>
</div>