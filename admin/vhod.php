<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
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
    <a href="#"><center><h4><font color="white"><br>Авторизация</font></h4></center></a>
  </header>
  <!-- / header -->
  <section id="content">
    <div class="main padder">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 m-t-large">
          <section class="panel">
            <header class="panel-heading text-center">
              Вход
            </header>
            <form action="testreg.php" class="panel-body" method="POST">
              <div class="block">
                <label class="control-label">Логин</label>
                <input type="text" placeholder="ваш логин" name="login" value="<?php echo $_SESSION['login'];?>" autocomplete="on" class="form-control">
              </div>
              <div class="block">
                <label class="control-label">Пароль</label>
                <input type="password" id="inputPassword" placeholder="ваш пароль" value="<?php echo $_SESSION['password'];?>" autocomplete="on" name="password" class="form-control">
              </div>
              <div class="checkbox">
              </div>
              <center>
              <button type="submit" class="btn btn-info"><i class="icon-signin"></i> Войти</button>
              </center>
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