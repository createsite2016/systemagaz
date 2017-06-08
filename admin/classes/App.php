<?php

include_once "Database.php"; // подключаем БД

// Вывод ошибок. ( для показа написать $error = show; )
//$error = show;
if ($error == show) {
    ini_set('display_errors', TRUE);
} else {
    ini_set('display_errors', FALSE);
}


/**
 * Класс всего приложения
 * Clear(%переменная) - обработка переменных перед запросом
 * goWay(%путь, %сообщение) - делает переадресацию на другую страницу с сообщение или безсообщения
 * goWayClass(%путь) - переадресация на класс
 * create_user - создание нового пользователя
 * get_action(%экшен) - обработка действий пользователя
 *
 * ЗАКАЗЫ
 * del_zakaz - Удаление заказа (Страницы заказы)
 * izm_zakaz - Изменение заказа (Страница заказы)
 * add_zakaz - Добавление заказа (Страница заказы)
 *
 * ТОВАРЫ
 * add_categor - Добавление категории (Страница товары)
 * add_tovar - Добавление товара (Страница товары)
 * del_categor - Удаление категории и товара в этой категории (Страницы товары)
 * izm_categor - Изменение категории (Страница товары)
 * izm_tovar - Изменение товара (Страница товары)
 * del_tovar - Удаление товара (Страница товары)
 * del_find_tovar - Удаление найденного товара (Страница поиск товары)
 * prinyat_tovar - Принятие товара и запись в историю (Страница товары)
 * prodat_tovar - Продажа товара и запись в историю (Страница товары)
 *
 * В ПУТИ
 * izm_way - Изменение товара в пути (Страница В пути)
 * del_way - Удаление товара в пути (Страница В пути)
 * add_way - Добавлние товара в пути (Страница В пути)
 *
 * ОЧИЩЕНИЕ СТАРЫХ ОСТАТКОВ
 * del_long_time_tovar - Удаление товара который давно выставлен (Страница В пути)
 *
 * ПРИХОД
 * add_prihod - Добавлние прихода (Страница Приход)
 * del_prihod - Удаление прихода (Страница Приход)
 * izm_prihod - Изменение прихода (Страница Приход)
 *
 * РАСХОД
 * add_rashod - Добавление расхода (Страница расход)
 * del_rashod - Удаление расхода (Страница расход)
 * izm_rashod - Изменение расхода (Страница расход)
 *
 * МАГАЗИНЫ
 * add_magaz - Добавление магазина (Станица справочники.магазины)
 * izm_magaz - Изменение магазина (Страница справочники.магазины)
 * del_magaz - Удаление магазина (Страница справочники.магазины)
 *
 * СТАТУСЫ ЗАКАЗЫ
 * izm_status - Изменение статуса заказа (Страница справочники.статусы заказы)
 * add_status - Добавление статуса заказа (Станица справочники.статусы заказы)
 * del_status - Удаление статуса заказа (Станица справочники.статусы заказы)
 *
 * СТАТУСЫ ПРИХОД
 * izm_status_pr - Изменения статуса приход (Станица справочники.статусы приход)
 * add_status_pr - Добавление статуса прихода (Страница справочники.статусы приход)
 * del_status_pr - Удаление статуса прихода (Страница справочники.статусы приход)
 *
 * СТАТУСЫ РАСХОД
 * izm_status_rs - Изменения статуса расход (Станица справочники.статусы расход)
 * add_status_rs - Добавление статуса расход (Страница справочники.статусы расход)
 * del_status_rs - Удаление статуса расход (Страница справочники.статусы расход)
 *
 * ДОСТАВКА
 * izm_dostavka - Изменение службы доставки (Страница справочники.служба доставки)
 * add_dostavka - Добавление службы доставки (Страница справочники.служба доставки)
 * del_dostavka - Удаление службы доставки (Страница справочники.служба доставки)
 *
 * ПОСТАВЩИКИ
 * izm_potavshiki - Изменение поставщиков (Страница справочники.поставщики)
 * add_potavshiki - Добавление поставщика (Страница справочники.поставщики)
 * del_potavshiki - Удаление поставщика (Страница справочники.поставщики)
 *
 * ВАЛЮТА
 * izm_money - Изменение валюты (Страница справочники.валюта)
 * add_money - Добавление валюты (Страница справочники.валюта)
 * del_money - Удаление валюты (Страница справочники.валюта)
 *
 * СОТРУДНИКИ
 * izm_user - Изменить данные сотрудника (Страница сотрудники)
 * add_user - Добавить нового сотрудника (Страница сотрудники)
 * del_user - Удалить сотрудника (Страница сотрудники)
 */
