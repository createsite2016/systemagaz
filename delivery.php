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
                        <h2 class="title text-center">Доставка</h2>
                        <p>Доставка у нас по всей России, доставляем с помощью Почты России и курьерских компаний. По Гулькевичскому району и Кропоткину делаем <b>БЕСПЛАТНУЮ</b> доставку до дверей вашего дома (МегаУдобно, когда у Вас маленькие дети или плотный график для походов в магазины).</p>
                        <p>Вопросы по поводу доставки вы сможете задать в нашем чате прямо на сайте, либо написать нам, обратившись на страницу <a href="contact.php" target="_blank">'КОНТАКТЫ'</a></p>
                        <br>
                        <center><p><img src="images/kurer.jpg" width="360"></p></center>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include_once 'view/tpl_footer.php'; ?>