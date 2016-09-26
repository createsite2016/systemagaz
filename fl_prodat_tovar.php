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
              <form action="fl_post_prodat_tovar.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Продажа продукта</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Количество шт.:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="kolvo" class="form-control parsley-validated" value="<?php //echo $params['fio']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Продавец:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="prodavec" class="form-control parsley-validated" value="<?php //echo $params['fio']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Магазин:</label>
                  <div class="col-lg-8">
                    <select name="magazin">
                    <?php
                    $id_categor = $_GET['categor'];
                    $sql_get_categor = mysql_query(" SELECT * FROM `magazins` ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="chena_output" value="<?php echo $params['chena_output']; ?>" >
                    <input type="hidden" name="chena_input" value="<?php echo $params['chena_input']; ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Комментарий:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" class="form-control parsley-validated" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Наложка:</label>
                  <div class="col-lg-8">
                    <select name="nalogka">
                    <?php
                    // $status = $params['status'];
                    // echo "<option selected value=".$status.">".$status."</option>";
                    // ?>
                    <option value="Доступен">Да</option>
                    <option value="Недоступен">Нет</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">ТТН:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="nakladnaya" class="form-control parsley-validated" value="">
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