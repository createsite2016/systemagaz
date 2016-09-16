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
<br><b><span class="center"> | <a class="btn btn-sm btn-info" data-toggle="modal" href="#modal"><i class="icon-credit-card"></i> Новый заказ</a> | </span></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th></th>
                    <th><b>Дата</b></th>
                    <th><b>ФИО</b></th>
                    <th><b>Телефон</b></th>
                    <th><b>Адрес</b></th>
                    <th><b>Служба доставки<b></th>
                    <th><b>Товары</b></th>
                    <th><b>Статус</b></th>
                    <th><b>Менеджер</b></th>
                    <th><b>Магазин</b></th>
                    <th>Редактировать</th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `priem` ORDER BY `datatime` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td>
                    <div class="checkbox">
                    <label class="checkbox-custom">
                      <input name="checkboxA" type="checkbox">
                      <i class="icon-unchecked"></i>
                    </label>
                  </div>
                    </td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php $vremya = date_smart($data_get_device['datatime']); echo $vremya ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['fio']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['phone']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['adress']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['dostavka']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['tovar']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['status']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['user_name']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['sklad']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_zakaz.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="fl_del_zakaz.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
                  </tr>
<?php }} 


// Если роль пользователя 3
if ($user_role=='3') {
                        $sql_get_device = mysql_query("SELECT * FROM `priem` ORDER BY `datatime` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                  <td>
                    <div class="checkbox">
                    <label class="checkbox-custom">
                      <input name="checkboxA" type="checkbox">
                      <i class="icon-unchecked"></i>
                    </label>
                  </div>
                    </td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php $vremya = date_smart($data_get_device['datatime']); echo $vremya ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['fio']; // фамилия ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['phone'];?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['adress']; // адрес ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['dostavka']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['tovar']; // содержание ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['status']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['user_name']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>"><b><font color="black"><?php echo $data_get_device['sklad']; ?></font></b></td>
                    <td bgcolor="<?php echo $data_get_device['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                            <li><a href="fl_izm_zakaz.php?id=<?php echo $data_get_device['id']; ?>&usid=<?php echo $id_user; ?>">Изменить</a></li>
                            <li class="divider"></li>
                            <li><a href="fl_del_zakaz.php?id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
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
                    <form class="m-b-none" action="fl_post_add_zakaz.php" method="POST">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый заказ</h4>
                    </div>
                    <div class="modal-body">
                    <div class="block">
                    <label class="control-label">Фамилия:</label>
                    <input class="form-control parsley-validated" placeholder="Иванов" type="text" name="fio" autofocus autocomplete="off">
                    </div>
                    <div class="block">
                    <label class="control-label">Телефон:</label>
                    <input class="form-control parsley-validated" placeholder="Телефон" type="text" name="phone" autofocus autocomplete="off">
                    </div>
                    <div class="block">
                    <label class="control-label">Адрес:</label>
                    <input class="form-control" placeholder="Адрес" type="text" name="adress" autofocus autocomplete="off">
                    </div>

                    <div class="block">
                    <label class="control-label">Служба доставки:</label><br>
                      <select name="dostavka">
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `dostavka` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>


                    <div class="block">
                    <label class="control-label">Содержание:</label>
                    <textarea placeholder="Содержание" rows="3" name="tovar" class="form-control parsley-validated" data-trigger="keyup" ></textarea>
                    <input type="hidden" name="user_name" value="<?php echo $name ?>" >
                    <input type="hidden" name="user_sc" value="<?php echo $user_sc ?>" >
                    </div>

                    <div class="block">
                    <label class="control-label">Магазин:</label><br>
                      <select name="sklad">
                    <?php
                    $sql_get_magaz = mysql_query("SELECT * FROM `magazins` ",$db);
                      while ($data = mysql_fetch_assoc($sql_get_magaz)) {
                      echo "<option>".$data['name']."</option>";
                    }
                    ?>
                      </select>
                    </div>

                    <div class="block">
                    <label class="control-label">Статус:</label><br>
                      <select name="status">
                    <?php
                    $sql_get_status = mysql_query("SELECT * FROM `status` ",$db);
                      while ($data_status = mysql_fetch_assoc($sql_get_status)) {
                      echo "<option value=".$data_status['color'].">".$data_status['name']."</option>";
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

