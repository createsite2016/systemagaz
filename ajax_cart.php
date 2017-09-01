<?php
// Данный скрипт получает данные корзины из eshop.js и делая выборку из базы отправляет ответ в cart.php
$id = $_POST['id'];
$kolvo = $_POST['kolvo'];
$id_ = $_POST['id_'];
$kolvo_ = $_POST['kolvo_'];
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();

$i = 0;
foreach ($id as $item) {
    if ( $kolvo[$i] > '0' ) {
    $sql_tovar = $pdo->getRow("SELECT * FROM `tovar` WHERE id = ? ",[$item]); // получение данных о товаре

    if ( $kolvo[$i] > $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$sql_tovar['kolvo'];
        $out = $out."шт.</td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo[$i].")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }

    if ( $kolvo[$i] == $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$kolvo[$i];
        $out = $out."шт.</td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo[$i].")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }
    if ( $kolvo[$i] < $sql_tovar['kolvo'] ) {
        $out = "<tr><td>".$sql_tovar['id']."</td><td>";
        $out = $out."<a href=product.php?id=".$sql_tovar['id'].">".$sql_tovar['name'];
        $out = $out."</a></td><td>".$sql_tovar['chena_output'];
        $out = $out."</td><td><button onclick='minusCart(".$sql_tovar['id'].")' type='submit'>-</button>".$kolvo[$i];
        $out = $out."<button onclick='plusCart(".$sql_tovar['id'].")' type='submit'>+</button></td>";
        $out = $out."<td><button onclick='removeCart(".$sql_tovar['id'].",".$kolvo[$i].")' type='submit'>Убрать</button></td></tr>";
        echo $out;
    }

}
    $i++;
}

//if ( $kolvo[$i] == '0' ) {?>
<!--Нет ниодного товара в корзине-->
<?// } ?>