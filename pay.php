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
                        <h2 class="title text-center">Оплата</h2>
                        <p>Оплата по картам, мы не подключали ни какие сервисы онлайн оплаты, так как они берут от 5 до 12 процентов, мы не хотим перекладывать это на наших покупателей и делать товары дороже, поэтому для оплаты нужно будет сделать обычный перевод с карты на карту.</p>
                        <p>Для удобства у нас есть несколько карт разных банков (Чтобы и тут устранить коммисию при переводе).</p>
                        <br>
                        <p>Мы стремимся к тому, чтобы сделать для Вас шопинг максимально выгоднее.</p>
                        <center><p><img src="images/pay.jpg" width="300"></p></center>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include_once 'view/tpl_footer.php'; ?>