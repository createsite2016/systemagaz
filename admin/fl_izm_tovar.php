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
              <form action="classes/App.php" enctype="multipart/form-data" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Редактирование свойств товара</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Категория:</label>
                  <div class="col-lg-8">
                      <select name="categor_id" id="selecategor">
                          <?php
                          $sql_get_categor = $pdo->getRows("SELECT * FROM `categor` ");
                          $sql_get_select_categor = $pdo->getRow("SELECT * FROM `categor` WHERE `id` = ?",[$_GET['categor']]);
                          foreach ( $sql_get_categor as $data_categor ) {

                              if($data_categor['parent']){
                                  if($sql_get_select_categor['id'] == $data_categor['id']){
                                      $get_categor = $pdo->getRow("SELECT * FROM `categor` WHERE `id` = ?",[$data_categor['parent']]);
                                      echo "<option selected value=".$data_categor['id'].">".$get_categor['name']."--".$data_categor['name']."</option>";
                                  } else {
                                      $get_categor = $pdo->getRow("SELECT * FROM `categor` WHERE `id` = ?",[$data_categor['parent']]);
                                      echo "<option value=".$data_categor['id'].">".$get_categor['name']."--".$data_categor['name']."</option>";
                                  }

                              } else {
                                  if($sql_get_select_categor['id'] == $data_categor['id']){
                                      echo "<option selected value=".$data_categor['id'].">".$data_categor['name']."</option>";
                                  } else {
                                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";
                                  }

                              }


                          }
                          ?>
                      </select>
                      <script type='text/javascript'>
                          function sorted(id){for(var c=document.getElementById(id),b=c.options,a=0;a<b.length;)
                              if(b[a+1]&&b[a].text>b[a+1].text){c.insertBefore(b[a+1],b[a]);a=a>=1?a-1:a+1}else a++;
                               };
                          sorted("selecategor");
                      </script>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <input type="hidden" name="id_categor" value="<?php echo $id_categor; ?>" >
                    <input type="hidden" name="action" value="izm_tovar">
                    <input type="hidden" name="path_file_old" value="../../<?php echo $params['image']; ?>">
                  </div>
                </div>
                  
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Фото:</label>
                      <div class="col-lg-8">
                          <img src="../<?php echo $params['image']; ?>" height="180" width="180">
                          <br>
                          <input type="file" name="foto" title="Изменить фото товара" style="left: -204.562px; top: 17px;">
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
                      <label class="col-lg-3 control-label">Фирма изготовитель:</label>
                      <div class="col-lg-8">
                          <input type="text" autocomplete="off" name="firma" class="form-control parsley-validated" value="<?php echo $params['firma']; ?>">
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
                    <input type="number" autocomplete="off" name="chena_input" class="form-control parsley-validated" value="<?php echo $params['chena_input']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Исходящая цена:</label>
                  <div class="col-lg-8">
                    <input type="number" autocomplete="off" name="chena_output" class="form-control parsley-validated" value="<?php echo $params['chena_output']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Описание:</label>
                  <div class="col-lg-8">
                      <textarea class="form-control parsley-validated" placeholder="" style="height: 271px;" name="komment" autofocus autocomplete="off"><?php echo $params['komment']; ?></textarea>
                  </div>
                </div>



                  <div class="form-group">
                      <label class="col-lg-3 control-label">Новинка:</label>
                      <div class="col-lg-8">
                          <select name="new">
                              <?php
                              if ($params['new']) {
                                  $status = $params['new'];
                              } else {
                                  $status = 'Нет';
                              }

                              echo "<option selected value=".$status.">".$status."</option>";
                              if ($params['new'] == 'Да') { ?>
                                  <option value="Нет">Нет</option>
                              <?php } else { ?>
                                  <option value="Да">Да</option>
                              <?php } ?>

                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label">% Скидки на товар:</label>
                      <div class="col-lg-8">
                          <input type="text" autocomplete="off" name="skidka" class="form-control parsley-validated" value="<?=$params['skidka']?>">
                      </div>
                  </div>




                  <!--Размер:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Размер:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" name="razmer" value="<?=$params['razmer']?>" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Вес:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Вес:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" value="<?=$params['ves']?>" name="ves" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Объем:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Объем:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" name="obem" value="<?=$params['obem']?>" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Длина:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Длина:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" name="dlina" value="<?=$params['dlina']?>" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Материал:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Материал:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" value="<?=$params['material']?>" name="material" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Цвет:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Цвет:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" name="color" value="<?=$params['color']?>" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Гарантия:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Гарантия:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" value="<?=$params['garant']?>" name="garant" autofocus autocomplete="off">
                      </div>
                  </div>

                  <!--Комплектация:-->
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Комплектация:</label>
                      <div class="col-lg-8">
                          <input class="form-control parsley-validated" placeholder="" type="text" name="complect" value="<?=$params['complect']?>" autofocus autocomplete="off">
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