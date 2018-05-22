<section class="rates container">
    <h2>Привет, <?= strip_tags($_SESSION['user']['name']) ?></h2>
    <h2>Мои ставки</h2>
    <?php  if (count( $bets_list)>0) : ?>
    <table class="rates__list">
        <?php  foreach ($bets_list as $bet) { ?>
            <tr class="rates__item">
                <td class="rates__info">
                    <div class="rates__img">
                    <img src="<?= $bet['img']?>" width="54" height="40" alt="<?= $bet['img_alt']?>">
                    </div>
                    <h3 class="rates__title"><a href="lot.php?lot_id=<?= $bet['id']?>"><?= $bet['lot_name']?></a></h3>
                </td>
                <td class="rates__category">
                    <?= $bet['cat_name']?>
                </td>
                <td class="rates__timer">
                    <div class="timer timer--finishing"><?= $bet['date_end']?></div>
                </td>
                <td class="rates__price">
                    <?= lot_cost($bet['price']) ?> <b class='rub'>р</b>
                </td>
                <td class="rates__time">
                    <?= $bet['ts']?>
                </td>
            </tr>
        <?php }; ?>
    </table>
    <?php else : echo "<div class=''>У вас пока нет ставок</div></br>"; endif;?>

    <h2>Мои лоты</h2>
    <?php  if (count( $lots_list)>0) : ?>
        <ul class="lots__list">
            <?php  foreach ($lots_list as $lot) :?>
                    <?= renderTemplate('lot', ['lot' => $lot]) ?>
            <?php endforeach; ?>
        </ul>
        <?php  if (count( $lots_list)>9) :?>
            <ul class="pagination-list">
                <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
                <li class="pagination-item pagination-item-active"><a>1</a></li>
                <li class="pagination-item"><a href="#">2</a></li>
                <li class="pagination-item"><a href="#">3</a></li>
                <li class="pagination-item"><a href="#">4</a></li>
                <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
            </ul>
        <?php endif; ?>
    <?php else : echo "<div class=''>У вас пока нет лотов</div></br>"; endif;?>

</section>
