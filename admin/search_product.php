<?php
session_start();

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
                <?php
                $id_categor = $_GET['id_categor'];

                $sql_get_name_categor = $pdo->getRows("SELECT * FROM `categor` WHERE `id` = ? LIMIT 1 ", [$id_categor]);
                foreach ( $sql_get_name_categor as $data_name_categor ) {
                    $name_categor = $data_name_categor['name'];
                } ?>

                <section class="panel">

                    <br><b><span class="center"><b> |   <a href="products.php">  <- <?php echo $name_categor; ?></a></b> |

                            <?php
                // ДОСТУП ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ
                if ( $user_role == '3' ) { ?>
                            <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a> | </span></b><br><br>
                    <?php } ?>

                    <div class="table-responsive">
                        <table class="table table-striped b-t text-small">
                            <thead>
                            <tr>
                                <th><b>Артикул</b></th>
                                <th><b>Наименование</b></th>
                                <th><b>Страна производитель</b></th>
                                <th><b>Количество</b></th>
                                <th><b>Цена (закупка)</b></th>
                                <th><b>Цена (продажа)</b></th>
                                <th><b>Описание</b></th>
                                <th><b>Действие</b></th>
                            </tr>
                            </thead>
                            <?php
                            // Если роль пользователя 1
                            include('showdata_forpeople.php');
                            if ($user_role=='1') {

                                $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `categor_id` =  ? ",[$id_categor]);
                                foreach ( $sql_products as $data_products ) { ?>
                                    <tr>
                                        <td><?php echo $data_products['article']; ?></td>
                                        <td><?php echo $data_products['name']; ?></td>
                                        <td><?php echo $data_products['model']; ?></td>
                                        <td><?php echo $data_products['kolvo']; ?></td>
                                        <td><?php echo $data_products['chena_input']; echo " "; echo $data_products['money_input']; ?></td>
                                        <td> </td>
                                        <td><?php echo $data_products['chena_output'];?></td>
                                        <td><?php echo $data_products['status']; ?></td>
                                        <td>Нет прав</td>
                                    </tr>
                                <?php }}


                            // Если роль пользователя 3
                            if ($user_role=='3') {
                                $search_tovar = $_POST['search_tovar'];
                                $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `article` =  ? ",[$search_tovar]);
                                foreach ( $sql_products as $data_products ) { ?>
                                    <tr>
                                        <td><?php echo $data_products['article']; ?></td>
                                        <td><a href="../product.php?id=<?php echo $data_products['id']; ?>" target="_blank"><?php echo $data_products['name']; ?></a></td>
                                        <td><?php echo $data_products['model']; ?></td>
                                        <td><?php echo $data_products['kolvo']; ?></td>
                                        <td><?php echo $data_products['chena_input'];?></td>
                                        <td><?php echo $data_products['chena_output'];?></td>
                                        <td><?php echo $data_products['komment']; ?></td>
                                        <td><a href="classes/App.php?action=del_find_tovar&id=<?php echo $data_products['id']; ?>"><font color="red">Удалить</font></a>
                                            <a href="fl_izm_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green">Изменить</font></a><br>
                                            <a href="fl_prinyat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                                            <?php
                                            if ($data_products['kolvo']>0){ ?>
                                                <a href="fl_prodat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }} ?>
                    </div>
                    </tbody>
                    </table>
                </section>







                <div id="tovar" class="modal fade" style="display: none;" aria-hidden="true">
                    <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php"  method="POST">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новый товар</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="block">
                                        <label class="control-label">Артикул:</label>
                                        <input class="form-control parsley-validated" placeholder="" type="text" name="article" autofocus autocomplete="off">
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

