<?php
session_start();
$login = $_SESSION['login']; 
$name = $_POST['name'];
$color = $_POST['color'];
$komment = $_POST['komment'];

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

include("bd.php");

$sql_add_status = mysql_query("INSERT INTO `status` (`name`,`color`,`name_color`,`komment`) VALUES ('$name','$color','$name_color','$komment')",$db);

exit("<html><head><meta http-equiv='Refresh' content='0; URL=status.php'></head></html>");
?>