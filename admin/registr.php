<?php
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$get_user_info = $pdo->getRows("SELECT * FROM `users_8897532`"); // получение данных о пользователях
foreach ( $get_user_info as $data_user_info ) { }
if ( $data_user_info['id']>0 ) {
exit("<html><head><meta http-equiv='Refresh' content='0; URL=index_old.php'></head></html>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Система управления заказами</title>
  <meta name="description" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/font.css" cache="false">
  <link rel="stylesheet" href="css/style.css">
  <!--[if lt IE 9]>
    <script src="js/ie/respond.min.js" cache="false"></script>
    <script src="js/ie/html5.js" cache="false"></script>
  <![endif]-->
</head>
<body>
  <!-- header -->
  <header id="header" class="navbar bg bg-black">
    <a href="registr.php"><center><h4><font color="white"><br>Регистрация</font></h4></cente></a>
  </header>
  <!-- / header -->
  <section id="content">
    <div class="main padder">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 m-t-large">
          <section class="panel">
            <header class="panel-heading text-center">
              Создайте пользователя, заполните все поля
            </header>
            <form action="classes/App.php" class="panel-body" method="POST">
              <div class="block">
                <label class="control-label">Ваше имя</label>
                <input type="text" name="name" placeholder="имя" class="form-control">
              </div>
              <div class="block">
                <label class="control-label">Ваш логин</label>
                <input type="text" name="login" placeholder="на английском" class="form-control">
              </div>
              <div class="block">
                <label class="control-label">Ваш пароль</label>
                <input type="text" name="password" id="inputPassword" placeholder="более 6 символов" class="form-control">
                <input type="hidden" name="action" value="create_user">
              </div>
              <br>
              <div class="line line-dashed"></div>
              <p class="text-muted text-center"><small>Перед тем как нажать, проверьте правильность введенных данных</small></p>
              <center>
              <button type="submit" class="btn btn-info">Все правильно, Зарегистрироваться</button>
              </center>

              <div class="line line-dashed"></div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
<?php
include("niz.php");
?>
    </div>
  </footer>
  <!-- / footer -->
	<script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- app -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/app.data.js"></script>
</body>
</html>