class App
{


// зачистка переменной
    public function Clear($value){
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = trim($value);
        return $value;
    }

// переход на страницу
    public function goWay($way,$message){
        // если переданно сообщение, то выводим его, а потом делаем переадресацию
        if (!empty($message)) {
            exit("<html><head><meta http-equiv='Refresh' content='2; URL=admin/../".$way.".php'></head><body><center><br><br><br><h3><font color='red'>".$message."</font></h3></center></body></html>");
        }
        if (empty($message)) {
            exit("<html><head><meta http-equiv='Refresh' content='0; URL=admin/../".$way.".php'></head></html>");
        }
    }

// переход на страницу
    public function goWayClass($way){
            exit("<html><head><meta http-equiv='Refresh' content='0; URL=admin/../../".$way.".php'></head></html>");
    }

// переход на страницу с параметрами
    public function goWayClassParams($way,$params){
        exit("<html><head><meta http-equiv='Refresh' content='0; URL=admin/../../".$way.".php?".$params."'></head></html>");
    }

// ЭКШЕНЫ
    public function get_action($action){

        $id = $_REQUEST['id']; // айдишник
        $this->Clear($id);
        global $pdo; // Делаем PDO глобальным, для того чтобы видеть ее везде
        $pdo = new Database();

/**
 * Начальная страница
 */
// Создание пользователя, если в системе нет не единого пользователя
        if ( $action == 'create_user' ) {
            $new_user_name = $_POST['name'];
            $new_user_login = $_POST['login'];
            $new_user_password = $_POST['password'];
            $role = 3;
            $profes = 'Директор';
            $pdo->insertRow("INSERT INTO `users_8897532` (`name`,`login`,`password`,`role`,`profes`) VALUES (?,?,?,?,?) ", [$new_user_name,$new_user_login,$new_user_password,$role,$profes]);
            $this->goWayClass('index');
        }

/**
 * Страницы ЗАКАЗЫ
 */
// Удаление заказа (Страницы заказы)
        if ( $action == 'del_zakaz' ) {

            $pdo->deleteRow("DELETE FROM `priem` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_priem` WHERE `id_zakaz` = ?",[$id]);
            $this->goWayClass('index');

        }

// Изменение заказа (Страница заказы)
        if ( $action == 'izm_zakaz' ) {

            $fio = $_REQUEST['fio']; // имя заказчика
            $phone = $_REQUEST['phone']; // номер телефона заказчика
            $adress = $_REQUEST['adress']; // адрес доставки
            $status = $_REQUEST['status']; //
            $datatime = date("Y-m-d H:i:s"); // формирование даты создания заказа
            $user_name = $_REQUEST['user_name']; // имя менеджера, который закрыл заказ
            $kolvo = $_REQUEST['kolvo']; // количество купленного товара
            $id = $_REQUEST['id']; // айди товара

            // выборка с целью заполучения названия статуса
            $sql_get_status = $pdo->getRows("SELECT * FROM `status` WHERE `id` = '$status' LIMIT 1 ");
            foreach ($sql_get_status as $data_get_device2) {
                $name_status = $data_get_device2['name'];
            }
            // если статус равен 29(Тобишь закрыт)
            if ( $status == '29' ) {
                // в заказах выбираем id товара
                $tovar = $pdo->getRow("SELECT * FROM `priem` WHERE `id` = ? ",[$id]);
                // по id товара получаем всю инфу о товаре
                $k_old = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?",[$tovar['tovar']]);
                $prihod = $k_old['chena_output'] * $kolvo; // считаем выручку от продажи
                $k_new = $k_old['kolvo'] - $kolvo; // получаем остаток товара
                // подготавливаем строку для комментария
                $text_komment = 'Клиент - Имя: '.$fio.' Тел: '.$phone.' Адрес: '.$adress.' Товар: <a href=../product.php?id='.$k_old['id'].' target="_blank">'.$k_old['name'].'</a>'; // запись коммента о продажи
                // обновляем остатки новым количеством
                $pdo->updateRow("UPDATE `tovar` SET `kolvo` = ? WHERE `id` = ? ",[$k_new,$tovar['tovar']]);
                // в приход добавляем деньги вырученные от продажи
                $pdo->insertRow("INSERT INTO `prihod` (`cash1`,`datatime`,`manager`,`statya`,`komment`) VALUES (?,?,?,?,?)",[$prihod,$datatime,$user_name,'Продажа интернет',$text_komment]); // запись выручки от продажи в приход

            }
            $pdo->updateRow("UPDATE `priem` SET `phone`='$phone',`fio`='$fio',`adress`='$adress',`status`='$name_status',`color`='$status',`user_name`='$user_name' WHERE `id`='$id' ");
            $pdo->insertRow("INSERT INTO `log_priem` (`id_zakaz`,`datatime`,`meneger`,`status`,`fio`,`phone`,`adress`) VALUES ('$id','$datatime','$user_name','$name_status','$fio','$phone','$adress')");
            $this->goWayClass('index');
        }


// !!! Убрал, теперь добавление заказа, через товары Добавление заказа (Страница заказы)
        if ( $action == 'add_zakaz' ) {
//
//            $phone = $_REQUEST['phone'];
//            $fio = $_REQUEST['fio'];
//            $adress = $_REQUEST['adress'];
//            $user_name = $_REQUEST['user_name'];
//            $user_sc = $_REQUEST['sklad'];
//            $tovar = $_REQUEST['tovar'];
//            $status = $_REQUEST['status'];
//            $datatime = date("Y-m-d H:i:s");
//            $dostavka = $_REQUEST['dostavka'];
//            $postavshik = $_REQUEST['postavshik'];
//
//            $sql = $pdo->getRows("SELECT * FROM `status` WHERE `id` = '$status' LIMIT 1 ");
//            foreach ($sql as $data_get_device2):
//                $name_status = $data_get_device2['name'];
//            endforeach;
//            // добавление заказа и получение его ключа
//            $id_zakaza = $pdo->lastInsertId("INSERT INTO `priem` (`phone`,`fio`,`adress`,`user_name`,`datatime`,`sklad`,`tovar`,`status`,`color`,`dostavka`,`postavshik`) VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$phone,$fio,$adress,$user_name,$datatime,$user_sc,$tovar,$name_status,$status,$dostavka,$postavshik]);
//            // добавление в Лог заказа
//            $pdo->insertRow("INSERT INTO `log_priem` (`id_zakaz`,`datatime`,`meneger`,`status`,`komment`,`fio`,`phone`,`adress`,`dostavka`,`store`,`postavshik`) VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$id_zakaza,$datatime,$user_name,$name_status,$tovar,$fio,$phone,$adress,$dostavka,$user_sc,$postavshik]);
//            // добавление в базу клиентов
//            $pdo->insertRow("INSERT INTO `klient` (`name`,`phone`,`adress`) VALUES (?,?,?) ", [$fio,$phone,$adress]);
//            $this->goWayClass('index');
        }

/**
 * Страницы ТОВАРЫ
 */

// Добавление категории (Страница товары)
        if ( $action == 'add_categor' ) {

            // получаем название категрии
            $name = $_POST['name'];

            // вносим новую в базу категорию
            $pdo = new Database();
            $pdo->insertRow("INSERT INTO `categor` (`name`) VALUES (?)",[$name]);

            // делаем переход на страницу товары
            $this->goWayClass('products');

        }

// Добавление товара (Страница товары)
        if ( $action == 'add_tovar' ) {

            $uploadfile = "../../foto_tovar/" . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
            $dbfile = "foto_tovar/" . $_FILES['foto']['name'];
            $name = $_POST['name']; // наименование
            $article = $_POST['article']; // артикул товара
            $model = $_POST['model']; // страна производитель
            $chena_input = $_POST['chena_input']; // цена закупки
            $chena_output = $_POST['chena_output']; // цена продажи
            $komment = $_POST['komment']; // описание товара
            $status = $_POST['status']; // витрина (да, нет)
            $datatime = date("Y-m-d H:i:s"); // дата добавления товара
            $id_categor = $_POST['categor_id']; // ключ категории
            $user_id = $_POST['user_id']; // айдишник пользователя, который добавляет товар
            $shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина

            // вносим новый товар в категорию
            $id_tovara = $pdo->lastInsertId("
INSERT INTO `tovar` (
`categor_id`,
`name`,
`model`,
`chena_input`,
`chena_output`,
`komment`,
`status`,
`datatime`,
`user_id`,
`image`,
`article`) 
VALUES (
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?)", [$id_categor, $name, $model, $chena_input, $chena_output, $komment, $status, $datatime, $user_id, $dbfile, $article]);





/**
    * Выгрузка в группу одноклассников
    * $params   - Выгрузка картинки
    * $message  - Выгрузка комментария к ней
*/

// Параметры
$ok_access_token    = $shop['token'];  // Наш вечный токен
$ok_private_key     = $shop['private_key'];  // Секретный ключ приложения
$ok_public_key      = $shop['public_key'];  // Публичный ключ приложения
$ok_group_id        = $shop['id_ok_group'];  // ID нашей группы
$message            = $name.' Цена: '.$chena_output.'руб. '.$komment.' Артикул товара: '.$article. ' Заказать можно тут: https://vitashopik.ru/product.php?id='.$id_tovara; // текст для выгрузки

// Запрос
            function getUrl($url, $type = "GET", $params = array(), $timeout = 30, $image = false, $decode = true)
            {
                if ($ch = curl_init())
                {
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, false);

                    if ($type == "POST")
                    {
                        curl_setopt($ch, CURLOPT_POST, true);

                        // Картинка
                        if ($image) {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                        }
                        // Обычный запрос
                        elseif($decode) {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
                        }
                        // Текст
                        else {
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                        }
                    }

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                    $data = curl_exec($ch);

                    curl_close($ch);

                    // Еще разок, если API завис
                    if (isset($data['error_code']) && $data['error_code'] == 5000) {
                        $data = getUrl($url, $type, $params, $timeout, $image, $decode);
                    }

                    return $data;

                }
                else {
                    return "{}";
                }
            }

// Массив аргументов в строку
            function arInStr($array)
            {
                ksort($array);

                $string = "";

                foreach($array as $key => $val) {
                    if (is_array($val)) {
                        $string .= $key."=".arInStr($val);
                    } else {
                        $string .= $key."=".$val;
                    }
                }

                return $string;
            }

// 1. Получим адрес для загрузки 1 фото

            $params = array(
                "application_key"   =>  $ok_public_key,
                "method"            => "photosV2.getUploadUrl",
                "count"             => 1,  // количество фото для загрузки
                "gid"               => $ok_group_id,
                "format"            =>  "json"
            );

// Подпишем запрос
            $sig = md5( arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

            $params['access_token'] = $ok_access_token;
            $params['sig']          = $sig;

// Выполним
            $step1 = json_decode(getUrl("https://api.ok.ru/fb.do", "POST", $params), true);

// Если ошибка
            if (isset($step1['error_code'])) {
                // Обработка ошибки
                var_dump($step1);
                //exit();
            }

// Идентификатор для загрузки фото
            $photo_id = $step1['photo_ids'][0];

// 2. Закачаем фотку

// Предполагается, что картинка располагается в каталоге со скриптом
            //$params = array(
            //    "pic1" => "@testpic.jpg",
            //);

            $params = array(
                "pic1" => new \CURLFile("../../foto_tovar/" . $_FILES['foto']['name']),
            );

// Отправляем картинку на сервер, подписывать не нужно
            $step2 = json_decode( getUrl( $step1['upload_url'], "POST", $params, 30, true), true);

// Если ошибка
            if (isset($step2['error_code'])) {
                // Обработка ошибки
                exit();
            }

// Токен загруженной фотки
            $token = $step2['photos'][$photo_id]['token'];

// Заменим переносы строк, чтоб не вываливалась ошибка аттача
            $message_json = str_replace("\n", "\\n", $message);

// 3. Запостим в группу
            $attachment = '{
                    "media": [
                        {
                            "type": "text",
                            "text": "'.$message_json.'"
                        },
                        {
                            "type": "photo",
                            "list": [
                                {
                                    "id": "'.$token.'"
                                }
                            ]
                        }
                    ]
                }';

            $params = array(
                "application_key"   =>  $ok_public_key,
                "method"            =>  "mediatopic.post",
                "gid"               =>  $ok_group_id,
                "type"              =>  "GROUP_THEME",
                "attachment"        =>  $attachment,
                "format"            =>  "json",
            );

// Подпишем
            $sig = md5( arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

            $params['access_token'] = $ok_access_token;
            $params['sig']          = $sig;

            $step3 = json_decode( getUrl("https://api.ok.ru/fb.do", "POST", $params, 30, false, false ), true);

// Если ошибка
            if (isset($step3['error_code'])) {
                // Обработка ошибки
                exit();
            }

// Успешно
echo 'OK';




/**
    * Выгрузка в Instagram
    * $dest   - Выгрузка картинки
    * $caption  - Выгрузка комментария к ней
    * $username - Логин инстаграмма
    * $password - Пароль инстаграмма
*/

// Парметры
    $caption = $name.' цена: '.$chena_output.'руб. '.$komment.' Артикул: '.$article; // текст выгрузки в инстаграмм


//СОЗДАНИЕ КВАДРАТНОГО ИЗОБРАЖЕНИЯ И ЕГО ПОСЛЕДУЮЩЕЕ СЖАТИЕ ВЗЯТО С САЙТА www.codenet.ru

// Создание квадрата 90x90
// dest - результирующее изображение
// w - ширина изображения
// ratio - коэффициент пропорциональности

// квадратная 90x90. Можно поставить и другой размер.

// создаём исходное изображение на основе
// исходного файла и определяем его размеры
$im = imagecreatefromjpeg("../../foto_tovar/" . $_FILES['foto']['name']); //если оригинал был в формате jpg, то создаем изображение в этом же формате. Необходимо для последующего сжатия
$w_src = imagesx($im); //вычисляем ширину
$h_src = imagesy($im); //вычисляем высоту изображения

// создаём пустую квадратную картинку
// важно именно truecolor!, иначе будем иметь 8-битный результат
$dest = imagecreatetruecolor($w, $h);

// вырезаем квадратную серединку по x, если фото горизонтальное
if ($w_src > $h_src) {
    $w = 1200;
    $h = 1200;
    $dest = imagecreatetruecolor($w, $h);
    imagecopyresampled($dest, $im, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src)) / 2), 0, $w, $h, min($w_src, $h_src), min($w_src, $h_src));
}

// вырезаем квадратную верхушку по y,
// если фото вертикальное (хотя можно тоже серединку)
if ($w_src < $h_src) {
    $w = 1200;
    $h = 1200;
    $dest = imagecreatetruecolor($w, $h);
    imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, min($w_src, $h_src), min($w_src, $h_src));
}

