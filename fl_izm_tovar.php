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
                    <center><h4><i class="icon-edit"></i>Редактирование продукта</h4></center>
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
                    <input type="text" autocomplete="off" name=" " class="form-control parsley-validated" value="<?php //echo $params['fio']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цена(вх.):</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena_input" class="form-control parsley-validated" value="<?php echo $params['chena_input']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цена(исх.):</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena_output" class="form-control parsley-validated" value="<?php echo $params['chena_output']; ?>">
                  </div>
                </div>

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

<?php include("niz.php"); }?>