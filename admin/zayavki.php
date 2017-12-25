<?php
session_start();


include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database(); // подключаем БД

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

                <section class="panel">

                    <div class="table-responsive">
                        <table class="table table-striped b-t text-small">
                            <thead>
                            <tr>
                                <th><b>Имя</b></th>
                                <th><b>Телефон</b></th>
                                <th><b>Тема заявки</b></th>
                                <th><b>Текст заявки</b></th>
                                <th><b>Действие</b></th>
                            </tr>
                            </thead>
                            <?php
                            // Если роль пользователя 3
                            include('showdata_forpeople.php');
                            if ($user_role=='3') {
                                $sql_get_device = $pdo->getRows("SELECT * FROM `zayavki` ORDER BY `datatime` DESC ");
                                foreach ( $sql_get_device as $data_get_device ) { ?>
                                    <tr>
                                        <td><?php echo $data_get_device['name']; ?></td>
                                        <td><?php echo $data_get_device['phone'];?></td>
                                        <td><?php echo $data_get_device['tema']; ?></td>
                                        <td><?php echo $data_get_device['obrashenie']; ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="classes/App.php?action=del_zayavka&id=<?php echo $data_get_device['id']; ?>"><font color="red">Удалить</font></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }} ?>
                    </div>
                    </tbody>
                    </table>
                </section>

                <!-- / Конец тела страницы -->
                <?php include("niz.php"); }?>

