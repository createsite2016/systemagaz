<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$chena = $_POST['chena'];
$id = $_POST['id'];
$komment = $_POST['komment'];

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `money` SET 
	`name` = '$name',
	`chena` = '$chena',
	`komment`='$komment'
	 WHERE `id` = '$id' ",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=money.php'></head></html>");

?>