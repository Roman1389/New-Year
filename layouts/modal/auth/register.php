<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="registerForm" action="backend/registration/register.php" method="POST" enctype="multipart/form-data">
               <div class="mb-3">
                  <label for="surname" class="form-label">Фамилия</label>
                  <input type="text" class="form-control" id="surname" name="surname" autocomplete="off" required>
               </div>
               <div class="mb-3">
                  <label for="name" class="form-label">Имя</label>
                  <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
               </div>
               <div class="mb-3">
                  <label for="patronymic" class="form-label">Отчество</label>
                  <input type="text" class="form-control" id="patronymic" name="patronymic" autocomplete="off">
               </div>
               <div class="mb-3">
                  <label for="phone_number" class="form-label">Номер телефона</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" autocomplete="off" required>
               </div>
               <div class="mb-3">
                  <label for="avatar" class="form-label">Фото профиля</label>
                  <div id="avatarContainer" class="d-flex align-items-center w-100">
                     <div style="flex-grow: 1;">
                        <input type="file" class="form-control w-100" id="avatar" name="avatar" autocomplete="off" accept="image/*">
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="login" class="form-label">Логин</label>
                  <input type="text" class="form-control" id="login" name="login" autocomplete="off" required pattern=".*@.*"
                     title="Логин должен содержать символ '@'.">
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Пароль</label>
                  <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
               </div>
               <div class="mb-3">
                  <label for="confirm_password" class="form-label">Подтвердите пароль</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off" required>
               </div>
               <div class="mb-3">
                  <button type="submit" class="btn btn-danger w-100">Зарегистрироваться</button>
               </div>
            </form>

            <div class="text-center mt-3">
               <p>Уже есть аккаунт? <a href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Авторизоваться</a></p>
            </div>
         </div>
      </div>
   </div>
</div>