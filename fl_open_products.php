<?php
session_start();
// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}  
// Иначе открываем для него контент
else { include("verh.php"); ?>

<!-- / Тело страницы -->
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

                    <br>
                    <br>



<div class="row">
        <div class="col-lg-12">
<?php
$id_categor = $_GET['id_categor']; 
$sql_get_name_categor = mysql_query("SELECT * FROM `categor` WHERE `id` = '$id_categor' LIMIT 1 ",$db); 
while ($data_name_categor = mysql_fetch_assoc($sql_get_name_categor))
{
    $name_categor = $data_name_categor['name'];
} ?>
<section class="panel">
<br><b><span class="center"><b> |   <a href="products.php">  <- <?php echo $name_categor; ?></a></b> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> | </span></b><br><br>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Модель</b></th>
                    <th><b>Наименование</b></th>
                    <th><b>Кол-во</b></th>
                    <th><b>Цена(вх.)</b></th>
                    <th><b>Цена(ис.)</b></th>
                    <th><b>состояние</b></th>
                    <th><b>Дейстиве</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `tovar` WHERE `categor_id` =  '$id_categor' ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php echo $data_get_device['model']; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['kolvo']; ?></td>
                    <td><?php echo $data_get_device['chena_input']; echo " "; echo $data_get_device['money_input']; ?></td>
                    <td><?php echo $data_get_device['chena_output']; echo " "; echo $data_get_device['money_output']; ?></td>
                    <td><?php echo $data_get_device['status']; ?></td>
                    <td><a href="fl_del_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green">Изменить</font></a>
                    <a href="fl_prinyat_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                    <?php
                    if ($data_get_device['kolvo']>0){ ?>
                        <a href="fl_prodat_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                    <?php } ?>
                    </td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
                        $sql_get_device = mysql_query("SELECT * FROM `tovar` WHERE `categor_id` =  '$id_categor' ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php echo $data_get_device['model']; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['kolvo']; ?></td>
                      <td><?php echo $data_get_device['chena_input']; echo " "; echo $data_get_device['money_input']; ?></td>
                      <td><?php echo $data_get_device['chena_output']; echo " "; echo $data_get_device['money_output']; ?></td>
                    <td><?php echo $data_get_device['status']; ?></td>
                    <td><a href="fl_del_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green">Изменить</font></a><br>
                    <a href="fl_prinyat_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                        <?php
                        if ($data_get_device['kolvo']>0){ ?>
                            <a href="fl_prodat_tovar.php?id=<?php echo $data_get_device['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                        <?php } ?>
                    </td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                   





                    <div id="tovar" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="fl_post_add_tovar.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый товар</h4>
                    </div>


                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                    <input type="hidden" name="id_categor" autofocus autocomplete="off" value="<?php echo $id_categor; ?>">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Модель:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вх.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                    <select name="money_input">
                    <?php
                    $sql_get_money = mysql_query("SELECT * FROM `money` ",$db);
                      while ($data_money = mysql_fetch_assoc($sql_get_money)) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вых.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                    <select name="money_output">
                    <?php
                    $sql_get_money = mysql_query("SELECT * FROM `money` ",$db);
                      while ($data_money = mysql_fetch_assoc($sql_get_money)) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                    <?php
                    $sql_get_status = mysql_query("SELECT * FROM `status_rs` ",$db);
                      while ($data_status = mysql_fetch_assoc($sql_get_status)) {
                      echo "<option>".$data_status['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>


                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

