<? include_once 'header.php'; // подключение хэдера ?>



    <!-- end .header -->
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
<!--                    <h1 class="h1">-->
                        <?//$template["NAME_OPEN_CATEGOR"]['name'];?>
<!--                    </h1>-->

                    <?
                    if($user["RULES"] == 'y') {?>
                        <a class="btn btn_yellow_bord" href="/admin/products.php" target="_blank">изменить категории товара</a>
                    <?}?>
                    <aside class="aside">
                        <ul class="map_site map_site_big">
                            <?
                            // перебор каьегорий
                            foreach ( $template["CATEGORIES"] as $category ) { ?>

                                <?if(!$category['parent']){ // если это не дочерняя категория?>
                                    <li>
                                        <?$count_parent = array_search($category['id'], array_column($template["CATEGORIES"], 'parent')); // смотрим есть ли дочернии подкатегории?>
                                        <?if($count_parent>0){ // если есть дочернии подкатегории?>
                                            <span class="hold">
                                            <a href="categor.php?cat=<?=$category['id']?>" onclick="location.href = 'categor.php?cat=<?=$category[id]?>';"><?=$category['name']?></a>
                                        </span>
                                            <ul style="display: none;">
                                                <?
                                                foreach ($template["CATEGORIES"] as $items) {
                                                    if($items['parent'] == $category['id']){?>
                                                        <li><a class="hold" href="categor.php?cat=<?=$items['id']?>"><?=$items['name']?></a></li>
                                                    <?}
                                                }
                                                ?>
                                            </ul>
                                        <?}else{ // иначе выводим одну главную?>
                                            <a class="hold" href="categor.php?cat=<?=$category['id']?>"><?=$category['name']?></a>
                                        <?}?>
                                    </li>
                                <?}else{?>
                                    <!--                                    <li>-->
                                    <!--                                        <a class="hold" href="categor.php?cat=--><?php //echo $category['id']; ?><!--">--><?php //echo $category['name']; ?><!--</a>-->
                                    <!--                                    </li>-->
                                <?}?>
                            <?php } ?>
                        </ul>
                        <!-- end .map_site_big -->



                        <? include_once 'include/popular_items.php'; // подключение популярных товаров ?>


                    </aside>
                    <!-- end .aside -->

                    <section class="mainContent">
                        <section class="caregory_prod_sect">
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
