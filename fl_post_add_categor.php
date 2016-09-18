<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];

include("bd.php");

$sql_add_status = mysql_query("INSERT INTO `categor` (`name`) VALUES ('$name')",$db);


exit("<html><head><meta http-equiv='Refresh' content='0; URL=products.php'></head></html>");
?>