<?php
session_start();
echo "<meta charset='utf8'>";
$login = $_SESSION['login'];

$phone = $_POST['phone'];
$fio = $_POST['fio'];
$adress = $_POST['adress'];
$user_name = $_POST['user_name'];
$user_sc = $_POST['sklad'];
$tovar = $_POST['tovar'];
$status = $_POST['status'];
$datatime = date("Y-m-d H:i:s");
$dostavka = $_POST['dostavka'];


include("bd.php");


$sql_get_device2 = mysql_query("SELECT * FROM `status` WHERE `color` = '$status' LIMIT 1 ",$db); 
while ($data_get_device2 = mysql_fetch_assoc($sql_get_device2))
{
	$name_status = $data_get_device2['name'];
}



$sql_add_zakaz = mysql_query("INSERT INTO `priem` (
	`phone`,
	`fio`,
	`adress`,
	`user_name`,
	`datatime`,
	`sklad`,
	`tovar`,
	`status`,
	`color`,
	`dostavka`
	) VALUES (
	'$phone',
	'$fio',
	'$adress',
	'$user_name',
	'$datatime',
	'$user_sc',
	'$tovar',
	'$name_status',
	'$status',
	'$dostavka'
	)",$db); // доб нов заказа
$id_zakaza=mysql_insert_id(); // получаем id только что добавленного заказа
$sql_add_history = mysql_query("INSERT INTO `log_priem` (
	`id_zakaz`,
	`datatime`,
	`meneger`,
	`status`,
	`komment`
	) VALUES (
	'$id_zakaza',
	'$datatime',
	'$user_name',
	'$name_status',
	'$tovar'
	)",$db);

exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
?>