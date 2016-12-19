<?php
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
    include('bd.php');
    $sql_get_data = mysql_query("SELECT * FROM `priem` WHERE `id` = '{$id}'  ",$db);
    $row_data = mysql_fetch_array($sql_get_data);
    echo " (". $row_data['sklad'] .") " . $row_data['fio'] . "<br>";
    echo " Телефон: " . $row_data['phone'] . "<br>";
    echo " Доставка: " . $row_data['dostavka'] . "<br>";
    echo " Адрес: " . $row_data['adress'] . "<br>";
    echo " Товар: " . $row_data['tovar'] . "<br>";

}


foreach ( $_POST['products'] as $id ) {
    echo ++$i.". ";
    get_data($id);
    echo "<br>";
}
?>