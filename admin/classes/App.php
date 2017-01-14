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











    }
}
// получениея экшена
$action = $_REQUEST['action'];
$act = new App();
// обработка сценария экшена
$act->get_action($action);