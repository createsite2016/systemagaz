<?php
session_start(); // вкл сессию
//include_once '../../../admin/classes/App.php'; // подключаем БД
include_once '../../../admin/classes/Database.php'; // подключаем БД
include_once '../../../smsGateway.php';
$product_id = $_POST['id']; // получаем ID товара
$product_chena = $_POST['chena']; // получаем цену товара
$action = $_POST['action']; // экшен который будет выполнятся

// Добавление товара из витрины
if ($action == 'add') {

    $cart = $_SESSION["cart"]; // в массив cart(корзину) выгружаем данные из сессии


    $cart[$product_id]["PRICE"] = $product_chena; // в массиве cart[id товара] помещаем цену товара
    if(!empty($cart[$product_id]["COUNT"])){ // если уже указанно количество, делаем + 1 к остатку
        $cart[$product_id]["COUNT"] = $cart[$product_id]["COUNT"] + 1;
    } else { // если количество не указанно, присваиваем 1 к количеству
        $cart[$product_id]["COUNT"] = 1;
    }


    $_SESSION["cart"] = $cart; // выгружаем наш массив корзины, назад в сессию
    $count = 0; // создаем переменую $count

    foreach ($cart as $key=>$value){ // перебераем массив корзины для получения всей стоимости и количества всех товаров
        $count = $count + $value["COUNT"]; // тут количество
        $res_price = $res_price + ($value["PRICE"]*$value["COUNT"]); // тут стоимость
    }
    $_SESSION["all_price_cart"] = $res_price; // помещаем в сессию общую стоимость покупки.

    $out =  $res_price.' <span class="top_cart_curr"> руб.</span><span class="top_cart_num" id="cart">'.$count.'</span>'; // данные из $out встрою в тело страницы с помощью JS

    print_r($out);
}


