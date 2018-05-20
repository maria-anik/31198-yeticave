<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("data.php");
    require_once("db.php");
    $front=false;


    if ($con) {
        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];


        $search_category = mysqli_real_escape_string($con, $_GET["category"]);

        $sql_lots = "SELECT l.id, l.title , c.title as category_name, category, date_end, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE c.category='$search_category'";
        $result_lots = mysqli_query($con, $sql_lots);
        $lots_list = ($result_lots) ? mysqli_fetch_all($result_lots, MYSQLI_ASSOC) : [];

        $search_category_name = "SELECT title FROM categories WHERE category = '$search_category';";
        $result_search_cat = mysqli_query($con, $search_category_name);
        $category = ($result_search_cat) ? mysqli_fetch_assoc($result_search_cat) : [];
        $category_name = $category['title'];


        $search_content = renderTemplate("category_lay",
        [
            "lots_list" => $lots_list,
            "search_category" => $category_name
        ]);

        $layout_content = renderTemplate("layout",
        [
            "content" => $search_content,
            "title" => "Yeticave - $category_name",
            "is_auth" => $is_auth,
            "user_name" => $user_name,
            "user_avatar" => $user_avatar,
            "categories" => $categories,
            "front" => $front
        ]);
        print($layout_content);

    }
?>
