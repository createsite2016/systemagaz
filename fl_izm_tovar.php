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
$get_params = mysql_query("SELECT * FROM `tovar` WHERE `id`='$id' ",$db);
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_tovar.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование товара</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Категория:</label>
                  <div class="col-lg-8">
                    <select name="categor_id">
                    <?php
                    $id_categor = $_GET['categor']; // получение категории
                    $sql_get_select_tovat = mysql_query("SELECT * FROM `categor` WHERE `id` = '$id_categor' ",$db);
                      while ($select_tovar = mysql_fetch_assoc($sql_get_select_tovat)) {
                      echo "<option selected value=".$select_tovar['id'].">".$select_tovar['name']."</option>";
                    }
                    $sql_get_categor = mysql_query("SELECT * FROM `categor` WHERE `id`<>'$id_categor' ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Название:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="name" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Модель:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="model" class="form-control parsley-validated" value="<?php echo $params['model']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Количество:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name=" " class="form-control parsley-validated" disabled value="<?php echo $params['kolvo']; ?>">
                  </div>
                </div>

                <br>
                <br>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Входящая цена:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena_input" class="form-control parsley-validated" value="<?php echo $params['chena_input']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Входящая валюта:</label>
                  <div class="col-lg-8">
                    <select name="money_input">
                      <?php
                      $name_input_money=$params['money_input'];
                      $sql_get_select_valuta = mysql_query("SELECT * FROM `money` WHERE `name` = '$name_input_money' ",$db);
                      while ($select_valuta = mysql_fetch_assoc($sql_get_select_valuta)) {
                        echo "<option selected value=".$select_valuta['name'].">".$select_valuta['name']."</option>";
                      }
                      $sql_get_categor = mysql_query("SELECT * FROM `money` WHERE `name` <> '$name_input_money' ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                        echo "<option value=".$data_categor['name'].">".$data_categor['name']."</option>";
                      }
                      ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                  </div>
                </div>


                <br>
                <br>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Исходящая цена:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena_output" class="form-control parsley-validated" value="<?php echo $params['chena_output']; ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Исходящая валюта:</label>
                  <div class="col-lg-8">
                    <select name="money_output">
                      <?php
                      $name_output_money=$params['money_output'];
                      $sql_get_select_valuta = mysql_query("SELECT * FROM `money` WHERE `name` = '$name_output_money' ",$db);
                      while ($select_valuta = mysql_fetch_assoc($sql_get_select_valuta)) {
                        echo "<option selected value=".$select_valuta['name'].">".$select_valuta['name']."</option>";
                      }
                      $sql_get_categor = mysql_query("SELECT * FROM `money` WHERE `name` <> '$name_output_money' ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                        echo "<option value=".$data_categor['name'].">".$data_categor['name']."</option>";
                      }
                      ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                  </div>
                </div>


                <br>
                <br>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Комментарий:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Статус:</label>
                  <div class="col-lg-8">
                    <select name="status">
                    <?php
                    $status = $params['status'];
                    echo "<option selected value=".$status.">".$status."</option>";
                    ?>
                    <option value="Доступен">Доступен</option>
                    <option value="Недоступен">Недоступен</option>
                    <option value="Неизвестен">Неизвестен</option>
                    </select>
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Изменить</button>
                    <span class="center"><a href="fl_open_products.php?id_categor=<?php echo $id_categor; ?>" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>





  <center><h4><i class="icon-time"></i>Итория товара</h4></center>
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
          <th><b>Профит</b></th>
          <th><b>Накладная</b></th>
          <th><b>Наложка</b></th>
          <th><b>Комментарий</b></th>
          <th><b>Магазин</b></th>
          <th><b>Менеджер</b></th>
          <th><b>Продавец</b></th>
        </tr>
        </thead>
        <tbody>
        <?php
        include('showdata_forpeople.php');
        if ($user_role=='1') {
          $sql_get_history = mysql_query("SELECT * FROM `log_rashod` WHERE `id_tovara` = '$id' ORDER BY `datatime` DESC ",$db);
          while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
            <tr>
              <td><b><font color="black"><?php $vremya = date_smart($data_history['datatime']); echo $vremya ?></font></b></td>
              <td><b><font color="black"><?php echo $data_history['kolvo'];?></font></b></td>
              <td><b><font color="black"><?php echo $data_history['chena'];?></font></b></td>
              <td><b><font color="black"><?php echo $data_history['prifut'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['nakladnaya'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['nalogka'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['magazin'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['menedger'];?></font></b></td>
                <td><b><font color="black"><?php echo $data_history['prodavec'];?></font></b></td>
            </tr>
          <?php }}
        if ($user_role=='3') {
            $sql_get_history = mysql_query("SELECT * FROM `log_rashod` WHERE `id_tovara` = '$id' ORDER BY `datatime` DESC ",$db);
            while ($data_history = mysql_fetch_assoc($sql_get_history)) { ?>
                <tr>
                    <td><b><font color="black"><?php $vremya = date_smart($data_history['datatime']); echo $vremya ?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['kolvo'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['chena'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['prifut'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['nakladnaya'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['nalogka'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['komment'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['magazin'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['menedger'];?></font></b></td>
                    <td><b><font color="black"><?php echo $data_history['prodavec'];?></font></b></td>
                </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div></section>

<?php include("niz.php"); }?>