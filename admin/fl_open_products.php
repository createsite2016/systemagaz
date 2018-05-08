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
<?php
$id_categor = $_GET['id_categor'];

if ( $id_categor == null ) {
    exit("<html><head><meta http-equiv='Refresh' content='0; URL=admin/../products.php'></head></html>");
}

$sql_get_name_categor = $pdo->getRows("SELECT * FROM `categor` WHERE `id` = ? LIMIT 1 ", [$id_categor]);
foreach ( $sql_get_name_categor as $data_name_categor ) {
    $name_categor = $data_name_categor['name'];
    $id_return_categor = $data_name_categor['parent'];
} ?>





<!--Вывод верхнего списка постраничного показа-->
            <div class="row">
                <div class="col-lg-12">
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-12 text-right text-center-sm">
                                <ul class="pagination pagination-small m-t-none m-b-none">
<?php
//  ВЫВОД СТРАНИЦ НАВИГАЦИИ
$arra = $pdo->getRow("SELECT count(*) FROM `tovar`  WHERE `categor_id` =  ? ",[$id_categor]);
$total_articles_number = $arra['count(*)']; //общее количество статей
$articles_per_page = 25; // количество заказов на странице
$b = $_GET['page'];
if (!isset($_GET['page'])) {
    $b=0;
}
$a = $b + $articles_per_page;
//получаем количество страниц
$total_pages = ceil($total_articles_number/$articles_per_page);

