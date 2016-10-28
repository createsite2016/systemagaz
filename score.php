<?php
session_start();
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
                    <th><b><font color="black">UAH</font></b></th>
                    <th><b><font color="black">USD</font></b></th>
                    <th><b><font color="black">EUR</font></b></th>
                    <th><b><font color="black">Счет1</font></b></th>
                    <th><b><font color="black">Счет2</font></b></th>
                    <th><b><font color="black">Счет3</font></b></th>
                    <th><b><font color="black">Счет4</font></b></th>
                    <th><b><font color="black">Счет5</font></b></th>
                    <th><b><font color="black">Счет6</font></b></th>
                  </tr>
                </thead>
<?php
// Если роль пользователя 1
include('showdata_forpeople.php');
if ($user_role=='1') {
                        $sql_get_device = mysql_query("SELECT * FROM `rashod` ORDER BY `datatime` DESC ",$db);
                        while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
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
                        // $sql_get_device = mysql_query("SELECT * FROM `rashod` ORDER BY `datatime` DESC ",$db);
                        // while ($data_get_device = mysql_fetch_assoc($sql_get_device)) { ?>
                  <tr>
                    <td>Приход</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Расход</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>В пути</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Склад</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Приход</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Итого</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Наличные</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>

                  <tr>
                    <td>Наличные в грн.</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                  </tr>
<?php 
//}
} 
?>
                    </div>
              </tbody>
              </table>
              </section>

<!-- / Конец тела страницы -->
<?php include("niz.php"); }?>

