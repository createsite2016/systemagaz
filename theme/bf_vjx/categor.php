<? include_once 'header.php'; // подключение хэдера ?>



    <div class="content">

        <nav class="menu_content">
            <div class="container">
                <a href="index.php">Главная</a>
                <!-- <span class="slash">/</span> <a href="#">Рубакши</a>   -->
                <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]['name'];?>
            </div>
            <!-- end .container -->
        </nav>
        <!-- end .menu_content -->
        <main>

            <!-- end .filter_hor_sect -->
            <div class="mainContent_hold">
                <div class="container">
                    <h1 class="h1"><?=$template["NAME_OPEN_CATEGOR"]['name'];?></h1>

                    <?
                    if($user["RULES"] == 'y') {?>
                        <a class="btn btn_yellow_bord" href="/admin/products.php" target="_blank">изменить категории товара</a>
                    <?}?>
                    <aside class="aside">
                        <ul class="map_site map_site_big">
                            <?php
                            foreach ( $template["CATEGORIES"] as $category ) { ?>
                                <li><a class="hold" href="categor.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <!-- end .map_site_big -->



                        <? include_once 'include/popular_items.php'; // подключение популярных товаров ?>

                    </aside>
                    <!-- end .aside -->

                    <section class="mainContent">
                        <section class="caregory_prod_sect">
                            <?
                            if($user["RULES"] == 'y') {?>
                                <a class="btn btn_yellow_bord" href="/admin/fl_open_products.php?id_categor=<?=$_GET['cat']?>" target="_blank">Добавить товар в эту категорию</a>
                            <?}?>
                            <div class="caregory_prod_hold">
                                <? include_once 'include/tovars.php'; // подключение вывода товара ?>
                            </div>


                            <nav class="page page_orange">
                                <div class="page_hold">
                                    <?foreach ($template["NAVIGATION"] as $key=>$value) {
                                        echo $value;
                                    }?>
                                </div>
                                <!-- end .page_hold -->
                            </nav>
                            <!-- end .page_orange -->
                        </section>
                        <!-- end .caregory_prod_sect -->



                    </section>
                    <!-- end .mainContent -->

                </div>
                <!-- end .container -->
            </div>
            <!-- end .mainContent_hold -->

        </main>

    </div>


</div>

<? include_once 'footer.php'; // подключение футера ?>
