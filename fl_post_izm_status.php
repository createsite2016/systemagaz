<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$color = $_POST['color'];
$id = $_POST['id'];
$komment = $_POST['komment'];
$sort = $_POST['sort'];

if ($color == "#FFFFFF") {
	$name_color = "Без цвета";
}
if ($color == "#45B5B3") {
	$name_color = "Синий";
}
if ($color == "#45B562") {
	$name_color = "Зеленый";
}
if ($color == "#E7D627") {
	$name_color = "Желтый";
}
if ($color == "#CC3E43") {
	$name_color = "Красный";
}
if ($color == "#CCC9CF") {
	$name_color = "Серый";
}
if ($color == "#FF7400") {
	$name_color = "Оранжевый";
}
if ($color == "#FF0096") {
	$name_color = "Розовый";
}
if ($color == "#CDEB8B") {
	$name_color = "Салатовый";
}

include("bd.php");

$sql_izm_status = mysql_query("UPDATE `status` SET `name` = '$name',`color` = '$color',`name_color` = '$name_color',`komment`='$komment', `sort`='$sort' WHERE `id` = '$id' ",$db);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=status.php'></head></html>");

?>