<?php

$id = $_POST['id'];
$tovar = $_POST['tovar'];
$kolvo = $_POST['kolvo'];
$chena = $_POST['chena'];
$profit = $_POST['profit'];
$ttn = $_POST['ttn'];
$komment = $_POST['komment'];
$magazin = $_POST['magazin'];
$menedger = $_POST['menedger'];
$prodavec = $_POST['prodavec'];
$datatime = date("Y-m-d H:i:s");

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `in_way` SET 
	`tovar` = '$tovar',
	`kolvo` = '$kolvo',
	`chena` = '$chena',
	`profit` = '$profit',
	`ttn` = '$ttn',
	`komment` = '$komment',
	`magazin` = '$magazin',
	`menedger` = '$menedger',
	`prodavec` = '$prodavec',
	`datatime` = '$datatime' 
	WHERE `id` = '$id' ",$db);


exit("<html><head><meta http-equiv='Refresh' content='0; URL=way.php'></head></html>");

?>