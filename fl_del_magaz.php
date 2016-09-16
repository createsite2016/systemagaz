<?php
session_start();
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
include("vhod.php");
}
else
{
$id = $_REQUEST['id'];

include("bd.php");

$id = stripslashes($id); 
$id = htmlspecialchars($id);

$sql_del_uchet = mysql_query("DELETE FROM `magazins` WHERE `id` = '$id'",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=magazins.php'></head></html>");
}
?>