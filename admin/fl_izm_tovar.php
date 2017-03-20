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
                    <center><h4><i class="icon-edit"></i>Редактирование свойств товара</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Категория:</label>
                  <div class="col-lg-8">
                    <select name="categor_id">
                    <?php
                    $id_categor = $_GET['categor']; // получение категории

                    $sql_get_select_tovat = $pdo->getRows("SELECT * FROM `categor` WHERE `id` = ? ",[$id_categor]);
                    foreach ( $sql_get_select_tovat as $select_tovar ) {
                      echo "<option selected value=".$select_tovar['id'].">".$select_tovar['name']."</option>";
                    }
                    $sql_get_categor = $pdo->getRows("SELECT * FROM `categor` WHERE `id`<>? ",[$id_categor]);
                    foreach ( $sql_get_categor as $data_categor ) {
                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                    }
                    ?>
                    </select>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                    <input type="hidden" name="action" value="izm_tovar">
                  </div>
                </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label">Артикул:</label>
                      <div class="col-lg-8">
                          <input type="text" autocomplete="off" name="article" class="form-control parsley-validated" value="<?php echo $params['article']; ?>">
                      </div>
                  </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Наименование:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="name" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Страна производитель:</label>
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
                  <label class="col-lg-3 control-label">Исходящая цена:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="chena_output" class="form-control parsley-validated" value="<?php echo $params['chena_output']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Описание:</label>
                  <div class="col-lg-8">
                    <input type="text" autocomplete="off" name="komment" class="form-control parsley-validated" value="<?php echo $params['komment']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Показать этот товар на витрине?</label>
                  <div class="col-lg-8">
                    <select name="status">
                    <?php
                    $status = $params['status'];
                    echo "<option selected value=".$status.">".$status."</option>";
                    if ($params['status'] == 'Да') { ?>
                        <option value="Нет">Нет</option>
                    <?php } else { ?>
                        <option value="Да">Да</option>
                    <?php } ?>

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
          $sql_get_history = $pdo->getRows("SELECT * FROM `log_rashod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
          foreach ( $sql_get_history as $data_history ) { ?>
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
          $sql_get_history = $pdo->getRows("SELECT * FROM `log_rashod` WHERE `id_tovara` = ? ORDER BY `datatime` DESC ",[$id]);
          foreach ( $sql_get_history as $data_history ) { ?>
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