// квадратная картинка масштабируется без вырезок
if ($w_src == $h_src) {
    $w = 1200;
    $h = 1200;
    $dest = imagecreatetruecolor($w, $h);
    imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $h, $w_src, $w_src);
}
    imagejpeg($dest, "../../foto_tovar/instagram.jpg"); //сохраняем изображение формата jpg в нужную папку, именем будет текущее время. Сделано, чтобы у аватаров не было одинаковых имен.






// ОТПРАВКА В ИНСТАГРАММ
function SendRequest($url, $post, $post_data, $user_agent, $cookies)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://instagram.com/api/v1/' . $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        if ($cookies) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
        } else {
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
        }
    $response = curl_exec($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($http, $response);
}

function GenerateGuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function GenerateUserAgent() {
    $resolutions = array('720x1280', '320x480', '480x800', '1024x768', '1280x720', '768x1024', '480x320');
    $versions = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');
    $dpis = array('120', '160', '320', '240');
    $ver = $versions[array_rand($versions)];
    $dpi = $dpis[array_rand($dpis)];
    $res = $resolutions[array_rand($resolutions)];
    return 'Instagram 4.' . mt_rand(1, 2) . '.' . mt_rand(0, 2) . ' Android (' . mt_rand(10, 11) . '/' . mt_rand(1, 3) . '.' . mt_rand(3, 5) . '.' . mt_rand(0, 5) . '; ' . $dpi . '; ' . $res . '; samsung; ' . $ver . '; ' . $ver . '; smdkc210; en_US)';
}

