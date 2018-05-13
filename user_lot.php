<?php
    $user_id = 1;
    require_once("functions.php");
    require_once("config.php");
    require_once("data.php");
    require_once("db.php");

    if ($con) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $sql_bet = "SELECT l.title AS lot_name, c.title AS cat_name, img, img_alt, link, price, date_end, ts FROM lots_list l JOIN bet_list b ON l.id=b.lot_id  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category_id=c.id WHERE us.id = $user_id ORDER BY ts;";
        $result_bet = mysqli_query($con, $sql_bet);
        $bets_list = ($result_cat) ? mysqli_fetch_all($result_bet, MYSQLI_ASSOC) : [];


        $user_bet = renderTemplate("user_bet_lay",
        [
            "categories" => $categories,
            "bets_list" => $bets_list
        ]);

        $layout_content = renderTemplate("layout",
        [
            "content" => $user_bet,
            "title" => "Yeticave - Мои ставки",
            "is_auth" => $is_auth,
            "user_name" => $user_name,
            "user_avatar" => $user_avatar,
            "categories" => $categories
        ]);

        print($layout_content);

    }







?>
