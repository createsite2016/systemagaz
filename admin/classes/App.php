<?php

include_once "Database.php"; // подключаем БД

/**
 * Класс всего приложения
 * Clear(%переменная) - обработка переменных перед запросом
 * goWay(%путь, %сообщение) - делает переадресацию на другую страницу с сообщение или безсообщения
 * goWayClass(%путь) - переадресация на класс
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
 * prinyat_tovar - Принятие товара и запись в историю (Страница товары)
 * prodat_tovar - Продажа товара и запись в историю (Страница товары)
 *
 * В ПУТИ
 * izm_way - Изменение товара в пути (Страница В пути)
 * del_way - Удаление товара в пути (Страница В пути)
 * add_way - Добавлние товара в пути (Страница В пути)
 *
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


/**
 * Страницы ЗАКАЗЫ
 */
// Удаление заказа (Страницы заказы)
        if ( $action == 'del_zakaz' ) {

            $pdo = new Database();
            $pdo->deleteRow("DELETE FROM `priem` WHERE `id` = '$id'");
            $pdo->deleteRow("DELETE FROM `log_priem` WHERE `id_zakaz` = '$id'");
            $this->goWayClass('index');

        }

// Изменение заказа (Страница заказы)
        if ( $action == 'izm_zakaz' ) {

            $fio = $_REQUEST['fio'];
            $phone = $_REQUEST['phone'];
            $adress = $_REQUEST['adress'];
            $sklad = $_REQUEST['sklad'];
            $status = $_REQUEST['status'];
            $tovar = $_REQUEST['tovar'];
            $datatime = date("Y-m-d H:i:s");
            $dostavka = $_REQUEST['dostavka'];
            $user_name = $_REQUEST['user_name'];
            $postavshik = $_REQUEST['postavshik'];
            $pdo = new Database();
            $sql_get_status = $pdo->getRows("SELECT * FROM `status` WHERE `id` = '$status' LIMIT 1 ");
            foreach ($sql_get_status as $data_get_device2) {
                $name_status = $data_get_device2['name'];
            }
            echo $status;
            $pdo->updateRow("UPDATE `priem` SET `phone`='$phone',`fio`='$fio',`adress`='$adress',`status`='$name_status',`color`='$status',`tovar`='$tovar',`sklad`='$sklad',`dostavka`='$dostavka',`postavshik`='$postavshik',`user_name`='$user_name' WHERE `id`='$id' ");
            $pdo->insertRow("INSERT INTO `log_priem` (`id_zakaz`,`datatime`,`meneger`,`status`,`komment`,`fio`,`phone`,`adress`,`dostavka`,`postavshik`,`store`) VALUES ('$id','$datatime','$user_name','$name_status','$tovar','$fio','$phone','$adress','$dostavka','$postavshik','$sklad')");
            $this->goWayClass('index');
        }


// Добавление заказа (Страница заказы)
        if ( $action == 'add_zakaz' ) {

            $phone = $_REQUEST['phone'];
            $fio = $_REQUEST['fio'];
            $adress = $_REQUEST['adress'];
            $user_name = $_REQUEST['user_name'];
            $user_sc = $_REQUEST['sklad'];
            $tovar = $_REQUEST['tovar'];
            $status = $_REQUEST['status'];
            $datatime = date("Y-m-d H:i:s");
            $dostavka = $_REQUEST['dostavka'];
            $postavshik = $_REQUEST['postavshik'];

            $pdo = new Database();
            $sql = $pdo->getRows("SELECT * FROM `status` WHERE `id` = '$status' LIMIT 1 ");
            foreach ($sql as $data_get_device2):
                $name_status = $data_get_device2['name'];
            endforeach;
            $id_zakaza = $pdo->lastInsertId("INSERT INTO `priem` (`phone`,`fio`,`adress`,`user_name`,`datatime`,`sklad`,`tovar`,`status`,`color`,`dostavka`,`postavshik`) VALUES ('$phone','$fio','$adress','$user_name','$datatime','$user_sc','$tovar','$name_status','$status','$dostavka','$postavshik')");
            $pdo->insertRow("INSERT INTO `log_priem` (`id_zakaz`,`datatime`,`meneger`,`status`,`komment`,`fio`,`phone`,`adress`,`dostavka`,`store`,`postavshik`) VALUES ('$id_zakaza','$datatime','$user_name','$name_status','$tovar','$fio','$phone','$adress','$dostavka','$user_sc','$postavshik')");
            $this->goWayClass('index');
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

            // создаем подключечние к БД
            $pdo = new Database();

            $name = $_POST['name'];
            $model = $_POST['model'];
            $chena_input = $_POST['chena_input'];
            $chena_output = $_POST['chena_output'];
            $money_input = $_POST['money_input'];
            $money_output = $_POST['money_output'];
            $komment = $_POST['komment'];
            $status = $_POST['status'];
            $datatime = date("Y-m-d H:i:s");
            $id_categor = $_POST['categor_id'];

            // вносим новый товар в категорию
            $pdo->insertRow("
INSERT INTO `tovar` (
`categor_id`,
`name`,
`model`,
`chena_input`,
`chena_output`,
`money_input`,
`money_output`,
`komment`,
`status`,
`datatime`) 
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
?)",[$id_categor,$name,$model,$chena_input,$chena_output,$money_input,$money_output,$komment,$status,$datatime]);

            // делаем переход на страницу товары
            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);

        }

