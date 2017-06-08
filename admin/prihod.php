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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-plus"></i> Новый приход</a> | </span></b><br><br>
    <div class="table-responsive">
        <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b><font color="green">Дата</font></b></th>
                    <th><b><font color="green">Наличка</font></b></th>
                    <th><b><font color="green">USD</font></b></th>
                    <th><b><font color="green">EUR</font></b></th>
                    <th><b><font color="green">Счет1</font></b></th>
                    <th><b><font color="green">Счет2</font></b></th>
                    <th><b><font color="green">Счет3</font></b></th>
                    <th><b><font color="green">Счет4</font></b></th>
                    <th><b><font color="green">Счет5</font></b></th>
                    <th><b><font color="green">Счет6</font></b></th>
                    <th><b><font color="green">Менеджер</font></b></th>
                    <th><b><font color="green">Статья</font></b></th>
                    <th><b><font color="green">Комментарий</font></b></th>
                    <th>Ред</th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
    $sql_get_device = $pdo->getRows("SELECT * FROM `prihod` ORDER BY `datatime` DESC ");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php $date = new DateTime($data_get_device['datatime']); echo $date->format('d.m.y | H:i'); ?></td>
                      <td><?php echo number_format($data_get_device['uah'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['usd'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['eur'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash1'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash2'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash3'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash4'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash5'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash6'], 0, ',', ' '); ?></td>
                    <td><?php echo $data_get_device['manager']; ?></td>
                    <td><?php echo $data_get_device['statya']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>

                    <td td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_prihod.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="fl_del_prihod.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
                  </tr>
<?php }} 


// Если роль пользователя 3
if ($user_role=='3') {
    $sql_get_device = $pdo->getRows("SELECT * FROM `prihod` ORDER BY `datatime` DESC ");
    foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td><?php $date = new DateTime($data_get_device['datatime']); echo $date->format('d.m.y | H:i'); ?></td>
                      <td><?php echo number_format($data_get_device['uah'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['usd'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['eur'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash1'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash2'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash3'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash4'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash5'], 0, ',', ' '); ?></td>
                      <td><?php echo number_format($data_get_device['cash6'], 0, ',', ' '); ?></td>
                    <td><?php echo $data_get_device['manager']; ?></td>
                    <td><?php echo $data_get_device['statya']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>

                    <td td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_prihod.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="classes/App.php?action=del_prihod&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
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
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый приход</h4>
                    </div>
                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                    <?php
                    $sql_get_magaz = $pdo->getRows("SELECT * FROM `status_pr` ");
                    foreach ( $sql_get_magaz as $data) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>

                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control" placeholder="Комментарий" type="text" name="komment" autofocus autocomplete="off">
                    <input type="hidden" name="action" value="add_prihod">
                    </div>

                    <b><font color="green"><i class="icon-money"></i>НАЛИЧНЫЕ</font></b>

                    <div class="block">
                    <label class="control-label">UAH:</label>
                    <input class="form-control" placeholder="UAH" type="tel" pattern="[0-9]{0,100}" name="uah" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">USD:</label>
                    <input class="form-control" placeholder="USD" type="tel" pattern="[0-9]{0,100}" name="usd" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">EUR:</label>
                    <input class="form-control" placeholder="EUR" type="tel" pattern="[0-9]{0,100}" name="eur" autofocus autocomplete="off">
                    </div>

                    <b><font color="green"><i class="icon-credit-card"></i>БЕЗНАЛ</font></b>

                    <div class="block">
                    <label class="control-label">Счет1:</label>
                    <input class="form-control" placeholder="Счет1" type="tel" pattern="[0-9]{0,100}" name="cash1" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет2:</label>
                    <input class="form-control" placeholder="Счет2" type="tel" pattern="[0-9]{0,100}" name="cash2" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет3:</label>
                    <input class="form-control" placeholder="Счет3" type="tel" pattern="[0-9]{0,100}" name="cash3" autofocus autocomplete="off">
                    </div>
                    
                    <div class="block">
                    <label class="control-label">Счет4:</label>
                    <input class="form-control" placeholder="Счет4" type="tel" pattern="[0-9]{0,100}" name="cash4" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет5:</label>
                    <input class="form-control" placeholder="Счет5" type="tel" pattern="[0-9]{0,100}" name="cash5" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет6:</label>
                    <input class="form-control" placeholder="Счет6" type="tel" pattern="[0-9]{0,100}" name="cash6" autofocus autocomplete="off">
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
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

