<?php


    //Load Composer's autoloader
    require 'vendor/autoload.php';

     $sql_win_lot = "SELECT l.id, title, us.about as about_creator, us.email as mail_creator, us.id as id_creator, sent_mail_win FROM lots_list l JOIN user_list us ON l.user_id=us.id WHERE NOW()>=date_end AND user_win IS NULL";
        $result_win_lot = mysqli_query($con, $sql_win_lot);
        $win_lot = ($result_win_lot) ? mysqli_fetch_all($result_win_lot, MYSQLI_ASSOC) : [];

        if (!empty($win_lot)) {

            foreach ($win_lot as $key => $lot) {
                $id_win_lot = (int)$lot['id'];
                $sql_win_user = " SELECT user_id, email, name FROM bet_list b JOIN user_list us ON b.user_id=us.id  WHERE lot_id = '$id_win_lot'  ORDER BY ts DESC LIMIT 1;";
                $result_win_user = mysqli_query($con, $sql_win_user);
                $win_user = ($result_win_user) ? mysqli_fetch_assoc($result_win_user) : [];

                if (!empty($win_user)) {

                    $win["user_name"] = $win_user["name"];
                    $win["user_id"] = $win_user["user_id"];
                    $win["lot_id"] = $lot["id"];
                    $win["lot_title"] = $lot["title"];

                    $mail_text = renderTemplate("email",
                        [
                            "win" => $win
                        ]);
                    $id_win_user = (int)$win_user["user_id"];


                     // Create the Mailer using your created Transport
                    $transport = (new Swift_SmtpTransport('phpdemo.ru', 25))
                      ->setUsername('keks@phpdemo.ru')
                      ->setPassword('htmlacademy')
                      ;

                    // Create a message
                    $message = (new Swift_Message('YetiCave поздравляет с победой!'))
                      ->setFrom(['keks@phpdemo.ru' => 'YetiCave'])
                      ->setTo([$win_user["email"] => $win_user["name"]])
                      ->setBody($mail_text, 'text/html')
                      ;

                    // Send the message
                    $mailer = new Swift_Mailer($transport);
                    $result = $mailer->send($message);

                } else {
                    $id_win_user = $lot["id_creator"];
                }

                $sql_record_win = "UPDATE lots_list SET user_win = $id_win_user WHERE id = $id_win_lot;";
                $res_pass = mysqli_query($con, $sql_record_win);
            }
        }
