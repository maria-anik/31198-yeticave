<form class="form container" action="" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?=($errors['email'])? 'form__item--invalid':''?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="signup[email]" placeholder="Введите e-mail" value="<?=$values['email'] ?? ''; ?>" >
        <span class="form__error"><?=$errors["email"] ?? "";?></span>
    </div>
    <div class="form__item">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="signup[password]" placeholder="Введите пароль" >
        <span class="form__error"><?=$errors["password"] ?? "";?></span>
    </div>
    <div class="form__item <?=($errors['name'])? 'form__item--invalid':''?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="signup[name]" placeholder="Введите имя" value="<?=$values['name'] ?? ''; ?>"  >
        <span class="form__error"><?=$errors["name"] ?? ""?></span>
    </div>
    <div class="form__item <?=($errors['message'])? 'form__item--invalid':''?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="signup[message]" placeholder="Напишите как с вами связаться" ><?=$values["message"] ?? ""; ?></textarea>
        <span class="form__error"><?=$errors["message"] ?? ""?></span>
    </div>
    <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" name="avatar" type="file" id="photo2" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
        <span class="form__error"><?=$errors["file"] ?? ""?></span>
    </div>
    <?php
    if (count($errors)>0) :?>
            <span class="form__error form__error--bottom">
                Пожалуйста, исправьте ошибки в форме.
                <ul>
                    <?php foreach ($errors as $key => $value): ?>
                         <li><?=$value;?></li>
                    <?php endforeach; ?>
                </ul>
            </span>
    <?php endif;?>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>
