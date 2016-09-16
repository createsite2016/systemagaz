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
    <a href="#"><center><h4><font color="white"><br>Регистрация</font></h4></cente></a>
  </header>
  <!-- / header -->
  <section id="content">
    <div class="main padder">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 m-t-large">
          <section class="panel">
            <header class="panel-heading text-center">
              Заполните все поля
            </header>
            <form action="save_reg.php" class="panel-body" method="POST">
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
              </div>
              <br>
              <center>
              <button type="submit" class="btn btn-info">Зарегистрироваться</button>
              </center>
              <div class="line line-dashed"></div>
              <p class="text-muted text-center"><small>У Вас уже есть аккаунт?</small></p>
              <a href="index.php" class="btn btn-white btn-block">Войти</a>
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