<?php

require_once('config.php');
require_once('data.php');
require_once('functions.php');

$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");
$sql = "SELECT  l.title, c.title, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE c.title='Доски и лыжи';";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


$search_content = renderTemplate('search',
    [
        'categories' => $categories,
        'lots_list' => $lots_list,
        'search_word' => 'Union'
    ]);

$all_lots = renderTemplate('all_lots',
    [
        'categories' => $categories,
        'lots_list' => $lots_list,
        'search_category' => 'Доски и лыжи'
    ]);



$main_content = renderTemplate('main',
    [
        'categories' => $categories,
        'lots_list' => $lots_list,
    ]);

$layout_content = renderTemplate('layout',
    [
        'content' => $main_content,
        'title' => 'Yeticave - Главная',
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'categories' => $categories
    ]);

print($layout_content);


