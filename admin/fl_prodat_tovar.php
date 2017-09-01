<?php
session_start();

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения
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
  $params = $pdo->getRow("SELECT * FROM `tovar` WHERE `id`= ? ",[$id]);
?>
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Продажа товара</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Количество шт.:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="kolvo" class="form-control parsley-validated" value="<?php echo $params['kolvo']; ?>">
                    <input type="hidden" name="action" value="prodat_tovar">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Цена исх.:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena" class="form-control parsley-validated" value="<?php echo $params['chena_output']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label"><font color="red">!!! Способ оплаты: </font></label>
                  <div class="col-lg-8">
                    <select name="oplata">
                      <option value="Наличка">Наличка</option>
                      <option value="Безнал">Безнал</option>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="col-lg-3 control-label">Менеджер:</label>
                  <div class="col-lg-8">



                    <input type="text" autocomplete="off" name="manager" class="form-control parsley-validated" disabled value="<?php echo $name; ?>">
                  </div>
                </div>

                <div class="form-group" style="display: none">
                  <label class="col-lg-3 control-label">Магазин:</label>
                  <div class="col-lg-8">
                    <select name="magazin">
                    <?php
                    $id_categor = $_GET['categor'];
                    $sql_get_categor = $pdo->getRows(" SELECT * FROM `magazins` ");
                    foreach ( $sql_get_categor as $data_categor ) {
                      echo "<option value='".$data_categor[name]."'>".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="chena_input" value="<?php echo $params['chena_input']; ?>" >
                    <input type="hidden" name="valuta" value="<?php echo $params['money_input']; ?>" >
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


                <br>
                <br>
                <script>
                  function select() {
                    var selind = document.getElementById("ttn").options.selectedIndex;
                    if (document.getElementById("ttn").options[selind].text == 'Да') {
                      document.getElementById("ttn_edit").style.display = '';
                    } else {
                      document.getElementById("ttn_edit").style.display = 'none';
                    }
                  }

                </script>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Наложка:</label>
                  <div class="col-lg-8">
                    <select name="nalogka" id="ttn" onchange="select();">
                    <option value="Нет">Нет</option>
                    <option value="Да">Да</option>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="ttn_edit" style="display: none">
                  <label class="col-lg-3 control-label">ТТН:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="nakladnaya" class="form-control parsley-validated" value="">
                  </div>
                </div>

                 
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <button type="submit" class="btn btn-primary">Продать</button>
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
          $sql_get_history = $pdo->getRows("SELECT * FROM `log_rashod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
          foreach ( $sql_get_history as $data_history ) {
            if ($data_history['nalogka']=="Да"){$color_font = "black";}
            if ($data_history['nalogka']=="Нет"){$color_font = "grey";}
            ?>
            <tr>
              <td><b><font color="<?php echo $color_font; ?>"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['kolvo'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['chena'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['prifut'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['nakladnaya'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['nalogka'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['komment'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['magazin'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['menedger'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['prodavec'];?></font></b></td>
            </tr>
          <?php }}
        if ($user_role=='3') {
          $sql_get_history = $pdo->getRows("SELECT * FROM `log_rashod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
          foreach ( $sql_get_history as $data_history ) {
            if ($data_history['nalogka']=="Да"){$color_font = "black";}
            if ($data_history['nalogka']=="Нет"){$color_font = "grey";}
            ?>
            <tr>
              <td><b><font color="<?php echo $color_font; ?>"><?php $date = new DateTime($data_history['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['kolvo'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['chena'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['prifut'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['nakladnaya'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['nalogka'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['komment'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['magazin'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['menedger'];?></font></b></td>
              <td><b><font color="<?php echo $color_font; ?>"><?php echo $data_history['prodavec'];?></font></b></td>
            </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div></section>





<?php include("niz.php"); }?>