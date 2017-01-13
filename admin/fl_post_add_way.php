<?php
session_start();
$login = $_SESSION['login']; 
$tovar = $_POST['tovar'];
$kolvo = $_POST['kolvo'];
$chena = $_POST['chena'];
$profit = $_POST['profit'];
$ttn = $_POST['ttn'];
$komment = $_POST['komment'];
$menedger = $_POST['user_name'];
$magazin = $_POST['magazin'];
$prodavec = $_POST['prodavec'];
$datatime = date("Y-m-d H:i:s");


include("bd.php");

$sql_add_tovar_way = mysql_query("INSERT INTO `in_way` (
	`datatime`,
	`tovar`,
	`kolvo`,
	`chena`,
	`profit`,
	`ttn`,
	`komment`,
	`magazin`,
	`menedger`,
	`prodavec`
	) VALUES (
	'$datatime',
	'$tovar',
	'$kolvo',
	'$chena',
	'$profit',
	'$ttn',
	'$komment',
	'$magazin',
	'$menedger',
	'$prodavec'
	)",$db);

echo mysql_error();

exit("<html><head><meta http-equiv='Refresh' content='0; URL=way.php'></head></html>");
?>
