<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$id = $_POST['id'];

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `categor` SET `name` = '$name' WHERE `id` = '$id' ",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=products.php'></head></html>");

?>