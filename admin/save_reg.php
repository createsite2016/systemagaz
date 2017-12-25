<?
$login = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];
$profes = "инженер";
$ip = $_SERVER['REMOTE_ADDR'];
$sklad = $_POST['sklad'];

$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$name = stripslashes($name);
$name = htmlspecialchars($name);

$profes = stripslashes($profes);
$profes = htmlspecialchars($profes);

$sklad = stripslashes($sklad);
$sklad = htmlspecialchars($sklad);

include('bd.php');
$sql = mysql_query("SELECT `login` FROM `users_8897532` WHERE `login`='$login' ",$db); 
$result=mysql_fetch_array($sql);

  if ($result['login']==$login)
{
print <<<HERE
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" http-equiv='Refresh' content='3; URL=registr.php'>
  <title>Ошибка регистрации</title>
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
              <h3 class="h2 text-black">Придумайте другой логин</h1>
            </div>
            <div class="list-group m-b-small">
              <a href="index_old.php" class="list-group-item">
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

include("niz.php");

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
}
else
{
$result2 = mysql_query("INSERT INTO `users_8897532` (`login`,`password`,`name`,`role`,`ip`,`profes`, `sklad`) VALUES ('$login','$password','$name','3','$ip','$profes', '$sklad')",$db);
print <<<HERE
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" http-equiv='Refresh' content='2; URL=index_old.php'>
  <title>Успешная регистрации</title>
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
              <h3 class="h2 text-black">Регистрация прошла успешно, теперь вы можете авторизоваться</h1>
            </div>
            <div class="list-group m-b-small">
              <a href="index_old.php" class="list-group-item">
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

include("niz.php");

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
}
?>