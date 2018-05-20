<?php

    require_once("functions.php");
    require_once("config.php");
    require_once("data.php");
    require_once("db.php");
    $front = false;


    if ($con) {
        $sql_category= "SELECT id, category, title FROM categories;";
        $result_cat = mysqli_query($con, $sql_category);
        $categories = ($result_cat) ? mysqli_fetch_all($result_cat, MYSQLI_ASSOC) : [];


        $errors = [];
        $form = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $form = $_POST['add_lot'];


            if (isset($_FILES['lot-img']['name'])) {
                $tmp_name = $_FILES['lot-img']['tmp_name'];
                $path = $_FILES['lot-img']['name'];

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_type = finfo_file($finfo, $tmp_name);
                if ($file_type !== "image/jpeg") {
                    $errors['file'] = 'Загрузите картинку в формате JPEG';
                }
                else {
                    if (count($errors)==0) {
                        move_uploaded_file($tmp_name, 'lot_img/' . $path);
                        $form['path'] = 'lot_img/' . $path;
                        $form['img_alt'] = $path;
                    }
                }
            }
            else {
                $errors['file'] = 'Вы не загрузили файл';
            };

            foreach ($form as $key => $value) {
                if ($key == "lot-name") {
                    if ($value=="") {
                        $errors[$key] = 'Введите наименование лота';
                    }
                }
                elseif ($key == "category") {
                    if ($value=="0") {
                        $errors[$key] = 'Введите категорию';
                    }
                }
                elseif ($key == "message") {
                    if ($value=="") {
                        $errors[$key] = 'Напишите описание лота';
                    }
                }
                elseif ($key == "lot-rate") {
                    if ($value=="") {
                        $errors[$key] = 'Введите начальную цену';
                    }
                    elseif ((int)$value<0) {
                        $errors[$key] = 'Начальная цена должна быть больше нуля';
                    }
                }
                elseif ($key == "lot-step") {
                    if ($value=="") {
                        $errors[$key] = 'Введите шаг ставки';
                    }
                    elseif ( ((int) $value<0) && is_int($value) ) {
                        $errors[$key] = 'Шаг ставки должен быть целым числом и  больше нуля';
                    }
                }
                elseif ($key == "lot-date") {
                    if ($value=="") {
                        $errors[$key] = 'Введите дату завершения торгов';
                    }
                    elseif ( (int) (strtotime($value) - time())<day ) {
                        $errors[$key] = 'Дата завершения должна быть больше текущей даты хотя бы на один день';
                    }
                }
            };

            if (count($errors)==0) {

                $sql = 'INSERT INTO lots_list (title, category_id, user_id, cost, img, img_alt, date_create, date_end, description) VALUES ( ?, ?, ?, ?, ?, ?, NOW(), ?, ? )';
                $stmt = db_get_prepare_stmt($con, $sql, [$form['lot-name'], $form['category'], $_SESSION['user']['id'],  $form['lot-rate'], $form['path'], $form['img_alt'], $form['lot-date'], $form['message']]);
                $res_pass = mysqli_stmt_execute($stmt);

                if ($res_pass) {
                    $lot_id = mysqli_insert_id($con);
                    header("Location: lot.php?lot_id=".$lot_id);
                    exit();
                }
            }
            /*if ($res_pass && empty($errors)) {
                header("Location: /enter.php");
                exit();
            }

            $tpl_data['errors'] = $errors;
            $tpl_data['values'] = $form;*/
        }

        $add_lot = renderTemplate("add-lot",
        [
            "errors" => $errors,
            "values" => $form,
            "categories" => $categories
        ]);

        $layout_content = renderTemplate("layout",
        [
            "content" => $add_lot,
            "title" => "Yeticave - Добавление лота",
            "is_auth" => $is_auth,
            "user_name" => $user_name,
            "user_avatar" => $user_avatar,
            "categories" => $categories,
            "front" => $front
        ]);

        print($layout_content);
    }

?>
