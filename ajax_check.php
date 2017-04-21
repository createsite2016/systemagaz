<?php
session_start();
// Данный скрипт отвечает за оформление заказа
// Данные летят из "js/check_cart.js" методом POST в ajax_check.php
// передаются данные из корзины(LocalStorage) и полей формы вверденной при оформлении заказа






include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$magazin = $pdo->getRow("SELECT * FROM `magazins`"); // получаем магазин

//Получаем данные о клиенте

$id = $_POST['id']; // ключ товара
$kolvo = $_POST['kolvo']; // количество товара
$name = $_POST['name']; // Имя заказчика
$phone = $_POST['phone']; // телефон заказчика
$adress = $_POST['adress']; // адрес заказчика
$komment = $_POST['komment']; // пожелание к заказу или просьба
$datatime = date("Y-m-d H:i:s"); // дата и время совершения заказа

if ($kolvo > 0) {

    $number_zakaza = $pdo->lastInsertId("INSERT INTO `priem` (`tovar`,`kolvo`,`fio`,`phone`,`adress`,`komment`,`datatime`,`sklad`) VALUES (?,?,?,?,?,?,?,?) ",
        [$id,$kolvo,$name,$phone,$adress,$komment,$datatime,$magazin['name']]);

    // подключаем класс для смс рассылки
    $sms_login = "xakerfsb@gmail.com";
    $sms_password = "16213150z";
    $sms_device_id = "45409";
    include_once "smsGateway.php";
    $smsGateway = new SmsGateway($sms_login, $sms_password);
    $deviceID = $sms_device_id; // номер устройства
    $number = '+7'.$phone; // номер на который отправлять
    $message = $name.', Ваш номер заказа: '.$number_zakaza; // смска
    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);


    $number = '+79892370744'; // номер на который отправлять
    $message = 'Привет, только что поступил заказ от: '.$name.', номер заказа: '.$number_zakaza.', номер телефона: '.'+7'.$phone; // смска
    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

    // добавление в базу клиентов
    $pdo->insertRow("INSERT INTO `klient` (`name`,`phone`,`adress`) VALUES (?,?,?) ", [$name,$phone,$adress]);
}




?>