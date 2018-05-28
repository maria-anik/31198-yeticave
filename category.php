<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");
    $search_category = mysqli_real_escape_string($con, $_GET["category"]);

    if ( $con && !empty($search_category)) {

        $sql_current_category = "SELECT id FROM categories WHERE category = '$search_category'";
        $current_category = mysqli_query($con, $sql_current_category);

        if (mysqli_num_rows($current_category) > 0) {
            $sql_category= "SELECT category, title FROM categories;";
            $result_cat = mysqli_query($con, $sql_category);
            $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

            $result = mysqli_query($con, "SELECT COUNT(*) as cnt
                                          FROM lots_list l
                                          JOIN categories c
                                          ON l.category_id=c.id
                                          WHERE c.category='$search_category'
                                          AND  NOW()<date_end");
            $lots_count = ($result) ? (int) mysqli_fetch_assoc($result)["cnt"] : 1;

            if (isset($_GET["page"])) {
                $cur_page = (int) mysqli_real_escape_string($con, $_GET["page"]) ?? 1;
            }
            else {
                $cur_page = 1;
            };

            $page_items = 6;
            $pages_count = ceil( $lots_count / $page_items);
            $offset = ($cur_page - 1) * $page_items;
            $pages = range(1, $pages_count);
            $file_name = "category.php";



            $sql_lots = "SELECT l.id, l.title , c.title as category_name, category, date_end, cost, img
                         FROM lots_list l
                         JOIN categories c
                         ON l.category_id=c.id
                         WHERE c.category='$search_category'
                         AND  NOW()<date_end
                         ORDER BY date_create ASC
                         LIMIT $page_items OFFSET $offset";

            $result_lots = mysqli_query($con, $sql_lots);
            $lots_list = ($result_lots) ? mysqli_fetch_all($result_lots, MYSQLI_ASSOC) : [];

            $search_category_name = "SELECT title FROM categories WHERE category = '$search_category';";
            $result_search_cat = mysqli_query($con, $search_category_name);
            $category = ($result_search_cat) ? mysqli_fetch_assoc($result_search_cat) : [];
            $category_name = $category["title"];

            $search_content = renderTemplate("category_lay",
                [
                    "lots_list" => $lots_list,
                    "category_name" => $category_name,
                    "search_category" => $search_category,
                    "pages" => $pages,
                    "cur_page"=> $cur_page,
                    "file_name" => $file_name
                ]);

            $layout_content = renderTemplate("layout",
                [
                    "content" => $search_content,
                    "title" => "Yeticave - $category_name",
                    "categories" => $categories,
                    "front" => $front
                ]);
            print($layout_content);
        } else {
            header("HTTP/1.0 404 Not Found");
            header("Location: 404.php"); exit;
        };

    } else {
        header("HTTP/1.0 404 Not Found");
        header("Location: 404.php"); exit;
    };
