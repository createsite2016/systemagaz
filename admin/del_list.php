<?php
include_once "classes/Database.php";

$i = 0;
$total = count($_POST['products']);
function get_data($id) {
    $pdo = new Database();
    $get_check = $pdo->deleteRow("DELETE FROM `priem` WHERE `id` = ?  ",[$id]);
//    foreach ($get_check as $item):
//        $tovar = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?  ",[$item['tovar']]);
//        echo " Клиент: " . $item['fio'] . "<br>";
//        echo " Телефон: " . $item['phone'] . "<br>";
//        echo " Доставка: " . $item['adress'] . "<br>";
//        echo " Товар: " . $tovar['name'] . " (" . $tovar['article'] . ")<br>";
//    endforeach;

}

foreach ( $_POST['products'] as $id ) {
    ++$i;
    get_data($id); // вывод порядкового номера для списка
    if($i == $total) {
        exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
    }
}
?>