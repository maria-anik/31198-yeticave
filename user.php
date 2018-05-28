<?php
    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");

    if ($con) {
        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $user_id = strip_tags($_SESSION["user"]["id"]);

        $sql_bet = "SELECT l.id, l.title AS lot_name, c.title AS cat_name, l.img, img_alt, l.user_id as id_user_creator, price, date_end, ts FROM lots_list l JOIN bet_list b ON l.id=b.lot_id  JOIN user_list us ON b.user_id=us.id  JOIN categories c ON l.category_id=c.id WHERE us.id = $user_id ORDER BY date_end ASC; ";
        $result_bet = mysqli_query($con, $sql_bet);
        $bets_list = ($result_bet) ? mysqli_fetch_all($result_bet, MYSQLI_ASSOC) : [];

        for ( $i = 0; $i<count($bets_list); $i++) {
            $lot_id = $bets_list[$i]["id"];
            $user_id = $bets_list[$i]["id_user_creator"];
            $sql_creator = "SELECT us.about as user_creator_about FROM lots_list l JOIN user_list us ON l.user_id=us.id  WHERE us.id = $user_id AND l.id= $lot_id ";
            $result_creator = mysqli_query($con, $sql_creator);
            $creator = ($result_creator) ? mysqli_fetch_assoc($result_creator) : [];

            if ($creator!==[]) {
                $creator_about = $creator["user_creator_about"];
                $bets_list[$i]["user_creator_about"] = $creator_about;
            };
        };

        foreach ($bets_list as $bet) {

        }

        $sql_lots = "SELECT l.id, l.title , c.title as category_name, category, date_end, cost, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.user_id = $user_id ORDER BY date_end DESC ";
        $result_lots = mysqli_query($con, $sql_lots);
        $lots_list = ($result_lots) ? mysqli_fetch_all($result_lots, MYSQLI_ASSOC) : [];


        $user_bet = renderTemplate("user_lay",
        [
            "bets_list" => $bets_list,
            "lots_list" => $lots_list
        ]);

        $layout_content = renderTemplate("layout",
        [
            "content" => $user_bet,
            "title" => "Yeticave - Мои ставки",
            "categories" => $categories,
            "front" => $front
        ]);

        print($layout_content);
    }
