<form class="form form--add-lot container <?=(count($errors)>0)? 'form--invalid':''?>" enctype="multipart/form-data" action="" method="post"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item  <?=($errors['lot-name'])? 'form__item--invalid':''?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="add_lot[lot-name]" placeholder="Введите наименование лота" value="<?=$values['lot-name'] ?? ''; ?>" >
        <span class="form__error"><?=$errors['lot-name'] ?? ''?></span>
      </div>
      <div class="form__item <?=($errors['category'])? 'form__item--invalid':''?>">
        <label for="category">Категория</label>
        <select id="category" name="add_lot[category]" >
          <option value="0">Выберите категорию</option>
          <?php foreach ($categories as $category) {?>
            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
          <?};?>
        </select>
        <span class="form__error"><?=$errors['category'] ?? ''?></span>
      </div>
    </div>
    <div class="form__item form__item--wide  <?=($errors['message'])? 'form__item--invalid':''?>">
      <label for="message">Описание</label>
      <textarea id="message" name="add_lot[message]" placeholder="Напишите описание лота" > <?=$values['message'] ?? ''; ?></textarea>
      <span class="form__error"><?=$errors['message'] ?? ''?></span>
    </div>
    <div class="form__item form__item--file form__item--uploaded"> <!--  -->
      <label>Изображение</label>
      <!--div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div-->
      <div class="form__input-file">
        <input class="visually-hidden" name="lot-img" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
      <span class="form__error"><?=$errors['file'] ?? ''?></span>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=($errors['lot-rate'])? 'form__item--invalid':''?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="add_lot[lot-rate]" placeholder="0" value="<?=$values['lot-rate'] ?? ''; ?>"  >
        <span class="form__error"><?=$errors['lot-rate'] ?? ''?></span>
      </div>
      <div class="form__item form__item--small <?=($errors['lot-step'])? 'form__item--invalid':''?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="add_lot[lot-step]" placeholder="0" value="<?=$values['lot-step'] ?? ''; ?>"  >
        <span class="form__error"><?=$errors['lot-step'] ?? ''?></span>
      </div>
      <div class="form__item <?=($errors['lot-date'])? 'form__item--invalid':''?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="add_lot[lot-date]" value="<?=$values['lot-date'] ?? ''; ?>"  >
        <span class="form__error"><?=$errors['lot-date'] ?? ''?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
