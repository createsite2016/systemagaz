<?php
session_start();

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();

// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}
// Иначе открываем для него контент
else { include("verh.php"); ?>

    <!-- / nav -->
    <section id="content">
    <section class="main padder">
    <div class="row">
        <div class="col-lg-12">
            <section class="toolbar clearfix m-t-large m-b">

            </section>
        </div>
    </div>

    </div>

    </div>
    <div class="row">
    <?php
    $id = $_GET['id'];
    ?>

    <center><h4><i class="icon-time"></i>Итория всех поступлений данного товара</h4></center>
    <!-- Панель лога действий с товаром -->
    <section class="panel">
        <br><b></b><br><br>
        <div class="table">
            <table class="table text-small">
                <thead>
                <tr>
                    <th><b>Дата | Время</b></th>
                    <th><b>Кол-во</b></th>
                    <th><b>Цена закупки</b></th>
                    <th><b>Поставщик (склад)</b></th>
                    <th><b>Комментарий</b></th>
                    <th><b>Кто принял</b></th>
                </tr>
                </thead>
                <tbody>
                <?php
                include('showdata_forpeople.php');
                if ($user_role=='1') {
                    $sql_get_history = $pdo->getRows("SELECT * FROM `log_prihod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
                    foreach ( $sql_get_history as $data_history ) { ?>
                        <tr>
                            <td><b><font color="black"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['kolvo'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['chena']; echo " "; echo $data_history['valuta']; ?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['postavshik'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                        </tr>
                    <?php }}
                if ($user_role=='3') {
                    $sql_get_history = $pdo->getRows("SELECT * FROM `log_prihod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
                    foreach ( $sql_get_history as $data_history ) { ?>
                        <tr>
                            <td><b><font color="black"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['kolvo'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['chena']; echo " "; echo $data_history['valuta']; ?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['postavshik'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                            <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div></section>





    <?php include("niz.php"); }?>