function GenerateSignature($data) {
    return hash_hmac('sha256', $data, 'b4a23f5e39b5929e0666ac5de94c89d1618a2916');
}

function GetPostData($filename) {
    if (!$filename) {
        echo "The image doesn't exist " . $filename;
    } else {
        $cfile = curl_file_create($filename);
        $post_data = array('device_timestamp' => time(), 'photo' => $cfile);
        return $post_data;
    }
}

// Set the username and password of the account that you wish to post a photo to
    $username = $shop['instagram_login'];
    $password = $shop['instagram_password'];
// Set the caption for the photo
    //$caption = $name.' цена: '.$chena_output.'руб. '.$komment.' Артикул: '.$article;
// Set the path to the file that you wish to post.
// This must be jpeg format and it must be a perfect square
    $filename = "../../foto_tovar/instagram.jpg";
// Define the user agent
    $agent = GenerateUserAgent();
// Define the GuID
    $guid = GenerateGuid();
// Set the devide ID
    $device_id = "android-" . $guid;
            /* LOG IN */
// You must be logged in to the account that you wish to post a photo too
// Set all of the parameters in the string, and then sign it with their API key using SHA-256
    $data = '{"device_id":"' . $device_id . '","guid":"' . $guid . '","username":"' . $username . '","password":"' . $password . '","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
    $sig = GenerateSignature($data);
    $data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';
    $login = SendRequest('accounts/login/', true, $data, $agent, false);
        if (strpos($login[1], "Sorry, an error occurred while processing this request.")) {
            echo "Request failed, there's a chance that this proxy/ip is blocked";
        } else {
            if (empty($login[1])) {
                echo "Empty response received from the server while trying to login";
            } else {
                // Decode the array that is returned
                $obj = @json_decode($login[1], true);
                if (empty($obj)) {
                    // echo "Could not decode the response: " . $body;
                } else {
                    // Post the picture
                    $data = GetPostData($filename);
                    $post = SendRequest('media/upload/', true, $data, $agent, true);
                    if (empty($post[1])) {
                        echo "Empty response received from the server while trying to post the image";
                    } else {
                        // Decode the response
                        $obj = @json_decode($post[1], true);
                        var_dump($obj);
                        if (empty($obj)) {
                            echo "Could not decode the response";
                        } else {
                            $status = $obj['status'];
                            if ($status == 'ok') {
                                // Remove and line breaks from the caption
                                $caption = preg_replace("/\r|\n/", "", $caption);
                                $media_id = $obj['media_id'];
                                $device_id = "android-" . $guid;
                                $data = '{"device_id":"' . $device_id . '","guid":"' . $guid . '","media_id":"' . $media_id . '","caption":"' . trim($caption) . '","device_timestamp":"' . time() . '","source_type":"5","filter_type":"0","extra":"{}","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
                                $sig = GenerateSignature($data);
                                $new_data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';
                                // Now, configure the photo
                                $conf = SendRequest('media/configure/', true, $new_data, $agent, true);
                                if (empty($conf[1])) {
                                    echo "Empty response received from the server while trying to configure the image";
                                } else {
                                    if (strpos($conf[1], "login_required")) {
                                        echo "You are not logged in. There's a chance that the account is banned";
                                    } else {
                                        $obj = @json_decode($conf[1], true);
                                        $status = $obj['status'];
                                        if ($status != 'fail') {
                                            echo "Success";
                                        } else {
                                            echo 'Fail';
                                        }
                                    }
                                }
                            } else {
                                echo "Status isn't okay";
                            }
                        }
                    }
                }
            }
        }
    unlink("../../foto_tovar/instagram.jpg");

// делаем переход на страницу товары
$this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);
        }

// Удаление категории и товара в этой категории (Страницы товары)
        if ( $action == 'del_categor' ) {

            $pdo->deleteRow("DELETE FROM `categor` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `categor_id` = ?",[$id]);
            $this->goWayClass('products');

        }

// Изменение категории (Страница товары)
        if ( $action == 'izm_categor' ) {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $sort = $_POST['sort']; // цифра порядка сортировка вывода
            $pdo->updateRow("UPDATE `categor` SET `name` = ?, `sort` = ? WHERE `id` = ? ",[$name,$sort,$id]);
            $this->goWayClass('products');

        }

// Изменение товара (Страница товары)
        if ( $action == 'izm_tovar' ) {

            $article = $_POST['article']; // артикул товара
            $categor_id = $_POST['categor_id'];
            $name = $_POST['name'];
            $model = $_POST['model'];
            $chena_input = $_POST['chena_input'];
            $chena_output = $_POST['chena_output'];
            $komment = $_POST['komment'];
            $status = $_POST['status'];
            $id = $_POST['id'];
            $id_categor = $_POST['id_categor'];
            $money_input = $_POST['money_input'];
            $money_output = $_POST['money_output'];

            echo $article;

            $pdo->updateRow("UPDATE `tovar` SET
    `article` = ?,
	`name` = ?,
	`model` = ?,
	`chena_input` = ?,
	`chena_output` = ?,
	`money_input` = ?,
	`money_output` = ?,
	`komment` = ?,
	`categor_id` = ?,
	`status` = ?
	WHERE `id` = ? ",[$article,$name,$model,$chena_input,$chena_output,$money_input,$money_output,$komment,$categor_id,$status,$id]);

            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);

        }

// Удаление товара (Страница товары)
        if ( $action == 'del_tovar' ) {

            $id = $_GET['id']; // айдишник талона
            $id_categor = $_GET['categor'];
            $del_photo = $pdo->getRow("SELECT `image` FROM `tovar` WHERE `id` = ?",[$id]);
            unlink($del_photo);
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_rashod` WHERE `id_tovara` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_prihod` WHERE `id_tovara` = ?",[$id]);
            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);
        }

// Удаление найденного_товара (Страница поиск товара)
        if ( $action == 'del_find_tovar' ) {

            $id = $_GET['id']; // айдишник талона
            $del_photo = $pdo->getRow("SELECT `image` FROM `tovar` WHERE `id` = ?",[$id]);
            unlink($del_photo);
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_rashod` WHERE `id_tovara` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_prihod` WHERE `id_tovara` = ?",[$id]);
            $this->goWayClass('products');
        }

