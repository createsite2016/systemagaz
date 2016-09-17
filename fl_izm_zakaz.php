<?php
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
$get_params = mysql_query("SELECT * FROM `priem` WHERE `id`='$id' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$params = mysql_fetch_array($get_params);
?>
<!-- Панель редактирования заказа -->
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_zakaz.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование заказа</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Фамилия:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="fio" placeholder="" data-required="true" class="form-control parsley-validated" value="<?php echo $params['fio']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Телефон:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="phone" placeholder="" data-required="true" class="form-control parsley-validated" value="<?php echo $params['phone']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Адрес:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="adress" placeholder="" data-required="true" class="form-control parsley-validated" value="<?php echo $params['adress']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="usid" value="<?php echo $usid ?>" >
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Служба доставки:</label>
                  <div class="col-lg-8">
                      <select name="dostavka">
                      <option selected value="<?php echo $params['dostavka']; ?>"><?php echo $params['dostavka']; ?></option>
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `dostavka` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      if ($data['name']!==$params['dostavka']) {
                         echo "<option>".$data['name']."</option>";
                      }
                    }
                    ?>
                      </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="col-lg-3 control-label">Содержание:</label>
                  <div class="col-lg-8">
                      <textarea placeholder="" rows="3" name="tovar" class="form-control parsley-validated" data-trigger="keyup"><?php echo $params['tovar']; ?>
                      </textarea>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Магазин:</label>
                  <div class="col-lg-8">
                      <select name="sklad">
                      <option selected value="<?php echo $params['sklad']; ?>"><?php echo $params['sklad']; ?></option>
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `magazins` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      if ($data['name']!==$params['sklad']) {
                         echo "<option>".$data['name']."</option>";
                      }

                    }
                    ?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Статус:</label>
                  <div class="col-lg-8">
                      <select name="status">
                      <option selected value="<?php echo $params['color']; ?>"><?php echo $params['status']; ?></option>
                    <?php
                    $sql_get_status = mysql_query("SELECT * FROM `status` ",$db);
                      while ($data_status = mysql_fetch_assoc($sql_get_status)) {
                      if ($data_status['name']!==$params['status']) {
                        echo "<option value=".$data_status['color'].">".$data_status['name']."</option>";
                      }
                    }
                    ?>
                      </select>
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="index.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div></section>



<center><h4><i class="icon-time"></i>Итория заказа</h4></center>
<!-- Панель лога действий заказов -->
<section class="panel"> 
  <br><b></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th><b>Дата</b></th>
                    <th><b>Менеджер</b></th>
                    <th><b>Статус</b></th>
                    <th><b>Комментарий</b></th>
                  </tr>
                </thead>
                  <tbody>
<?php 
include('showdata_forpeople.php');
if ($user_role=='1') {
  $sql_get_history = mysql_query("SELECT * FROM `log_priem` WHERE `id_zakaz` = '$id' ORDER BY `datatime` DESC ",$db);
while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
                  <tr>
                    <td><b><font color="black"><?php $vremya = date_smart($data_history['datatime']); echo $vremya ?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['status'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                  </tr>
<?php }}
if ($user_role=='3') {
  $sql_get_history = mysql_query("SELECT * FROM `log_priem` WHERE `id_zakaz` = '$id' ORDER BY `datatime` DESC ",$db);
while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
                  <tr>
                    <td><b><font color="black"><?php $vremya = date_smart($data_history['datatime']); echo $vremya ?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['status'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                  </tr>
<?php }} ?>              
              </tbody>
              </table>
              </div></section>

<?php include("niz.php"); }?>