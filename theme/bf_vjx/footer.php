<div class="footer-place">
</div>
<footer class="footer">
    <div class="container">
        <nav class="menu_bottom">
            <div class="hold">
                <?
                if($user["RULES"] == 'y') {?>
                    <a class="btn btn_yellow_bord" href="/admin/products.php" target="_blank">изменить категории</a>
                <?}?>
                <strong>Категории</strong>
                <ul>
                    <?php
                    $count_footer_categor = 0;
                    foreach ( $template["CATEGORIES"] as $category ) {
                        if ($count_footer_categor > 10){$count_footer_categor=0;?></ul><ul><?}?>
                        <?if(!$category['parent']){?>
                        <li><a href="categor.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                        <?}?>
                    <?php $count_footer_categor++;} ?>
                </ul>
            </div>
            <!-- end .hold -->
            <div class="hold">
                <?
                if($user["RULES"] == 'y') {?>
                    <a class="btn btn_yellow_bord" href="/admin/pages.php" target="_blank">изменить страницы</a>
                <?}?>
                <strong>Страницы </strong>
                <ul>
                    <?foreach ($template["PAGES"] as $pages) {?>
                        <?if (!empty($pages['about'])) {?>
                            <li><a href="page.php?id=<?=$pages["id"]?>"><?=$pages["name"]?></a></li>
                        <?}?>
                    <?}?>
                </ul>
            </div>
            <!-- end .hold -->
            <div class="hold">
                <?if($user["RULES"] == 'y') {?>
                <a class="btn btn_yellow_bord" href="/admin/fl_izm_magaz.php?id=1&razdel=social" target="_blank">изменить соц сети</a>
                <?}?>
                <strong>Соц сети</strong>
                <ul>
                    <?if(!empty($template["MAGAZIN"]["instagram_login"])) {?><li><a href="https://www.instagram.com/<?=$template["MAGAZIN"]["instagram_login"]?>/" target="_blank">Instagram</a></li><?}?>
                    <?if(!empty($template["MAGAZIN"]["vklink"])) {?><li><a href="<?=$template["MAGAZIN"]["vklink"]?>" target="_blank">VK</a></li><?}?>
                    <?if(!empty($template["MAGAZIN"]["facebooklink"])) {?><li><a href="<?=$template["MAGAZIN"]["facebooklink"]?>" target="_blank">Facebook</a></li><?}?>
                    <?if(!empty($template["MAGAZIN"]["id_ok_group"])) {?><li><a href="https://www.ok.ru/group/<?=$template["MAGAZIN"]["id_ok_group"]?>" target="_blank">OK</a></li><?}?>
                </ul>
            </div>
        </nav>
        <!-- end .menu_bottom -->
        <div class="footer_left">
            <div class="logo">
                <center><h4><?=$template["MAGAZIN"]['name']?></h4></center>
<!--                <img src="--><?//=$template["TEMPLATE_PATH"];?><!--img/footer_logo.png" width="172" height="36" alt="image">-->
            </div>
            <div class="copy">
                © 2016 - <?=$datatime = date("Y");?>. <br>
                CRM TORPIX
                <br>
                <a href="admin/index.php" target="_blank">Администрирование</a>
            </div>
            <!-- end .copy -->
            <div>
                <span class="img"><img src="<?=$template["TEMPLATE_PATH"];?>img/footer_PayPal.png" width="54" height="15" alt="image"></span>
                <span class="img"><img src="<?=$template["TEMPLATE_PATH"];?>img/footer_Visa.png" width="46" height="14" alt="image"></span>
                <span class="img"><img src="<?=$template["TEMPLATE_PATH"];?>img/footer_MasterCard.png" width="40" height="24" alt="image"></span>
            </div>
        </div>
        <!-- end .footer_left -->
    </div>
    <!-- end .container -->
</footer>
<script src="<?=$template["TEMPLATE_PATH"];?>/js/main.js"></script>
<div class="modal_overlay" style="display: none" id="black_block"></div>

<!--модальное окно о добавлении товара в корзину-->
    <div class="modal modal_prod" id="finish_window" style="display: none">
        <div class="modal_head">Ваш товар успешно добавлен в корзину</div>
        <!-- end .modal_head -->
        <div class="modal_prod_blk">
            <div class="clearfix" id="finish_window_text">


            </div>
            <!-- end .clearfix -->
            <div class="modal_prod_bottom">
                <b>Ваш товар успешно добавлен в корзину</b>
                <div class="clearfix">
                    <a class="btn" href="cart.php">Перейти в корзину</a>
                    <a class="btn btn_red" onclick="close_win()">Продолжить покупки</a>
                </div>
                <!-- end .clearfix -->
            </div>
            <!-- end .modal_prod_bottom -->
        </div>
        <!-- end .modal_prod_blk -->
        <a class="modal_close" onclick="close_win();"></a>
    </div>

<!--модальное окно о завершонном заказе-->
    <div class="modal modal_small" id="order_ok" style="display: none">
    <div class="modal_head">
        <span class="success_ico"></span>
        Заказ № <?=$_SESSION["USER"]["number_zakaz"]?> принят.
    </div>
    <!-- end .modal_head -->
    <p class="txt">
        В ближайшее время с вами свяжется наш менеджер.<br>
        Для оплаты нажмите кнопку "Оплатить заказ"
        <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
            <input type="hidden" name="receiver" value="410014588303230">
            <input type="hidden" name="formcomment" value="<?=$template["MAGAZIN"]["NAME"]?>">
            <input type="hidden" name="short-dest" value="Оплата заказа № <?=$_SESSION["USER"]["number_zakaz"]?>">
            <input type="hidden" name="label" value="<?=$_SESSION["USER"]["number_zakaz"]?>">
            <input type="hidden" name="successURL" value="http://<?=$_SERVER['HTTP_HOST']?>/thankyou.php?orderid=<?=$_SESSION["USER"]["number_zakaz"]?>">
            <input type="hidden" name="quickpay-form" value="shop">
            <input type="hidden" name="targets" value="транзакция № <?=$_SESSION["USER"]["number_zakaz"]?>">
            <input type="hidden" name="sum" id="sum" value="<?=$_SESSION["all_price_cart"]?>" data-type="number">
            <?
            $date_today = date("m.d.y");
            $today[1] = date("H:i:s");
            ?>
            <input type="hidden" name="comment" value="Оплачен время: <?=$today[1]?> дата: <?=$date_today?>");">
            <input type="hidden" name="need-fio" value="false">
            <input type="hidden" name="need-email" value="false">
            <input type="hidden" name="need-phone" value="false">
            <input type="hidden" name="need-address" value="false">
            <label><input type="hidden" name="paymentType" value="AC"></label>
            <input type="submit" value="Оплатить заказ">
        </form>
    </p>
    <a class="modal_close" onclick="close_win();"></a>
