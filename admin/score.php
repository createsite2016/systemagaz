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

<section class="panel">
<br>
            <div class="table">
              <table class="table text-small">
                <thead>
                  <tr>
                    <th><b><font color="black"> </font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Местная валюта(Нал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','USD(Нал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','EUR(Нал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет1(Безнал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет2(Безнал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет3(Безнал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет4(Безнал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет5(Безнал.)') ?></font></b></th>
                    <th><b><font color="black"><?php go_link('money.php','Счет6(Безнал.)') ?></font></b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
  $sql_get_device = $pdo->getRows("SELECT * FROM `rashod` ORDER BY `datatime` DESC ");
  foreach ( $sql_get_device as $data_get_device ) { ?>
                  <tr>
                    <td></td>
                    <td><?php echo $data_get_device['uah']; ?></td>
                    <td><?php echo $data_get_device['usd']; ?></td>
                    <td><?php echo $data_get_device['eur']; ?></td>
                    <td><?php echo $data_get_device['cash1']; ?></td>
                    <td><?php echo $data_get_device['cash2']; ?></td>
                    <td><?php echo $data_get_device['cash3']; ?></td>
                    <td><?php echo $data_get_device['cash4']; ?></td>
                    <td><?php echo $data_get_device['cash5']; ?></td>
                    <td><?php echo $data_get_device['cash6']; ?></td>
                  </tr>
<?php }}


// Если роль пользователя 3
if ($user_role=='3') {


// Метод получения суммы отдельных счетов
function get_summ($name_stolb,$table_name){
  $pdo = new Database();
  $sql_get_summ = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name}`");
  foreach ($sql_get_summ as $money){}
  echo $money;
}

// Метод получения суммы отдельных счетов
function get_all_summ($name_stolb,$table_name){
  $pdo = new Database();
  $sql_get_summ = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name}`");
  foreach ($sql_get_summ as $money){}
  return $money;
}

// Метод получения итого на разнице счетов
function get_result($name_stolb,$table_name, $table_name2){
  $pdo = new Database();
  $sql_get_summ = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name}`");
  foreach ($sql_get_summ as $money){}


  $sql_get_summ2 = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name2}`");
  foreach ($sql_get_summ2 as $money2){}


  $result = $money - $money2;

  $result = number_format($result, 0, ',', ' ');
  // установка цвета
  if ($result < 0){
    $result = '<b><font color=red>'.$result.'</font></b>';
  }
  if ($result > 0){
    $result = '<b><font color=green>'.$result.'</font></b>';
  }
  if ($result == '0'){
    $result = '<b>0</b>';
  }

  echo $result;
}


// Метод получения Общего нала
function get_all_result($name_stolb,$table_name, $table_name2){
  $pdo = new Database();

  $sql_get_summ = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name}`");
  foreach ($sql_get_summ as $money){}

  $sql_get_summ2 = $pdo->getRow("SELECT SUM(`{$name_stolb}`) FROM `{$table_name2}`");
  foreach ($sql_get_summ2 as $money2){}


  $result = $money - $money2;

  if ($name_stolb == 'usd') {
    $pdo = new Database();
    $sql_get_valuta = $pdo->getRow("SELECT `chena` FROM `money` WHERE `name` = 'Доллар' ");
    foreach ($sql_get_valuta as $valuta){}
    $result = $result * $valuta;
  }

  if ($name_stolb == 'eur') {
    $pdo = new Database();
    $sql_get_valuta = $pdo->getRow("SELECT `chena` FROM `money` WHERE `name` = 'Евро' ");
    foreach ($sql_get_valuta as $valuta){}
    $result = $result * $valuta;
  }
  return $result;
}




// Метод получения складских остатков
  function sklad(){
    $summa = null;
    $pdo = new Database();
    $get_rows = $pdo->getRows("SELECT tovar.kolvo,tovar.chena_input,money.chena FROM `tovar` INNER JOIN `money` ON tovar.money_input = money.name AND tovar.kolvo > 0");
    foreach ( $get_rows as $data_get_device) {
                    $summa = $summa + $data_get_device['kolvo'] * $data_get_device['chena_input'] * $data_get_device['chena']; // Итого
          }
    echo $summa;
  }

// Метод получения Склада
function all_sklad(){
  $summa = null;
  $pdo = new Database();
  $get_rows = $pdo->getRows("SELECT tovar.kolvo,tovar.chena_input,money.chena FROM `tovar` INNER JOIN `money` ON tovar.money_input = money.name AND tovar.kolvo > 0");
  foreach ( $get_rows as $data_get_device ) {
    $summa = $summa + $data_get_device['kolvo'] * $data_get_device['chena_input'] * $data_get_device['chena']; // Итого
  }
  return $summa;
}

  ?>
                  <tr>
                    <td><font color="green"><b><?php go_link('prihod.php','Приход') ?></b></font></td>
                    <td><font color="green"><?php get_summ('uah','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('usd','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('eur','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash1','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash2','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash3','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash4','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash5','prihod'); ?></font></td>
                    <td><font color="green"><?php get_summ('cash6','prihod'); ?></font></td>
                  </tr>

                  <tr>
                    <td><font color="red"><b><?php go_link('rashod.php','Расход') ?></b></font></td>
                    <td><font color="red"><?php get_summ('uah','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('usd','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('eur','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash1','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash2','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash3','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash4','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash5','rashod'); ?></font></td>
                    <td><font color="red"><?php get_summ('cash6','rashod'); ?></font></td>
                  </tr>

                <tr>
                  <td><b>Разница(прих/расх)</b></td>
                  <td><?php get_result('uah','prihod','rashod'); ?></td>
                  <td><?php get_result('usd','prihod','rashod'); ?></td>
                  <td><?php get_result('eur','prihod','rashod'); ?></td>
                  <td><?php get_result('cash1','prihod','rashod'); ?></td>
                  <td><?php get_result('cash2','prihod','rashod'); ?></td>
                  <td><?php get_result('cash3','prihod','rashod'); ?></td>
                  <td><?php get_result('cash4','prihod','rashod'); ?></td>
                  <td><?php get_result('cash5','prihod','rashod'); ?></td>
                  <td><?php get_result('cash6','prihod','rashod'); ?></td>
                </tr>

                <tr>
                  <td><b>Итого наличными</b></td>
                  <td><b><?php $res = (int)(get_all_result('uah','prihod','rashod') +
                  get_all_result('usd','prihod','rashod') +
                  get_all_result('eur','prihod','rashod') +
                  get_all_result('cash1','prihod','rashod') +
                  get_all_result('cash2','prihod','rashod') +
                  get_all_result('cash3','prihod','rashod') +
                  get_all_result('cash4','prihod','rashod') +
                  get_all_result('cash5','prihod','rashod') +
                  get_all_result('cash6','prihod','rashod') );
                    echo number_format($res, 0, ',', ' '); ?></b></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

            </div>
  </tbody>
  </table>
</section>


          <section class="panel">
            <br>
          <div class="table">
            <table class="table text-small">
              <thead>
              <tr>
                <th><b><font color="black"> </font></b></th>
                <th><b><font color="black">Количество товаров(шт.)</font></b></th>
                <th><b><font color="black">Цена всех товаров (Местная валюта)</font></b></th>
                <th><b><font color="black">Профит с продажи (Местная валюта)</font></b></th>
              </tr>
              </thead>

                  <tr>
                    <td><i class="icon-truck"></i><b><?php go_link('way.php','В пути') ?></b></td>
                    <td><?php get_summ('kolvo','in_way'); ?></td>
                    <td><?php get_summ('chena','in_way'); ?></td>
                    <td><?php get_summ('profit','in_way'); ?></td>
                  </tr>

          </div>
            </tbody>
            </table>
          </section>


          <section class="panel">
            <br>
            <div class="table">
              <table class="table text-small">
                <thead>
                <tr>
                  <th><b><font color="black"> </font></b></th>
                  <th><b><font color="black">Количество товаров на складе(шт.)</font></b></th>
                  <th><b><font color="black">Стоимость всех товаров склада(Местная валюта)</font></b></th>
                  <th><b><font color="black"></font></b></th>
                </tr>
                </thead>

                <tr>
                  <td><i class="icon-sitemap  icon-xlarge"></i><b><?php go_link('products.php','Склад') ?></b></td>
                  <td><?php get_summ('kolvo','tovar'); ?></td>
                  <td><?php sklad(); ?></td>
                  <td></td>
                </tr>
            </div>
            </tbody>
            </table>
          </section>


          <section class="panel">
            <br>
            <div class="table">
              <table class="table text-small">
                <thead>
                <tr>
                  <th><b><font color="black">Общее итого</font></b></th>
                </tr>
                </thead>

                <tr>
                  <td><b><?php
                      $res = (int)(
                        get_all_result('uah','prihod','rashod') +
                        get_all_result('usd','prihod','rashod') +
                        get_all_result('eur','prihod','rashod') +
                        get_all_result('cash1','prihod','rashod') +
                        get_all_result('cash2','prihod','rashod') +
                        get_all_result('cash3','prihod','rashod') +
                        get_all_result('cash4','prihod','rashod') +
                        get_all_result('cash5','prihod','rashod') +
                        get_all_result('cash6','prihod','rashod') +
                        get_all_summ('chena','in_way') +
                        all_sklad()
                      );
                        echo number_format($res, 0, ',', ' '); ?></b></td>
                </tr>
            </div>
            </tbody>
            </table>
          </section>


<?php 
//}
} 
?>


<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

