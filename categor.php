<?php
//include_once "classes/Database.php"; // подключаем БД
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина
$categor = $_GET['cat'];
$data_categor = $pdo->getRow("SELECT * FROM `categor` WHERE `id` = ?",[$categor]);
include_once 'view/tpl_head.php';
?>

    <!--	<section id="slider"><!--Слайдер новинок-->
    <!--		<div class="container">-->
    <!--			<div class="row">-->
    <!--				<div class="col-sm-12">-->
    <!--					<div id="slider-carousel" class="carousel slide" data-ride="carousel">-->
    <!--						<ol class="carousel-indicators">-->
    <!--							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>-->
    <!--							<li data-target="#slider-carousel" data-slide-to="1"></li>-->
    <!--							<li data-target="#slider-carousel" data-slide-to="2"></li>-->
    <!--						</ol>-->
    <!--						-->
    <!--						<div class="carousel-inner">-->
    <!--							<div class="item active">-->
    <!--								<div class="col-sm-6">-->
    <!--									<h1><span>E</span>-SHOPPER</h1>-->
    <!--									<h2>Free E-Commerce Template</h2>-->
    <!--									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->
    <!--									<button type="button" class="btn btn-default get">Get it now</button>-->
    <!--								</div>-->
    <!--								<div class="col-sm-6">-->
    <!--									<img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />-->
    <!--									<img src="images/home/pricing.png"  class="pricing" alt="" />-->
    <!--								</div>-->
    <!--							</div>-->
    <!--							<div class="item">-->
    <!--								<div class="col-sm-6">-->
    <!--									<h1><span>E</span>-SHOPPER</h1>-->
    <!--									<h2>100% Responsive Design</h2>-->
    <!--									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->
    <!--									<button type="button" class="btn btn-default get">Get it now</button>-->
    <!--								</div>-->
    <!--								<div class="col-sm-6">-->
    <!--									<img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />-->
    <!--									<img src="images/home/pricing.png"  class="pricing" alt="" />-->
    <!--								</div>-->
    <!--							</div>-->
    <!--							-->
    <!--							<div class="item">-->
    <!--								<div class="col-sm-6">-->
    <!--									<h1><span>E</span>-SHOPPER</h1>-->
    <!--									<h2>Free Ecommerce Template</h2>-->
    <!--									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->
    <!--									<button type="button" class="btn btn-default get">Get it now</button>-->
    <!--								</div>-->
    <!--								<div class="col-sm-6">-->
    <!--									<img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />-->
    <!--									<img src="images/home/pricing.png" class="pricing" alt="" />-->
    <!--								</div>-->
    <!--							</div>-->
    <!--							-->
    <!--						</div>-->
    <!--						-->
    <!--						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">-->
    <!--							<i class="fa fa-angle-left"></i>-->
    <!--						</a>-->
    <!--						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">-->
    <!--							<i class="fa fa-angle-right"></i>-->
    <!--						</a>-->
    <!--					</div>-->
    <!--					-->
    <!--				</div>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--	</section>
    <!--/Слайдер новинок-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <?php include'view/tpl_left_menu_categors.php'; // подключение меню категорий ?>
                </div>
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--Товары-->
                        <h2 class="title text-center"><?php echo $data_categor['name']; ?></h2>
                        <?php
                        $get_tovar = $pdo->getRows("SELECT * FROM `tovar` WHERE `kolvo` > 0 AND `categor_id` = ?",[$categor]);
                        foreach ( $get_tovar as $tovar ) { ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <?php echo '<a href="product.php?id='.$tovar[id].'">'; ?><img src="<?php echo $tovar['image']; ?>" alt="<?php echo $tovar['name']; ?>" width="240" height="240"/></a>
                                            <h2><?php echo $tovar['chena_output']; ?> руб.</h2>
                                            <p><?php echo '<a href="product.php?id='.$tovar[id].'">'; ?> <?php echo $tovar['name']; ?></a></p>
                                            <p>Остаток: <?php echo $tovar['kolvo']; ?> шт.</p>
                                            <p>Артикул: <?php echo $tovar['article']; ?></p>

                                            <button onclick="test(<?php echo $tovar['id']; ?>)" type="submit" class="btn btn-default add-to-cart" id="btn<?php echo $tovar['id']; ?>">
                                                <i class="fa fa-shopping-cart"></i>
                                                В корзину
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div><!--/Товары-->
<?php
// добавление стастистики просмотренного товара
$datatime = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$pdo->insertRow("INSERT INTO `statistic` (
`id_statistic`,
`datatime`,
`caption`,
`ip`
) VALUES (
?,
?,
?,
?
)",[$categor,$datatime,'categor',$ip]);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <p>_</p>
<?php include_once 'view/tpl_footer.php'; ?>