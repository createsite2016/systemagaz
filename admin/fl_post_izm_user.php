<?php
session_start();
$login = $_SESSION['login']; // логин пользователя

$profes = $_POST['profes'];
$u_name = $_POST['u_name'];
$u_login = $_POST['u_login'];
$u_password = $_POST['u_password'];
$id = $_POST['id'];

if ($profes == "Директор"){
	$role = '3';
}
if ($profes == "Администратор"){
	$role = '3';
}
if ($profes == "Менеджер"){
	$role = '1';
}

include("bd.php");

$sql_izm_priem = mysql_query("UPDATE `users_8897532` SET `role` = '$role', `profes` = '$profes',`name` = '$u_name',`login` = '$u_login',`password` = '$u_password' WHERE `id` = '$id' ",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=users.php'></head></html>");
?>
