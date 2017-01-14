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
<?php
$id_categor = $_GET['id_categor'];

$sql_get_name_categor = $pdo->getRows("SELECT * FROM `categor` WHERE `id` = ? LIMIT 1 ", [$id_categor]);
foreach ( $sql_get_name_categor as $data_name_categor ) {
    $name_categor = $data_name_categor['name'];
} ?>

<section class="panel">

<br><b><span class="center"><b> |   <a href="products.php">  <- <?php echo $name_categor; ?></a></b> |

    <?php
// ДОСТУП ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ
    if ($user_role=='3') { ?>
            <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> | </span></b><br><br>
<?php } ?>

    <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Модель</b></th>
                    <th><b>Наименование</b></th>
                    <th><b>Кол-во</b></th>
                    <th><b>Цена(вх.)</b></th>
                    <th><b>Цена(вх. местная валюта)</b></th>
                    <th><b>Цена(ис.)</b></th>
                    <th><b>состояние</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {

    $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `categor_id` =  ? ",[$id_categor]);
    foreach ( $sql_products as $data_products ) { ?>
                  <tr>
                    <td><?php echo $data_products['model']; ?></td>
                    <td><?php echo $data_products['name']; ?></td>
                    <td><?php echo $data_products['kolvo']; ?></td>
                    <td><?php echo $data_products['chena_input']; echo " "; echo $data_products['money_input']; ?></td>
                      <td> </td>
                      <td><?php echo $data_products['chena_output'];?></td>
                    <td><?php echo $data_products['status']; ?></td>
                    <td>Нет прав</td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {
    $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `categor_id` =  ? ",[$id_categor]);
    foreach ( $sql_products as $data_products ) { ?>
                  <tr>
                    <td><?php echo $data_products['model']; ?></td>
                    <td><?php echo $data_products['name']; ?></td>
                    <td><?php echo $data_products['kolvo']; ?></td>
                      <td><?php echo $data_products['chena_input']; echo " "; echo $data_products['money_input']; $valuta_name = $data_products['money_input'];?></td>
                      <td><?php

                          $sql_v = $pdo->getRow("SELECT `chena` FROM `money` WHERE `name` = ? ",[$valuta_name]);
                          foreach ($sql_v as $data_v) {
                              echo $data_v[0] * $data_products['chena_input']; // местная валюта
                          }

                          ?></td>
                      <td><?php echo $data_products['chena_output'];?></td>
                    <td><?php echo $data_products['status']; ?></td>
                    <td><a href="classes/App.php?id=<?php echo $data_products['id']; ?>&action=del_tovar&categor=<?php echo $id_categor; ?>"><font color="red">Удалить</font></a>
                    <a href="fl_izm_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green">Изменить</font></a><br>
                    <a href="fl_prinyat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                        <?php
                        if ($data_products['kolvo']>0){ ?>
                            <a href="fl_prodat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                        <?php } ?>
                    </td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>







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
                                    <label class="control-label">Название:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                                    <input type="hidden" name="action" value="add_tovar">
                                    <input type="hidden" name="categor_id" value="<?php echo $id_categor; ?>">
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

