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
      <div class="row">
<?php
$id = $_GET['id'];
$params = $pdo->getRow("SELECT * FROM `users_8897532` WHERE `id`= ? ",[$id]);
?>
<section class="panel">
            <div class="panel-body">
              <form action="classes/App.php" class="form-horizontal" method="POST" data-validate="parsley">
                <div class="form-group">
                  <div class="col-lg-9 media">
                    <center><h4><i class="icon-edit"></i>Изменение данных сотрудника</h4></center>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Имя:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_name" placeholder="Иван" data-required="true" class="form-control parsley-validated" value="<?php echo $params['name']; ?>">
                    <input type="hidden" name="profes" value="Директор" >
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Логин:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_login" placeholder="ivan" data-required="true" class="form-control parsley-validated" value="<?php echo $params['login']; ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Пароль:</label>
                  <div class="col-lg-8">
                    <input type="text" name="u_password" placeholder="123qwe" data-required="true" class="form-control parsley-validated" value="<?php echo $params['password']; ?>">
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <span class="center"><a href="users.php" class="btn btn-default btn-xs">Отмена</a></span>
                  </div>
                </div>
              </form>


            </div>
          </section>
<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>
