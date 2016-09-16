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
$id = $_POST['id'];


include("bd.php");


$sql_izm_prihod = mysql_query("UPDATE `prihod` SET `statya`='$status',`komment`='$komment',`uah`='$uah',`usd`='$usd',`eur`='$eur',`cash1`='$cash1',`cash2`='$cash2',`cash3`='$cash3',`cash4`='$cash4',`cash5`='$cash5',`cash6`='$cash6',`manager`='$name' WHERE `id`='$id' ",$db);
exit("<html><head><meta charset='utf8'><meta http-equiv='Refresh' content='0; URL=prihod.php'></head></html>");
?>