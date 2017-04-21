<?php
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина
include_once('view/tpl_head.php');
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php include'view/tpl_left_menu_categors.php'; // подключение меню категорий ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Контакты</h2>
                    <p>Мы всегда онлайн, пишите в любой удобный для Вас мессанджер, будем рады общению с Вами:</p>
                    <br>
                        <p><a href="tel:+79649001435">Viber: +79649001435 <img src="images/viber.png" width="48"></p>
                        <p><a href="tel:+79649001435">WhatsApp: +79649001435 <img src="images/whatsapp.png" width="48"></p>
                    <p><b><a target="_blank" href="https://t.me/xakerfsb">Telegram <img src="images/email.png" width="48"></a></b></p>
                    <p><b><a target="_blank" href="https://www.instagram.com/vita_shop2016">Instagram <img src="images/instagram.png" width="48"></a></b></p>
                    <p><b><a target="_blank" href="https://ok.ru/group/58318300250167">Одноклассники <img src="images/odnoklassniki.png" width="48"></a></b></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'view/tpl_footer.php'; ?>
