<?php
# Вывод страницы созданной пользователей, для описания или вывода иной информации
include_once "admin/classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$shop = $pdo->getRow("SELECT * FROM `magazins`"); // получение данных магазина
include_once('view/tpl_head.php');
$id = $_GET['id'];
$data_page = $pdo->getRow("SELECT * FROM `pages` WHERE `id` = ? ",[$id]); // получение данных старницы
?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <?php include'view/tpl_left_menu_categors.php'; // подключение меню категорий ?>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center"><?php echo $data_page['name'] ?></h2>
                        <?php echo $data_page['datapage'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include_once 'view/tpl_footer.php'; ?>