<?php
print <<<HERE
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Ошибка авторизации</title>
  <meta name="">
  <meta name=""> 
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
    <a href="#" class="btn btn-link pull-right m-t-mini" data-toggle="class:bg-inverse" data-target="html"><i class="icon-lightbulb icon-xlarge text-default"></i></a>
    <a class="navbar-brand" href=""></a>
  </header>
  <!-- header end -->
  <section id="content">
    <div class="main padder">
      <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
            <div class="text-center m-b-large">
              <h3 class="h2 text-black"><i class="icon-frown"></i><h1>
Не верный логин или пароль
            </h1>
            </div>
            <div class="list-group m-b-small">
              <a href="index.php" class="list-group-item">
                <i class="icon-chevron-right"></i>
                <i class="icon-home"></i> Вернуться на главную
              </a>
            </div>
          </div>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
HERE;

include("../../niz.php");

print <<<HERE
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
HERE;
exit;
?>