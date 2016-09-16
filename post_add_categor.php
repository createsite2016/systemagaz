<?php
// вся процедура работает на сесиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!
session_start();
// Проверяем, пусты ли пересменные логина и id пользователя
$login = $_SESSION['login']; // логин пользователя

$name = $_POST['name']; // номер телефона клиента

include("bd.php");

$name = stripslashes($name); // обработка от sql инекций
$name = htmlspecialchars($name); // обработка от sql инекций

$sql_add_categor = mysql_query("INSERT INTO `categor_92834298374` (`name`) VALUES ('$name')",$db);

exit("<html><head><meta http-equiv='Refresh' content='0; URL=edit_categor.php'></head></html>");
?>
