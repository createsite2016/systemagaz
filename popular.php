<?php

# Страница вывода категорий и товаров открытой категории

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"]["name"] = 'популярные товары'; // имя активной страницы

$template["TOVARS"] = $pdo->getRows("SELECT COUNT(*) AS kolvo_in_group, 
`id`,
`image`,
`name`,
`kolvo`,
`article`,
`chena_output`,
`categor_id`,
`new`,
`skidka`,
`model`,
`firma`,
`shows`
 FROM `tovar` WHERE `kolvo`>0 GROUP BY `article` ORDER BY `shows` DESC LIMIT 30"); // список товара в открытой категории

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Описание

include $template["TEMPLATE_PATH"].'popular.php'; // подключение страницы шаблона
?>