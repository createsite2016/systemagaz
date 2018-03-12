<?php

# Страница пользователя с разной информацией

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"] = $pdo->getRow("SELECT `name`,`id`,`datapage` FROM `pages` WHERE `id` = ?",[$_GET['id']]); // получение активной страницы

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["MAGAZIN"]['name'].' '.$template["MAGAZIN"]['city'].' - '.$template["NAME_OPEN_CATEGOR"]['name']; // Заголовок
$template["SEO"]["KEYWORDS"] = $template["MAGAZIN"]['name'].' '.$template["MAGAZIN"]['city'].' - '.$template["NAME_OPEN_CATEGOR"]['name']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["MAGAZIN"]['name'].' '.$template["MAGAZIN"]['city'].' - '.$template["NAME_OPEN_CATEGOR"]['name']; // Описание

include $template["TEMPLATE_PATH"].'page.php'; // подключение страницы шаблона
?>