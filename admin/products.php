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

    <?php
// Доступ только для администраторов
    if ($user_role=='3') { ?>
    <br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#categor"><i class="icon-folder-open-alt"></i> Новая категория</a> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> |</span></b><br><br>
    <?php } ?>
    <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Категория</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
    $sql_get_products = $pdo->getRows("SELECT * FROM `categor` ORDER BY `name` DESC ");
    foreach ( $sql_get_products as $products ) { ?>
                  <tr>
                    <td><a href="fl_open_products.php?id_categor=<?php echo $products['id']; ?>"><?php echo $products['name']; ?></a></td>
                    <td>Нет прав</td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {

    $sql_get_products = $pdo->getRows("SELECT * FROM `categor` ORDER BY `name` DESC ");
    foreach ( $sql_get_products as $products ) { ?>
                  <tr>
                    <td><a href="fl_open_products.php?id_categor=<?php echo $products['id']; ?>"><?php echo $products['name']; ?></a></td>
                    <td><a href="classes/App.php?id=<?php echo $products['id']; ?>&action=del_categor"><font color="red">Удалить</font></a>
                    <a href="fl_izm_categor.php?id=<?php echo $products['id']; ?>"><font color="Green">Изменить</font></a></td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="categor" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новая категория</h4>
                    </div>
                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_categor">
                    </div>
                    </div>


                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>





                    <div id="tovar" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="classes/App.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый товар</h4>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Категория:</label>
                    <select name="categor_id">
                    <?php
                    $sql_get_categor = $pdo->getRows("SELECT * FROM `categor` ");
                    foreach ( $sql_get_categor as $data_categor ) {

                      echo "<option value=".$data_categor['id'].">".$data_categor['name']."</option>";

                    }
                    ?>
                    </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_tovar">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Модель:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вх.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                    <select name="money_input">
                    <?php
                    $sql_get_money = $pdo->getRows("SELECT * FROM `money` ");
                    foreach ( $sql_get_money as $data_money ) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(вых.):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                    <select name="money_output">
                    <?php
                    $sql_get_money = $pdo->getRows("SELECT * FROM `money` ");
                    foreach ( $sql_get_money as $data_money ) {
                      echo "<option>".$data_money['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                            <option selected value="Доступен">Доступен</option>
                            <option value="Недоступен">Недоступен</option>
                            <option value="Неизвестен">Неизвестен</option>
                      </select>
                    </div>


                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

