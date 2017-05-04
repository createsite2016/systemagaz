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
                    <h2 class="title text-center">Размеры</h2>
                    <p>Да да да, мы очень понимаем Ваши переживания по поводу товара, а именно размеров, подойдет или не подойдет, вдруг короткое, вдруг длинное, для Вас мы подготовили таблицы размеров с их помощью выбор Ваш будет правильным, а главное останетесь довольными покупкой</p>
                    <center><p><img src="images/1.jpg" width="480"></p></center>
                    <p>Представлена так же размерная таблица для детей разных возрастов, "от мало до велико" как для одежды, так и для обуви</p>
                    <center><p><img src="images/2.jpg" width="480"></p></center>
                    <p>Не пройдем мимо и такой темы, как женские джинсы</p>
                    <center><p><img src="images/3.jpg" width="480"></p></center>
                    <p>а так же табличка про талию, грудь и бедра</p>
                    <center><p><img src="images/4.jpg" width="480"></p></center>
                    <center><p><img src="images/5.jpg" width="480"></p></center>
                    <p>Ну и для наших мужчин, есть табличка с размерами</p>
                    <center><p><img src="images/6.jpg" width="480"></p></center>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once 'view/tpl_footer.php'; ?>
