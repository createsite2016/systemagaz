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

<!-- / Тело страницы -->
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

                    <br>
                    <br>



<div class="row">
        <div class="col-lg-12">

<section class="panel">
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-plus"></i> Добавить товар вручную</a> | </span></b><br><br>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Дата</b></th>
                    <th><b>Товар</b></th>
                    <th><b>Кол-во</b></th>
                    <th><b>Цена</b></th>
                    <th><b>Профит</b></th>
                    <th><b>ТТН</b></th>
                    <th><b>Комментарий</b></th>
                    <th><b>Магазин</b></th>
                    <th><b>Менеджер</b></th>
                    <th><b>Продавец</b></th>
                    <th><b>Ред.</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
    $sql_get_data = $pdo->getRows("SELECT * FROM `in_way` ORDER BY `datatime` DESC ");
    foreach ( $sql_get_data as $data_get_device ) { ?>
                  <tr>
                    <td><?php $date = new DateTime($data_get_device['datatime']); echo $date->format('d.m.y | H:i'); ?></td>
                    <td><?php echo $data_get_device['tovar']; ?></td>
                    <td><?php echo $data_get_device['kolvo']; ?></td>
                    <td><?php echo $data_get_device['chena']; ?></td>
                    <td><?php echo $data_get_device['profit']; ?></td>
                    <td><?php echo $data_get_device['ttn']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><?php echo $data_get_device['magazin']; ?></td>
                    <td><?php echo $data_get_device['menedger']; ?></td>
                    <td><?php echo $data_get_device['prodavec']; ?></td>
                    <td><a href="fl_del_way.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_way.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a>
                    </td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
    $sql_get_data = $pdo->getRows("SELECT * FROM `in_way` ORDER BY `datatime` DESC ");
    foreach ( $sql_get_data as $data_get_device ) { ?>
                  <tr>
                    <td><?php $date = new DateTime($data_get_device['datatime']); echo $date->format('d.m.y | H:i'); ?></td>
                    <td><?php echo $data_get_device['tovar']; ?></td>
                    <td><?php echo $data_get_device['kolvo']; ?></td>
                    <td><?php echo $data_get_device['chena']; ?></td>
                    <td><?php echo $data_get_device['profit']; ?></td>
                    <td><?php echo $data_get_device['ttn']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><?php echo $data_get_device['magazin']; ?></td>
                    <td><?php echo $data_get_device['menedger']; ?></td>
                    <td><?php echo $data_get_device['prodavec']; ?></td>
                    <td><a href="classes/App.php?id=<?php echo $data_get_device['id']; ?>&action=del_way"><font color="red">Удалить</font></a>
                    <a href="fl_izm_way.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a>
                    </td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

<!-- / Модальное окно -->
                    <div id="modal" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Добавление товара вручную</h4>
                    </div>
                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Товар:</label><br>
                    <input class="form-control" placeholder="Товар" type="text" name="tovar" autofocus autocomplete="off">
                    <input type="hidden" name="action" value="add_way">
                    </div>

                    <div class="block">
                    <label class="control-label">Кол-во:</label>
                    <input class="form-control" placeholder="Количество" type="text" name="kolvo" autofocus autocomplete="off" value="1">
                    </div>

                    <div class="block">
                    <label class="control-label">Цена:</label>
                    <input class="form-control" placeholder="Цена" type="tel" pattern="[0-9]{0,100}" name="chena" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Профит:</label>
                    <input class="form-control" placeholder="профит" type="tel" pattern="[0-9]{0,100}" name="profit" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">ТТН:</label>
                    <input class="form-control" placeholder="ТТН" type="tel" pattern="[0-9]{0,100}" name="ttn" autofocus autocomplete="off">
                    </div>


                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control" placeholder="Комментарий" type="text" name="komment" autofocus autocomplete="off">
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                    </div>

                    <div class="block">
                    <label class="control-label">Магазин:</label><br>
                      <select name="magazin">
                    <?php
                    $sql_get_magaz = $pdo->getRows("SELECT * FROM `magazins` ");
                    foreach ( $sql_get_magaz as $data ) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>

                    <div class="block">
                    <label class="control-label">Продавец:</label><br>
                      <select name="prodavec">
                    <?php
                    $sql_get_magaz = $pdo->getRows("SELECT * FROM `users_8897532` WHERE `role`<'3' ");
                    foreach ( $sql_get_magaz as $data ) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>


                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Принять заказ</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>


                    
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

