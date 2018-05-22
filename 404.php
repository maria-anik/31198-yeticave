<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("data.php");
    require_once("db.php");

    if ($con) {
        header("HTTP/1.0 404 Not Found");
        $page_404 = renderTemplate("404",[]);

        $layout_content = renderTemplate("layout",
            [
                "content" => $page_404,
                "title" => "Yeticave - Поиск",
                "is_auth" => $is_auth,
                "user_name" => $user_name,
                "user_avatar" => $user_avatar,
                "categories" => $categories,
                "front" => $front
            ]);
        print($layout_content);
    };
