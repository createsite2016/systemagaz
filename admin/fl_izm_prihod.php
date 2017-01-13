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
$get_params = mysql_query("SELECT * FROM `prihod` WHERE `id`='$id' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$params = mysql_fetch_array($get_params);
?>
<section class="panel">
            <div class="panel-body">
              <form action="fl_post_izm_prihod.php" class="form-horizontal" method="POST" data-validate="parsley">      
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование прихода</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Статус:</label>
                  <div class="col-lg-8">
                      <select name="status">
                    <option selected value="<?php echo $params['statya']; ?>"><?php echo $params['statya']; ?></option>
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `status_pr` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                    if ($data['name']!==$params['statya']) {
                      echo "<option>".$data['name']."</option>";
                    }
                    }
                    ?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Комментарий:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" placeholder="" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">UAH:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="uah" placeholder="" class="form-control parsley-validated" value="<?php echo $params['uah']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">USD:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="usd" placeholder="" class="form-control parsley-validated" value="<?php echo $params['usd']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">EUR:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="eur" placeholder="" class="form-control parsley-validated" value="<?php echo $params['usd']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет1:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash1" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash1']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет2:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash2" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash2']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет3:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash3" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash3']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет4:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash4" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash4']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет5:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash5" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash5']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Счет6:</label>
                  <div class="col-lg-8">
                    <input type="tel" pattern="[0-9]{0,100}" autocomplete="off" name="cash6" placeholder="" class="form-control parsley-validated" value="<?php echo $params['cash6']; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                  </div>
                </div>
   
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="prihod.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>

<?php include("niz.php"); }?>