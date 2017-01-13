<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 29.09.16
 * Time: 2:40
 * Принятие товара на остатки
 */

session_start();
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
    $get_params = mysql_query("SELECT * FROM `tovar` WHERE `id`='$id' ",$db);
    $params = mysql_fetch_array($get_params);
    ?>
    <section class="panel">
        <div class="panel-body">
            <form action="fl_post_prinyat_tovar.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                    <div class="col-lg-9 media">
                        <center><h4><i class="icon-edit"></i>Приход товара</h4></center>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Количество шт.:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="kolvo" class="form-control parsley-validated" value="1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Цена вх.:</label>
                    <div class="col-lg-8">
                        <input type="text" autocomplete="off" name="chena" class="form-control parsley-validated" value="<?php echo $params['chena_input']; ?>">
                        <select name="money_input">
                            <?php
                            $id_categor = $_GET['categor']; // получение категории



                            $sql_get_money = mysql_query("SELECT * FROM `tovar` WHERE `id` = '$id' ",$db);
                            while ($select_money = mysql_fetch_assoc($sql_get_money)) {
                                echo "<option selected value=".$select_money['money_input'].">".$select_money['money_input']."</option>";
                            }



                            $sql_get_all_money = mysql_query("SELECT * FROM `money` ",$db);
                            while ($data_all_money = mysql_fetch_assoc($sql_get_all_money)) {
                                echo "<option value=".$data_all_money['name'].">".$data_all_money['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Поставщик:</label>
                    <div class="col-lg-8">
                        <select name="postavshik">
                            <?php
                            $id_categor = $_GET['categor'];
                            $sql_get_categor = mysql_query(" SELECT * FROM `postavshiki` ",$db);
                            while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
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
                    $sql_get_history = mysql_query("SELECT * FROM `log_prihod` WHERE `id_tovara` = '$id' ORDER BY `datatime` DESC ",$db);
                    while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
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
                    $sql_get_history = mysql_query("SELECT * FROM `log_prihod` WHERE `id_tovara` = '$id' ORDER BY `datatime` DESC ",$db);
                    while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
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