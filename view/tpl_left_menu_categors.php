<?php ?>
<div class="left-sidebar">
    <h2>Категории</h2>
    <div class="panel-group category-products" id="accordian"><!--Категории товаров-->

        <?php
        $get_category = $pdo->getRows("SELECT * FROM `categor`");
        foreach ( $get_category as $category ) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="categor.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></h4>
                </div>
            </div>
        <?php } ?>
    </div><!--/Категории товара-->

    <?php
    if ( $shop['reklama'] == 'Да' ) { ?>
        <!--/Банер для рекламы-->
        <div class="shipping text-center">
            <img src="images/home/shipping.jpg" alt="Загрузка банера не удалась" />
        </div>
    <?php } else {

    } ?>



</div>