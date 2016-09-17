<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$chena = $_POST['chena'];
$komment = $_POST['komment'];

include("bd.php");

$sql_add_status = mysql_query("INSERT INTO `money` (
	`name`,
	`chena`,
	`komment`
	) VALUES (
	'$name',
	'$chena',
	'$komment'
	)",$db);


exit("<html><head><meta http-equiv='Refresh' content='0; URL=money.php'></head></html>");
?>