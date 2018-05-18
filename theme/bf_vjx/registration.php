<? include_once 'header.php'; // подключение хэдера ?>
    <div class="content">
        <nav class="menu_content">
            <div class="container">
                <a href="index.php">Главная</a>
                <span class="slash">/</span> <?=$template["NAME_OPEN_CATEGOR"]["name"];?>
            </div>
        </nav>

        <main>
            <article>
                <div class="container">
<?if($_SESSION["USER"]["name"]){
    echo $_SESSION["USER"]["name"].', Вы уже зарегистрированны!';
}else{?>
    <center><h4>Регистрация нового пользователя</h4></center>
                    <script type="text/javascript" src="js/mask.js"></script>

                    <script>
    $("#phone").mask("7(999) 999-9999", {placeholder: "7(___) ___ - ____" });
                    </script>

                    <!-- Форма для регистрации клиента -->
                    <div class="cart_form_client">

                            <div class="input">
                                <label>Ваше имя:</label>
                                <input name="action" required="" value="regnewuser" type="hidden">
                                <input name="name" required="" value="" id="name" type="text">
                            </div>
                            <!-- end .input -->
                            <div class="input">
                                <label>Номер телефона:</label>
                                <input name="phone" required="" value="" id="phone" type="text">
                            </div>

                        <div class="input">
                            <label>Пароль:</label>
                            <input name="password" required="" value="" id="password" type="password">
                        </div>
                        <div class="input">
                            <label>Адрес доставки:</label>
                            <input name="adress" required="" value="" id="adress" type="text">
                        </div>
                        <!-- end .input -->
                    </div>

                    <!-- я прочитал и принимаю условия -->
                    <div class="cart_form_bottom">
                        <label class="custom_check_lab">
                            <input class="outtaHere" name="" id="acseptCheckBox" onclick="acsept();" type="checkbox">
                            <span class="custom_checkbox"></span>
    Нажимая на кнопку «Зарегистрироваться» вы даете <a href="pravo.php" target="_blank">согласие на обработку</a> ваших персональных данных.
                        </label>
                        <div class="cart_form_bottom_hold">

                            <button class="btn" id="btn_order" disabled onclick="reg_new_user('<?=$template["TEMPLATE_PATH"]?>');">Зарегистрироваться</button>
                        </div>
                        <!-- end .cart_form_bottom_hold -->
                    </div>
<?}?>
                </div>
            </article>
        </main>

    </div>
<? include_once 'footer.php'; // подключение футера ?>