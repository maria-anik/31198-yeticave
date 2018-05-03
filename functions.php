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
    $file = __DIR__ . "/template/$file_name.php";
    if (is_readable($file)) {
        ob_start();
        extract($params_array);
        require($file);

        return ob_get_clean() ;
    }
}
?>