// Удаление категории и товара в этой категории (Страницы товары)
        if ( $action == 'del_categor' ) {

            $pdo = new Database();
            $pdo->deleteRow("DELETE FROM `categor` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `categor_id` = ?",[$id]);
            $this->goWayClass('products');

        }

// Изменение категории (Страница товары)
        if ( $action == 'izm_categor' ) {

            $pdo = new Database();
            $name = $_POST['name'];
            $id = $_POST['id'];
            $pdo->updateRow("UPDATE `categor` SET `name` = ? WHERE `id` = ? ",[$name,$id]);
            $this->goWayClass('products');

        }

// Изменение товара (Страница товары)
        if ( $action == 'izm_tovar' ) {
            $pdo = new Database();

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

            $pdo->updateRow("UPDATE `tovar` SET 
	`name` = ?,
	`model` = ?,
	`chena_input` = ?,
	`chena_output` = ?,
	`money_input` = ?,
	`money_output` = ?,
	`komment` = ?,
	`categor_id` = ?,
	`status` = ? 
	WHERE `id` = ? ",[$name,$model,$chena_input,$chena_output,$money_input,$money_output,$komment,$categor_id,$status,$id]);

            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);

        }

// Удаление товара (Страница товары)
        if ( $action == 'del_tovar' ) {
            $pdo = new Database();

            $id = $_GET['id']; // айдишник талона
            $id_categor = $_GET['categor'];
            $pdo->deleteRow("DELETE FROM `tovar` WHERE `id` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_rashod` WHERE `id_tovara` = ?",[$id]);
            $pdo->deleteRow("DELETE FROM `log_prihod` WHERE `id_tovara` = ?",[$id]);
            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);
        }

// Принятие товара и запись в историю (Страница товары)
        if ( $action == 'prinyat_tovar' ) {
            $pdo = new Database();
            $id_tovara = $_POST['id'];
            $kolvo = $_POST['kolvo'];
            $chena = $_POST['chena'];
            $postavshik = $_POST['postavshik'];
            $komment = $_POST['komment'];
            $datatime = date("Y-m-d H:i:s");
            $valuta = $_POST['money_input'];
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
	`meneger`,
	`valuta`
	) VALUES (
	?,
	?,
	?,
	?,
	?,
	?,
	?,
	?
	)",[$id_tovara,$kolvo,$chena,$postavshik,$komment,$datatime,$user_name,$valuta]);
            if ( empty($chena)==true ) {
                $pdo->updateRow("UPDATE `tovar` SET `kolvo`= ? WHERE `id`= ? ",[$vsego,$id_tovara]);
            }

            if ( !empty($chena)==true ) {
                $pdo->updateRow("UPDATE `tovar` SET `kolvo`= ?,`chena_input`= ?,`money_input`= ? WHERE `id`= ? ",[$vsego,$chena,$valuta,$id_tovara]);
            }
            $this->goWayClassParams('fl_open_products',"id_categor=".$id_categor);
        }

// Продажа товара и запись в историю (Страница товары)
        if ( $action == 'prodat_tovar' ) {

            $pdo = new Database();

            $kolvo = $_POST['kolvo'];
            $prodavec = $_POST['prodavec'];
            $magazin = $_POST['magazin'];
            $komment = $_POST['komment'];
            $nakladnaya = $_POST['nakladnaya'];
            $nalogka = $_POST['nalogka'];
            $id = $_POST['id'];
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

            $pdo = new Database();

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
            $pdo = new Database();
            $id = $_REQUEST['id']; // айдишник талона
            $pdo->deleteRow("DELETE FROM `in_way` WHERE `id` = ?",[$id]);
            $this->goWayClass('way');
        }

// Добавлние товара в пути (Страница В пути)
        if ( $action == 'add_way' ) {
            $pdo = new Database();
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





    }
}
// получениея экшена
$action = $_REQUEST['action'];
$act = new App();
// обработка сценария экшена
$act->get_action($action);