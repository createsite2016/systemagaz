<?php
session_start();
$login = $_SESSION['login'];
$categor_id = $_POST['categor_id'];
$name = $_POST['name'];
$model = $_POST['model'];
$chena_input = $_POST['chena_input'];
$chena_output = $_POST['chena_output'];
$komment = $_POST['komment'];
$status = $_POST['status'];
$id = $_POST['id'];
$id_categor = $_POST['id_categor'];

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `tovar` SET 
	`name` = '$name',
	`model` = '$model',
	`chena_input` = '$chena_input',
	`chena_output` = '$chena_output',
	`komment` = '$komment',
	`categor_id` = '$categor_id',
	`status` = '$status' 
	WHERE `id` = '$id' ",$db);


exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$id_categor'></head></html>");

?>