<section class="rates container">
    <h2>Привет, <?= strip_tags($_SESSION["user"]["name"]) ?></h2>
    <div class="tab">
        <div class="tab__link">
            <a href="#tab1" class="tab__link-item active">Ставки</a>
            <a href="#tab2" class="tab__link-item">Лоты</a>
        </div>
        <div class="tab__item active" id="tab1">
            <h2>Мои ставки</h2>
            <?php  if (count( $bets_list)>0) : ?>
            <table class="rates__list">
                <?php  foreach ($bets_list as $bet) { ?>
                    <tr class="rates__item <?php if ( strtotime($bet['date_end']) - time()>=day ) {}
                                                 else if (( strtotime($bet['date_end']) - time()>day )&&( strtotime($bet['date_end']) - time()>0 )) { echo "rates__item--finishing"; }
                                                 else { echo "rates__item--end";}
                                            ?>">
                        <td class="rates__info">
                            <div class="rates__img">
                            <img src="<?= $bet['img']?>" width="54" height="40" alt="<?= $bet['img_alt']?>">
                            </div>
                            <div>
                                 <h3 class="rates__title"><a href="lot.php?lot_id=<?= $bet['id']?>"><?= $bet["lot_name"]?></a></h3>
                                <?php if(isset($bet["user_creator_about"])) : ?>
                                    <p><?= $bet["user_creator_about"]?></p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="rates__category"> <?= $bet["cat_name"]?> </td>
                        <td class="rates__timer">
                            <div class="timer <?php
                                if ( strtotime($bet['date_end']) - time()>=day ) {}
                                else if (( strtotime($bet['date_end']) - time()>day )&&( strtotime($bet['date_end']) - time()>0 )) { echo "timer--finishing"; }
                                else { echo "timer--end"; }
                            ?>"><?= lot_time($bet["date_end"])?></div>
                        </td>
                        <td class="rates__price"><?= lot_cost($bet["price"]) ?> p</td>
                        <td class="rates__time"> <?= passed_time($bet["ts"])?> </td>
                    </tr>
                <?php }; ?>
            </table>
            <?php else : ?>
                <div class="">У вас пока нет ставок</div>
            <?php endif;?>
        </div>
        <div class="tab__item" id="tab2">
            <h2>Мои лоты</h2>
            <?php  if (count( $lots_list)>0) : ?>
                <ul class="lots__list">
                    <?php  foreach ($lots_list as $lot) :?>
                            <?= renderTemplate("lot", ["lot" => $lot]) ?>
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
            <?php else : ?>
                <div class="">У вас пока нет лотов</div></br>
            <?php endif;?>
        </div>
    </div>
</section>
<script>
    var tab_link = document.querySelector(".tab__link-item");
    var count_link = document.querySelectorAll(".tab__link-item").length;
    var count_tab = document.querySelectorAll(".tab__item").length;
    for ( var i=0; i<count_link; i++) {
        document.querySelectorAll(".tab__link-item")[i].addEventListener("click", function(e) {
            for ( var k=0; k<count_link; k++) {
                document.querySelectorAll(".tab__link-item")[k].classList.remove("active");
            }
            this.classList.add("active");
            e.preventDefault();
            var href = this.getAttribute("href");
            for ( var j=0; j<count_tab; j++) {
                document.querySelectorAll(".tab__item")[j].classList.remove("active");
            }
            document.querySelector(href).classList.add("active");
        });
    }
</script>
