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
$get_params = mysql_query("SELECT * FROM `categor` WHERE `id`='$id' ",$db);
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_categor.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование продукта</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Название:</label>
                  <div class="col-lg-8">
                    <select name="categor_id">
                    <?php
                    $sql_get_select_tovat = mysql_query("SELECT * FROM `categor` WHERE `id` = '$id' ",$db);
                      while ($select_tovar = mysql_fetch_assoc($sql_get_select_tovat)) {
                      echo "<option selected value=".$select_tovar['id'].">".$select_tovar['name']."</option>";
                    }
                    $sql_get_categor = mysql_query("SELECT * FROM `categor` ",$db);
                      while ($data_categor = mysql_fetch_assoc($sql_get_categor)) {
                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="products.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>