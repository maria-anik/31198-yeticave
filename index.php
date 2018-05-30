<?php

    require_once("config.php");
    require_once("functions.php");
    require_once("db.php");
    $front=true;


    if ($con) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $index_lot = "SELECT l.id, l.title , c.title as category_name, category, cost, date_end, img, img_alt FROM lots_list l JOIN categories c ON l.category_id=c.id WHERE NOW()<date_end  ORDER BY date_end ASC LIMIT 6 ;";
        $result_lot = mysqli_query($con, $index_lot);
        $lots_list = ($result_lot) ? mysqli_fetch_all($result_lot, MYSQLI_ASSOC) : [];


        $sql_win_lot = "SELECT l.id, title, us.about as about_creator, us.email as mail_creator, sent_mail_win FROM lots_list l JOIN user_list us ON l.user_id=us.id WHERE NOW()>=date_end";
        $result_win_lot = mysqli_query($con, $sql_win_lot);
        $win_lot = ($result_win_lot) ? mysqli_fetch_all($result_win_lot, MYSQLI_ASSOC) : [];

        /*var_dump($win_lot);*/


        if (!empty($win_lot)) {

            foreach ($win_lot as $key => $lot) {
                $id_win_lot = $lot['id'];
                $sql_win_user = " SELECT user_id, email, name FROM bet_list b JOIN user_list us ON b.user_id=us.id  WHERE lot_id = '$id_win_lot'  ORDER BY ts DESC LIMIT 1;";
                $result_win_user = mysqli_query($con, $sql_win_user);
                $win_user = ($result_win_user) ? mysqli_fetch_assoc($result_win_user) : [];

                if (!empty($win_user) && !$lot['sent_mail_win']) {
                    print("Отправляет<br>");
                    $lot['sent_mail_win'] = true;

                    /*$to  = $win_user["name"]."&lt;".$win_user["email"]">, " ;*/
                    $to  = "<maria-anik@mail.ru>" ;
                    $subject = "Поздравлеем с выигрышем ставки!";

                    $message = '
                    <html>
                        <head>
                            <title>Поздравлеем с выигрышем ставки, '.$win_user["name"].'!</title>
                        </head>
                        <body>
                            <p>Вы выиграли лот "'.$lot["title"].'".</p>
                            <p>Свяжитесь с владельцем лота по почте "'.$lot["mail_creator"].'".</p>
                            <p>Комментарии владельца лота:  "'.$lot["about_creator"].'".</p>
                        </body>
                    </html>';

                    $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
                    $headers .= "From: Yeticave <yeticave@example.com>\r\n";
                    $headers .= "Bcc: yeticave@example.com\r\n";

                    mail($to, $subject, $message, $headers);
                }
            }
        }




        $main_content = renderTemplate("main",
            [
                "categories" => $categories,
                "lots_list" => $lots_list
            ]);

        $layout_content = renderTemplate("layout",
            [
                "content" => $main_content,
                "title" => "Yeticave - Главная",
                "categories" => $categories,
                "front" => $front
            ]);

        print($layout_content);
    }
