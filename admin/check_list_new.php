<?php
include_once "classes/Database.php";
?>
<html>
<meta charset="UTF-8">
<title>Чек лист</title>

<?
$i = 0; // переменная для подсчета выведенных элементов
$kolvo = 4; // количество элементов в ряду таблицы
?>

<button onclick="window.print();">Распечатать отчет №1</button>
<table>
    <colgroup>


    </colgroup>


<?foreach ( $_POST['products'] as $key=>$value ) {
    $pdo = new Database(); // Создание объекта БД
    $zakaz_info = $pdo->getRows("SELECT `tovar`,`fio`,`kolvo`,`komment` FROM `priem` WHERE `id` = ?  ", [$value]); // Получение информации о заказе по ID
        foreach ($zakaz_info as $k => $v) {
            $tovar_info = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?  ", [$v['tovar']]);

            if ($i == 0) {?><tr><?}$i++;?>
            <td>
                <figure class="sign">
                    <p><img src="../<?= $tovar_info['image'] ?>" width="150" height="150" alt="<?= $tovar_info['name'] ?>">
                    </p>
                    <figcaption><?= $v['fio'] ?></figcaption>
                    <figcaption>Цена опт: <?= $tovar_info['chena_input'] ?>руб.</figcaption>
                    <figcaption>(<?= $tovar_info['article'] ?>)</figcaption>
                    <figcaption><?= $tovar_info['name'] ?></figcaption>
                    <figcaption><?= $tovar_info['komment'] ?></figcaption>
                </figure>
            </td>
            <?if ($i == $kolvo) {?></tr><? $i = 0;}

            $arr_data[$key]["kom"] = $tovar_info['komment']; // описание товара
            $arr_data[$key]["art"] = $tovar_info['article']; // артикул
            $arr_data[$key]["name"] = $tovar_info['name']; // имя товара
            $arr_data[$key]["fio"] = $v['fio']; // имя заказчика
            $arr_data[$key]["kolvo"] = $v['kolvo']; // количество заканного товара
            $arr_data[$key]["komment"] = $v['komment']; // комментарий к заказу
            $arr_data[$key]["zakup"] = $tovar_info['chena_input']; // цена закупки
            $arr_data[$key]["prodaj"] = $tovar_info['chena_output']; // цена закупки}
        }
}

?>

</table>
<br>
<br>

<a href="check_list.xlsx">Скачать отчет №2 (Эксель)</a>


<?
/** Include PHPExcel */
require_once 'classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Torpix platform")
    ->setLastModifiedBy("Torpix platform")
    ->setTitle("Отчет по товару")
    ->setSubject("Отчет по товару")
    ->setDescription("Отчет по товару")
    ->setKeywords("Отчет по товару")
    ->setCategory("Отчет по товару");
// Add some data
$exel_cell = 2;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Наименование')
    ->setCellValue('B1', 'ФИО заказчика')
    ->setCellValue('C1', 'Количество')
    ->setCellValue('D1', 'Оптовая цена')
    ->setCellValue('E1', 'Рознечная цена');
foreach ($arr_data as $value) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$exel_cell, $value['name'].' ('.$value['art'].')')
        ->setCellValue('B'.$exel_cell, $value['fio'])
        ->setCellValue('C'.$exel_cell, $value['kolvo'])
        ->setCellValue('D'.$exel_cell, $value['zakup'])
        ->setCellValue('E'.$exel_cell, $value['prodaj']);
    $exel_cell++;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Отчет по товару');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
$callStartTime = microtime(true);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
?>