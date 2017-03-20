<?php
session_start();
include_once "classes/App.php";
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
  // получение данных о заказах
  $get_params = $pdo->getRows("SELECT * FROM `priem` WHERE `id`='$id' ");
  foreach ($get_params as $params):
  endforeach;

?>
<!-- Панель редактирования заказа -->
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование заказа</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Фамилия:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="fio" class="form-control parsley-validated" value="<?php echo $params['fio']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Телефон:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="phone" class="form-control parsley-validated" value="<?php echo $params['phone']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Адрес:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="adress" class="form-control parsley-validated" value="<?php echo $params['adress']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="usid" value="<?php echo $usid ?>" >
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                    <input type="hidden" name="kolvo" value="<?php echo $_GET['kolvo'] ?>" >
                    <input type="hidden" name="action" value="izm_zakaz" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Товар:</label>
                  <div class="col-lg-8">
                      <textarea placeholder="" disabled rows="1" name="tovar" class="form-control parsley-validated" data-trigger="keyup">
                        <?php
                        $tovar_name = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ? ",[$params['tovar']]);
                        echo $tovar_name['name']; ?>
                      </textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Статус:</label>
                  <div class="col-lg-8">
                      <select name="status">

                      <?php
                      $color_id = $params['color'];
                      $color = $pdo->getRows("SELECT * FROM `status` where `id`='$color_id' ");
                      foreach ($color as $data_get_color):
                        $color_code = $data_get_color['color']; // код цвета
                        $color_name_status = $data_get_color['name']; // наименование статуса
                      endforeach;
                      ?>


                      <option selected value="<?php echo $color_id; ?>"><?php echo $color_name_status; ?></option>
                    <?php
                    $sql_status = $pdo->getRows("SELECT * FROM `status` ");
                    foreach ($sql_status as $data_status):
                    if ($data_status['name']!==$color_name_status) {
                        echo "<option value=".$data_status['id'].">".$data_status['name']."</option>";
                      }
                    endforeach;
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
                    <th><b></b>ФИО</th>
                    <th><b>Телефон</b></th>
                    <th><b>Адрес</b></th>
                    <th><b>Служба доставки</b></th>
                    <th><b>Поставщик</b></th>
                    <th><b>Магазин</b></th>
                    <th><b>Комментарий</b></th>
                  </tr>
                </thead>
                  <tbody>
<?php 
include('showdata_forpeople.php');
if ($user_role=='1') {
  $sql = $pdo->getRows("SELECT * FROM `log_priem` WHERE `id_zakaz` = '$id' ORDER BY `datatime` DESC ");
  foreach ($sql as $data_history): ?>
                  <tr>
                    <td><b><font color="black"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['status'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['fio'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['phone'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['adress'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['dostavka'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['postavshik'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['store'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                  </tr>
<?php endforeach; }
if ($user_role=='3') {
  $sql = $pdo->getRows("SELECT * FROM `log_priem` WHERE `id_zakaz` = '$id' ORDER BY `datatime` DESC ");
  foreach ($sql as $data_history): ?>
                  <tr>
                    <td><b><font color="black"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['meneger'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['status'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['fio'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['phone'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['adress'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['dostavka'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['postavshik'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['store'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                  </tr>
  <?php endforeach; } ?>
              </tbody>
              </table>
              </div></section>

<?php include("niz.php"); }?>