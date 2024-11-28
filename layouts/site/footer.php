<?php
session_start();
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
?>
<!--! Подвал сайта-->
<!-- Подвал -->
<footer id="contacts" class="bg-dark text-light py-4 mt-5">
   <div class="container-fluid px-5 mt-4">
      <div class="row justify-content-center">
         <div class="col-12 text-start">
            <h5 class="mb-3">О компании</h5>
            <p class="text-justify">
               Мы — профессиональная команда аниматоров, организующих новогодние мероприятия с участием Деда
               Мороза и Снегурочки. Уже более 10 лет мы дарим детям и взрослым настоящую новогоднюю сказку, создавая
               праздничную атмосферу и незабываемые впечатления. Наши программы включают индивидуальные
               поздравления, корпоративные праздники и выступления в детских садах и школах. Мы заботимся о том, чтобы каждый
               праздник был уникальным и запоминающимся.
            </p>
         </div>
      </div>
   </div>
   <div class="container-fluid px-5">
      <!-- Первая строка -->
      <div class="row justify-content-left-4">
         <!-- FAQ -->
         <div class="col-md-12 text-start">
            <h5 class="mb-3">FAQ</h5>
            <div class="accordion" id="faqAccordion">
               <!-- FAQ пункты -->
               <!-- Пункт FAQ 1 -->
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Какие услуги включены в новогоднюю программу?
                     </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                     data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                        В нашу программу входят веселые конкурсы, игры, фотосессии с Дедом Морозом и Снегурочкой,
                        а также сказочное шоу для детей.
                     </div>
                  </div>
               </div>
               <!-- Пункт FAQ 2 -->
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Можно ли заказать индивидуальную программу для детского сада или школы?
                     </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                     data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                        Да, мы предлагаем индивидуальные программы для школ, детских садов и других детских
                        коллективов.
                     </div>
                  </div>
               </div>
               <!-- Пункт FAQ 3 -->
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Как можно забронировать мероприятие?
                     </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                     data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                        Вы можете забронировать мероприятие, позвонив по указанному номеру телефона или через наш
                        сайт.
                     </div>
                  </div>
               </div>
               <!-- Пункт FAQ 4 -->
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Какие мероприятия вы предлагаете для новогодних праздников?
                     </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                     data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                        Мы предлагаем новогодние шоу с участием Деда Мороза и Снегурочки, а также тематические
                        мероприятия
                        для разных возрастных групп.
                     </div>
                  </div>
               </div>
               <!-- Пункт FAQ 5 -->
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFive">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Как долго длится ваше новогоднее представление?
                     </button>
                  </h2>
                  <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                     data-bs-parent="#faqAccordion">
                     <div class="accordion-body">
                        Наше представление длится от 45 минут до 1 часа в зависимости от программы.
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Третья строка -->
      <div class="row mt-4">
         <!-- Обратная связь -->
         <div class="col-md-12 col-lg-6 mb-4 mb-lg-0">
            <h5 class="mb-3">Обратная связь</h5>
            <form id="feedbackForm" method="POST" action="../../backend/user/feedback.php" autocomplete="off">
               <div class="mb-3">
                  <label for="feedbackPhone">Телефон <span class="text-danger">*</span></label>
                  <input type="text" id="feedbackPhone" name="phone" class="form-control" placeholder="Введите ваш телефон" autocomplete="tel" required>
                  <div id="phoneError" class="text-danger"></div>
               </div>
               <div class="mb-3">
                  <label for="email">Email <span class="text-danger">*</span></label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Введите ваш email" autocomplete="email" required>
                  <div id="emailError" class="text-danger"></div>
               </div>
               <div class="mb-3">
                  <label for="message">Сообщение <span class="text-danger">*</span></label>
                  <textarea id="message" name="message" class="form-control" placeholder="Введите ваше сообщение" required></textarea>
                  <div id="messageError" class="text-danger"></div>
               </div>

               <?php if ($isLoggedIn): ?>
                  <!-- Скрытое поле для user_id -->
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                  <button type="submit" class="btn btn-danger text-light">Отправить</button>
               <?php else: ?>
                  <button type="button" class="btn btn-primary text-light w-100" data-bs-toggle="modal" data-bs-target="#loginModal">Авторизуйтесь, чтобы оставить отзыв</button>
               <?php endif; ?>
            </form>

         </div>
         <!-- Навигация -->
         <div class="col-12 col-lg-3 mb-4 mb-lg-0">
            <div class="navigation">
               <h5 class="text-navigation mb-3">Навигация</h5>
               <ul class="list-unstyled text-left">
                  <li class="d-flex align-items-center">
                     <a href="#home" class="text-white">Главная</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#about-us" class="text-white">О нас</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#features" class="text-white">Наши особенности</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#services" class="text-white">Услуги</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#gallery" class="text-white">Галерея</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#reviews" class="text-white">Отзывы</a>
                  </li>
                  <li class="d-flex align-items-center">
                     <a href="#contacts" class="text-white">Контакты</a>
                  </li>
               </ul>
            </div>
         </div>
         <!-- Контакты -->
         <div class="col-12 col-lg-3">
            <div class="contact-info">
               <h5 class="text-navigation mb-3">Контакты</h5>
               <p>
                  <i class="fas fa-phone-alt"></i>
                  +7(910) 806-00-33
               </p>
               <p>
                  <i class="fas fa-envelope"></i>
                  zinoveva.90@mail.ru
               </p>
               <p>
                  <i class="fas fa-map-marker-alt"></i>
                  Ул. Черногорская 8, г. Кострома
               </p>
               <p>
                  <i class="fas fa-clock"></i>
                  Ежедневно: 09:00-23:00
               </p>
            </div>
         </div>
      </div>
   </div>
   <!-- Описание -->
   <div class="container-fluid px-5 mt-4">
      <div class="row justify-content-center">
      </div>
   </div>
   <!-- Соцсети в подвале -->
   <div class="container-fluid mt-4">
      <div class="row justify-content-center">
         <div class="col-12 text-center">
            <h5 class="mb-3 text-white">Мы в соцсетях</h5>
            <div>
               <a href="https://vk.com/tatjani" target="_blank" class="mx-2 text-white"
                  style="text-decoration: none;">
                  <i class="fab fa-vk fa-2x"></i>
               </a>
               <a href="https://t.me/tatjani_tati" target="_blank" class="mx-2 text-white" style="text-decoration: none;">
                  <i class="fab fa-telegram fa-2x"></i>
               </a>
               <a href="https://wa.me/89108060033" target="_blank" class="mx-2 text-white"
                  style="text-decoration: none;">
                  <i class="fab fa-whatsapp fa-2x"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- Разделитель -->
   <div class="container text-center mt-3">
      <hr>
   </div>
   <!-- Copyright -->
   <div class="container text-center mt-3">
      <p>&copy; 2024 Новогодние мероприятия с Дедом Морозом и Снегурочкой. Все права защищены.</p>
   </div>
</footer>