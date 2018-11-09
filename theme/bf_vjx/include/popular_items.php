<?
$template["TOVARS_POPULARS"] = $pdo->getRows("SELECT COUNT(*) AS kolvo_in_group, 
`id`,
`image`,
`name`,
`kolvo`,
`article`,
`chena_output`,
`categor_id`,
`new`,
`skidka`,
`model`,
`firma`,
`shows`
 FROM `tovar` WHERE `kolvo`>0 GROUP BY `article` ORDER BY `shows` DESC LIMIT 6"); // список товара в открытой категории
?>
<section class="caregory_prod_slider">
                            <h6 class="h6">Популярные товары:</h6>
                            <div class="slider_img2">
                                <ul class="dot">
                                    <?foreach ($template["TOVARS_POPULARS"] as $tovar) {?>
                                            <li>&nbsp;</li>
                                    <?}?>
                                </ul>
                                <div class="hold">
                                    <ul>
                                        <?foreach ($template["TOVARS_POPULARS"] as $tovar) {?>
                                           <li style="width: 281px;">
                                            <div class="caregory_prod_block">
                                                <div class="top_block">
                                                    <div class="img">
                                                        <?
                                                        include_once 'vendor/get_path.php';
                                                        $cache_file = get_cache_path($tovar['image'],11);
                                                        $mini_img = 'cache_img/'.$cache_file;
                                                        ?>
                                                        <img src="<?=$mini_img;?>" width="160" height="160" alt="image">
                                                    </div>
                                                    <!-- end .img -->
                                                    <div class="open_blk">
                                                        <div class="open_blk_hold">
                                                            <? if ($tovar["kolvo_in_group"] > 1 ) {?>
                                                                <a class="btn btn_green_bord" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>&article=<?=$tovar['article']?>">посмотреть</a>
                                                            <?} else {?>
                                                                <a class="btn btn_green_bord" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>">посмотреть</a>
                                                            <?}?>
                                                            <?
                                                            if($user["RULES"] == 'y') {?>
                                                                <a class="btn btn_green_bord" href="/admin/fl_izm_tovar.php?id=<?=$tovar['id']?>&categor=<?=$tovar['categor_id']?>" target="_blank">изменить</a>
                                                            <?}?>
                                                            <div class="check_hold">

                                                            </div>
                                                            <!-- end .check_hold -->
                                                        </div>
                                                        <!-- end .open_blk_hold -->
                                                    </div>
                                                    <!-- end .open_blk -->
                                                </div>
                                                <!-- end .top_block -->
                                                <div class="text_hold">
                                                    <h4><a href="#"><?=$tovar['name'];?></a></h4>
                                                    <p class="txt">
                                                        <?if( !empty($tovar['firma']) ) {?>
                                                            Фирма: <?=$tovar['firma']?>
                                                        <?}?>

                                                        <?if( !empty($tovar['model']) ) {?>
                                                            <br>Производство: <?=$tovar['model']?>
                                                        <?}?>

                                                    </p>

                                                    <!-- end .rating_star -->
                                                </div>
                                                <!-- end .text_hold -->
                                                <div class="bottom_blk">
                                                    <div class="price">

                                                        <?if ($tovar['skidka'] !== ''){?>
                                                            <span class="price_num"><?$res_chena = $tovar['chena_output']-($tovar['chena_output']/100 * $tovar['skidka']); echo number_format($res_chena, 0, ',', ' ');?> руб.
                                            <del><?echo number_format($tovar['chena_output'], 0, ',', ' ');?> руб.</del>
                                        </span>
                                                        <?} else {?>
                                                            <span class="price_num"><?$res_chena = $tovar['chena_output']; echo number_format($res_chena, 0, ',', ' ');?> руб.
                                        </span>
                                                        <?}?>


                                                    </div>
                                                    <!-- end .price -->
                                                    <? if ($tovar["kolvo_in_group"] == 1 ) {?>
                                                        <a class="btn" onclick="add_cart(<?=$tovar['id'];?>,<?=$res_chena;?>,'<?=$template["TEMPLATE_PATH"];?>');">в корзину</a>
                                                    <?}?>
                                                    <? if ($tovar["kolvo_in_group"] > 1 ) {?>
                                                        <a class="btn" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>&article=<?=$tovar['article']?>">посмотреть</a>
                                                    <?}?>
                                                </div>
                                                <!-- end .bottom_blk -->

                                                <div class="caregory_prod_inf">

                                                    <?if ($tovar['skidka'] !== ''){?>
                                                        <div class="sale">
                                                            <span class="top"><?=$tovar['skidka']?>%</span>
                                                            скидка
                                                        </div>
                                                    <?}?>


                                                    <?
                                                    if ($tovar['new'] == 'Да') {?>
                                                        <div class="new_lb">новинка</div>
                                                    <?}?>

                                                    <!-- end .new_lb -->
                                                    <!--                                            <div class="hot">ТОП</div>-->
                                                    <!-- end .hot -->
                                                </div>
                                                <!-- end .watch -->
                                            </div>
                                        </li>
                                        <?}?>
                                    </ul>
                                </div>
                            </div>
                            <!-- end .slider_img2 -->
                        </section>