<?php
//include_once "classes/Database.php"; // подключаем БД
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина
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
						<h2 class="title text-center">Недавно добавленные</h2>
						<ul class="pagination">
						<?php
						//  ВЫВОД СТРАНИЦ НАВИГАЦИИ
						$arra = $pdo->getRow("SELECT count(*) FROM `tovar` ");
						$total_articles_number = $arra['count(*)']; //общее количество статей
						$articles_per_page = 9; // количество заказов на странице
						$b = $_GET['page'];
						if (!isset($_GET['page'])) {
							$b=0;
						}
						$a = $b + $articles_per_page;
						//получаем количество страниц
						$total_pages = ceil($total_articles_number/$articles_per_page);

						// запускаем цикл - количество итераций равно количеству страниц
						for ( $i=0; $i<$total_pages; $i++ )
						{
// получаем значение $from (как $page_number) для использования в формировании ссылки
							$page_number=$i*$articles_per_page;
// если $page_number (фактически это проверка того является ли $from текущим) не соответствует
// текущей странице,
// выводим ссылку на страницу со значением $from равным $page_number

							if ($page_number!=$from) {
								$step = $i+1;
								if ($_GET['i'] == $step) {
									echo "<li class='active'><a href='".$PHP_SELF."?page=".$page_number."&i=".$step."'> ".($i+1).
										" </a></li>";
								} else {
									echo "<li><a href='".$PHP_SELF."?page=".$page_number."&i=".$step."'> ".($i+1).
										" </a></li>";
								}


							}
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
							else {
								$page_number='1';
								$step = $i+1;
								if ($step == '1' and $_GET['page'] == '1') {
									echo "<li class='active'><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
								} else {
									echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
								}

							} // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
						}
						?>
						</ul><br>





						<?php
						$get_tovar = $pdo->getRows("SELECT * FROM `tovar` WHERE `kolvo` > 0 ORDER BY `datatime` DESC LIMIT $b,$articles_per_page");
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

<br><ul class="pagination">
							<?php
							//  ВЫВОД СТРАНИЦ НАВИГАЦИИ
							$arra = $pdo->getRow("SELECT count(*) FROM `tovar` ");
							$total_articles_number = $arra['count(*)']; //общее количество статей
							$articles_per_page = 9; // количество заказов на странице
							$b = $_GET['page'];
							if (!isset($_GET['page'])) {
								$b=0;
							}
							$a = $b + $articles_per_page;
							//получаем количество страниц
							$total_pages = ceil($total_articles_number/$articles_per_page);

							// запускаем цикл - количество итераций равно количеству страниц
							for ( $i=0; $i<$total_pages; $i++ )
							{
// получаем значение $from (как $page_number) для использования в формировании ссылки
								$page_number=$i*$articles_per_page;
// если $page_number (фактически это проверка того является ли $from текущим) не соответствует
// текущей странице,
// выводим ссылку на страницу со значением $from равным $page_number

								if ($page_number!=$from) {
									$step = $i+1;
									if ($_GET['i'] == $step) {
										echo "<li class='active'><a href='".$PHP_SELF."?page=".$page_number."&i=".$step."'> ".($i+1).
											" </a></li>";
									} else {
										echo "<li><a href='".$PHP_SELF."?page=".$page_number."&i=".$step."'> ".($i+1).
											" </a></li>";
									}


								}
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
								else {
									$page_number='1';
									$step = $i+1;
									if ($step == '1' and $_GET['page'] == '1') {
										echo "<li class='active'><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
									} else {
										echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
									}

								} // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
							}
							?>
						</ul>
						
					</div><!--/Товары-->

				</div>
			</div>
		</div>
	</section>
	<p>_</p>
<?php include_once 'view/tpl_footer.php'; ?>