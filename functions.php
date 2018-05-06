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
    $file = __DIR__ . "/template/$file_name.php";
    if (is_readable($file)) {
        ob_start();
        extract($params_array);
        require($file);

        return ob_get_clean() ;
    }
}


/**
 * Вычисляет сколько времени осталось до продажи лота
 * @return string
 */
function lot_time() {
    date_default_timezone_set("Europe/Moscow");
    setlocale(LC_ALL, "ru_RU");

    $tomorrow = strtotime("tomorrow");
    $time_wait = $tomorrow - time();

    $hours = floor($time_wait / 3600);
    $minutes = floor(($time_wait % 3600) / 60);
    $seconds = ($time_wait - $hours*3600 - $minutes*60)  % 86400;

    $time_wait_string = $hours.":".$minutes.":". $seconds;
    return $time_wait_string;
}

?>
