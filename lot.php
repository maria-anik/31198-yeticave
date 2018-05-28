<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");
    $lot_id = mysqli_real_escape_string($con, $_GET["lot_id"]);

    if ($con && !empty($lot_id) ) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $sql_lot = "SELECT  l.title as lot_name, c.title as category_name, description, user_id, step, category, date_end, cost, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.id = $lot_id; ";
        $result_lot = mysqli_query($con, $sql_lot);
        $lot = ($result_lot) ? mysqli_fetch_assoc($result_lot) : [];

        if (count($lot)>0) {

            if (strtotime($lot["date_end"])>time()) {
                $time_end = false;
            }
            else {
                $time_end = true;
            }

            $sql_bet = "SELECT us.id as user_id, us.name, price, ts FROM bet_list b JOIN user_list us ON b.user_id=us.id  WHERE b.lot_id = $lot_id  ORDER BY ts DESC LIMIT 10; ";
            $result_bet = mysqli_query($con, $sql_bet);
            $bets_list = ($result_bet) ? mysqli_fetch_all($result_bet, MYSQLI_ASSOC) : [];

            $man_get_bet = false;


            if (count($bets_list)>0) {
                $current_price = $bets_list[0]["price"];
                $min_price =  $current_price + $lot["step"];

                foreach ($bets_list as $key => $value) {
                    if ( !empty($_SESSION["user"]["id"]) && ($_SESSION["user"]["id"] === $bets_list[$key]["user_id"]) ) {
                        $man_get_bet = true;
                    }
                }
            }
            else {
                $current_price = $lot["cost"];
                $min_price =  $current_price;
                $man_get_bet = false;
            }

            $errors = [];
            $form = [];

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $form = $_POST;

                    foreach ($form as $key => $value) {
                        if ($key === "cost") {
                            if ( !isset($value)) {
                                $errors[$key] = "Введите вашу ставку";
                            }
                            elseif ( (int)$value<0 || (int)$value <$min_price ) {
                                $errors[$key] = "Ваша ставка должна быть не меньше текущей цены. Шаг равен ". $lot["step"]. ".";
                            }
                        }
                    };

                    if (count($errors)==0) {
                        $sql = "INSERT INTO bet_list (lot_id, user_id, price, ts ) VALUES ( ?, ?, ?, NOW() )";
                        $stmt = db_get_prepare_stmt($con, $sql, [ (int)$lot_id, (int)$_SESSION["user"]["id"], (int)$form["cost"] ]);
                        $res_pass = mysqli_stmt_execute($stmt);


                        header("Location: lot.php?lot_id=$lot_id"); exit;
                    }
                };

                $lot_page = renderTemplate("lot_lay",
                [
                    "lot" => $lot,
                    "bets_list" => $bets_list,
                    "current_price" => $current_price,
                    "min_price" => $min_price,
                    "errors" => $errors,
                    "value" => $form,
                    "man_get_bet" => $man_get_bet,
                    "time_end" => $time_end

                ]);

                $layout_content = renderTemplate("layout",
                [
                    "content" => $lot_page,
                    "title" => $lot["lot_name"],
                    "categories" => $categories,
                    "front" => $front
                ]);

                print($layout_content);

        } else {
            header("HTTP/1.0 404 Not Found");
            header("Location: 404.php"); exit;
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        header("Location: 404.php"); exit;
    }


