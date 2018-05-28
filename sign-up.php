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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $form = $_POST["signup"];



            if (!empty($_FILES["avatar"]["name"])) {
                $tmp_name = $_FILES["avatar"]["tmp_name"];
                $path = $_FILES["avatar"]["name"];

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_type = finfo_file($finfo, $tmp_name);
                if (($file_type !== "image/jpeg") && ($file_type !== "image/png")) {
                    $errors["file"] = "Загрузите картинку в формате JPEG/PNG";
                }
            }
            else {
                $errors["file"] = "Вы не загрузили файл";
            }

            $email = mysqli_real_escape_string($con, $form["email"]);
            $sql = "SELECT id FROM user_list WHERE email = '$email'";
            $res_email = mysqli_query($con, $sql);


            if (mysqli_num_rows($res_email) > 0) {
                $errors["email"] = "Пользователь с этим email уже зарегистрирован";
            }
            else {
                foreach ($form as $key => $value) {
                    if ($key === "email" && !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
                        $errors[$key] = "Email должен быть корректным";
                    }
                    elseif ($key === "name" && empty($value)) {
                        $errors[$key] = "Введите имя";
                    }
                    elseif ($key === "message" && empty($value)) {
                        $errors[$key] = "Введите контактные данные";
                    }
                    elseif ($key === "password" && empty($value)) {
                        $errors[$key] = "Введите пароль";
                    }
                };

                if ( (count($errors)===1 && !empty($errors["file"])) || (count($errors)===0)  ) {

                    if (count($errors)===0) {
                        move_uploaded_file($tmp_name, "user_img/" . $path);
                        $form["path"] = "user_img/" . $path;
                    }
                    else {
                        $form["path"] = "user_img/user.png";
                    }

                    $password = password_hash($form["password"], PASSWORD_DEFAULT);

                    $sql = "INSERT INTO user_list (email, name, password, about, img) VALUES ( ?, ?, ?, ?, ? )";
                    $stmt = db_get_prepare_stmt($con, $sql, [$form["email"], $form["name"], $password, $form["message"], $form["path"]]);
                    $res_pass = mysqli_stmt_execute($stmt);

                    if ($res_pass) {

                        $user["id"] = mysqli_insert_id($con);
                        $user["name"] = $form["name"];
                        $user["email"] = $form["email"];
                        $user["password"] = $form["password"];
                        $user["about"] = $form["message"];
                        $user["img"] = $form["path"];

                        $_SESSION["user"] = $user;

                        header("Location: /index.php");
                        exit();
                    }
                }
            }
        }


        $sign_content = renderTemplate("sign-up",
            [
                "errors" => $errors,
                "values" => $form
            ]);

        $layout_content = renderTemplate("layout",
            [
                "content" => $sign_content,
                "title" => "Yeticave - Регистрация",
                "categories" => $categories,
                "front" => $front
            ]);

        print($layout_content);
    };


