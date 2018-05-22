<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");

    if ($con) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];


        $search_word = mysqli_real_escape_string($con, $_POST["search"]);

        if ($search_word && ($search_word!="") ) {
            $sql_search = "SELECT l.id,  l.title , c.title as category_name, category, date_end, cost, img, img_alt, description FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE MATCH (l.title , l.description) AGAINST ('$search_word') OR   CONCAT(l.title, l.description) like '%$search_word%' ";

            $result_search = mysqli_query($con, $sql_search);
            $lots_list = ($result_search) ? mysqli_fetch_all($result_search, MYSQLI_ASSOC) : [];

            $search_content = renderTemplate("search_lay",
            [
                "lots_list" => $lots_list,
                "search_word" => $search_word
            ]);

            $layout_content = renderTemplate("layout",
            [
                "content" => $search_content,
                "title" => "Yeticave - Поиск",
                "categories" => $categories,
                "front" => $front
            ]);

            print($layout_content);
        } else {
            header("Location: index.php"); exit;
        }

    };


