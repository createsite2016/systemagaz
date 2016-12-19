<?php
          include("bd.php");
          $login = $_SESSION['login'];
          $login = stripslashes($login);
          $login = htmlspecialchars($login);

          $sql = mysql_query("SELECT * FROM `users_8897532` WHERE `login`='$login'",$db); 
          $data = mysql_fetch_array($sql);
          $login = $data['login'];
          $name = $data['name'];
          $user_sc = $data['sklad'];
          $id_user = $data['id'];
          $user_role = $data['role'];
function go_link($link_way,$link_name){
    echo "<a href='".$link_way."'>".$link_name."</a>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Система управления заказами</title>
  <meta name="" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/font.css" cache="false">
   <link rel="stylesheet" href="js/select2/select2.css" cache="false">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/plugin.css">
  <link rel="stylesheet" href="css/landing.css">
</head>
<body>
  <header id="header" class="navbar">
    <ul class="nav navbar-nav navbar-avatar pull-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
          <span class="hidden-xs-only"><?php echo $user_name; ?></span>
          <span class="thumb-small avatar inline"><img src="images/avatar.jpg" alt="Mika Sokeil" class="img-circle"></span>
          <b class="caret hidden-xs-only"></b>
        </a>
        <ul class="dropdown-menu">
<?php include('menu_right.php'); ?>
        </ul>
      </li>
    </ul>
    <a class="navbar-brand" href="index.php"></a>
    <button type="button" class="btn btn-link pull-left nav-toggle visible-xs" data-toggle="class:slide-nav slide-nav-left" data-target="body">
      <i class="icon-reorder icon-xlarge text-default"></i>
    </button>
  </header>
  <nav id="nav" class="nav-primary hidden-xs nav-vertical">
    <ul class="nav" data-spy="affix" data-offset-top="50">
<?php include('menu_left.php'); ?>
      </li>
    </ul>
  </nav>