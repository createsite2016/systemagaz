<?php
session_start();

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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-user"></i> Новый поставщик</a> | </span></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th><b>№</b></th>
                    <th><b>Поставщик</b></th>
                    <th><b>Примечание</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
    $sql_get_device = $pdo->getRows("SELECT * FROM `postavshiki` ORDER BY `name`");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php echo ++$z; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><a href="classes/App.php?action=del_potavshiki&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_postavshiki.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
    $sql_get_device = $pdo->getRows("SELECT * FROM `postavshiki` ORDER BY `name`");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php echo ++$z; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><a href="classes/App.php?action=del_potavshiki&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_postavshiki.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="modal" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый поставщик</h4>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_potavshiki">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Примечание:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Внести поставщика в справочник</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

