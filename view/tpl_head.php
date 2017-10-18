<?php ?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <?php
    if (isset($_GET['cat'])) {
        $categor = $_GET['cat'];
        $data_categor = $pdo->getRow("SELECT * FROM `categor` WHERE `id` = ?",[$categor]);
        $shop['title'] = $data_categor['name'].' '.$shop['city'];
        $shop['keywords'] = $data_categor['name'].' '.$shop['city'];
        $shop['description'] = $data_categor['name'].' '.$shop['city'];
    }
    if (isset($_GET['id'])) {
        $id_tov = $_GET['id'];
        $data_categor = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ?",[$id_tov]);
        $shop['title'] = $data_categor['name'].' '.$shop['city'];
        $shop['keywords'] = $data_categor['name'].' '.$shop['city'];
        $shop['description'] = $data_categor['name'].' '.$shop['city'];
    }
    if ( empty($_GET['id']) & empty($_GET['cat']) ) {
        $shop['keywords'] = $shop['keywords'].' '.$shop['city'];
        $shop['description'] = $shop['description'].' '.$shop['city'];
    }
    ?>
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $shop['keywords']; ?>" />
    <meta name="description" content="<?php echo $shop['description']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Torpix company, made in Girey city">
    <title><?php echo $shop['title']; ?></title>
    <link rel="shortcut icon" href="../icon.ico" type="image/x-icon">
    <?php
    $get_theme = $pdo->getRow("SELECT * FROM `magazins`");
    if ($get_theme['theme']) {
        echo '<link href="css/bootstrap.min_'.$get_theme['theme'].'.css" rel="stylesheet">';
        echo '<link href="css/main_'.$get_theme['theme'].'.css" rel="stylesheet">';
    } else {
        echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
        echo '<link href="css/main.css" rel="stylesheet">';
    }
    ?>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>

    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/zoomsl-3.0.min.js"></script>

        <?php
            if ( !empty($shop['chatbroscript']) ) {
                echo $shop['chatbroscript'];
            }
        ?>

</head>

<body>
<!-- Лупа -->	
<script>
jQuery(function(){
	
    // если отсутсвует zoomsl-3.0.min.js
	if(!$.fn.imagezoomsl){
		$('.msg').show();
		return;
	}
     else $('.msg').hide();
	// инициализация плагина
	$('.my-foto').imagezoomsl({ 
		zoomrange: [3, 3]	
	});  
});
</script>

        <?php
            if ( !empty($shop['redconnectscript']) ) {
                echo $shop['redconnectscript'];
            }
        ?>


<header id="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="tel:<?php echo $shop['phone']; ?>"><i class="fa fa-phone"></i> <?php echo $shop['phone']; ?></a></li>
                            <li><a href="mailto:<?php echo $shop['email']; ?>"><i class="fa fa-envelope"></i> <?php echo $shop['email']; ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <br>Сайт работает на платформе <span><a target="_blank" href="/torpix/Theme/">Torpix</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.php"><img src="images/home/logo.png" alt="" /><font size="5"><?php echo $shop['name']; ?></font></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="cart.php" id="cart"><i class="fa fa-shopping-cart"></i>Корзина</a></li>
                            <li><a href="/admin/index.php" target="_blank"><i class="fa fa-lock"></i> Вход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="index.php">Главная</a></li>
                            <?php
                            $get_pages = $pdo->getRows("SELECT * FROM `pages` ORDER BY `id`");
                            foreach ( $get_pages as $pages ) { ?>
                                <li><a href="page.php?id=<?php echo $pages['id']; ?>"><?php echo $pages['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
