<?php
session_start();

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();

// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("vhod.php");
}
// Иначе открываем для него контент
else { include("verh.php"); ?>

<!-- / Тело страницы -->
<section id="content">
    <section class="main padder">
        <div class="row">
            <div class="col-lg-12">
                <section class="toolbar clearfix m-t-large m-b">
                </section>
            </div>
        </div>
        </div>
        </div>

        <br>
        <br>



        <div class="row">
            <div class="col-lg-12">
                <!--Вывод верхнего списка постраничного показа-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <br>
                            <?php
                            // ДОСТУП ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ
                            if ( $user_role == '3' ) { ?>
                                <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Очистить статистику</a> | </span></b><br><br>
                            <?php } ?>

                            <div class="table-responsive">
                                <table class="table table-striped b-t text-small">
                                    <thead>
                                    <tr>
                                        <th><b>Категория</b></th>
                                        <th><b>Крайний раз</b></th>
                                        <th><b>ip</b></th>
                                        <th><b>Просмотров</b></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    // Если роль пользователя 3
                                    include('showdata_forpeople.php');
                                    if ($user_role=='3') {
                                        if ( $_REQUEST['page'] == '1' ) { $b = '0'; } // вывод постранично
                                        $sql_products = $pdo->getRows("SELECT * FROM `statistic` WHERE `caption` =  ? GROUP BY `id_statistic` ORDER BY `datatime`",['categor']);
                                        foreach ( $sql_products as $data_statistic ) {

                                            $sql_kolvo = $pdo->getRows("SELECT COUNT('kolvo') as kolvo FROM `statistic` WHERE `id_statistic` =  ?",[$data_statistic['id_statistic']]);
                                            foreach ( $sql_kolvo as $kolvo ) { }

                                            $sql_categor = $pdo->getRows("SELECT * FROM `categor` WHERE `id` =  ?",[$data_statistic['id_statistic']]);
                                            foreach ( $sql_categor as $categor ) { }
                                            ?>
                                            <tr>
                                                <td><a target="_blank" href="../product.php?id=<?php echo $categor['id']; ?>&statistic=false">
                                                        <?php echo $categor['name']; ?></a></td>
                                                <td><?php $date = new DateTime($data_statistic['datatime']); echo $date->format('d.m.y | H:i'); ?></td>
                                                <td><?php echo $data_statistic['ip']; ?></td>
                                                <td><?php echo $kolvo['kolvo']; ?></td>
                                            </tr>
                                        <?php }} ?>
                            </div>
                            </tbody>
                            </table>
                        </section>


                        <!--Вывод нижнего списка постраничного показа-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="tovar" class="modal fade" style="display: none;" aria-hidden="true">
                                    <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php"  method="POST">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый товар</h4>
                                                </div>

                                                <?php
                                                $number_article = $pdo->getRow("SELECT * FROM `tovar` ORDER BY `datatime` DESC");
                                                ?>
                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Артикул:</label>
                                                        <input class="form-control parsley-validated" value="<?php echo $number_article['article']; ?>" placeholder="" type="text" name="article" autofocus autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Наименование товара:</label>
                                                        <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                                                        <input type="hidden" name="action" value="add_tovar">
                                                        <input type="hidden" name="user_id" value="<?php echo $id_user; ?>">
                                                        <input type="hidden" name="categor_id" value="<?php echo $id_categor; ?>">
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Фото:</label>
                                                        <input type="file" name="foto" title="Прикрепить файл"></a><br>
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Страна производитель:</label>
                                                        <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Цена(Закупка):</label>
                                                        <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Цена(Продажа):</label>
                                                        <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="block">
                                                        <label class="control-label">Описание:</label>
                                                        <input class="form-control parsley-validated" placeholder="" type="text" name="komment" autofocus autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="block">
                                                        <label class="control-label">Показать на витрине?</label><br>
                                                        <select name="status">
                                                            <option selected value="Да">Да</option>
                                                            <option value="Нет">Нет</option>
                                                        </select>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php
                                $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `categor_id` =  ? ",[$id_categor]);
                                foreach ( $sql_products as $data_products ) : ?>
                                    <!--Модальное окно удаления товара-->
                                    <div id="delete<?php echo $data_products['id']; ?>" class="modal fade" style="display: none;" aria-hidden="true">
                                        <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php?id=<?php echo $data_products['id']; ?>&action=del_tovar&categor=<?php echo $id_categor; ?>"  method="POST">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                                        <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Вы хотите удалить товар?</h4>
                                                    </div>

                                                    <center>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Да</button>
                                                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Нет</button>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endforeach; ?>




                                <!-- / Конец тела страницы -->
                                <?php include("niz.php"); }?>

