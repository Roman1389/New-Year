<!-- Модальное окно для входа -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Вход</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
         </div>
         <div class="modal-body">
            <form id="loginForm" action="backend/auth/login.php" method="POST" enctype="multipart/form-data" autocomplete="off">
               <div class="mb-3">
                  <label for="login" class="form-label">Логин</label>
                  <input type="text" class="form-control" id="login-auth" name="login" autocomplete="username" required>
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Пароль</label>
                  <input type="password" class="form-control" id="password-auth" name="password" autocomplete="current-password" required>
               </div>
               <button type="submit" class="btn btn-danger w-100">Войти</button>
               <div id="error-message" class="mt-2"></div> <!-- Ошибка, будет заполнено через JS -->
            </form>
            <!-- Ссылка для перехода к форме входа -->
            <div class="text-center mt-3">
               <p>Еще не зарегистрированы? <a href="#registerModal" data-bs-toggle="modal" data-bs-target="#registerModal">Зарегистрироваться</a></p>
            </div>
         </div>
      </div>
   </div>
</div>