// Принятие товара и запись в историю (Страница товары)
        if ( $action == 'prinyat_tovar' ) {

            $id_tovara = $_POST['id']; // айдишник товара
            $kolvo = $_POST['kolvo']; // количество товара
            $chena = $_POST['chena']; // цена товара
            $postavshik = $_POST['postavshik'];
            $komment = $_POST['komment'];
            $datatime = date("Y-m-d H:i:s");
            $id_categor = $_POST['id_categor'];
            $user_name = $_POST['user_name'];

            $sql_get_kolvo = $pdo->getRows(" SELECT * FROM `tovar` WHERE `id` = ?",[$id_tovara]);
            foreach ( $sql_get_kolvo as $data_kolvo ){
                $ostatok_tovara += $data_kolvo['kolvo']; // получение остатка товара
            }
            $vsego += $ostatok_tovara + $kolvo;

            $pdo->insertRow("INSERT INTO `log_prihod` (
	`id_tovara`,
	`kolvo`,
	`chena`,
	`postavshik`,
	`komment`,
	`datatime`,
	`meneger`
	) VALUES (
	?,
	?,
	?,
	?,
	?,
	?,
	?
	)",[$id_tovara,$kolvo,$chena,$postavshik,$komment,$datatime,$user_name]);
            if ( empty($chena) == true ) {
                // создание новой позиции товара
                $pdo->updateRow("UPDATE `tovar` SET `kolvo`= ? WHERE `id`= ? ",[$vsego,$id_tovara]);
            }

            if ( !empty($chena) == true ) {
                // при приходе товара
                $pdo->updateRow("UPDATE `tovar` SET `kolvo`= ?,`money_input`= ? WHERE `id`= ? ",[$vsego,$chena,$id_tovara]);
                $rashod = $kolvo * $chena; // расход денег на приход товара
                // формирование комметария к расходу
                $text_komment = '('.$kolvo.'шт.)Товара: <a href=../product.php?id='.$id_tovara.' target=_blank>'.$data_kolvo['name'].'</a> Поставщик: <a href=potavshiki.php>'.$postavshik.'</a>';
                // создание расхода
                $pdo->insertRow("INSERT INTO `rashod` (`datatime`,`cash1`,`manager`,`statya`,`komment`) VALUES (?,?,?,?,?)",[$datatime,$rashod,$user_name,'Приход товара',$text_komment]);
            }
            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);
        }

// Продажа товара и запись в историю (Страница товары)
        if ( $action == 'prodat_tovar' ) {


            $kolvo = $_POST['kolvo']; // количество продаваемого товара
            $prodavec = $_POST['user_name']; // кто продал
            $magazin = $_POST['magazin']; // с какого магазина проданно
            $komment = $_POST['komment']; // комментарий к продаже
            $nakladnaya = $_POST['nakladnaya']; //
            $nalogka = $_POST['nalogka'];
            $oplata = $_POST['oplata'];
            $id_categor = $_POST['id_categor'];
            $chena_input = $_POST['chena_input']; // 3 доллара
            $chena_output = $_POST['chena']; // 188 рублей
            $datatime = date("Y-m-d H:i:s");
            $valuta = $_POST['valuta'];
            $id_tovara = $_POST['id'];
            $user_name = $_POST['user_name'];

            $manager = $_POST['manager'];
            $prodaja = $kolvo*$chena_output; // продажа в нашей валюте
            $sql_get_kurs = $pdo->getRows(" SELECT * FROM `money` WHERE `name`= ?",[$valuta]);
            foreach ( $sql_get_kurs as $data_kurs ) {
                $kurs = $data_kurs['chena'];
            }
            // Курс валюты
            $prodaja_v_valute = $kolvo*$chena_input*$kurs;
            // Продажа в валюте
            $itogo = $prodaja-$prodaja_v_valute;
            // Итого навар (профит)
            $prifut = $itogo;

            $sql_get_kolvo = $pdo->getRows(" SELECT * FROM `tovar` WHERE `id`= ?",[$id_tovara]);
            foreach ( $sql_get_kolvo as $data_kolvo ) {
                $ostatok_tovara += $data_kolvo['kolvo']; // получение остатка товара
                $tovar_name = $data_kolvo['name']; // получение название товара
                $tovar_model = $data_kolvo['model']; // получение модели товара
            }

            $vsego += $ostatok_tovara - $kolvo;

            $pdo->insertRow("INSERT INTO `log_rashod` (
	`kolvo`,
	`prodavec`,
	`magazin`,
	`komment`,
	`nakladnaya`,
	`nalogka`,
	`chena`,
	`prifut`,
	`datatime`,
	`id_tovara`,
	`menedger`,
	`valuta`
	) VALUES (
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?
	)",[$kolvo,$prodavec,$magazin,$komment,$nakladnaya,$nalogka,$chena_output,$prifut,$datatime,$id_tovara,$user_name,$valuta]);

            $prihod = $kolvo*$chena_output; // деньги с продажи, кидаем их на приход
            $text_komment = 'Товар: <a href=../product.php?id='.$id_tovara.' target="_blank">'.$tovar_name.'</a>';

            if ( $oplata == 'Безнал' ) {
                $pdo->insertRow("INSERT INTO `prihod` (`cash1`,`datatime`,`manager`,`statya`,`komment`) VALUES (?,?,?,?,?)",[$prihod,$datatime,$user_name,'Продажа физически',$text_komment]); // запись выручки от продажи в приход
            }

            if ( $oplata == 'Наличка' ) {
                $pdo->insertRow("INSERT INTO `prihod` (`uah`,`datatime`,`manager`,`statya`,`komment`) VALUES (?,?,?,?,?)", [$prihod, $datatime, $user_name, 'Продажа физически', $text_komment]); // запись выручки от продажи в приход
            }

            $datatime; // время и дата
            $tovar = "модель: {$tovar_model} товар: {$tovar_name}"; // товар
            $primechanie = $komment; // товар
            $kolvo; // количество
            $chena = $chena_output;
            $profit = $prifut;
            $ttn = $nakladnaya;
            $komment;
            $magazin;
            $menedger = $user_name;
            $prodavec;


            if ($nalogka == "Да"){

                $pdo->insertRow("INSERT INTO `in_way` (
	`datatime`,
	`tovar`,
	`kolvo`,
	`chena`,
	`profit`,
	`ttn`,
	`komment`,
	`magazin`,
	`menedger`,
	`prodavec`
	) VALUES (
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?
	)",[$datatime,$tovar,$kolvo,$chena,$profit,$ttn,$primechanie,$magazin,$menedger,$prodavec]);
            }

            $pdo->updateRow("UPDATE `tovar` SET `kolvo`= ? WHERE `id`= ? ",[$vsego,$id_tovara]);


            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);

        }