// запускаем цикл - количество итераций равно количеству страниц
for ( $i=0; $i<$total_pages; $i++ )
{
// получаем значение $from (как $page_number) для использования в формировании ссылки
                                        $page_number=$i*$articles_per_page;
// если $page_number (фактически это проверка того является ли $from текущим) не соответствует
// текущей странице,
// выводим ссылку на страницу со значением $from равным $page_number
    if ($page_number!=$from) {echo "<li><a href='".$PHP_SELF."?page=".$page_number."&id_categor=".$id_categor."'> ".($i+1).
        " </a></li>"; }
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
    else {
        $page_number='1';
        echo "<li><a href='".$PHP_SELF."?page=".$page_number."&id_categor=".$id_categor."'> ".($i+1)." </a></li>";
    } // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </footer>









<section class="panel">
<?
$sql_get_categors = $pdo->getRows("SELECT * FROM `categor` WHERE `parent` = ? ",[$_GET['id_categor']]);
?>
<br><b><span class="center"><b>

                <?
                if(count($sql_get_categors)>0){?>
                |   <a href="products.php">  <- <?php echo $name_categor; ?></a></b> |
                <?} else {?>
                |   <a href="fl_open_products.php?id_categor=<?=$id_return_categor?>">  <- <?php echo $name_categor; ?></a></b> |
                <?}?>



    <?php
// ДОСТУП ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ
    if ( $user_role == '3' ) { ?>
            <a class="btn btn-sm btn-info" data-toggle="modal" href="#tovar"><i class="icon-shopping-cart"></i> Новый товар</a>
            <?
            if(!$_GET['parent']){?>
                |<a class="btn btn-sm btn-info" data-toggle="modal" href="#newcategor"><i class="icon-folder-open-alt"></i> Новая категория</a>
            <?} else {?>

            <?}?>
            |

            <script>
                function send() {
                    var file_data = $('#sortpicture').prop('files')[0];
                    var categor = document.getElementById('categor');
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    form_data.append('categor', categor.value);
                    alert(form_data);
                    $.ajax({
                        url: 'readex.php',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(php_script_response){
                            alert(php_script_response);
                            location.href=location.href;
                        }
                    });
                }

                function show_btn() {
                    document.getElementById('upload').style.display = '';
                }


            </script>

            <style>
                .fileContainer {
                    overflow: hidden;
                    position: relative;
                }
                .test {
                    display: none;
                }

                .fileContainer [type=file] {
                    cursor: inherit;
                    display: block;
                    font-size: 999px;
                    filter: alpha(opacity=0);
                    min-height: 100%;
                    min-width: 100%;
                    opacity: 0;
                    position: absolute;
                    right: 0;
                    text-align: right;
                    top: 0;
                }
            </style>


            <label class="btn btn-white">
                <i class="icon-cloud-upload text"></i>Выбрать таблицу эксель(.xlsx)
                <input id="sortpicture" class="test" type="file" onchange="show_btn();" name="sortpic" accept=".xlsx">
                <input type="hidden" name="categor" id="categor" value="<?=$_GET['id_categor']?>">
            </label>
            <button id="upload" onclick="send();" class="btn btn-sm btn-info" style="display: none">Загрузить выбранный файл</button>




        </span></b><br><br>
<?php } ?>

    <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th><b>Артикул</b></th>
                    <th><b>Наименование</b></th>
                    <th><b>Страна производитель</b></th>
                    <th><b>Количество</b></th>
                    <th><b>Цена (закупка/продажа)</b></th>
                    <th><b>Описание</b></th>
                    <th><b>Действие</b></th>
                  </tr>
                </thead>
<?php
include('showdata_forpeople.php');

// ВЫВОД КАТЕГОРИЙ
foreach ( $sql_get_categors as $categors ) {?>
    <tr>
        <td></td>
        <td><a href="fl_open_products.php?id_categor=<?php echo $categors['id']; ?>&parent=<?=$_GET['id_categor']?>"><img src="images/categor.png"><?php echo $categors['name'];
                $sql_get_tovar = $pdo->getRow("SELECT SUM(`kolvo`) FROM `tovar` WHERE `categor_id` = $categors[id] ");
                foreach ($sql_get_tovar as $test){
                    if ($test > 0) {
                        echo "<font color='#228b22'> ( кол-во товара: ".$test."шт. )</font>";
                    } else {
                        echo "<font color='#a9a9a9'> ( категория пуста )</font>";
                    }
                }
                ?></a></td>
        <td><a data-toggle="modal" href="#deletecategor<?php echo $categors['id']; ?>"><font color="red">Удалить</font></a>
            <a href="fl_izm_categor.php?id=<?php echo $categors['id']; ?>&parent=<?=$_GET['id_categor']?>"><font color="Green">Изменить</font></a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
<?}?>





<?
// ВОВОД ТОВАРА Если роль пользователя 3
if ($user_role=='3') {
    if ( $_REQUEST['page'] == '1' ) { $b = '0'; } // вывод постранично
    $sql_products = $pdo->getRows("SELECT * FROM `tovar` WHERE `categor_id` =  ? ORDER BY `name` DESC LIMIT $b,$articles_per_page",[$id_categor]);
    foreach ( $sql_products as $data_products ) { ?>
                  <tr>
                   <?php if ($data_products['kolvo']>0){ ?>
                    <td><?=$data_products['article'];?><br><img src="../<?=$data_products['image'];?>" alt="не загруженно фото товара" width="40"></td>
                    <td>
                        <a href="../product.php?id=<?php echo $data_products['id']; ?>" target="_blank"><?php echo $data_products['name']; ?></a>
                        <br>
                        <a href="history.php?id=<?php echo $data_products['id']; ?>" target="_blank"><font color="#d2691e"><i class="icon-time"></i>История поступлений товара</a></font>
                    </td>
                    <td><?php echo $data_products['model']; ?></td>
                    <td><?php echo $data_products['kolvo']; ?></td>
                      <td><font color="red"><i class="icon-money"></i><?=$data_products['chena_input'];?></font>/<font color="Green"><i class="icon-money"></i><?=$data_products['chena_output'];?></font></td>
                      
                    <td><?php echo $data_products['komment']; ?></td>
                    <td>
                        <a data-toggle="modal" href="#delete<?php echo $data_products['id']; ?>"><font color="red"><i class="icon-trash"></i>Удалить</font></a>
                        <a href="fl_izm_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green"><i class="icon-pencil"></i>Изменить</font></a><br>
                        <a href="fl_prinyat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                            <?php
                            if ($data_products['kolvo']>0){ ?>
                                <br><a href="fl_prodat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                            <?php } ?>
                    </td><?php }
                   else { ?>

                       <td><b><font color="#a52a2a"><?php echo $data_products['article']; ?><br><img src="../<?=$data_products['image'];?>" alt="альтернативный текст" width="40"></font></b></td>
                       <td>
                           <b><font color="#a52a2a"><a href="../product.php?id=<?php echo $data_products['id']; ?>" target="_blank"><?php echo $data_products['name']; ?></a></font></b>
                           <br>
                           <a href="history.php?id=<?php echo $data_products['id']; ?>" target="_blank"><font color="#d2691e"><i class="icon-time"></i>История поступлений товара</a></font>
                       </td>
                       <td><b><font color="#a52a2a"><?php echo $data_products['model']; ?></font></b></td>
                       <td><b><font color="#a52a2a"><?php echo $data_products['kolvo']; ?></font></b></td>
                       <td><b><font color="red"><?=$data_products['chena_input'];?></font>/<font color="Green"><?=$data_products['chena_output'];?></font></b></td>
                       <td><b><font color="#a52a2a"><?php echo $data_products['komment']; ?></font></b></td>
                       <td><b><font color="#a52a2a"><a data-toggle="modal" href="#delete<?php echo $data_products['id']; ?>"><font color="red"><i class="icon-trash"></i>Удалить</font></a>
                           <a href="fl_izm_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>"><font color="Green"><i class="icon-pencil"></i>Изменить</font></a><br>
                           <a href="fl_prinyat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(+)Принять</a>
                           <?php
                           if ($data_products['kolvo']>0){ ?>
                               <a href="fl_prodat_tovar.php?id=<?php echo $data_products['id']; ?>&categor=<?php echo $id_categor; ?>">(-)Продать</a>
                           <?php } ?>
                               </font></b></td>

                  <?php } ?>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section>


<!--Вывод нижнего списка постраничного показа-->
                    <div class="row">
                        <div class="col-lg-12">
                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-12 text-right text-center-sm">
                                        <ul class="pagination pagination-small m-t-none m-b-none">
                                            <?php
                                            //  ВЫВОД СТРАНИЦ НАВИГАЦИИ
                                            $arra = $pdo->getRow("SELECT count(*) FROM `tovar`  WHERE `categor_id` =  ? ",[$id_categor]);
                                            $total_articles_number = $arra['count(*)']; //общее количество статей
                                            $articles_per_page = 25; // количество заказов на странице
                                            $b = $_GET['page'];
                                            if (!isset($_GET['page'])) {
                                                $b=0;
                                            }
                                            $a = $b + $articles_per_page;
                                            //получаем количество страниц
                                            $total_pages = ceil($total_articles_number/$articles_per_page);

                                            // запускаем цикл - количество итераций равно количеству страниц
                                            for ( $i=0; $i<$total_pages; $i++ )
                                            {
// получаем значение $from (как $page_number) для использования в формировании ссылки
                                                $page_number=$i*$articles_per_page;
// если $page_number (фактически это проверка того является ли $from текущим) не соответствует
// текущей странице,
// выводим ссылку на страницу со значением $from равным $page_number
                                                if ($page_number!=$from) {echo "<li><a href='".$PHP_SELF."?page=".$page_number."&id_categor=".$id_categor."'> ".($i+1).
                                                    " </a></li>"; }
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
                                                else {
                                                    $page_number='1';
                                                    echo "<li><a href='".$PHP_SELF."?page=".$page_number."&id_categor=".$id_categor."'> ".($i+1)." </a></li>";
                                                } // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </footer>


            <div id="tovar" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
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
                                    <input class="form-control parsley-validated" value="<?php echo $number_article['article']; ?>" placeholder="" type="text" name="article" autofocus>
                                </div>
                            </div>

                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Наименование товара:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus autocomplete="off">
                                    <input type="hidden" name="action" value="add_tovar">
                                    <input type="hidden" name="user_id" value="<?php echo $id_user; ?>">
                                    <input type="hidden" name="categor_id" value="<?php echo $id_categor; ?>">
                                    <input type="hidden" name="status" value="да">
                                </div>
                            </div>

                            <!--Фото:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Фото:</label>
                                    <input type="file" name="foto" title="Прикрепить файл"></a><br>
                                </div>
                            </div>

                            <!--Цена(Закупка):-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Цена(Закупка):</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_input" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Цена(Продажа):-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Цена(Продажа):</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="chena_output" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Страна производитель:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Страна производитель:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="model" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Описание:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Описание:</label>
                                    <input class="form-control parsley-validated" placeholder="" name="komment" autofocus autocomplete="off"></input>
                                </div>
                            </div>



                            <!-- СВОЙСТВА ТОВАРА-->

                            <!--Фирма изготовитель:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Фирма изготовитель:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="firma" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Новинка:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Новинка:</label>
                                    <select name="new">
                                        <option selected="" value="Нет">Нет</option>
                                        <option value="Да">Да</option>
                                    </select>
                                </div>
                            </div>

                            <!--% скидки на товар:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">% Процент скидки:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="skidka" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Размер:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Размер:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="razmer" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Вес:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Вес:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="ves" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Объем:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Объем:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="obem" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Длина:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Длина:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="dlina" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Материал:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Материал:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="material" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Цвет:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Цвет:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="color" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Гарантия:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Гарантия:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="garant" autofocus autocomplete="off">
                                </div>
                            </div>

                            <!--Комплектация:-->
                            <div class="modal-body">
                                <div class="block">
                                    <label class="control-label">Комплектация:</label>
                                    <input class="form-control parsley-validated" placeholder="" type="text" name="complect" autofocus autocomplete="off">
                                </div>
                            </div>


                            <div class="modal-body" style="display: none">
                                <div class="block">
                                    <label class="control-label">Показывать на витрине?</label><br>
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
            <div id="delete<?php echo $data_products['id']; ?>" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
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

                            <div id="newcategor" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
                                <form class="m-b-none" action="classes/App.php" method="POST">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                                <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Новая категория</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="block">
                                                    <label class="control-label">Название:</label>
                                                    <input class="form-control parsley-validated" placeholder="" type="text" name="name" autofocus="" autocomplete="off">
                                                    <input type="hidden" name="parent" value="<?=$_GET['id_categor']?>">
                                                    <input type="hidden" name="action" value="add_categor">
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
                            $sql_products = $pdo->getRows("SELECT * FROM `categor` WHERE `parent` = ? ",[$_GET['id_categor']]);
                            foreach ( $sql_products as $windows ){ ?>

                                <!--Модальное окно удаления категории-->
                                <div id="deletecategor<?php echo $windows['id']; ?>" data-backdrop="false" class="modal fade" style="display: none;" aria-hidden="true">
                                    <form class="m-b-none" enctype = "multipart/form-data" action="classes/App.php?id=<?php echo $windows['id']; ?>&action=del_categor&parent=<?=$_GET['id_categor']?>"  method="POST">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                                    <h4 class="modal-title" id="myModalLabel"><i class="icon-edit"></i>Вы хотите удалить категорию товара?</h4>
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
                                <div class="modal-overlay"></div>

                            <?php } ?>



<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

