<?php
// Данный скрипт получает данные корзины из eshop.js и делая выборку из базы отправляет ответ в cart.php
$id = $_POST['id'];
$kolvo = $_POST['kolvo'];
$id_ = $_POST['id_'];
$kolvo_ = $_POST['kolvo_'];
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();

$sql_tovar = $pdo->getRow("SELECT * FROM `tovar` WHERE id = ? ",[$id_]); // получение данных о товаре
if ( $kolvo_ < $sql_tovar['kolvo'] ) { // проверяем чтобы количество было больше нуля
        echo $sql_tovar['kolvo'];
    }
if ( $kolvo_ >= $sql_tovar['kolvo'] ) { // проверяем чтобы количество было больше нуля
        echo $sql_tovar['kolvo'];
    }



if ( $kolvo > '0' ) {
    $sql_tovar = $pdo->getRow("SELECT * FROM `tovar` WHERE id = ? ",[$id]); // получение данных о товаре

    if ( $kolvo > $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$sql_tovar['kolvo'];
        $out = $out."шт.</td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo.")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }

    if ( $kolvo == $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$kolvo;
        $out = $out."шт.</td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo.")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }
    if ( $kolvo < $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$kolvo;
        $out = $out."<button onclick='plusCart(".$sql_tovar['id'].")' type='submit'>+</button></td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo.")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }
}
?>