// Показ данных о товаре в сплывающем окне, после нажатии кнопки добавить на витрине товаров
if ($action == 'only') {
    $pdo = new Database();
    $template["TOVAR"] = $pdo->getRow("SELECT 
                                        `image`,
                                        `name`,
                                        `komment`
                                       FROM `tovar` WHERE `id` = ?",[$product_id]); // данные о магазине

    // Формирование данных для помещения в сплывающее окно
    $out = $out.'<div class="img"><img src="'.$template["TOVAR"]["image"];
    $out = $out.'" alt="image" height="160" width="160"></div><div class="nofloat">';
    $out = $out.'<p><span class="price">'.$template["TOVAR"]["name"].'</span></p><p>'.$template["TOVAR"]["komment"].'</p>';
    $out = $out.'<span class="price">'.number_format($product_chena, 0, ',', ' ').' руб.</span></div>';
    print_r($out);
}


// действия при нажатии кнопки + в корзине
if ($action == 'plus') {

    $cart = $_SESSION["cart"]; // в массив cart(корзину) выгружаем данные из сессии

    if(!empty($cart[$product_id]["COUNT"])){ // если уже указанно количество, делаем + 1 к остатку
        $cart[$product_id]["COUNT"] = $cart[$product_id]["COUNT"] + 1;
    } else { // если количество не указанно, присваиваем 1 к количеству
        $cart[$product_id]["COUNT"] = 1;
    }


    $_SESSION["cart"] = $cart; // выгружаем наш массив корзины, назад в сессию
    $count = 0; // создаем переменую $count

    foreach ($cart as $key=>$value){ // перебераем массив корзины для получения всей стоимости и количества всех товаров
        $count = $count + $value["COUNT"]; // тут количество
        $res_price = $res_price + ($value["PRICE"]*$value["COUNT"]); // тут стоимость
    }
    $_SESSION["all_price_cart"] = $res_price; // помещаем в сессию общую стоимость покупки.

    $out =  $res_price.' <span class="top_cart_curr"> руб.</span><span class="top_cart_num" id="cart">'.$count.'</span>';

    print_r($out);
}

// действия при нажатии кнопки - в корзине
if ($action == 'minus') {

    $cart = $_SESSION["cart"]; // в массив cart(корзину) выгружаем данные из сессии

    if(!empty($cart[$product_id]["COUNT"])){ // если уже указанно количество, делаем - 1 к остатку
        $cart[$product_id]["COUNT"] = $cart[$product_id]["COUNT"] - 1;
    } else { // если количество не указанно, присваиваем 1 к количеству
        $cart[$product_id]["COUNT"] = 1;
    }


    $_SESSION["cart"] = $cart; // выгружаем наш массив корзины, назад в сессию
    $count = 0; // создаем переменую $count

    foreach ($cart as $key=>$value){ // перебераем массив корзины для получения всей стоимости и количества всех товаров
        $count = $count - $value["COUNT"]; // тут количество
        $res_price = $res_price - ($value["PRICE"]*$value["COUNT"]); // тут стоимость
    }


    $res_price = -$res_price;
    $count = -$count;

    $_SESSION["all_price_cart"] = $res_price; // помещаем в сессию общую стоимость покупки.

    $out =  $res_price.' <span class="top_cart_curr"> руб.</span><span class="top_cart_num" id="cart">'.$count.'</span>';

    print_r($out);
}
if ($action == 'get_summ') {
    print_r($_SESSION["all_price_cart"]);
}
// действия при нажатии кнопки Х в корзине
if ($action == 'del') {

    $cart = $_SESSION["cart"]; // в массив cart(корзину) выгружаем данные из сессии

    if(!empty($cart[$product_id])){ // если уже указанно количество, делаем - 1 к остатку
        unset($cart[$product_id]);
    } else {

    }


    $_SESSION["cart"] = $cart; // выгружаем наш массив корзины, назад в сессию
    $count = 0; // создаем переменую $count

    foreach ($cart as $key=>$value){ // перебераем массив корзины для получения всей стоимости и количества всех товаров
        $count = $count - $value["COUNT"]; // тут количество
        $res_price = $res_price - ($value["PRICE"]*$value["COUNT"]); // тут стоимость
    }
    $_SESSION["all_price_cart"] = $res_price; // помещаем в сессию общую стоимость покупки.

    print_r(1);
}

// действия при нажатии кнопки оформить заказ в корзине
if ($action == 'order') {
    $pdo = new Database();
    $magazin = $pdo->getRow("SELECT * FROM `magazins`"); // получаем магазин

//Получаем данные о клиенте
    $name = $_POST['name']; // Имя заказчика
    $phone = $_POST['phone']; // телефон заказчика
    $pass = rand(111111, 999999);
    $adress = $_POST['adress']; // адрес заказчика
    $komment = $_POST['komment']; // пожелание к заказу или просьба
    $datatime = date("Y-m-d H:i:s"); // дата и время совершения заказа

    $magazin = $pdo->getRow("SELECT * FROM `magazins`"); // получаем магазин

    // перебераю данные из сессии и записываю в БД
    $insert_number_zakaza = $_SESSION["USER"]["number_zakaz"];
    foreach ($_SESSION["cart"] as $key=>$value) {
        $number_zakaza = $pdo->lastInsertId("INSERT INTO `priem` (`tovar`,`kolvo`,`fio`,`phone`,`adress`,`komment`,`datatime`,`sklad`,`number_zakaza`) VALUES (?,?,?,?,?,?,?,?,?) ",
            [$key,$value["COUNT"],$name,$phone,$adress,$komment,$datatime,$magazin['name'],$insert_number_zakaza]);
    }

    // добавление в базу клиентов
    // Если нет такого клиента, с номером телефона из заказа, добавляем клиента + создаем личный кабинет
    $klient = $pdo->getRow("SELECT * FROM `klient` WHERE `phone` = ?",[$phone]);
    if (empty($klient['phone'])) {
        $pdo->insertRow("INSERT INTO `klient` (
        `name`,
        `phone`,
        `password`,
        `adress`
        ) VALUES (
        ?,
        ?,
        ?,
        ?
        )",[$name,$phone,$pass,$adress]);


        //  смс рассылка (https://smsgateway.me)
        if ( !empty($magazin['smslogin']) & !empty($sms_login = $magazin['smslogin']) & !empty($magazin['smsid']) ) {
            $sms_login = $magazin['smslogin'];
            $sms_password = $magazin['smspassword'];
            $sms_device_id = $magazin['smsid'];
            $smsGateway = new SmsGateway($sms_login, $sms_password);
            $deviceID = $sms_device_id; // номер устройства

            $phone = str_replace([' ', '(', ')', '-'], '', $phone);

            $number = '+'.$phone;
            $message = $name . ', Ваш заказ принят, Вам создан личный кабинет, логин: номер Вашего телефона, пароль:'.$pass; // смска
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс покупателю

            $number = $magazin['smsnumber']; // номер на который отправлять (телефон для уведомлений)
            $message = 'Привет, только что поступил заказ от: ' . $name . ', номер телефона: ' . $phone; // смска
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс на телефон для уведоммлений
        }


    } else {
        //  смс рассылка (https://smsgateway.me)
        if ( !empty($magazin['smslogin']) & !empty($sms_login = $magazin['smslogin']) & !empty($magazin['smsid']) ) {
            $sms_login = $magazin['smslogin'];
            $sms_password = $magazin['smspassword'];
            $sms_device_id = $magazin['smsid'];
            $smsGateway = new SmsGateway($sms_login, $sms_password);
            $deviceID = $sms_device_id; // номер устройства

            $phone = str_replace([' ', '(', ')', '-'], '', $phone);

            $number = '+'.$phone;
            $message = $name . ', Ваш заказ принят, доступ к личному кабинету, логин: ваш номер телефона, пароль:'.$klient["password"]; // смска
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс покупателю

            $number = $magazin['smsnumber']; // номер на который отправлять (телефон для уведомлений)
            $message = 'Привет, только что поступил заказ от: ' . $name . ', номер телефона: ' . $phone; // смска
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс на телефон для уведоммлений
        }
    }




    if (!empty($number_zakaza)) {
        $_SESSION["cart"] = '';
        echo 1;
    } else {
        echo 0;
    }


}
