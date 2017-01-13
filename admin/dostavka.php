<?php
session_start();
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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-plane"></i> Новая служба доставки</a> | </span></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th><b>Служба доставки</b></th>
                    <th><b>Примечание</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `dostavka` ORDER BY `name` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><a href="fl_del_dostavka.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_dostavka.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
                        $sql_get_device = mysql_query("SELECT * FROM `dostavka` ORDER BY `name` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php echo $data_get_device['name']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>
                    <td><a href="fl_del_dostavka.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_dostavka.php?id=<?php echo $data_get_device['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="modal" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="fl_post_add_dostavka.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новая служба доставки</h4>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Примечание:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
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

