<?php

require_once('data.php');
require_once('functions.php');

$search_content = renderTemplate('search',
    [
        'categories' => $categories,
        'lots_list' => $lots_list
    ]);

$main_content = renderTemplate('main',
    [
        'categories' => $categories,
        'lots_list' => $lots_list
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
?>

