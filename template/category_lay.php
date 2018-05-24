<div class="container">
  <section class="lots">
    <h2>Все лоты в категории «<span><?= $category_name ?></span>»</h2>
    <?php  if (count( $lots_list)>0) :?>
    <ul class="lots__list">
        <?php foreach ($lots_list as $lot) : ?>
            <?= renderTemplate('lot', ['lot' => $lot])?>
        <?php endforeach; ?>
    </ul>
    <?php if ( count($pages) > 1) :?>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev">
                <?php  if ($cur_page !== 1) : ?>
                    <a href="category.php?category=<?= $search_category?>&page=<?= ($cur_page-1)?>">Назад</a>
                <?php else : ?>
                    <span>Назад</span>
                <?php endif; ?>
            </li>
            <?php  foreach ($pages as $page) : ?>
                <?php  if ($page==$cur_page) : ?>
                    <li class="pagination-item pagination-item-active"><span><?= $page?></span></li>
                <?php else : ?>
                    <li class="pagination-item"><a href="<?= $file_name?>?category=<?= $search_category?>&page=<?= $page?>"><?= $page?></a></li>
                <?php endif; ?>
            <?php  endforeach; ?>
            <li class="pagination-item pagination-item-next">
                <?php  if ($cur_page !== count($pages)) : ?>
                    <a  href="category.php?category=<?= $search_category?>&page=<?= ($cur_page+1)?>">Вперед</a>
                <?php else : ?>
                    <span>Вперед</span>
                <?php endif; ?>
            </li>
        </ul>
    <?php endif; ?>
    <?php else : echo "<div class=''>В этой категории пока нет товаров</div></br>"; endif; ?>
  </section>

</div>