/**
* Страницы В ПУТИ
*/


// Изменение товара в пути (Страница В пути)
        if ( $action == 'izm_way' ) {


            $id = $_POST['id'];
            $tovar = $_POST['tovar'];
            $kolvo = $_POST['kolvo'];
            $chena = $_POST['chena'];
            $profit = $_POST['profit'];
            $ttn = $_POST['ttn'];
            $komment = $_POST['komment'];
            $magazin = $_POST['magazin'];
            $menedger = $_POST['menedger'];
            $prodavec = $_POST['prodavec'];
            $datatime = date("Y-m-d H:i:s");

            $pdo->updateRow("UPDATE `in_way` SET 
	`tovar` = ?,
	`kolvo` = ?,
	`chena` = ?,
	`profit` = ?,
	`ttn` = ?,
	`komment` = ?,
	`magazin` = ?,
	`menedger` = ?,
	`prodavec` = ?,
	`datatime` = ? 
	WHERE `id` = '$id' ",[$tovar,$kolvo,$chena,$profit,$ttn,$komment,$magazin,$menedger,$prodavec,$datatime]);

            $this->goWayClass('way');
        }

// Удаление товара в пути (Страница В пути)
        if ( $action == 'del_way' ) {

            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `in_way` WHERE `id` = ?",[$id]);
            $this->goWayClass('way');
        }

// Добавлние товара в пути (Страница В пути)
        if ( $action == 'add_way' ) {

            $tovar = $_POST['tovar'];
            $kolvo = $_POST['kolvo'];
            $chena = $_POST['chena'];
            $profit = $_POST['profit'];
            $ttn = $_POST['ttn'];
            $komment = $_POST['komment'];
            $menedger = $_POST['user_name'];
            $magazin = $_POST['magazin'];
            $prodavec = $_POST['prodavec'];
            $datatime = date("Y-m-d H:i:s");

            $pdo->insertRow("INSERT INTO `in_way` (
	`datatime`,
	`tovar`,
	`kolvo`,
	`chena`,
	`profit`,
	`ttn`,
	`komment`,
	`magazin`,
	`menedger`,
	`prodavec`
	) VALUES (
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?
	)",[$datatime,$tovar,$kolvo,$chena,$profit,$ttn,$komment,$magazin,$menedger,$prodavec]);
            $this->goWayClass('way');
        }

// Удаление стараго товара (Страница "остатки")
        if ( $action == 'del_long_time_tovar' ) {

            $id = $_GET['id']; // айдишник товара
            $del_photo = $pdo->getRow("SELECT `image` FROM `tovar` WHERE `id` = ?",[$id]);
            unlink($del_photo);
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_rashod` WHERE `id_tovara` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_prihod` WHERE `id_tovara` = ?",[$id]);
            $this->goWayClass('long_time_product');
        }

/**
* Страницы В ПУТИ
*/

// Добавлние прихода (Страница Приход)
        if ( $action == 'add_prihod' ) {

            $status = $_POST['status'];
            $komment = $_POST['komment'];
            $uah = $_POST['uah'];
            $usd = $_POST['usd'];
            $eur = $_POST['eur'];
            $cash1 = $_POST['cash1'];
            $cash2 = $_POST['cash2'];
            $cash3 = $_POST['cash3'];
            $cash4 = $_POST['cash4'];
            $cash5 = $_POST['cash5'];
            $cash6 = $_POST['cash6'];
            $datatime = date("Y-m-d H:i:s");
            $name = $_POST['user_name'];
            $pdo->insertRow("INSERT INTO `prihod` (
`statya`,
`komment`,
`uah`,
`usd`,
`eur`,
`cash1`,
`cash2`,
`cash3`,
`cash4`,
`cash5`,
`cash6`,
`datatime`,
`manager`) VALUES (
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?)",[$status,$komment,$uah,$usd,$eur,$cash1,$cash2,$cash3,$cash4,$cash5,$cash6,$datatime,$name]);
            $this->goWayClass('prihod');
            }

// Удаление прихода (Страница Приход)
        if ( $action == 'del_prihod' ) {

            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `prihod` WHERE `id` = ?",[$id]);
            $this->goWayClass('prihod');
        }

// Изменение прихода (Страница Приход)
        if ( $action == 'izm_prihod' ) {

            $status = $_POST['status'];
            $komment = $_POST['komment'];
            $uah = $_POST['uah'];
            $usd = $_POST['usd'];
            $eur = $_POST['eur'];
            $cash1 = $_POST['cash1'];
            $cash2 = $_POST['cash2'];
            $cash3 = $_POST['cash3'];
            $cash4 = $_POST['cash4'];
            $cash5 = $_POST['cash5'];
            $cash6 = $_POST['cash6'];
            $datatime = date("Y-m-d H:i:s");
            $name = $_POST['user_name'];
            $id = $_POST['id'];
            $pdo->updateRow(" UPDATE `prihod` SET 
 `statya`= ?,
 `komment`= ?,
 `uah`= ?,
 `usd`= ?,
 `eur`= ?,
 `cash1`= ?,
 `cash2`= ?,
 `cash3`= ?,
 `cash4`= ?,
 `cash5`= ?,
 `cash6`= ?,
 `manager`= ? WHERE `id`= ? ",[$status,$komment,$uah,$usd,$eur,$cash1,$cash2,$cash3,$cash4,$cash5,$cash6,$name,$id]);

            $this->goWayClass('prihod');
        }

/**
* Страницы РАСХОД
*/


// Добавление расхода (Страница Расход)
        if ( $action == 'add_rashod' ) {

            $status = $_POST['status'];
            $komment = $_POST['komment'];
            $uah = $_POST['uah'];
            $usd = $_POST['usd'];
            $eur = $_POST['eur'];
            $cash1 = $_POST['cash1'];
            $cash2 = $_POST['cash2'];
            $cash3 = $_POST['cash3'];
            $cash4 = $_POST['cash4'];
            $cash5 = $_POST['cash5'];
            $cash6 = $_POST['cash6'];
            $datatime = date("Y-m-d H:i:s");
            $name = $_POST['user_name'];
            $pdo->insertRow("INSERT INTO `rashod` (
`statya`,
`komment`,
`uah`,
`usd`,
`eur`,
`cash1`,
`cash2`,
`cash3`,
`cash4`,
`cash5`,
`cash6`,
`datatime`,
`manager`) VALUES (
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?)",[$status,$komment,$uah,$usd,$eur,$cash1,$cash2,$cash3,$cash4,$cash5,$cash6,$datatime,$name]);
            $this->goWayClass('rashod');
        }

// Удаление расхода (Страница Расход)
        if ( $action == 'del_rashod' ) {

            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `rashod` WHERE `id` = ?",[$id]);
            $this->goWayClass('rashod');
        }

// Изменение расхода (Страница Расход)
        if ( $action == 'izm_rashod' ) {

            $status = $_POST['status'];
            $komment = $_POST['komment'];
            $uah = $_POST['uah'];
            $usd = $_POST['usd'];
            $eur = $_POST['eur'];
            $cash1 = $_POST['cash1'];
            $cash2 = $_POST['cash2'];
            $cash3 = $_POST['cash3'];
            $cash4 = $_POST['cash4'];
            $cash5 = $_POST['cash5'];
            $cash6 = $_POST['cash6'];
            $datatime = date("Y-m-d H:i:s");
            $name = $_POST['user_name'];
            $id = $_POST['id'];
            $pdo->updateRow(" UPDATE `rashod` SET 
 `statya`= ?,
 `komment`= ?,
 `uah`= ?,
 `usd`= ?,
 `eur`= ?,
 `cash1`= ?,
 `cash2`= ?,
 `cash3`= ?,
 `cash4`= ?,
 `cash5`= ?,
 `cash6`= ?,
 `manager`= ? WHERE `id`= ? ",[$status,$komment,$uah,$usd,$eur,$cash1,$cash2,$cash3,$cash4,$cash5,$cash6,$name,$id]);

            $this->goWayClass('rashod');
        }

/**
* Страницы МАГАЗИНЫ
*/

// Добавление магазина (Станица справочники.магазины)
        if ( $action == 'add_magaz') {

            $name = $_POST['name']; // Название магазина
            $komment = $_POST['komment']; // Комментарий, если требуется
            $pdo->insertRow("INSERT INTO `magazins` (`name`,`komment`) VALUES (?,?)",[$name,$komment]);
            $this->goWayClass('magazins');
        }

// Изменение магазина (Страница справочники.магазины)
        if ( $action == 'izm_magaz') {

            $name = $_POST['name']; // Название магазина
            $id = $_POST['id']; // айдишник магазина
            $phone = $_POST['phone']; // Номер телефона магазина
            $email = $_POST['email']; // Электронная почта
            $komment = $_POST['komment']; // Комментарий магазина
            $idokgroup = $_POST['idokgroup']; // ID группы в одноклассниках
            $reklama = $_POST['reklama']; // показ рекламы ('Да' или 'Нет')
            $instagram_login = $_POST['instagramlogin']; // логин инстаграмм
            $instagram_password = $_POST['instagrampassword']; // пароль инстаграмм
            $token = $_POST['token'];
            $private_key = $_POST['private_key'];
            $public_key = $_POST['public_key'];
            $time_day = $_POST['time_day'];
            $pdo->updateRow("UPDATE `magazins` SET `name` = ?,`phone` = ?, `email` = ?,`id_ok_group` = ?,`komment`= ?, `reklama` = ?, `instagram_login` = ?, `instagram_password` = ?, `token` = ?, `private_key` = ?, `public_key` = ?,`time_day` = ?  WHERE `id` = ? ",[$name,$phone,$email,$idokgroup,$komment,$reklama,$instagram_login,$instagram_password,$token,$private_key,$public_key,$time_day,$id]);
            $this->goWayClass('magazins');
        }

// Удаление магазина (Страница справочники.магазины)
        if ( $action == 'del_magaz' ) {

            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `magazins` WHERE `id` = ?",[$id]);
            $this->goWayClass('magazins');
        }


/**
* Страницы СТАТУСЫ (заказы)
*/


// Изменение статуса (Страница справочники.статусы заказы)
        if ( $action == 'izm_status' ) {

            $name = $_POST['name'];
            $color = $_POST['color'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];
            $sort = $_POST['sort'];

            if ($color == "#FFFFFF") {
                $name_color = "Без цвета";
            }
            if ($color == "#45B5B3") {
                $name_color = "Синий";
            }
            if ($color == "#45B562") {
                $name_color = "Зеленый";
            }
            if ($color == "#E7D627") {
                $name_color = "Желтый";
            }
            if ($color == "#CC3E43") {
                $name_color = "Красный";
            }
            if ($color == "#CCC9CF") {
                $name_color = "Серый";
            }
            if ($color == "#FF7400") {
                $name_color = "Оранжевый";
            }
            if ($color == "#FF0096") {
                $name_color = "Розовый";
            }
            if ($color == "#CDEB8B") {
                $name_color = "Салатовый";
            }

            $pdo->updateRow("UPDATE `status` SET `name` = ?,`color` = ?,`name_color` = ?,`komment`= ?, `sort`= ? WHERE `id` = ? ",[$name,$color,$name_color,$komment,$sort,$id]);
            $this->goWayClass('status');
        }

// Добавление статуса (Страница справочниики.статусы заказы)
        if ( $action == 'add_status' ) {

            $name = $_POST['name'];
            $color = $_POST['color'];
            $komment = $_POST['komment'];
            $sort = $_POST['sort'];

            if ($color == "#FFFFFF") {
                $name_color = "Без цвета";
            }
            if ($color == "#45B5B3") {
                $name_color = "Синий";
            }
            if ($color == "#45B562") {
                $name_color = "Зеленый";
            }
            if ($color == "#E7D627") {
                $name_color = "Желтый";
            }
            if ($color == "#CC3E43") {
                $name_color = "Красный";
            }
            if ($color == "#CCC9CF") {
                $name_color = "Серый";
            }
            if ($color == "#FF7400") {
                $name_color = "Оранжевый";
            }
            if ($color == "#FF0096") {
                $name_color = "Розовый";
            }
            if ($color == "#CDEB8B") {
                $name_color = "Салатовый";
            }

            $pdo->insertRow("INSERT INTO `status` (`name`,`color`,`name_color`,`komment`,`sort`) VALUES (?,?,?,?,?)",[$name,$color,$name_color,$komment,$sort]);
            $this->goWayClass('status');
        }

// Удаление статуса (Страница справочниики.статусы заказы)
        if ( $action == 'del_status' ) {

            $id = $_REQUEST['id']; // айдишник статуса
            $pdo->deleteRow("DELETE FROM `status` WHERE `id` = ? ",[$id]);
            $this->goWayClass('status');
        }

/**
* Страницы СТАТУСЫ (приходы)
*/

// Изменение статуса прихода (Страница справочники.статусы приход)
        if ( $action == 'izm_status_pr' ) {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];

            $pdo->updateRow("UPDATE `status_pr` SET `name` = ?,`komment`= ? WHERE `id` = ? ",[$name,$komment,$id]);
            $this->goWayClass('status_pr');
        }

// Добавление статуса прихода (Страница справочники.статусы приход)
        if ( $action == 'add_status_pr' ) {

            $name = $_POST['name'];
            $komment = $_POST['komment'];

            $pdo->insertRow("INSERT INTO `status_pr` (`name`,`komment`) VALUES (?,?)",[$name,$komment]);
            $this->goWayClass('status_pr');
        }

// Удаление статуса прихода (Страница справочники.статусы приход)
        if ( $action == 'del_status_pr' ) {

            $id = $_REQUEST['id']; // айдишник статуса прихода
            $pdo->deleteRow("DELETE FROM `status_pr` WHERE `id` = ?",[$id]);
            $this->goWayClass('status_pr');
        }

/**
* Страницы СТАТУСЫ (расходы)
*/

// Изменение статуса прихода (Страница справочники.статусы приход)
        if ( $action == 'izm_status_rs' ) {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];

            $pdo->updateRow("UPDATE `status_rs` SET `name` = ?,`komment`= ? WHERE `id` = ? ",[$name,$komment,$id]);
            $this->goWayClass('status_rs');
        }

// Добавление статуса расхода (Страница справочники.статусы расход)
        if ( $action == 'add_status_rs' ) {

            $name = $_POST['name'];
            $komment = $_POST['komment'];

            $pdo->insert("INSERT INTO `status_rs` (`name`,`komment`) VALUES (?,?)",[$name,$komment]);
            $this->goWayClass('status_rs');
        }

// Удаление статуса расхода (Страница справочники.статусы расход)
        if ( $action == 'del_status_rs' ) {

            $id = $_REQUEST['id']; // айдишник статуса прихода
            $pdo->deleteRow("DELETE FROM `status_rs` WHERE `id` = ?",[$id]);
            $this->goWayClass('status_rs');
        }

/**
* Страницы СЛУЖБЫ ДОСТАВКИ
*/

// Добавление службы доставки (Страница справочники.служба доставки)
        if ( $action == 'add_dostavka' ) {

            $name = $_POST['name'];
            $komment = $_POST['komment'];

            $pdo->insertRow("INSERT INTO `dostavka` (`name`,`komment`) VALUES (?,?)",[$name,$komment]);
            $this->goWayClass('dostavka');
        }

// Изменение службы доставки (Страница справочники.служба доставки)
        if ( $action == 'izm_dostavka' ) {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];

            $pdo->updateRow("UPDATE `dostavka` SET `name` = ?,`komment`= ? WHERE `id` = ? ",[$name,$komment,$id]);
            $this->goWayClass('dostavka');
        }

