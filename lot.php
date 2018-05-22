<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("data.php");
    require_once("db.php");
    $front=false;


    if ($con) {

        $lot_id = mysqli_real_escape_string($con, $_GET["lot_id"]);

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];


        if ($lot_id && ($lot_id!=="") ) {

            $sql_lot = "SELECT  l.title as lot_name, c.title as category_name, description, user_id, step, category, date_end, cost, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.id = $lot_id; ";
            $result_lot = mysqli_query($con, $sql_lot);
            $lot = ($result_lot) ? mysqli_fetch_assoc($result_lot) : [];

            if (count($lot)>0) {

                $sql_bet = "SELECT us.name, price, ts FROM bet_list b JOIN user_list us ON b.user_id=us.id  WHERE b.lot_id = $lot_id  ORDER BY ts DESC LIMIT 10; ";
                $result_bet = mysqli_query($con, $sql_bet);
                $bets_list = ($result_bet) ? mysqli_fetch_all($result_bet, MYSQLI_ASSOC) : [];

                if (count($bets_list)>0) {
                    $current_price = $bets_list[0]["price"];
                    $min_price =  $current_price + $lot["step"];
                }
                else {
                    $current_price = $lot["cost"];
                    $min_price =  $current_price;
                }

                $errors = [];
                $form = [];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $form = $_POST;
                    foreach ($form as $key => $value) {
                        if ($key == "cost") {
                            if ($value=="") {
                                $errors[$key] = "Введите вашу ставку";
                            }
                            elseif (((int)$value<0) ||((int)$value)<$min_price) {
                                $errors[$key] = "Ваша ставка должна быть не меньше текущей цены. Шаг равен ". $lot["step"]. ".";
                            }
                        }
                    };

                    if (count($errors)==0) {
                        $sql = "INSERT INTO lots_list (lot_id, user_id, price, ts ) VALUES ( ?, ?, ?, NOW() )";
                        $stmt = db_get_prepare_stmt($con, $sql, [ $lot_id, $_SESSION["user"]["id"], $form["cost"] ]);
                        $res_pass = mysqli_stmt_execute($stmt);
                    }

                };

                $lot_page = renderTemplate("lot_lay",
                [
                    "lot" => $lot,
                    "bets_list" => $bets_list,
                    "current_price" => $current_price,
                    "min_price" => $min_price,
                    "errors" => $errors,
                    "value" => $form
                ]);

                $layout_content = renderTemplate("layout",
                [
                    "content" => $lot_page,
                    "title" => $lot['lot_name'],
                    "is_auth" => $is_auth,
                    "user_name" => $user_name,
                    "user_avatar" => $user_avatar,
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

    };


