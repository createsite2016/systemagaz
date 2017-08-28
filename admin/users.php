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
  <nav id="nav" class="nav-primary hidden-xs nav-vertical">
    <ul class="nav" data-spy="affix" data-offset-top="50">
<?php include('menu_left.php'); ?>
      </li>
    </ul>
  </nav>
  <!-- / nav -->
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
<br><b><span class="center"> | <a href="fl_add_user.php" class="btn btn-default btn-xs">Добавить пользователя</a> | </span></b><br><br>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Имя</b></th>
                    <th><b>Логин</b></th>
                    <th><b>Пароль</b></th>
                    <th>Ред.</th>
                  </tr>
                </thead>
                <tbody>
<?php
$i = 0;
include('showdata_forpeople.php');
$sql_get_device = $pdo->getRows("SELECT * FROM `users_8897532` ");
foreach ( $sql_get_device as $data_get_device ) {
    $i++; ?>
                  <tr>
                    <td><?php echo $data_get_device['name'];// проффесия ?></td>
                    <td><?php echo $data_get_device['login']; // логин ?></td>
                    <td><?php echo $data_get_device['password'];// пароль ?></td>
                      <td>
                          <div class="btn-group">
                              <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="fl_izm_user.php?id=<?php echo $data_get_device['id']; ?>">Ред-ть данные</a></li>
                                  <li class="divider"></li>
                                  <li class="divider"></li>
                                  <li><a href="classes/App.php?action=del_user&id=<?php echo $data_get_device['id']; ?>"><font color="red">Уволить сотрудника</font></a></li>
                              </ul>
                          </div>
                      </td>
                  </tr>
<?php } ?>

                </tbody>
              </table>
            </div>
          </section>
        </div>

  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <footer id="footer">
    <div class="text-center padder clearfix">
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>
