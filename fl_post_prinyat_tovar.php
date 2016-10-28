<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 29.09.16
 * Time: 5:47
 * Добавление принятого товара на склад и добавдение в лог истории
 */

session_start();
$login = $_SESSION['login'];

$id_tovara = $_POST['id'];
$kolvo = $_POST['kolvo'];
$chena = $_POST['chena'];
$postavshik = $_POST['postavshik'];
$komment = $_POST['komment'];
$datatime = date("Y-m-d H:i:s");
$valuta = $_POST['money_input'];

$id_categor = $_POST['id_categor'];
$user_name = $_POST['user_name'];

include("bd.php");

$sql_get_kolvo = mysql_query(" SELECT * FROM `tovar` WHERE `id`='$id_tovara'",$db);
while ($data_kolvo = mysql_fetch_assoc($sql_get_kolvo)) {
    $ostatok_tovara += $data_kolvo['kolvo']; // получение остатка товара
}

$vsego += $ostatok_tovara + $kolvo;

echo("<meta charset='utf8'>");
$sql_add_tovar = mysql_query("INSERT INTO `log_prihod` (
	`id_tovara`,
	`kolvo`,
	`chena`,
	`postavshik`,
	`komment`,
	`datatime`,
	`meneger`,
	`valuta`
	) VALUES (
	'$id_tovara',
	'$kolvo',
	'$chena',
	'$postavshik',
	'$komment',
	'$datatime',
	'$user_name',
	'$valuta'
	)",$db);

if ( empty($chena)==true ) {

    $sql_izm_tovar = mysql_query("UPDATE `tovar` SET `kolvo`='$vsego' WHERE `id`='$id_tovara' ",$db);
}
if ( !empty($chena)==true ) {
    $sql_izm_tovar = mysql_query("UPDATE `tovar` SET `kolvo`='$vsego',`chena_input`='$chena',`money_input`='$valuta' WHERE `id`='$id_tovara' ",$db);
}


echo mysql_error();


exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$id_categor'></head></html>");

?>