// Удаление службы доставки (Страница справвочники.служба доставки)
        if ( $action == 'del_dostavka' ) {

            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `dostavka` WHERE `id` = ? ",[$id]);
            $this->goWayClass('dostavka');
        }

/**
* Страницы ПОСТАВЩИКИ
*/

// Добавление поставщика (Страница справочники.поставщики)
        if ( $action == 'add_potavshiki') {

            $name = $_POST['name'];
            $komment = $_POST['komment'];

            $pdo->insertRow("INSERT INTO `postavshiki` (`name`,`komment`) VALUES (?,?)",[$name,$komment]);
            $this->goWayClass('potavshiki');
        }

// Изменение поставщика (Страница справочники.поставщики)
        if ( $action == 'izm_potavshiki') {

            $name = $_POST['name'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];

            $pdo->updateRow("UPDATE `postavshiki` SET `name` = ?,`komment`= ? WHERE `id` = ? ",[$name,$komment,$id]);
            $this->goWayClass('potavshiki');
        }

// Удаление поставщика (Страница справочники.поставщики)
        if ( $action == 'del_potavshiki') {

            $id = $_REQUEST['id']; // айдишник поставщика
            $pdo->deleteRow("DELETE FROM `postavshiki` WHERE `id` = ?",[$id]);
            $this->goWayClass('potavshiki');
        }

