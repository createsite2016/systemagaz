<?php
session_start();
$login = $_SESSION['login']; 
$profes = $_POST['profes']; 
$name = $_POST['name']; 
$login = $_POST['login']; 
$password = $_POST['password']; 

if ($profes == "Директор")
{
	$role = "3";
}
if ($profes == "Администратор")
{
	$role = "3";
}
if ($profes == "Менеджер")
{
	$role = "1";
}

include("bd.php");

$sql_add_dohod = mysql_query("INSERT INTO `users_8897532` (`profes`,`name`,`login`,`password`,`role`) VALUES ('$profes','$name','$login','$password','$role')",$db);

exit("<html><head><meta http-equiv='Refresh' content='0; URL=users.php'></head></html>");
?>
