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

include("bd.php");

$id = stripslashes($id); // обработка от sql инекций
$id = htmlspecialchars($id); // обработка от sql инекций

$sql_del_uchet = mysql_query("DELETE FROM `categor` WHERE `id` = '$id'",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=products.php'></head></html>");
}
?>