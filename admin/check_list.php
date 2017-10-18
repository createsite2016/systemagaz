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
    <tr>

<?function get_data($id,$step) {
    global $arr_data;
    $pdo = new Database();
    $get_check = $pdo->getRows("SELECT * FROM `priem` WHERE `id` = ?  ",[$id]);

    foreach ($get_check as $key=>$value):
        $tovar = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?  ",[$value['tovar']]);?>
                <td>
                    <figure class="sign">
                        <p><img src="../<?=$tovar['image']?>" width="150" height="150" alt="<?=$tovar['name']?>"></p>
                        <figcaption><?=$value['fio']?></figcaption>
                        <figcaption>(<?=$tovar['article']?>)</figcaption>
                        <figcaption><?=$tovar['name']?></figcaption>
                        <figcaption><?=$tovar['komment']?></figcaption>
                    </figure>
                </td>
    <?
    $arr_data[$step]["kom"] = $tovar['komment']; // описание товара
    $arr_data[$step]["art"] = $tovar['article']; // артикул
    $arr_data[$step]["name"] = $tovar['name']; // имя товара
    $arr_data[$step]["fio"] = $value['fio']; // имя заказчика
    $arr_data[$step]["kolvo"] = $value['kolvo']; // имя заказчика
    $arr_data[$step]["komment"] = $value['komment']; // комментарий к заказу
    $arr_data[$step]["zakup"] = $tovar['chena_input']; // цена закупки
    $arr_data[$step]["prodaj"] = $tovar['chena_output']; // цена закупки
    endforeach;?>
<?}
foreach ( $_POST['products'] as $key=>$value ) {
    if ( $i < $kolvo ) {} else {?><tr><?}
    get_data($value,$key); // вывод порядкового номера для списка
    if ( $i < $kolvo ) {} else { ?><tr><? $i = 0; }
    $i++;
}
?>
    </tr>
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
