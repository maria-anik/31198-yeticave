<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");

    if ($con) {
        header("HTTP/1.0 404 Not Found");
        $page_404 = renderTemplate("404",[]);

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $layout_content = renderTemplate("layout",
            [
                "content" => $page_404,
                "title" => "Yeticave - Поиск",
                "categories" => $categories,
                "front" => $front
            ]);
        print($layout_content);
    };
