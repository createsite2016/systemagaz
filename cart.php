<?php
//include_once "classes/Database.php"; // подключаем БД
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина

include_once('view/tpl_head.php');
?>

<script src="js/jquery.js"></script>
<script src="js/mask.js"></script>
<script>
    $("#checkphone").mask("+7(999) 999-9999", {placeholder: "+7(___) ___ - ____" });
</script>

<section>
    <div class="container">
        <div class="row">
                <div class="col-sm-3">
                    <?php include'view/tpl_left_menu_categors.php'; // подключение меню категорий ?>
                </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>
                    <p>Вы выбрали такие товары:</p>
                    <table class="table-bordered table-striped table" id="rex">
                        </table>
<!--оформление заказа-->
                            <div id="ndsfnsdfjsklf" style="display: block">
                                <div class="shopper-info">
                                    <p>Оформление заказа:</p>
                                    <form>
                                        <div id="labelname">*Ваше имя</div>
                                        <input type="text" placeholder="Иван" id="checkname" required>
                                        <div id="labelphone">*Номер телефона</div>
                                        <input type="text" placeholder="Ваш телефон(Без +7 и 8)" id="checkphone" required>
                                        <div id="labeladress">*Адрес доставки</div>
                                        <input type="text" placeholder="Город, улица, дом" id="checkadress" required>
                                        Комментарий
                                        <input type="text" placeholder="Звонить после 17 часов" id="checkkomment">
                                    </form>
                                    <button class="btn btn-primary" onclick="addCheck()" href=""><i class="fa fa-shopping-cart"></i> Оформить заказ</button>

                                </div>
                            </div>
                            <br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'view/tpl_footer.php'; ?>
