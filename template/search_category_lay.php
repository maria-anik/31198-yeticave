<nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($categories as $type => $category_name) {?>
        <li class="nav__item">
          <a href="<?= $type ?>"><?= $category_name ?></a>
        </li>
      <?};?>
    </ul>
</nav>

<div class="container">
  <section class="lots">
    <h2>Все лоты в категории «<span><?= $search_category ?></span>»</h2>
    <ul class="lots__list">
        <?php foreach ($lots_list as $lot) { ?>
            <?= renderTemplate('lot', ['lot' => $lot])?>
        <?php }?>
    </ul>
  </section>
  <ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
    <li class="pagination-item pagination-item-active"><a>1</a></li>
    <li class="pagination-item"><a href="#">2</a></li>
    <li class="pagination-item"><a href="#">3</a></li>
    <li class="pagination-item"><a href="#">4</a></li>
    <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
  </ul>
</div>
