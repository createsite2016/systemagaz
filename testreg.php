<?php
ini_set("session.gc_maxlifetime",99999) ;
session_start();// вся процедура работает на сессиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{



//exit ("Вы ввели не всю информацию, венитесь назад и заполните все поля!");
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);


// подключаемся к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 



$result = mysql_query("SELECT * FROM `users_8897532` WHERE `login`='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysql_fetch_array($result);
if (empty($myrow['password']))
{
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
              <h3 class="h2 text-black"><i class="icon-frown"></i> Не верный пароль или логин</h1>
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
exit;
}
else {
//если существует, то сверяем пароли
          if ($myrow['password']==$password) {
          //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
          $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
          echo "<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>";
          }

       else {
       //если пароли не сошлись
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
              <h3 class="h2 text-black"><i class="icon-thumbs-down"></i> не верный пароль, логин</h1>
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
exit;
	   }
}
?>