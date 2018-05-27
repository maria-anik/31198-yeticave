<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("db.php");

    if ($con) {

        $sql_category= "SELECT category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];

        $errors = [];
        $form = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = $_POST['login'];

            $required = ['email', 'password'];

            foreach ($required as $field) {
                if (empty($form[$field])) {
                    $errors[$field] = 'Это поле надо заполнить';
                }
            }


            $email = mysqli_real_escape_string($con, $form['email']);
            $mail_sql = "SELECT * FROM user_list WHERE email = '$email'";
            $res = mysqli_query($con, $mail_sql);

            $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;


            if ($user) {
                if ( $form['password'] === "" ) {
                    $errors['password'] = 'Это поле надо заполнить';
                } else {
                    if (password_verify($form['password'], $user['password'])) {
                        $_SESSION['user'] = $user;

                        header("Location: /user.php");
                        exit();
                    }
                    else {
                        $errors['password'] = 'Неверный пароль';
                    }
                }
            }
            else {
                $errors['email'] = 'Пользователь с этим email не зарегистрирован';
            }
        }

        $login_content = renderTemplate("login",
            [
                "values" => $form,
                "errors" => $errors
            ]);

        $layout_content = renderTemplate("layout",
            [
                "content" => $login_content,
                "title" => "Yeticave - Логин",
                "categories" => $categories,
                "front" => $front
            ]);

        print($layout_content);
    };


