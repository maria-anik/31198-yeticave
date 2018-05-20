<?php

require_once("config.php");
require_once("data.php");
require_once("functions.php");
require_once("db.php");

$front=true;


if ($con) {

    $sql_category= "SELECT category, title FROM categories;";
    $result_cat = mysqli_query($con, $sql_category);
    $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

    $index_lot = "SELECT l.id, l.title , c.title as category_name, category, cost, date_end, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id LIMIT 6 ;";
    $result_lot = mysqli_query($con, $index_lot);
    $lots_list = ($result_lot) ? mysqli_fetch_all($result_lot, MYSQLI_ASSOC) : [];

    $main_content = renderTemplate("main",
        [
            "categories" => $categories,
            "lots_list" => $lots_list
        ]);

    $layout_content = renderTemplate("layout",
        [
            "content" => $main_content,
            "title" => "Yeticave - Главная",
            "is_auth" => $is_auth,
            "user_name" => $user_name,
            "user_avatar" => $user_avatar,
            "categories" => $categories,
            "front" => $front
        ]);

    print($layout_content);
}
