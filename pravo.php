<?php

# Страница вывода информации о персональных даных

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name`,`parent` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"]["name"] = "Согласие на обработку персональных данных";

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"]    = $template["MAGAZIN"]['keywords'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["MAGAZIN"]['description'].' '.$template["MAGAZIN"]['city']; // Описание

$template["FIRMA"] = "ИП Иванову Ивану Ивановичу (ОГРНИП 123456789012345)";
$template["ADRESS"] = "г. Москва, Полевой проезд, д.999, корп.222, кв.444";

include $template["TEMPLATE_PATH"].'pravo.php'; // подключение страницы шаблона
?>