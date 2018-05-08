<?
# Страница вывода детальной карточки товара

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона
$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name`,`parent` FROM `categor` ORDER BY `sort`"); // список категорий
if (!empty($_GET["article"])) {
    $template["PROPERTY_TOVAR"] = $pdo->getRows("SELECT * FROM `tovar` WHERE `kolvo`>0 AND `article` = ?",[ $_GET['article'] ]); // данные о товаре
}
$template["DATA_DETAIL_TOVAR"] = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?",[ $_GET['id'] ]); // данные о товаре
$template["NAME_OPEN_CATEGOR"] = $pdo->getRow("SELECT `name` FROM `categor` WHERE `id` = ?",[$_GET['cat']]); // имя открытой категории

$shows_result = $template["DATA_DETAIL_TOVAR"]["shows"] + 1;
$pdo->updateRow("UPDATE `tovar` SET `shows` = ? WHERE `id` = ? ",[ $shows_result,$_GET['id'] ]);

$template["SEO"]["TITLE"] = $template["DATA_DETAIL_TOVAR"]["name"].' '.$template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"]    = $template["MAGAZIN"]['keywords'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["MAGAZIN"]['description'].' '.$template["MAGAZIN"]['city']; // Описание

include $template["TEMPLATE_PATH"].'product.php'; // подключение страницы шаблона
?>
