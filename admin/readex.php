<?php

ini_set('display_errors', TRUE);
include_once "classes/Database.php"; // подключаем БД
global $pdo; // Делаем PDO глобальным, для того чтобы видеть ее везде
$pdo = new Database();
$step = '';

if (!empty($_FILES)) {
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Ошибка загрузки: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], '' . $_FILES['file']['name']);
        echo "Товары из эксель файла добавлены в магазин";
        /*
* Считывает данные из любого excel файла и созадет из них массив.
* $filename (строка) путь к файлу от корня сервера
*/
        function parse_excel_file( $filename ){
            // подключаем библиотеку
            include_once "classes/PHPExcel.php";

            $result = array();

            // получаем тип файла (xls, xlsx), чтобы правильно его обработать
            $file_type = PHPExcel_IOFactory::identify( $filename );
            // создаем объект для чтения
            $objReader = PHPExcel_IOFactory::createReader( $file_type );
            $objPHPExcel = $objReader->load( $filename ); // загружаем данные файла в объект
            $result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

            return $result;
        }

        $res = parse_excel_file("example.xlsx");

        foreach ($res as $key=>$value) {
            if ($key !== 0) {
                $tovar_number[] = $key; // ключи записей товара (для каждого товара)
            };
        }

        foreach ($tovar_number as $key=>$value) {
            if (!empty($res[$value][0]) ) {$TOVARS[$key]["article"] = $res[$value][0];} else {$TOVARS[$key]["article"] = '';};
            if (!empty($res[$value][1]) ) {$TOVARS[$key]["name"] = $res[$value][1];} else {$TOVARS[$key]["name"] = '';};
            if (!empty($res[$value][2]) ) {$TOVARS[$key]["image"] = $res[$value][2];} else {$TOVARS[$key]["image"] = '';};
            if (!empty($res[$value][3]) ) {$TOVARS[$key]["chena_input"] = $res[$value][3];} else {$TOVARS[$key]["chena_input"] = '';};
            if (!empty($res[$value][4]) ) {$TOVARS[$key]["chena_output"] = $res[$value][4];} else {$TOVARS[$key]["chena_output"] = '';};
            if (!empty($res[$value][5]) ) {$TOVARS[$key]["model"] = $res[$value][5];} else {$TOVARS[$key]["model"] = '';};
            if (!empty($res[$value][6]) ) {$TOVARS[$key]["komment"] = $res[$value][6];} else {$TOVARS[$key]["komment"] = '';};
            if (!empty($res[$value][7]) ) {$TOVARS[$key]["firma"] = $res[$value][7];} else {$TOVARS[$key]["firma"] = '';};
            if (!empty($res[$value][8]) ) {$TOVARS[$key]["new"] = $res[$value][8];} else {$TOVARS[$key]["new"] = '';};
            if (!empty($res[$value][9]) ) {$TOVARS[$key]["skidka"] = $res[$value][9];} else {$TOVARS[$key]["skidka"] = '';};
            if (!empty($res[$value][10]) ) {$TOVARS[$key]["razmer"] = $res[$value][10];} else {$TOVARS[$key]["razmer"] = '';};
            if (!empty($res[$value][11]) ) {$TOVARS[$key]["ves"] = $res[$value][11];} else {$TOVARS[$key]["ves"] = '';};
            if (!empty($res[$value][12]) ) {$TOVARS[$key]["obem"] = $res[$value][12];} else {$TOVARS[$key]["obem"] = '';};
            if (!empty($res[$value][13]) ) {$TOVARS[$key]["dlina"] = $res[$value][13];} else {$TOVARS[$key]["dlina"] = '';};
            if (!empty($res[$value][14]) ) {$TOVARS[$key]["material"] = $res[$value][14];} else {$TOVARS[$key]["material"] = '';};
            if (!empty($res[$value][15]) ) {$TOVARS[$key]["color"] = $res[$value][15];} else {$TOVARS[$key]["color"] = '';};
            if (!empty($res[$value][16]) ) {$TOVARS[$key]["garant"] = $res[$value][16];} else {$TOVARS[$key]["garant"] = '';};
            if (!empty($res[$value][17]) ) {$TOVARS[$key]["complect"] = $res[$value][17];} else {$TOVARS[$key]["complect"] = '';};
            if (!empty($res[$value][18]) ) {$TOVARS[$key]["kolvo"] = $res[$value][18];} else {$TOVARS[$key]["kolvo"] = '';};
        }

        $id_categor = $_POST["categor"];
        $status = "Да";
        $datatime = date("Y-m-d H:i:s"); // дата добавления товара
        $user_id = 1;

        foreach ($TOVARS as $key=>$value) {
            $id_tovara = $pdo->lastInsertId("
        INSERT INTO `tovar` (
        `kolvo`,
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
        `article`,
        
        `new`,
        `skidka`,
        `firma`,
        `razmer`,
        `ves`,
        `obem`,
        `dlina`,
        `material`,
        `color`,
        `garant`,
        `complect`
        ) 
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
        ?
        
        )", [$TOVARS[$key]["kolvo"],$id_categor, $TOVARS[$key]["name"], $TOVARS[$key]["model"], $TOVARS[$key]["chena_input"], $TOVARS[$key]["chena_output"], $TOVARS[$key]["komment"], $status, $datatime, $user_id, 'foto_tovar/'.$TOVARS[$key]["image"], $TOVARS[$key]["article"],   $TOVARS[$key]["new"],$TOVARS[$key]["skidka"],$TOVARS[$key]["firma"],$TOVARS[$key]["razmer"],$TOVARS[$key]["ves"],$TOVARS[$key]["obem"],$TOVARS[$key]["dlina"],$TOVARS[$key]["material"],$TOVARS[$key]["color"],$TOVARS[$key]["garant"],$TOVARS[$key]["complect"]]);
        }
    }
}









