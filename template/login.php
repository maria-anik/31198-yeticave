<form class="form container  <?=(count($errors)>0)? 'form--invalid':''?>" action="" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?=($errors['email'])? 'form__item--invalid':''?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="login[email]" placeholder="Введите e-mail"  value="<?=$values['email'] ?? ''; ?>">
      <span class="form__error"><?=$errors["email"] ?? "";?></span>
    </div>
    <div class="form__item form__item--last">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="login[password]" placeholder="Введите пароль" >
      <span class="form__error"><?=$errors["password"] ?? "";?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>

