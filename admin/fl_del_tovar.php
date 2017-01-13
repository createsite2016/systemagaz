<?php
// вся процедура работает на сесиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!
session_start();
// Проверяем, пусты ли пересменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
include("vhod.php");
}
else
{
$id = $_REQUEST['id']; // айдишник талона
$categor = $_REQUEST['categor'];

include("bd.php");

$id = stripslashes($id); // обработка от sql инекций
$id = htmlspecialchars($id); // обработка от sql инекций

$sql_del_uchet = mysql_query("DELETE FROM `tovar` WHERE `id` = '$id'",$db); // удаление из списка товаров
$sql_del_rashod = mysql_query("DELETE FROM `log_rashod` WHERE `id_tovara` = '$id'",$db); // удаление из истории рахода товара
$sql_del_rashod = mysql_query("DELETE FROM `log_prihod` WHERE `id_tovara` = '$id'",$db); // удаление из истории прихода товара

exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$categor'></head></html>");
}
?>