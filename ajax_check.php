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

    
    //  смс рассылка (https://smsgateway.me)
    if ( !empty($magazin['smslogin']) & !empty($sms_login = $magazin['smslogin']) & !empty($magazin['smsid']) ) {
    $sms_login = $magazin['smslogin'];
    $sms_password = $magazin['smspassword'];
    $sms_device_id = $magazin['smsid'];
    include_once "smsGateway.php";
    $smsGateway = new SmsGateway($sms_login, $sms_password);
    $deviceID = $sms_device_id; // номер устройства
    $number = $phone; // номер на который отправлять (телефон покупателя)
    $message = $name.', Ваш номер заказа: '.$number_zakaza.', ожидайте звонка от менеджера'; // смска
    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс покупателю


    $number = $magazin['smsnumber']; // номер на который отправлять (телефон для уведомлений)
    $message = 'Привет, только что поступил заказ от: '.$name.', номер заказа: '.$number_zakaza.', номер телефона: '.$phone; // смска
    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс на телефон для уведоммлений

    // добавление в базу клиентов
    $pdo->insertRow("INSERT INTO `klient` (`name`,`phone`,`adress`,`komment`) VALUES (?,?,?,?) ", [$name,$phone,$adress,$komment]);
    }
}




?>