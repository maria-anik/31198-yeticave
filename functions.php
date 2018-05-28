<?php
/**
 * Преобразует формат цены
 * @param price integer - цена
 * @return string
 */
function lot_cost($price) {
    return number_format($price, 0, ",", " ");
}

/**
 * Шаблонизатор
 * @param file_name string - путь к файлу
 * @param params_array array - данные, которые будут подставлены в файл
 * @return string
 */
function renderTemplate($file_name, $params_array) {
    $file = __DIR__ . "/template/" . $file_name . ".php";
    if (is_readable($file)) {
        ob_start();
        extract($params_array);
        require($file);

        return ob_get_clean() ;
    }
}


/**
 * Вычисляет сколько времени осталось до продажи лота
 * @param date string - дата до конца продажи лота
 * @return string
 */
function lot_time($date) {
    $date_end = strtotime($date);
    $time_wait = $date_end - time();

    if ($time_wait>0) {
        $hours = floor($time_wait / hour);
        $minutes = floor(($time_wait % hour) / minute);
        $seconds = ($time_wait - $hours*hour - $minutes*minute)  % day;

        $time_wait_string = $hours . ":" . $minutes. ":". $seconds /*date("H:i:s", $time_wait)*/;
    }
    else {
        $time_wait_string = "Торги окончены";
    }
    return $time_wait_string;
}


/** Показывает сколько прошло времени от заданного значения $date
 * Если прошло 0...55 минут: X минут назад,
 * Если сегодня: 1...23 часа назад,
 * Если вчера: Вчера в 17:40,
 * Иначе: 21.04.18 в 17:40,
 * @param date string - дата до конца продажи лота
 * @return string
*/

function passed_time($date){
 $time = time();
 $date_end = strtotime($date);
 $tm = date("H:i", $date_end);
 $d = date("d", $date_end);
 $m = date("m", $date_end);
 $y = date("y", $date_end);
 $last = round(($time - $date_end)/minute);
 $last_hours = round(($time - $date_end)/hour);

 if( $last < 55 ) return "$last минут назад";
 elseif($d.$m.$y == date("dmy",$time)) {
    if ($last_hours==1 || $last_hours==21 ) { return "$last_hours час назад"; }
    else if ($last_hours==2 || $last_hours==3 || $last_hours==4 || $last_hours==22 || $last_hours==23 || $last_hours==24 ) {
        return "$last_hours часa назад";
    }
    else {
        return "$last_hours часов назад";
    }
 }
 elseif($d.$m.$y == date("dmy", strtotime("-1 day"))) return "Вчера в $tm";
 else return "$d.$m.$y в $tm";
}


/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = "i";
            }
            else if (is_string($value)) {
                $type = "s";
            }
            else if (is_double($value)) {
                $type = "d";
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = "mysqli_stmt_bind_param";
        $func(...$values);
    }

    return $stmt;
}
