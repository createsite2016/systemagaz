<?php
session_start();
echo "<meta charset='utf8'>";
$login = $_SESSION['login'];

$categor_id = $_POST['categor_id'];
$name = $_POST['name'];
$model = $_POST['model'];
$chena_input = $_POST['chena_input'];
$chena_output = $_POST['chena_output'];
$money_input = $_POST['money_input'];
$money_output = $_POST['money_output'];
$komment = $_POST['komment'];
$status = $_POST['status'];
$datatime = date("Y-m-d H:i:s");

$id_categor = $_REQUEST['id_categor'];


include("bd.php");

$sql_add_tovar = mysql_query("INSERT INTO `tovar` (
	`categor_id`,
	`name`,
	`model`,
	`chena_input`,
	`chena_output`,
	`money_input`,
	`money_output`,
	`komment`,
	`status`,
	`datatime`
	) VALUES (
	'$categor_id',
	'$name',
	'$model',
	'$chena_input',
	'$chena_output',
	'$money_input',
	'$money_output',
	'$komment',
	'$status',
	'$datatime'
	)",$db);
echo mysql_error();

exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$id_categor'></head></html>");
?>