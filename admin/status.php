<?php
session_start();
//$error = show; // вывод ошибок

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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-info"></i> Новый статус</a> | </span></b><br><br>
    <div class="table-responsive">
        <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Порядок</b></th>
                    <th><b>Статус</b></th>
                    <th><b>Цвет</b></th>
                    <th><b>Примечание</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
    $sql_get_device = $pdo->getRows("SELECT * FROM `status` ORDER BY ? ",[sotr]);
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php echo $data_get_device['sort']; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td bgcolor="<?php echo $data_get_device['color']; ?>"></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><a href="classes/App.php?action=del_status&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_status.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
    $sql_get_device = $pdo->getRows( "SELECT * FROM `status` ORDER BY `sort` ASC ");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php echo $data_get_device['sort']; ?></td>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td bgcolor="<?php echo $data_get_device['color']; ?>"><font color="black"><?php echo $data_get_device['name_color']; ?></font></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                   <td><a href="classes/App.php?action=del_status&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_status.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="modal" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый статус</h4>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_status">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Примечание:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Порядок вывода:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="sort" autofocus autocomplete="off" value="0">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цвет:</label>
                      <select name="color">
                        <option value="#FFFFFF">Без цвета</option>
                        <option value="#45B5B3">Cиний</option>
                        <option value="#45B562">Зеленый</option>
                        <option value="#E7D627">Желтый</option>
                        <option value="#CC3E43">Красный</option>
                        <option value="#CCC9CF">Серый</option>
                        <option value="#FF7400">Оранжевый</option>
                        <option value="#FF0096">Розовый</option>
                        <option value="#CDEB8B">Салатовый</option>
                      </select>
                    </div>

                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Внести в справочник</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>
