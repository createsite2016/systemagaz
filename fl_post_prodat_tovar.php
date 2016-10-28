<?php
session_start();
$login = $_SESSION['login'];

$kolvo = $_POST['kolvo'];
$prodavec = $_POST['prodavec'];
$magazin = $_POST['magazin'];
$komment = $_POST['komment'];
$nakladnaya = $_POST['nakladnaya'];
$nalogka = $_POST['nalogka'];
$id = $_POST['id'];
$id_categor = $_POST['id_categor'];
$chena_input = $_POST['chena_input'];
$chena_output = $_POST['chena_output'];
$prifut = $chena_output - $chena_input;
$datatime = date("Y-m-d H:i:s");
$valuta = $_POST['valuta'];
$id_tovara = $_POST['id'];
$user_name = $_POST['user_name'];

include("bd.php");
echo("<meta charset='utf8'>");




$sql_get_kolvo = mysql_query(" SELECT * FROM `tovar` WHERE `id`='$id_tovara'",$db);
while ($data_kolvo = mysql_fetch_assoc($sql_get_kolvo)) {
    $ostatok_tovara += $data_kolvo['kolvo']; // получение остатка товара
    $tovar_name = $data_kolvo['name']; // получение название товара
    $tovar_model = $data_kolvo['model']; // получение модели товара
}

$vsego += $ostatok_tovara - $kolvo;


$sql_add_tovar = mysql_query("INSERT INTO `log_rashod` (
	`kolvo`,
	`prodavec`,
	`magazin`,
	`komment`,
	`nakladnaya`,
	`nalogka`,
	`chena`,
	`prifut`,
	`datatime`,
	`id_tovara`,
	`menedger`,
	`valuta`
	) VALUES (
	'$kolvo',
	'$prodavec',
	'$magazin',
	'$komment',
	'$nakladnaya',
	'$nalogka',
	'$chena_output',
	'$prifut',
	'$datatime',
	'$id_tovara',
	'$user_name',
	'$valuta'
	)",$db);

$datatime; // время и дата
$tovar = "модель: {$tovar_model} товар: {$tovar_name}"; // товар
$primechanie = $komment; // товар
$kolvo; // количество
$chena = $chena_output;
$profit = $prifut;
$ttn = $nakladnaya;
$komment;
$magazin;
$menedger = $user_name;
$prodavec;


if ($nalogka == "Да"){
  $sql_add_tovar_in_way = mysql_query("INSERT INTO `in_way` (
	`datatime`, 
	`tovar`,
	`kolvo`,
	`chena`,
	`profit`,
	`ttn`,
	`komment`,
	`magazin`,
	`menedger`,
	`prodavec`
	) VALUES (
	'$datatime',
	'$tovar',
	'$kolvo',
	'$chena',
	'$profit',
	'$ttn',
	'$primechanie',
	'$magazin',
	'$menedger',
	'$prodavec'
	)",$db);	
}




$sql_izm_tovar = mysql_query("UPDATE `tovar` SET `kolvo`='$vsego' WHERE `id`='$id_tovara' ",$db);

echo mysql_error();


exit("<html><head><meta http-equiv='Refresh' content='0; URL=fl_open_products.php?id_categor=$id_categor'></head></html>");

?>