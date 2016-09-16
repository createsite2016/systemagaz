<?php
session_start();
$login = $_SESSION['login'];

$status = $_POST['status'];
$komment = $_POST['komment'];
$uah = $_POST['uah'];
$usd = $_POST['usd'];
$eur = $_POST['eur'];
$cash1 = $_POST['cash1'];
$cash2 = $_POST['cash2'];
$cash3 = $_POST['cash3'];
$cash4 = $_POST['cash4'];
$cash5 = $_POST['cash5'];
$cash6 = $_POST['cash6'];
$datatime = date("Y-m-d H:i:s");
$name = $_POST['user_name'];

include("bd.php");
$sql_add_prihod = mysql_query("INSERT INTO `prihod` (`statya`,`komment`,`uah`,`usd`,`eur`,`cash1`,`cash2`,`cash3`,`cash4`,`cash5`,`cash6`,`datatime`,`manager`) VALUES ('$status','$komment','$uah','$usd','$eur','$cash1','$cash2','$cash3','$cash4','$cash5','$cash6','$datatime','$name')",$db);

exit("<html><head><meta charset='utf8'><meta http-equiv='Refresh' content='0; URL=prihod.php'></head></html>");
?>