<div class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>

        <ul class="promo__list">
            <?php foreach ($categories as $type => $category_name) { ?>
                <li class="promo__item  promo__item--<?= $type ?>">
                    <a class="promo__link" href="<?= $type ?>"><?= $category_name ?></a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>

        <ul class="lots__list">
            <?php foreach ($lots_list as $lot) { ?>
                <?= renderTemplate('lot', ['lot' => $lot])?>
            <?php }?>
        </ul>
    </section>
</div>
