<?php
session_start();
// Данный скрипт отвечает за оформление заказа
// Данные летят из "js/check_cart.js" методом POST в ajax_check.php
// передаются данные из корзины(LocalStorage) и полей формы вверденной при оформлении заказа






include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$magazin = $pdo->getRow("SELECT * FROM `magazins`"); // получаем магазин

//$login = $_SESSION['login'];
//$userdata = $pdo->getRow("SELECT * FROM `users_8897532` WHERE `login`= ? ",[$login]);

$id = $_POST['id']; // ключ товара
$kolvo = $_POST['kolvo']; // количество товара
$name = $_POST['name']; // Имя заказчика
$phone = $_POST['phone']; // телефон заказчика
$adress = $_POST['adress']; // адрес заказчика
$komment = $_POST['komment']; // пожелание к заказу или просьба
$datatime = date("Y-m-d H:i:s"); // дата и время совершения заказа
//$user_name = $userdata['name']; // имя
if ($kolvo > 0) {
    $pdo->insertRow("INSERT INTO `priem` (`tovar`,`kolvo`,`fio`,`phone`,`adress`,`komment`,`datatime`,`sklad`) VALUES (?,?,?,?,?,?,?,?) ",
        [$id,$kolvo,$name,$phone,$adress,$komment,$datatime,$magazin['name']]);
}




?>