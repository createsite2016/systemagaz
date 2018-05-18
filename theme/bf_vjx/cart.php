<? include_once 'header.php'; // подключение хэдера ?>
<div class="content">
    <nav class="menu_content">
        <div class="container">
            <a href="index.php">Главная</a>
            <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]["name"];?>
        </div>
    </nav>
<?
$_SESSION["USER"]["number_zakaz"] = rand(111111111111, 999999999999);
?>
    <main>
        <section class="cart_form_sect">
            <div class="container" id="bodycarthtml">
                <h1>Корзина</h1>



                    <?if ( !empty($template["cart"]) ) { // если массив с данными корзины не пуст?>
                        <!-- Вывод товаров -->
                        <div class="row_hold">
                                <?foreach ($template["cart"] as $item) { // перебераю данные из массива корзины для вывода?>
                                    <div class="row">

                                        <div class="left_tabel">
                                            <div class="cell">
                                                <span class="img">
                                                    <a href="product.php?id=<?=$item["id"]?>&cat=<?=$item["categor_id"]?>">
                                                        <img src="<?=$item["image"]?>" alt="image" width="160" height="160">
                                                    </a>
                                                </span>
                                            </div>
                                            <!-- end .cell -->
                                            <div class="cell">
                                                <div class="inline">
                                                    <h4 class="h4">
                                                        <a href="product.php?id=<?=$item["id"]?>&cat=<?=$item["categor_id"]?>"><?=$item["name"]?></a>
                                                    </h4>
                                                    <?if(!empty($item["firma"])){?>
                                                        <div class="cart_size">
                                                            Фирма <span><?=$item["firma"]?></span>
                                                        </div>
                                                        <br>
                                                    <?}?>

                                                    <div class="cart_size">
                                                        Производитель: <span><?=$item["model"]?></span>
                                                    </div>
                                                    <!-- end .cart_size -->
                                                </div>
                                                <!-- end .inline -->
                                            </div>
                                            <!-- end .cell -->
                                        </div>

                                        <!-- end .left_tabel -->
                                        <div class="right_table">
                                            <div class="cell">
                                                <div class="counter_blk">
                                                    <span class="minus" onclick="minus(<?=$item["id"]?>, '<?=$template["TEMPLATE_PATH"]?>');"></span>
                                                    <input value="<?=$_SESSION["cart"][$item["id"]]["COUNT"]?>" type="text" id="count_<?=$item["id"]?>" disabled>
                                                    <span class="plus" onclick="plus( <?=$item["id"];?>, '<?=$template["TEMPLATE_PATH"]?>');"></span>
                                                </div>
                                            </div>


                                            <div class="cell">
                                                <?if ($item['skidka'] !== ''){?>
                                                    <div class="cart_row_price">
                                                        <div id="hide_price_<?=$item["id"]?>" style="display: none"><?=$res_chena = ($item['chena_output']-($item['chena_output']/100 * $item['skidka']) );?></div>
                                                        <div id="hide_price_del_<?=$item["id"]?>" style="display: none">
                                                            <?=$item['chena_output'];?>
                                                        </div>
                                                        <div id="show_price_<?=$item["id"]?>">
                                                            <?=$_SESSION["cart"][$item["id"]]["COUNT"]*$res_chena?> р.
                                                        </div>
                                                        <del id="show_price_del_<?=$item["id"]?>">
                                                            <?=$_SESSION["cart"][$item["id"]]["COUNT"]*$item['chena_output'];?> р.
                                                        </del>
                                                    </div>
                                                <?} else {?>
                                                    <div class="cart_row_price">

                                                        <div id="hide_price_<?=$item["id"]?>" style="display: none">
                                                            <?=$item['chena_output'];?>
                                                        </div>
                                                        <div id="show_price_<?=$item["id"]?>">
                                                            <?=$_SESSION["cart"][$item["id"]]["COUNT"]*$item['chena_output']?> р.
                                                        </div>
                                                    </div>
                                                <?}?>
                                            </div>

                                            <div class="cell">
                                                <a class="bnt_close" onclick="del( <?=$item["id"];?>, '<?=$template["TEMPLATE_PATH"]?>');"></a>
                                            </div>

                                        </div>
                                    </div>
                                <?}?>
                        </div>

                        <!-- Оплата и доставка -->
<!--                        <div class="half_hold">-->
<!--                            <div class="half">-->
<!--                                <div class="cart_choise_blk">-->
<!--                                    <h3 class="h3">Доставка</h3>-->
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="delivery1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--                                        Почта России: <b>200 Р</b>-->
<!--                                    </label>-->
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="delivery1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--                                        Доставка курьером: <b>500 Р</b>-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                           -->
<!--                            <div class="half">-->
<!--                                <div class="cart_choise_blk">-->
<!--                                    <h3 class="h3">Оплата</h3>-->
<!--                                    -->
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="payment1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--                                        Счет на оплату-->
<!--                                    </label>-->
<!--                                    <label class="custom_check_lab">-->
<!--                                        <input class="outtaHere" name="payment1" value="" type="radio">-->
<!--                                        <span class="custom_radio"></span>-->
<!--                                        Наличный расчет-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

                        <!-- Купон на скидку -->
<!--                        <div class="discount_coupon">-->
<!--                            <h4 class="h4">Купон на скидку</h4>-->
<!--                            <img src="--><?//=$template["TEMPLATE_PATH"]?><!--img/discont_ico.png" alt="image" width="134" height="134">-->
<!--                            <input type="text">-->
<!--                            <a class="btn btn_red_big" href="#">Активировать</a>-->
<!--                        </div>-->


                        <script type="text/javascript" src="js/mask.js"></script>

                        <script>
                            $("#phone").mask("7(999) 999-9999", {placeholder: "7(___) ___ - ____" });
                        </script>

                        <!-- Форма для ввода данных клиента -->
                        <div class="cart_form_client">
                            <h4 class="h4">Данные для создания заказа</h4>
                            <div class="cart_form_client_hold">
                                <div class="input">
                                    <label>Ваше имя:</label>
                                    <input name="action" required="" value="order" type="hidden">
                                    <input name="name" required="" value="<?=$_SESSION["USER"]["name"]?>" id="name" type="text">
                                </div>
                                <!-- end .input -->
                                <div class="input">
                                    <label>Номер телефона:</label>
                                    <input name="phone" required="" value="<?=$_SESSION["USER"]["phone"]?>" id="phone" type="text">
                                </div>
                                <!-- end .input -->
                                <div class="input">
                                    <label>Адрес доставки:</label>
                                    <input name="adress" required="" value="<?=$_SESSION["USER"]["adress"]?>" id="adress" type="text">
                                </div>
                            </div>
                            <!-- end .cart_form_client_hold -->
                            <div class="input">
                                <label>Комментарий к заказу:</label>
                                <textarea name="komment" id="komment"></textarea>
                            </div>
                            <!-- end .input -->
                        </div>

                        <!-- я прочитал и принимаю условия -->
                        <div class="cart_form_bottom">
                            <label class="custom_check_lab">
                                <input class="outtaHere" name="" id="acseptCheckBox" onclick="acsept();" type="checkbox">
                                <span class="custom_checkbox"></span>
                                Нажимая на кнопку «Оформить заказ» вы даете <a href="pravo.php" target="_blank">согласие на обработку</a> ваших персональных данных.
                            </label>
                            <div class="cart_form_bottom_hold">
                                <div id="finish_price_hide" style="display: none">
                                    <?=$_SESSION["all_price_cart"]?>
                                </div>
                                <div class="price" id="finish_price_show">
                                    <?=$_SESSION["all_price_cart"];?> руб.
                                </div>
                                <!-- end .price -->
                                <button class="btn" id="btn_order" disabled onclick="order('<?=$template["TEMPLATE_PATH"]?>');">Оформить заказ</button>
                            </div>
                            <!-- end .cart_form_bottom_hold -->
                        </div>
                    <?} else {?>
                        Ваша корзина пуста <a href="index.php">перейти к покупкам</a>
                    <?}?>


            </div>
        </section>
    </main>

</div>
<? include_once 'footer.php'; // подключение футера ?>
