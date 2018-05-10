<?php

    $search_category = $_GET['category'];
    require_once('functions.php');
    require_once('config.php');
    require_once('data.php');

    $con = mysqli_connect("localhost", "root", "", "yeticave");
    mysqli_set_charset($con, "utf8");

    $sql_search = "SELECT  l.title , c.title as category_name, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE c.title='$search_category'";
    $result_search = mysqli_query($con, $sql_search);
    if ($result_search) {
        $lots_list = mysqli_fetch_all($result_search, MYSQLI_ASSOC);
    }
    else { $lots_list = []; };


    $sql_category= "SELECT category, title FROM categories;";
    $result_cat = mysqli_query($con, $sql_category);
    if ($result_cat) {
        $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
    }
    else { $categories = []; };

    $search_content = renderTemplate('all_lots',
    [
        'categories' => $categories,
        'lots_list' => $lots_list,
        'search_category' => $search_category
    ]);

    $layout_content = renderTemplate('layout',
    [
        'content' => $search_content,
        'title' => 'Yeticave - Главная',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'categories' => $categories
    ]);
    print($layout_content);
?>
