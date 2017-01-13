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
$get_params = mysql_query("SELECT * FROM `in_way` WHERE `id`='$id' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_way.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование товара</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Товар:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="tovar" placeholder="" class="form-control parsley-validated" value="<?php echo $params['tovar']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="menedger" value="<?php echo $name ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Количество:</label>
                  <div class="col-lg-8">
                    <input type="hidden" name="kolvo" value="<?php echo $params['kolvo']; ?>">
                    <input type="text" autocomplete="off" name=" " placeholder="" disabled class="form-control parsley-validated"value="<?php echo $params['kolvo']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цена:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena" placeholder="" class="form-control parsley-validated" value="<?php echo $params['chena']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Профит:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="profit" placeholder="" class="form-control parsley-validated" value="<?php echo $params['profit']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">ТТН:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="ttn" placeholder="" class="form-control parsley-validated" value="<?php echo $params['ttn']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Комментарий:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" placeholder="" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Магазин:</label>
                  <div class="col-lg-8">
                    <select name="magazin">
                      <option selected value="<?php echo $params['magazin']; ?>"><?php echo $params['magazin']; ?></option>
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `magazins` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      if ($data['name']!==$params['magazin']) {
                         echo "<option>".$data['name']."</option>";
                      }

                    }
                    ?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Продавец:</label>
                  <div class="col-lg-8">
                    <select name="prodavec">
                      <option selected value="<?php echo $params['prodavec']; ?>"><?php echo $params['prodavec']; ?></option>
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `users_8897532` WHERE `role`<'3' ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      if ($data['name']!==$params['prodavec']) {
                         echo "<option>".$data['name']."</option>";
                      }

                    }
                    ?>
                      </select>
                  </div>
                </div>


                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="way.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>