<section class="lot-item container">
    <h2><?=$lot['lot_name']?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$lot['img']?>" width="730" height="548" alt="<?=$lot['img_alt']?>">
            </div>
            <p class="lot-item__category">Категория: <span><?=htmlspecialchars($lot['category_name'])?></span></p>
            <p class="lot-item__description"><?=htmlspecialchars($lot['description'])?></p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    <?=lot_time($lot['date_end'])?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= lot_cost($min_price) ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= lot_cost($lot['cost']) ?> р</span>
                    </div>
                </div>
                <?php if ((isset($_SESSION['user']))&&($lot['user_id']!==(int)$_SESSION['user']['id'])) : ?>
                    <form class="lot-item__form" action="" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost" min="<?=$min_price?>" step="<?=$lot['step']?>" placeholder="<?=$min_price?>" value="<?=$value['cost'] ?? ''?>">
                            <span class="form__error"><?=$errors['cost'] ?? ''?></span>
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                <?php endif;?>
            </div>
            <div class="history">
                <h3>История ставок (<span><?=count($bets_list)?></span>)</h3>
                <table class="history__list">
                    <?php foreach ($bets_list as $bet) { ?>
                            <tr class="history__item">
                                <td class="history__name"><?=htmlspecialchars($bet['name'])?></td>
                                <td class="history__price"><?= lot_cost($bet['price']) ?> р</td>
                                <td class="history__time"><?=$bet['ts']?></td>
                            </tr>
                    <?php }?>

                    <tr class="history__item">
                        <td class="history__name">Константин</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">20 минут назад</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>