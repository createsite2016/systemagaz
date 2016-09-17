<?php
session_start();
$login = $_SESSION['login'];

$fio = $_POST['fio'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];
$sklad = $_POST['sklad'];
$status = $_POST['status'];
$tovar = $_POST['tovar'];
$datatime = date("Y-m-d H:i:s");
$id = $_POST['id']; 
$dostavka = $_POST['dostavka'];
$user_name = $_POST['user_name'];


include("bd.php");


$sql_get_device2 = mysql_query("SELECT * FROM `status` WHERE `color` = '$status' LIMIT 1 ",$db); 
while ($data_get_device2 = mysql_fetch_assoc($sql_get_device2))
{
	$name_status = $data_get_device2['name'];
}



$sql_izm_zakaz = mysql_query("UPDATE `priem` SET `phone`='$phone',`fio`='$fio',`adress`='$adress',`datatime`='$datatime',`status`='$name_status',`color`='$status',`tovar`='$tovar',`sklad`='$sklad',`dostavka`='$dostavka',`user_name`='$user_name' WHERE `id`='$id' ",$db);

$sql_add_history = mysql_query("INSERT INTO `log_priem` (
	`id_zakaz`,
	`datatime`,
	`meneger`,
	`status`,
	`komment`
	) VALUES (
	'$id',
	'$datatime',
	'$user_name',
	'$name_status',
	'$tovar'
	)",$db);

exit("<html><head><meta charset='utf8'><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
?>