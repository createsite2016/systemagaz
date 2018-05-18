<?
session_start(); // вкл сессию

// получение товара со скидкой, если скидка больше 0 и остаток больше 0
$template["TOVARS_SKIDKI"] = $pdo->getRows("SELECT 
`skidka`
 FROM `tovar` WHERE `skidka` > 0 AND `kolvo` > 0 LIMIT 1");
?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#338e7e">
    <title><?=$template["SEO"]["TITLE"]?></title>
    <meta name="keywords" content="<?=$template["SEO"]["KEYWORDS"]?>" />
    <meta name="description" content="<?=$template["SEO"]["DESCRIPTION"]?>">
    <link href="<?=$template["TEMPLATE_PATH"];?>css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../icon.ico" type="image/x-icon">
    <!--[if lte IE 8]>
    <script type="text/javascript" src="<?=$template[TEMPLATE_PATH];?>js/html5support.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?=$template["TEMPLATE_PATH"];?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=$template["TEMPLATE_PATH"];?>js/jquery.main.js"></script>
    <script type="text/javascript" src="<?=$template["TEMPLATE_PATH"];?>js/fancybox/jquery.fancybox.js"><div></div></script>
    <link href="<?=$template["TEMPLATE_PATH"];?>js/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">

    <?if ( !empty($template["MAGAZIN"]["chatbroscript"]) ) {
        echo $template["MAGAZIN"]["chatbroscript"];
    }
    ?>

    <?if ( !empty($template["MAGAZIN"]["redconnectscript"]) ) {
        echo $template["MAGAZIN"]["redconnectscript"];
    }
    ?>
</head>
<body>



<div class="wrapper">
    <header class="header">
        <div class="top_line">
            <div class="container">
                <div class="curr">

                    <?if ( !empty($_SESSION["USER"]["name"]) ) { // если есть данные в сессии о пользователе?>
                        <ul class="lang">
                            <li>
                                <a class="prj_label" href="lc.php">Личный кабинет (<?=$_SESSION["USER"]["name"]?>)</a>
                                <ul>
                                    <li><a href="lc.php?exit"> Выход</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?} else { // если данных нет, выводим окно авторизации?>
                        <a class="prj_label" onclick="lc();">Личный кабинет</a>
                    <?}?>

                </div>

                <nav class="top_line_menu">
                    <ul>
                        <li><a onclick="show_callback_form();">Форма обратной связи</a></li>
                    </ul>
                </nav>
                <!-- end .top_line_menu -->
            </div>
            <!-- end .container -->
        </div>
        <!-- end .top_line -->
        <div class="container">
            <div class="logo">
                <center>
                    <?if($user["RULES"] == 'y') {?>
                        <a class="btn btn_yellow_bord" href="/admin/fl_izm_magaz.php?id=1" target="_blank">изменить данные о магазине</a>
                    <?}?>
                    <h3><?=$template["MAGAZIN"]['name']?></h3>
                </center>
            </div>
            <div class="head_left">
                <label for="menu_check" id="menu_label"><span class="nav-toggle"><span></span></span></label>
                <!-- end #menu_label -->
                <div class="phone_blk">
                    <a class="phone_num" href="tel:<?=$template["MAGAZIN"]['phone']?>"><?=$template["MAGAZIN"]['phone']?></a>
                    <div class="txt"><?=$template["MAGAZIN"]['komment']?></div>
                    <div class="txt">e-mail: <a href="mailto:<?=$template["MAGAZIN"]['email']?>"><?=$template["MAGAZIN"]['email']?></a></div>
                </div>
                <!-- end .phone_blk -->
            </div>
            <!-- end .head_left -->
            <div class="head_right">

                <a class="top_cart" href="cart.php" id="cart">
                    <?
                    //$_SESSION["cart"] = '';
                    $cart = $_SESSION["cart"];
                    $count = 0;
                    foreach ($cart as $key=>$value){
                        $data[$key] = $value["PRICE"];
                        $count = $count + $value["COUNT"];
                        $res_price = $res_price + ($value["PRICE"] * $value["COUNT"]);
                    }
                    $_SESSION["all_price_cart"] = $res_price;
                    ?>
                    <?=$res_price;?> <span class="top_cart_curr">руб.</span>
                    <span class="top_cart_num"><?=$count;?></span>
                </a>
            </div>
            <!-- end .head_right -->
        </div>
        <!-- end .container -->
        <input type="checkbox" id="menu_check">
        <?
        if($user["RULES"] == 'y') {?>
            <a class="btn btn_yellow_bord" href="/admin/pages.php" target="_blank">управление страницами</a>
        <?}?>
        <nav class="menu">
            <div class="container">
                <ul>
                    <li><a class="popular" href="popular.php">Популярное</a></li>
                    <?if( !empty($template["TOVARS_SKIDKI"][0]["skidka"]) ) {?>
                        <li><a class="new" href="sale.php">Скидки</a></li>
                    <?}?>
                    <?foreach ( $template["PAGES"] as $pages ) { ?>
                        <?if (!empty($pages['about'])) {?>
                            <li><a href="page.php?id=<?php echo $pages['id']; ?>"><?php echo $pages['name']; ?></a></li>
                        <?}?>
                    <?}?>
                </ul>
            </div>
            <!-- end .container -->
        </nav>
        <!-- end .menu -->
    </header>

