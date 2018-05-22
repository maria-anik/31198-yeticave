<div class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>

        <ul class="promo__list">
            <?php foreach ($categories as $category) : ?>
                <li class="promo__item  promo__item--<?= $category['category'] ?>">
                    <a class="promo__link" href="category.php?category=<?= $category['category'] ?>"><?= $category['title'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <?php  if (count( $lots_list)>0) {?>
        <ul class="lots__list">
            <?php foreach ($lots_list as $lot) { ?>
                <?= renderTemplate('lot', ['lot' => $lot])?>
            <?php }?>
        </ul>
        <?php }?>
    </section>
</div>
