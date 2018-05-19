<? foreach ($template["TOVARS"] as $tovar) { ?>
    <div class="caregory_prod_block">
        <div class="top_block">
            <div class="img">
                <img src="<?=$tovar['image'];?>" width="128" height="179" alt="image">
            </div>
            <!-- end .img -->
            <div class="open_blk">
                <div class="open_blk_hold">
                    <? if ($tovar["kolvo_in_group"] > 1 ) {?>
                        <a class="btn btn_green_bord" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>&article=<?=$tovar['article']?>">посмотреть</a>
                    <?}?>
                    <? if ($tovar["kolvo_in_group"] == 1 ) {?>
                        <a class="btn btn_green_bord" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>">посмотреть</a>
                    <?}?>
                    <? if (empty($tovar["kolvo_in_group"]) ) {?>
                        <a class="btn btn_green_bord" href="product.php?id=<?=$tovar['id']?>&cat=<?=$tovar["categor_id"]?>">посмотреть</a>
                    <?}?>
                    <?
                    if($user["RULES"] == 'y') {?>
                        <a class="btn btn_yellow_bord" href="/admin/fl_izm_tovar.php?id=<?=$tovar['id']?>&categor=<?=$tovar['categor_id']?>" target="_blank">изменить</a>
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

                <?if ($tovar['skidka']){?>
                    <span class="price_num"><?$res_chena = $tovar['chena_output']-($tovar['chena_output']/100 * $tovar['skidka']); echo number_format($res_chena, 0, ',', ' ');?> руб.
                                            <del><?=$tovar['chena_output'];?> руб.</del>
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
            <? if (empty($tovar["kolvo_in_group"]) ) {?>
                <a class="btn" onclick="add_cart(<?=$tovar['id'];?>,<?=$res_chena;?>,'<?=$template["TEMPLATE_PATH"];?>');">в корзину</a>
            <?}?>
        </div>

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
<?}?>