<?php

    require_once('../functions.php');
    require_once('../config.php');
    require_once('../data.php');


    $con = mysqli_connect("localhost", "root", "", "yeticave");
    mysqli_set_charset($con, "utf8");

    /*$sql_search = "SELECT  l.title , c.title as category_name, cost, img FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE l.title like '%$search_word%'";
    $result_search = mysqli_query($con, $sql_search);
    $lots_list = mysqli_fetch_all($result_search, MYSQLI_ASSOC);*/

    $lot_title = $_POST['lot-name'];
    $category = $_POST['category'];
    $lot_description = $_POST['message'];
    $cost = $_POST['lot-rate'];
    $lot_step = $_POST['lot-step'];
    $lot_date= date("Y-m-d H:i:s");

    /*$lot_date_end= $_POST['lot-date-end'];
    $lot_img= $_POST['lot-img'];
    $lot_img_alt= $_POST['lot-img-alt'];
    $lot_link= $_POST['lot-link'];*/


    $sql_id_cat= "SELECT id FROM categories WHERE title=$category";
    $result_id_cat = mysqli_query($con, $sql_id_cat);
    $id_cat = mysqli_fetch_all($result_id_cat, MYSQLI_ASSOC);

    /*$sql_add_lot= "INSERT INTO lots_list (title, category_id, cost, step, link, img, img_alt, date_create, date_end)
    VALUES ('$lot_title', $id_cat[0], $cost, $lot_step, '$lot_link', '$lot_img', '$lot_img_alt', $lot_date, $lot_date_end);"*/

    $sql_add_lot= "INSERT INTO lots_list set title=$lot_title, category_id=$id_cat[0], date_create=$lot_date";

    $result_lot = mysqli_query($con, $sql_add_lot);

    /*header('Location: ../index.php'); exit;*/

?>
