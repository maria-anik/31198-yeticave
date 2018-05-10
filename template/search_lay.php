<nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($categories as $category) {?>
        <li class="nav__item">
          <a href="search_category.php?category=<?= $category['title']?>"><?= $category['title'] ?></a>
        </li>
      <?};?>
    </ul>
</nav>

<div class="container">
  <section class="lots">
    <h2>Результаты поиска по запросу «<span><?= $search_word?></span>»</h2>
    <?php  if (count( $lots_list)>0) {?>
    <ul class="lots__list">
        <?php
            if (count( $lots_list)>0) {
                foreach ($lots_list as $lot) { ?>
                <?= renderTemplate('lot', ['lot' => $lot])?>
        <?php } ?>
    </ul>
    <?php  if (count( $lots_list)>6) {?>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
    <?php } ?>
    <?php } else { echo "<div class=''>В этой категории пока нет товаров</div></br>" }?>
  </section>

</div>
