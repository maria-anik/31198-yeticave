<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) {?>
        <li class="nav__item">
            <a href="category.php?category=<?= $category['category']?>"><?= $category['title'] ?></a>
        </li>
        <?};?>
    </ul>
</nav>

<section class="rates container">
    <h2>Мои ставки</h2>
    <?php  if (count( $bets_list)>0) : ?>
    <table class="rates__list">
        <?php  foreach ($bets_list as $bet) { ?>
            <tr class="rates__item">
                <td class="rates__info">
                    <div class="rates__img">
                    <img src="<?= $bet['img']?>" width="54" height="40" alt="<?= $bet['img_alt']?>">
                    </div>
                    <h3 class="rates__title"><a href="<?= $bet['link']?>"><?= $bet['lot_name']?></a></h3>
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
    </section>