</div>


<script type="text/javascript" src="js/mask.js"></script>

<script>
    $("#lcphone").mask("7(999) 999-9999", {placeholder: "7(___) ___ - ____" });
</script>

<!--модальное окно авторизации-->
    <div class="modal" id="auth" style="display: none">
    <div class="modal_head">Вход в личный кабинет</div>
    <!-- end .modal_head -->
    <div class="form">
        <div class="half_hold">
            <div class="half">
                <div class="input_hold">
                    <label>Номер телефона</label>
                    <div class="input">
                        <input name="" required="" id="lcphone" required="" type="text" autocomplete="off">
                    </div>
                </div>

                    <a href="registration.php" class="btn btn_yellow_bord">Регистрация</a>

            </div>
            <!-- end .half -->
            <div class="half">
                <div class="input_hold">
                    <label>Пароль</label>
                    <div class="input">
                        <input name="" placeholder="" id="password" required="" type="password" autocomplete="off">
                    </div>
                </div>

                <div class="more">
                    <a onclick="show_reset_password();">Забыли пароль?</a>
                </div>


                <button class="btn btn_red_big" onclick="login_klient();">Войти</button>

            </div>
            <!-- end .half -->
        </div>
        Нажимая на кнопку «Войти» вы даете <a href="pravo.php" target="_blank">согласие на обработку</a> ваших персональных данных.
        <!-- end .half_hold -->
    </div>
    <!-- end .form -->
    <a class="modal_close" onclick="close_win();"></a>
</div>


<script type="text/javascript" src="js/mask.js"></script>

<script>
    $("#resetphone").mask("7(999) 999-9999", {placeholder: "7(___) ___ - ____" });
</script>

<!--модальное окно востановления пароля-->
<div class="modal modal_small modal_form-small" id="password_reset" style="display: none">
    <div class="modal_head">Забыли пароль ?</div>
    <!-- end .modal_head -->
    <p class="txt">
        Для востанновеления пароля к личному кабинету, введите свой номер телефона в поле ниже
    </p>
    <div class="form">
        <div class="input_hold">
            <label>Номер телефона</label>
            <div class="input">
                <input name="" id="resetphone" required="" type="text" autocomplete="off">
            </div>
            <!-- end .input -->
        </div>
        <!-- end .input_hold -->
        <div class="input_hold">
            <button class="btn btn_red_big" onclick="reset_password();">Востановить</button>
        </div>
        Нажимая на кнопку «Востановить» вы даете <a href="pravo.php" target="_blank">согласие на обработку</a> ваших персональных данных.
        <!-- end .input_hold -->
    </div>
    <!-- end .form -->
    <a class="modal_close" onclick="close_win();"></a>
</div>

<!--модальное окно обратной связи-->
<div class="modal modal_small modal_form-small" id="callback_form" style="display: none;">
    <div class="modal_head">Форма обратной связи</div>
    <!-- end .modal_head -->
    <p class="txt">
        Заполните указанные ниже поля
    </p>
    <div class="form">

        <div class="input_hold">
            <label>Ваше имя:</label>
            <div class="input">
                <input type="text" id="callback_name">
            </div>
            <label>Ваш телефон или e-mail:</label>
            <div class="input">
                <input type="text" id="callback_phone">
            </div>
            <label>Тема обращения:</label>
            <div class="input">
                <input type="text" id="callback_tema_title">
            </div>
            <label>Обращение:</label>
            <div class="input">
                <textarea id="callback_tema_text" style="height: 64px;"></textarea>
            </div>
        </div>


        <div class="input_hold">
            <button class="btn btn_red_big" onclick="send_callback('<?=$template["TEMPLATE_PATH"]?>');">Отправить</button>
        </div>
        Нажимая на кнопку «Отправить» вы даете <a href="pravo.php" target="_blank">согласие на обработку</a> ваших персональных данных.
        <!-- end .input_hold -->
    </div>
    <!-- end .form -->
    <a class="modal_close" onclick="close_win();"></a>
</div>

<!--модальное окно принятой заявке на звонок-->
<div class="modal modal_small" id="callback_ok" style="display: none">
    <div class="modal_head">
        <span class="success_ico"></span>
        Ваша заявка принята.
    </div>
    <!-- end .modal_head -->
    <p class="txt">
        В ближайшее время с вами свяжется наш менеджер.
    </p>
    <a class="modal_close" onclick="close_win();"></a>
</div>

<!-- end .footer -->
<a href="#" id='top'></a>



</body>
</html>