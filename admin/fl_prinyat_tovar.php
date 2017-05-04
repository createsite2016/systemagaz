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
    $params = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ? ",[$id]);
    ?>
    <section class="panel">
        <div class="panel-body">
            <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                    <div class="col-lg-9 media">
                        <center><h4><i class="icon-edit"></i>Приход товара</h4></center>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Количество шт.:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="kolvo" class="form-control parsley-validated" value="1">
                        <input type="hidden" name="action" value="prinyat_tovar">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Цена закупки:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="chena" class="form-control parsley-validated" value="<?php echo $params['chena_input']; ?>">
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Поставщик:</label>
                    <div class="col-lg-8">
                        <select name="postavshik">
                            <?php
                            $id_categor = $_GET['categor'];

                            $sql_get_categor = $pdo->getRows(" SELECT * FROM `postavshiki` ORDER BY `name`");
                            foreach ( $sql_get_categor as $data_categor ) {
                                echo "<option value='".$data_categor[name]."'>".$data_categor['name']."</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $id ?>" >
                        <input type="hidden" name="chena_output" value="<?php echo $params['chena_output']; ?>" >
                        <input type="hidden" name="chena_input" value="<?php echo $params['chena_input']; ?>" >
                        <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                        <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Комментарий:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="komment" class="form-control parsley-validated" value="">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary">Принять товар</button>
                        <span class="center"><a href="fl_open_products.php?id_categor=<?php echo $id_categor; ?>" class="btn btn-default btn-xs">Отмена</a></span>
                    </div>
                </div>
            </form>


        </div>
    </section>



    <center><h4><i class="icon-time"></i>Итория всех поступлений данного товара</h4></center>
    <!-- Панель лога действий с товаром -->
    <section class="panel">
        <br><b></b><br><br>
        <div class="table">
            <table class="table text-small">
                <thead>
                <tr>
                    <th><b>Дата</b></th>
                    <th><b>Кол-во</b></th>
                    <th><b>Цена</b></th>
                    <th><b>Поставщик</b></th>
                    <th><b>Комментарий</b></th>
                    <th><b>Менеджер</b></th>
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