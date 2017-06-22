<?php
include_once "classes/App.php"; // подключаем БД
$pdo = new Database();
          $login = $_SESSION['login'];
          $login = stripslashes($login);
          $login = htmlspecialchars($login);
$udata = $pdo->getRows("SELECT * FROM `users_8897532` WHERE `login`= ? ",[$login]);
foreach ($udata as $value) {
    $login = $value['login']; // логин пользователя
    $name = $value['name']; // имя пользователя
    $user_sc = $value['sklad']; //
    $id_user = $value['id']; // адишник пользователя
    $user_role = $value['role']; // права пользователя
}

function go_link($link_way,$link_name){
    echo "<a href='".$link_way."'>".$link_name."</a>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Система управления интернет торговлей</title>
  <meta name="" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <link rel="shortcut icon" href="icon.ico" type="image/x-icon">
            <link rel='stylesheet' href='css/bootstrap.css'>
            <link rel='stylesheet' href='css/font-awesome.min.css'>
            <link rel='stylesheet' href='css/font.css'>
            <link rel='stylesheet' href='js/select2/select2.css'>
            <link rel='stylesheet' href='css/style.css'>
            <link rel='stylesheet' href='css/plugin.css'>
            <link rel='stylesheet' href='css/landing.css'>

    <script id="chatBroEmbedCode">
        /* Chatbro Widget Embed Code Start */
        function ChatbroLoader(chats,async) {async=async!==false;var params={embedChatsParameters:chats instanceof Array?chats:[chats],needLoadCode:typeof Chatbro==='undefined'};var xhr=new XMLHttpRequest();xhr.withCredentials = true;xhr.onload=function(){eval(xhr.responseText)};xhr.onerror=function(){console.error('Chatbro loading error')};xhr.open('POST','//www.chatbro.com/embed_chats/',async);xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');xhr.send('parameters='+encodeURIComponent(JSON.stringify(params)))}
        /* Chatbro Widget Embed Code End */
        ChatbroLoader({encodedChatId: '4Cad'});
    </script>
</head>
<body>
  <header id="header" class="navbar">
    <ul class="nav navbar-nav navbar-avatar pull-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
          <span class="hidden-xs-only"><?php echo $name; ?></span>
          <span class="thumb-small avatar inline"><img src="images/avatar.jpg" alt="Mika Sokeil" class="img-circle"></span>
          <b class="caret hidden-xs-only"></b>
        </a>
        <ul class="dropdown-menu">
<?php include('menu_right.php'); ?>
        </ul>
      </li>
    </ul>
    <a class="navbar-brand" href="index.php"></a>
      <p><a href="../index.php" target="_blank"><b><font color="red">-- Перейти в магазин -- </font></b></a></p>
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