/**
* Страницы ВАЛЮТА
*/

// Изменение валюты (Страница справочники.валюта)
        if ( $action == 'izm_money' ) {

            $name = $_POST['name'];
            $chena = $_POST['chena'];
            $id = $_POST['id'];
            $komment = $_POST['komment'];

            $pdo->updateRow("UPDATE `money` SET 
	`name` = ?,
	`chena` = ?,
	`komment`= ?
	 WHERE `id` = ? ",[$name,$chena,$komment,$id]);

            $this->goWayClass('money');
        }

// Добавление валюты (Страница справочники.валюта)
        if ( $action == 'add_money' ) {

            $name = $_POST['name'];
            $chena = $_POST['chena'];
            $komment = $_POST['komment'];
            $pdo->insertRow("INSERT INTO `money` (`name`,`chena`,`komment`) VALUES (?,?,?)",[$name,$chena,$komment]);
            $this->goWayClass('money');
        }

// Удаление валюты (Страница справочники.валюта)
        if ( $action == 'del_money' ) {

            $id = $_REQUEST['id'];
            $pdo->deleteRow("DELETE FROM `money` WHERE `id` = ?",[$id]);
            $this->goWayClass('money');
        }

/**
* Страницы СОТРУДНИКИ
*/

// Изменение данных сотрудника (Страница сотрудники)
        if ( $action == 'izm_user' ) {

            $profes = $_POST['profes'];
            $u_name = $_POST['u_name'];
            $u_login = $_POST['u_login'];
            $u_password = $_POST['u_password'];
            $id = $_POST['id'];

            if ($profes == "Директор"){
                $role = '3';
            }
            if ($profes == "Администратор"){
                $role = '3';
            }
            if ($profes == "Менеджер"){
                $role = '1';
            }

            $pdo->updateRow("UPDATE `users_8897532` SET `role` = ?, `profes` = ?,`name` = ?,`login` = ?,`password` = ? WHERE `id` = ? ",[$role,$profes,$u_name,$u_login,$u_password,$id]);
            $this->goWayClass('users');
        }

// Добавление нового сотрудника (Страница сотрудники)
        if ( $action == 'add_user' ) {

            $profes = $_POST['profes'];
            $name = $_POST['name'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            if ($profes == "Директор")
            {
                $role = "3";
            }
            if ($profes == "Администратор")
            {
                $role = "3";
            }
            if ($profes == "Менеджер")
            {
                $role = "1";
            }

            $pdo->insertRow("INSERT INTO `users_8897532` (`profes`,`name`,`login`,`password`,`role`) VALUES (?,?,?,?,?)",[$profes,$name,$login,$password,$role]);
            $this->goWayClass('users');
        }

// Удаление сотрудника (Страница сотрудники)
        if ( $action == 'del_user') {
            $id = $_REQUEST['id'];

            $pdo->deleteRow("DELETE FROM `users_8897532` WHERE `id` = ?",[$id]);
            $this->goWayClass('exit');
        }


// classes/App.php
// <input type="hidden" name="action" value="add_magaz">
    }
}
// получениея экшена
$action = $_REQUEST['action'];
$act = new App();
// обработка сценария экшена
$act->get_action($action);