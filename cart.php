<?php

# Страница вывода корзины с товарами пользователя

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"]["name"] = 'корзина'; // имя активной страницы

if ( !empty($_SESSION["cart"]) ) {
    foreach ($_SESSION["cart"] as $key=>$value) { // получаю из сессии значения ключей и упорядочно кладу их в массив $ids
        $ids[] = $key; // id-шники товаров в корзине
    }
    $in  = str_repeat('?,', count($ids) - 1) . '?';  // получение из массива ключей, строки вида:   '?','?','?','?','?','?'  для запроса
    $template["cart"] = $pdo->getRows("SELECT * FROM `tovar` WHERE `id` IN ($in)", $ids ); // получаю из БД все данные о товаре


    if(!empty($template["cart"])) { // если есть данные в массиве $template["cart"]
        foreach ($template["cart"] as $key=>$value) { // перебираем $template["cart"] и обновляем цены в корзине($_SESSION["cart"]), вдруг изменились скидки или цены

            if($value['skidka'] !== ''){ // если есть на товаре скидка
                $_SESSION["cart"][$value["id"]]["PRICE"] = $value['chena_output']-($value['chena_output']/100 * $value['skidka']);
            } else { // если скидки нету
                $_SESSION["cart"][$value["id"]]["PRICE"] = $value["chena_output"];
            }

        }
    }

}



$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Описание

include $template["TEMPLATE_PATH"].'cart.php'; // подключение страницы шаблона
?>