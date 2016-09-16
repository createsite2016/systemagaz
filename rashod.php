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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-minus"></i> Новый расход</a> | </span></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th><b><font color="red">Дата</font></b></th>
                    <th><b><font color="red">UAH</font></b></th>
                    <th><b><font color="red">USD</font></b></th>
                    <th><b><font color="red">EUR</font></b></th>
                    <th><b><font color="red">Счет1</font></b></th>
                    <th><b><font color="red">Счет2</font></b></th>
                    <th><b><font color="red">Счет3</font></b></th>
                    <th><b><font color="red">Счет4</font></b></th>
                    <th><b><font color="red">Счет5</font></b></th>
                    <th><b><font color="red">Счет6</font></b></th>
                    <th><b><font color="red">Менеджер</font></b></th>
                    <th><b><font color="red">Статья</font></b></th>
                    <th><b><font color="red">Комментарий</font></b></th>
                    <th>Редактировать</th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `rashod` ORDER BY `datatime` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php $vremya = date_smart($data_get_device['datatime']); echo $vremya ?></td>
                    <td><?php echo $data_get_device['uah']; ?></td>
                    <td><?php echo $data_get_device['usd']; ?></td>
                    <td><?php echo $data_get_device['eur']; ?></td>
                    <td><?php echo $data_get_device['cash1']; ?></td>
                    <td><?php echo $data_get_device['cash2']; ?></td>
                    <td><?php echo $data_get_device['cash3']; ?></td>
                    <td><?php echo $data_get_device['cash4']; ?></td>
                    <td><?php echo $data_get_device['cash5']; ?></td>
                    <td><?php echo $data_get_device['cash6']; ?></td>
                    <td><?php echo $data_get_device['manager']; ?></td>
                    <td><?php echo $data_get_device['statya']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>

                    <td td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_rashod.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="fl_del_rashod.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
                  </tr>
<?php }} 


// Если роль пользователя 3
if ($user_role=='3') {
                        $sql_get_device = mysql_query("SELECT * FROM `rashod` ORDER BY `datatime` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td><?php $vremya = date_smart($data_get_device['datatime']); echo $vremya ?></td>
                    <td><?php echo $data_get_device['uah']; ?></td>
                    <td><?php echo $data_get_device['usd']; ?></td>
                    <td><?php echo $data_get_device['eur']; ?></td>
                    <td><?php echo $data_get_device['cash1']; ?></td>
                    <td><?php echo $data_get_device['cash2']; ?></td>
                    <td><?php echo $data_get_device['cash3']; ?></td>
                    <td><?php echo $data_get_device['cash4']; ?></td>
                    <td><?php echo $data_get_device['cash5']; ?></td>
                    <td><?php echo $data_get_device['cash6']; ?></td>
                    <td><?php echo $data_get_device['manager']; ?></td>
                    <td><?php echo $data_get_device['statya']; ?></td>
                    <td><?php echo $data_get_device['komment']; ?></td>

                    <td td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_rashod.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="fl_del_rashod.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>

                    <div id="modal" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" action="fl_post_add_rashod.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый расход</h4>
                    </div>
                    <div class="modal-body">

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `status_rs` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>

                    <div class="block">
                    <label class="control-label">Комментарий:</label>
                    <input class="form-control" placeholder="Комментарий" type="text" name="komment" autofocus autocomplete="off">
                    </div>

                    <b><font color="red"><i class="icon-money"></i>НАЛИЧНЫЕ</font></b>

                    <div class="block">
                    <label class="control-label">UAH:</label>
                    <input class="form-control" placeholder="UAH" type="text" name="uah" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">USD:</label>
                    <input class="form-control" placeholder="USD" type="text" name="usd" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">EUR:</label>
                    <input class="form-control" placeholder="EUR" type="text" name="eur" autofocus autocomplete="off">
                    </div>

                    <b><font color="red"><i class="icon-credit-card"></i>БЕЗНАЛ</font></b>

                    <div class="block">
                    <label class="control-label">Счет1:</label>
                    <input class="form-control" placeholder="Счет1" type="text" name="cash1" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет2:</label>
                    <input class="form-control" placeholder="Счет2" type="text" name="cash2" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет3:</label>
                    <input class="form-control" placeholder="Счет3" type="text" name="cash3" autofocus autocomplete="off">
                    </div>
                    
                    <div class="block">
                    <label class="control-label">Счет4:</label>
                    <input class="form-control" placeholder="Счет4" type="text" name="cash4" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет5:</label>
                    <input class="form-control" placeholder="Счет5" type="text" name="cash5" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Счет6:</label>
                    <input class="form-control" placeholder="Счет6" type="text" name="cash6" autofocus autocomplete="off">
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

