<?php
session_start();
include_once "classes/App.php"; // подключаем функции приложения
$pdo = new Database();
$get_user_info = $pdo->getRows("SELECT * FROM `users_8897532`"); // получение данных о пользователях
foreach ( $get_user_info as $data_user_info ) { }
if ( $data_user_info['login']=='' ) {
    exit("<html><head><meta http-equiv='Refresh' content='0; URL=registr.php'></head></html>");
}
// Проверка авторизован пользователь или нет.
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    include("views/login/login.php");
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
<br><br>
        <div class="row">
        <div class="col-lg-12">
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-12 text-right text-center-sm">
                        <ul class="pagination pagination-small m-t-none m-b-none">
<?php
//  ВЫВОД СТРАНИЦ НАВИГАЦИИ
$arra = $pdo->getRow("SELECT count(*) FROM `priem` ");
$total_articles_number = $arra['count(*)']; //общее количество статей
$articles_per_page = 100; // количество заказов на странице
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
if ($page_number!=$from) {echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1).
    " </a></li>"; }
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
else {
  $page_number='1';
  echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
  } // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
}
?>
                  </ul>
                </div>
              </div>
            </footer>
            <form action="del_list.php" method="POST" id="form">
<section class="panel">
<br><b><span class="center"> |
            <button class="btn btn-sm btn-info" id="checkbtn" type="submit" form="form"><i class="icon-document"></i> Удалить заказы</button>

        </span></b><br><br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th></th>
                    <th><b>№ Заказа</b></th>
                    <th><b>Дата</b></th>
                    <th><b>ФИО</b></th>
                    <th><b>Телефон</b></th>
                    <th><b>Адрес</b></th>
                    <th><b>Название товара<b></th>
                    <th><b>Количество<b></th>
                    <th><b>Статус</b></th>
                    <th><b>Менеджер</b></th>
                    <th><b>Комментарий</b></th>
                    <th>Редактировать</th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
// Если роль пользователя 3
if ($user_role=='3') {
    if ( $_REQUEST['page'] == '1' ) { $b = '0'; } // вывод постранично

    $sql_tovar = $pdo->getRows("SELECT priem.id,priem.color as id_status,datatime,fio,phone,adress,dostavka,tovar,status,kolvo,user_name,postavshik,priem.komment,status.color  FROM `priem` INNER JOIN `status` ON status.id=priem.color ORDER BY `sort`,`datatime` DESC LIMIT $b,$articles_per_page ");
    foreach ($sql_tovar as $tovar) { ?>
                  <tr>
                    <td>
                        <div class="checkbox">
                            <label class="checkbox-custom">
                                <input name="products[]" type="checkbox" form="form" value="<?php echo $tovar['id']; // id записи ?>">
                                <i class="icon-unchecked" ></i>
                            </label>
                        </div>
                    </td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['id']; // Заказ ?></font></b></td>
                      <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php $date = new DateTime($tovar['datatime']); echo $date->format('d.m.y | H:i'); ?></font></b></td>
                      <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['fio']; // фамилия ?></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black">


                                <a href="http://qrcoder.ru/code/?%2B7<?php echo $tovar['phone'];?>&4&0" target="_blank" onclick="window.open(this.href,this.target,'width=600,height=600,scrollbars=1,left=400,top=100');return false;"><?php echo $tovar['phone'];?></a>
                            </font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['adress']; // адрес ?></font></b></td>
                    <?php $tovar_name = $pdo->getRow("SELECT * FROM `tovar` WHERE `id` = ? ",[$tovar['tovar']]) ?>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><a href="../product.php?id=<?php echo $tovar['tovar']; ?>&statistic=false" target="_blank"><?php echo $tovar_name['name']; echo '<br>('; echo $tovar_name['article'].')'; // содержание ?></a></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['kolvo']; // количество ?></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['status']; ?></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['user_name']; ?></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>"><b><font color="black"><?php echo $tovar['komment']; ?></font></b></td>
                    <td bgcolor="<?php echo $tovar['color'];?>">
                      <div class="btn-group">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil"></i></a>
                          <ul class="dropdown-menu pull-right">
                              <?php
                              // если заказ закрыт, его не показываю
                              if ( $tovar['id_status'] != '2' ) { ?>
                                  <li><a href="fl_izm_zakaz.php?id=<?php echo $tovar['id']; ?>&usid=<?php echo $id_user; ?>&kolvo=<?php echo $tovar['kolvo']; ?>">Изменить</a></li>
                                  <li class="divider"></li>
                              <?php } ?>
                            <li><a href="classes/App.php?id=<?php echo $tovar['id']; ?>&action=del_zakaz"><font color="red">Удалить</font></a></li>
                          </ul>
                       </div>
                    </td>
                  </tr>
<?php }} ?>
                    </div>
              </tbody>
              </table>
              </section></form>
<footer class="panel-footer">
              <div class="row">
                <div class="col-12 text-right text-center-sm">
                  <ul class="pagination pagination-small m-t-none m-b-none">
  <?php
  //  ВЫВОД СТРАНИЦ НАВИГАЦИИ
 $arra = $pdo->getRow("SELECT count(*) FROM `priem` ");
 $total_articles_number = $arra['count(*)']; //общее количество статей

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
                          if ($page_number!=$from) {echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1).
                              " </a></li>"; }
// иначе просто выводим номер страницы - данная строка необязательна,
// пропустив ее вы просто получите линк на текущую страницу
                          else {
                              $page_number='1';
                              echo "<li><a href='".$PHP_SELF."?page=".$page_number."'> ".($i+1)." </a></li>";
                          } // если page_number - текущая страница - ничего не выводим (ссылку не делаем)
                      }
                      ?>
                  </ul>
                </div>
              </div>
            </footer>

<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

