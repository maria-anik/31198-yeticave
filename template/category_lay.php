<div class="container">
  <section class="lots">
    <h2>Все лоты в категории «<span><?= $search_category ?></span>»</h2>
    <?php  if (count( $lots_list)>0) :?>
    <ul class="lots__list">
        <?php foreach ($lots_list as $lot) : ?>
            <?= renderTemplate('lot', ['lot' => $lot])?>
        <?php endforeach; ?>
    </ul>
    <?php  if (count( $lots_list)>6) :?>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
    <?php endif;?>
    <?php else : echo "<div class=''>В этой категории пока нет товаров</div></br>"; endif; ?>
  </section>

</div>
