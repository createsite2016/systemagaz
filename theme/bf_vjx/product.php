<? include_once 'header.php'; // подключение хэдера ?>


<div class="content">
    <nav class="menu_content">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="slash">/</span> <a href="categor.php?cat=<?=$_GET['cat']?>"><?=$template['NAME_OPEN_CATEGOR']['name'];?></a>
            <span class="slash">/</span> <?=$template['DATA_DETAIL_TOVAR']['name'];?>
        </div>
        <!-- end .container -->
    </nav>
    <!-- end .menu_content -->
    <main>
        <section class="catalog_item_sect">
            <div class="container">
                <h1>
                    <?=$template['DATA_DETAIL_TOVAR']['name'];?>
                    <?
                    if($user["RULES"] == 'y') {?>
                        <a class="btn btn_dark_border" href="/admin/fl_izm_tovar.php?id=<?=$template['DATA_DETAIL_TOVAR']['id']?>&categor=<?=$template['DATA_DETAIL_TOVAR']['categor_id']?>" target="_blank">изменить товар</a>
                    <?}?>
                </h1>

            </div>
            <!-- end .container -->
            <section class="catalog_item_hold">
                <div class="container">
                    <div class="prod_block_img">
                        <div class="photo">
                            <a data-id="0" href="<?=$template['DATA_DETAIL_TOVAR']['image']?>" class="zoom fancybox" rel="group">
                                <img class="bigpic" src="<?=$template['DATA_DETAIL_TOVAR']['image']?>"
                                     alt=""/> </a>
                        </div>
                    </div>
                    <!-- end .prod_block_img -->
                    <div class="catalog_item_discript">

                        <!-- end .rating_star -->
                        <h3>Описание</h3>
                        <div class="catalog_item_discript_txt">
                            <p>
                                <?=$template['DATA_DETAIL_TOVAR']['komment']?>
                            </p>
                        </div>

                        <div class="half_hold">
                            <div class="half">
                                <div class="choose_check choose_check_color">
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['article'])){?><b class="titl">Артикул: <?=$template['DATA_DETAIL_TOVAR']['article']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['model'])){?><b class="titl">Страна производитель: <?=$template['DATA_DETAIL_TOVAR']['model']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['firma'])){?><b class="titl">Фирма: <?=$template['DATA_DETAIL_TOVAR']['firma']?></b><?}?>

                                    <?if (!empty($template["PROPERTY_TOVAR"])) {?>


                                                    <select class="customSelect select_small" name="" onchange="top.location=this.value">
                                                        <?foreach ($template["PROPERTY_TOVAR"] as $items) {?>
                                                            <?if ($items["id"] == $_GET["id"]){?>
                                                                <option selected value="product.php?id=<?=$items["id"]?>&cat=<?=$_GET['cat']?>&article=<?=$items["article"]?>"><?=$items["razmer"]?> - <?=$items["color"]?></option>
                                                            <?}?>
                                                            <?if ($items["id"] !== $_GET["id"]){?>
                                                                <option value="product.php?id=<?=$items["id"]?>&cat=<?=$_GET['cat']?>&article=<?=$items["article"]?>"><?=$items["razmer"]?> - <?=$items["color"]?></option>
                                                            <?}?>
                                                        <?}?>
                                                    </select>



                                    <?}?>

                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['razmer'])){?><b class="titl">Размер: <?=$template['DATA_DETAIL_TOVAR']['razmer']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['color'])){?><b class="titl">Цвет: <?=$template['DATA_DETAIL_TOVAR']['color']?></b><?}?>

                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['ves'])){?><b class="titl">Вес: <?=$template['DATA_DETAIL_TOVAR']['ves']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['obem'])){?><b class="titl">Объем: <?=$template['DATA_DETAIL_TOVAR']['obem']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['dlina'])){?><b class="titl">Длина: <?=$template['DATA_DETAIL_TOVAR']['dlina']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['material'])){?><b class="titl">Материал: <?=$template['DATA_DETAIL_TOVAR']['material']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['garant'])){?><b class="titl">Гарантия: <?=$template['DATA_DETAIL_TOVAR']['garant']?></b><?}?>
                                    <?if(!empty($template['DATA_DETAIL_TOVAR']['complect'])){?><b class="titl">Комплектация: <?=$template['DATA_DETAIL_TOVAR']['complect']?></b><?}?>
                                </div>
                            </div>
                        </div>


                        <div class="catalog_item_discript_bottom">
                            <div class="half_hold">
                                <div class="half">
                                    <div class="counter_hold">
                                        <b class="titl">Остаток: <?=$template['DATA_DETAIL_TOVAR']['kolvo']?></b>
                                    </div>
                                    <!-- end .counter_hold -->
                                </div>
                                <!-- end .half -->

                            </div>
                            <!-- end .half_hold -->
                            <div class="half_hold">
                                <div class="half">
                                    <div class="catalog_item_price">
                                        <?if ($template['DATA_DETAIL_TOVAR']['skidka'] !== ''){?>
                                            <?$res_chena = $template['DATA_DETAIL_TOVAR']['chena_output']-($template['DATA_DETAIL_TOVAR']['chena_output']/100 * $template['DATA_DETAIL_TOVAR']['skidka']);?>
                                            <span class="pr"><?=$res_chena;?> руб.</span>
                                            <span class="del"><?=$template['DATA_DETAIL_TOVAR']['chena_output']?> руб.</span>
                                        <?} else {?>
                                            <span class="pr"><?=$res_chena = $template['DATA_DETAIL_TOVAR']['chena_output']?> руб.</span>
                                        <?}?>

                                    </div>
                                    <!-- end .catalog_item_price -->
                                </div>
                                <!-- end .half -->
                                <div class="half">
                                    <a class="btn btn_big" onclick="add_cart(<?=$template['DATA_DETAIL_TOVAR']['id'];?>,<?=$res_chena;?>,'<?=$template["TEMPLATE_PATH"];?>');">добавить в корзину</a>
                                </div>
                                <!-- end .half -->
                            </div>
                            <!-- end .half_hold -->
                        </div>
                        <!-- end .catalog_item_discript_bottom -->
                    </div>
                    <!-- end .catalog_item_discript -->
                </div>
                <!-- end .container -->
            </section>
            <!-- end .catalog_item_hold -->

        </section>
        <!-- end .catalog_item_sect -->

    </main>
</div>
<!-- end .content -->
</div>
<? include_once 'footer.php'; // подключение футера ?>