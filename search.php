<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");
    $search_word = trim(mysqli_real_escape_string($con, $_GET["search"]));

    if ($con && $search_word && ($search_word!="")) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];


        $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots_list  WHERE MATCH (title , description) AGAINST ('$search_word') OR   CONCAT(title, description) like '%$search_word%' AND NOW()<date_end ");
        $lots_count = ($result) ? (int) mysqli_fetch_assoc($result)['cnt'] : 1;

        if (isset($_GET["page"])) {
            $cur_page = (int) mysqli_real_escape_string($con, $_GET["page"]) ?? 1;
        } else {
            $cur_page = 1;
        };

        $page_items = 3;
        $pages_count = ceil( $lots_count / $page_items);
        $offset = ($cur_page - 1) * $page_items;
        $pages = range(1, $pages_count);
        $file_name = "search.php";

        $sql_search = "SELECT l.id,  l.title , c.title as category_name, category, date_end, cost, img, img_alt, description FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE (MATCH (l.title , l.description) AGAINST ('$search_word') OR   CONCAT(l.title, l.description) like '%$search_word%') AND NOW()<date_end LIMIT $page_items OFFSET $offset";

        $result_search = mysqli_query($con, $sql_search);
        $lots_list = ($result_search) ? mysqli_fetch_all($result_search, MYSQLI_ASSOC) : [];

        $search_content = renderTemplate("search_lay",
            [
                "lots_list" => $lots_list,
                "search_word" => $search_word,
                "pages" => $pages,
                "cur_page"=> $cur_page,
                "file_name" => $file_name
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
        header("HTTP/1.0 404 Not Found");
        header("Location: index.php"); exit;
    }


