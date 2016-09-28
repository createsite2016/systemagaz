<?php
session_start();
$login = $_SESSION['login'];

$kolvo = $_POST['kolvo'];
$prodavec = $_POST['prodavec'];
$magazin = $_POST['magazin'];
$komment = $_POST['komment'];
$nakladnaya = $_POST['nakladnaya'];
$nalogka = $_POST['nalogka'];
$id = $_POST['id'];
$id_categor = $_POST['id_categor'];
$chena_input = $_POST['chena_input'];
$chena_output = $_POST['chena_output'];
$prifut = $chena_output - $chena_input;
$datatime = date("Y-m-d H:i:s");
$id_tovara = $_POST['id'];
$user_name = $_POST['user_name'];

include("bd.php");
echo("<meta charset='utf8'>");
$sql_add_tovar = mysql_query("INSERT INTO `log_rashod` (
	`kolvo`,
	`prodavec`,
	`magazin`,
	`komment`,
	`nakladnaya`,
	`nalogka`,
	`chena`,
	`prifut`,
	`datatime`,
	`id_tovara`,
	`menedger`
	) VALUES (
	'$kolvo',
	'$prodavec',
	'$magazin',
	'$komment',
	'$nakladnaya',
	'$nalogka',
	'$chena_input',
	'$prifut',
	'$datatime',
	'$id_tovara',
	'$user_name'
	)",$db);
echo mysql_error();


exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$id_categor'></head></html>");

?>