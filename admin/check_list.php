<?php
include_once "classes/Database.php";
?>
<html>
<meta charset="UTF-8">
<title>Чек лист</title>

<?php

echo "<br>";
echo date("Y-m-d H:i:s");
echo "<br>";
echo "<br>";
$i = 0;
function get_data($id) {
    $pdo = new Database();
    $get_check = $pdo->getRows("SELECT * FROM `priem` WHERE `id` = '{$id}'  ");
    foreach ($get_check as $item):
        echo " (". $item['sklad'] .") " . $item['fio'] . "<br>";
        echo " Телефон: " . $item['phone'] . "<br>";
        echo " Доставка: " . $item['dostavka'] . "<br>";
        echo " Адрес: " . $item['adress'] . "<br>";
        echo " Товар: " . $item['tovar'] . "<br>";
        endforeach;

}

foreach ( $_POST['products'] as $id ) {
    echo ++$i.". ";
    get_data($id); // вывод порядкового номера для списка
    echo "<br>";
}
?>