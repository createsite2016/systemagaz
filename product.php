<?php
//include_once "classes/Database.php"; // подключаем БД
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина
include_once 'view/tpl_head.php';
?>
	<section>
		<div class="container">
			<div class="row">
                <!--Категории товара-->
                <div class="col-sm-3">
					<?php include'view/tpl_left_menu_categors.php'; // подключение меню категорий ?>
                </div>
				<?php
				$id = $_GET['id'];
				$product = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ? ",[$id]); ?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="productinfo text-center">
								<img src="<?php echo $product['image']; ?>" alt="" />
<!--								<h3>Новинка</h3>-->
							</div>


						</div>

						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
<!--								<img src="images/product-details/new.jpg" class="newarrival" alt="" />-->
								<h2><?php echo $product['name']; ?></h2>
								<p>Артикул: <?php echo $product['article']; ?></p>
								<span>
									<span><?php echo $product['chena_output']; ?> руб.</span>
									<button onclick="test(<?php echo $product['id']; ?>)" type="submit" class="btn btn-default add-to-cart" id="btn<?php echo $product['id']; ?>">
												<i class="fa fa-shopping-cart"></i>
												В корзину
											</button>
								</span>
								<p><b>Количество:</b> <?php echo $product['kolvo']; ?></p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->

						<div class="tab-content">
<!--Описание товара-->
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
                                    <p><b>Описание товара:</b></p>
									<p><?php echo $product['komment']; ?></p>
								</div>
							</div>

						</div>
					</div><!--/category-tab-->



				</div>
			</div>
		</div>
	</section>
<p>_</p>
<?php include_once 'view/tpl_footer.php';