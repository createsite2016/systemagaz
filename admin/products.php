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
        <form class="m-b-none" action="search_product.php" method="POST">
    <br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#categor"><i class="icon-folder-open-alt"></i> Новая категория</a> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> |


                <div class="col-sm-4">
                  <div class="input-group">
                    <input type="text" name="search_tovar" class="input-sm form-control" placeholder="Поиск по артиклю" value="">
                    <span class="input-group-btn">
                      <button class="btn btn-sm btn-white" type="submit">Найти</button>
                    </span>
                  </div>
                </div>
                </form>

            </span></b><br><br>
    <?php } ?>
    <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Порядок</b></th>
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

    $sql_get_products = $pdo->getRows("SELECT * FROM `categor` ORDER BY `sort` ");
    foreach ( $sql_get_products as $products ) {
        ?>
                  <tr>
                    <td><?php echo $products['sort']; ?></td>
                    <td><a href="fl_open_products.php?id_categor=<?php echo $products['id']; ?>"><img src="images/categor.png"><?php echo $products['name'];
                            $sql_get_tovar = $pdo->getRow("SELECT SUM(`kolvo`) FROM `tovar` WHERE `categor_id` = $products[id] ");
                            foreach ($sql_get_tovar as $test){
                                if ($test > 0) {
                                    echo "<font color='#228b22'> ( кол-во товара: ".$test."шт. )</font>";
                                } else {
                                    echo "<font color='#a9a9a9'> ( категория пуста )</font>";
                                }

                            }
                            ?></a></td>
                    <td><a data-toggle="modal" href="#delete<?php echo $products['id']; ?>"><font color="red">Удалить</font></a>
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
                    <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php" method="POST">
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
                            <label class="control-label">Артикул:</label>
                            <input class="form-control parsley-validated" placeholder="" type="text" name="article" autofocus autocomplete="off">
                        </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Название:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                        <input type="hidden" name="action" value="add_tovar">
                        <input type="hidden" name="user_id" value="<?php echo $id_user; ?>">
                    </div>
                    </div>

                    <div class="modal-body">
                        <div class="block">
                            <label class="control-label">Фото:</label>
                            <input type="file" name="foto" title="Прикрепить файл"></a><br>
                        </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Страна производитель:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(Закупка):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Цена(Продажа):</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Описание:</label>
                    <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                    </div>
                    </div>

                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Показывать на витрине?</label><br>
                      <select name="status">
                            <option selected value="Да">Да</option>
                            <option value="Нет">Нет</option>
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
<?php
    $sql_products = $pdo->getRows("SELECT * FROM `categor` ORDER BY `name` DESC ");
        foreach ( $sql_products as $windows ){ ?>

            <!--Модальное окно удаления категории-->
            <div id="delete<?php echo $windows['id']; ?>" class="modal fade" style="display: none;" aria-hidden="true">
                <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php?id=<?php echo $windows['id']; ?>&action=del_categor"  method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Вы хотите удалить категорию товара?</h4>
                            </div>

                            <center>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Да</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Нет</button>
                                </div>
                            </center>
                        </div>
                    </div>
                </form>
            </div>

<?php } ?>

<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

