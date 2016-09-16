<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$id = $_POST['id'];
$komment = $_POST['komment'];

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `magazins` SET `name` = '$name',`komment`='$komment' WHERE `id` = '$id' ",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=magazins.php'></head></html>");

?>