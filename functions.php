<?php
/**
 * Преобразует формат цены
 * @param price integer - цена
 * @return string
 */
function lot_cost($price) {
    return number_format($price, 0, ',', ' ');
}

/**
 * Шаблонизатор
 * @param file_name string - путь к файлу
 * @param params_array array - данные, которые будут подставлены в файл
 * @return string
 */
function renderTemplate($file_name, $params_array) {
    $file = __DIR__ . '/template/' . $file_name . '.php';
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
function lot_time($date = 'tomorrow') {
    $date_end = strtotime($date);
    $time_wait = $date_end - time();

    $hours = floor($time_wait / hour);
    $minutes = floor(($time_wait % hour) / minute);
    $seconds = ($time_wait - $hours*hour - $minutes*minute)  % day;

    $time_wait_string = $hours . ':' . $minutes. ':'. $seconds /*date("H:i:s", $time_wait)*/;
    return $time_wait_string;
}

/**
 * Вычисляет сколько времени осталось до продажи лота
 * @param date string - дата до конца продажи лота
 * @return string
 */
function lot_time_string ($date = 'tomorrow') {
    $date_end = strtotime($date);
    $time_wait = $date_end - time();

    $hours = floor($time_wait / hour);
    $minutes = floor(($time_wait % hour) / minute);
    $seconds = ($time_wait - $hours*hour - $minutes*minute)  % day;

    $time_wait_string = $hours . ':' . $minutes. ':'. $seconds;
    return $time_wait_string;
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
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}

function show_error(&$content, $error) {
    $content = include_template('error.php', ['error' => $error]);
}
