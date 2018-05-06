<?php

require_once('data.php');
require_once('functions.php');

$lot_content = renderTemplate('lot', ['lots_list' => $lots_list]);
$search_content = renderTemplate('search', ['lot_content' => $lot_content, 'categories' => $categories]);
$main_content = renderTemplate('main', ['lot_content' => $lot_content, 'categories' => $categories]);

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

