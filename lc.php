<?

# Страница вывода категорий и товаров открытой категории

include_once "admin/classes/App.php"; // Класс доступа к БД и функционалу
$template["TEMPLATE_PATH"] = 'theme/bf_vjx/'; // путь до макета шаблона

// эти данные летят из авторизации в хедере (форма из двух полей)
if ( isset($_POST["phone"]) AND isset($_POST["password"]) ) {
    $login = $_POST["phone"];
    $password = $_POST["password"];

    $template["USER"] = $pdo->getRow("SELECT `name`,`phone`,`password`,`adress` FROM `klient` WHERE `phone` = ?", [$login]);

    if ($template["USER"]["phone"] == $login AND $template["USER"]["password"] == $password) {
        $_SESSION["USER"] = $template["USER"];
        echo 'y';
    } else {
        $_SESSION["USER"] = '';
        echo 'n';
    }
}

// тут выход клиента из личного кабинета, ссылка на выход в хедере тоже
if ( isset($_GET["exit"]) ) {
    $_SESSION["USER"] = '';
    exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
}

if ( $_POST["action"] == 'saveuserdata' ) {
    $name = $_POST["name"];
    $adress = $_POST["adress"];
    $password = $_POST["password"];

    $pdo->updateRow("UPDATE `klient` SET `name`= ?,`adress`= ?,`password`= ? WHERE `phone`= ? ",[$name,$adress,$password, $_SESSION["USER"]["phone"]]);
    $template["USER"] = $pdo->getRow("SELECT `name`,`phone`,`password`,`adress` FROM `klient` WHERE `phone` = ?", [$_SESSION["USER"]["phone"]]);
    $_SESSION["USER"] = $template["USER"];
    echo 'y';
}

if ( $_POST["action"] == 'deluserorder' ) {
    $id = $_POST["id"];
    $pdo->deleteRow("DELETE FROM `priem` WHERE `id` = ?",[$id]);
    echo 'y';
}

if ( $_POST["action"] == 'resetpassword' ) {
    $data_user["klient"] = $pdo->getRow("SELECT `name`,`phone`,`password`,`adress` FROM `klient` WHERE `phone` = ?", [ $_POST['phone'] ]);
    if ( !empty($data_user["klient"]) ) {

        include_once "smsGateway.php";

        $magazin = $pdo->getRow("SELECT * FROM `magazins`"); // получаем магазин

        if ( !empty($magazin['smslogin']) & !empty($sms_login = $magazin['smslogin']) & !empty($magazin['smsid']) ) {
            $sms_login = $magazin['smslogin'];
            $sms_password = $magazin['smspassword'];
            $sms_device_id = $magazin['smsid'];
            $smsGateway = new SmsGateway($sms_login, $sms_password);
            $deviceID = $sms_device_id; // номер устройства

            $phone = str_replace([' ', '(', ')', '-'], '', $data_user["klient"]["phone"]);

            $number = '+'.$phone;
            $message = $data_user["klient"]["name"] . ', Ваш пароль:'.$data_user["klient"]["password"]; // смска
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID); // отправка смс покупателю
            echo 'y';
        }
    } else {
        echo 'n';
    }
}




$template["MAGAZIN"] = $pdo->getRow("SELECT * FROM `magazins`"); // данные о магазине

$template["CATEGORIES"] = $pdo->getRows("SELECT `id`,`name`,`parent` FROM `categor` ORDER BY `sort`"); // список категорий
$template["NAME_OPEN_CATEGOR"]["name"] = 'Личный кабинет';

$template["priem"] = $pdo->getRows("SELECT * FROM `tovar` AS `t`, `priem` AS `p` WHERE `p`.`tovar` = `t`.`id` "); // список товара в открытой категории

$template["PAGES"] = $pdo->getRows("SELECT `name`,`id`,`about` FROM `pages` ORDER BY `id`"); // получение страниц пользователя
$template["SEO"]["TITLE"] = $template["NAME_OPEN_CATEGOR"]['name'].' '.$template["MAGAZIN"]['city']; // Заголовок
$template["SEO"]["KEYWORDS"]    = $template["MAGAZIN"]['keywords'].' '.$template["MAGAZIN"]['city']; // Ключевые слова
$template["SEO"]["DESCRIPTION"] = $template["MAGAZIN"]['description'].' '.$template["MAGAZIN"]['city']; // Описание

include $template["TEMPLATE_PATH"].'lc.php'; // подключение страницы шаблона
?>