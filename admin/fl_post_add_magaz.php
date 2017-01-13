<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$komment = $_POST['komment'];

include("bd.php");

$sql_add_magaz = mysql_query("INSERT INTO `magazins` (`name`,`komment`) VALUES ('$name','$komment')",$db);

exit("<html><head><meta http-equiv='Refresh' content='0; URL=magazins.php'></head></html>");
?>