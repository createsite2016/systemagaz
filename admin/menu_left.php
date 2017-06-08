<?php
include_once "classes/Database.php";
$pdo = new Database();

$login = $_SESSION['login'];

$sql_get_user = $pdo->getRows("SELECT * FROM `users_8897532` WHERE `login`='$login'");
foreach ($sql_get_user as $get_user_data):
$id_user = $get_user_data['id']; // получаем id пользователя
endforeach;

$sql_get_user = $pdo->getRows("SELECT * FROM `users_8897532` WHERE `id`<>'$id_user' ");
foreach ($sql_get_user as $value):
$us_ids = $value['id'];
endforeach;
//$sql_us = mysql_query("SELECT * FROM `users_8897532` WHERE `id`<>'$id_user' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
//$us_ids = mysql_fetch_array($sql_us);
 ?>
      <li><a href="index.php"><i class="icon-credit-card icon-xlarge"></i><span>Заказы</span></a></li>
      <li class="dropdown-submenu"><a href="products.php"><i class="icon-sitemap  icon-xlarge"></i>Товары</a>

<?php
// ДОСТУП ДЛЯ МЕНЕДЖЕРОВ
if ($user_role=='1') { ?>
      </li>
         <?php } ?>

<?php
// ДОСТУП ТОЛЬКО ДЛЯ АДМИНИСТРАТОРОВ
if ($user_role=='3') { ?>
    <ul class="dropdown-menu">
          <li><a href="way.php"><i class="icon-truck"></i>
                  В пути<?php
                  $count = $pdo->getRow("SELECT COUNT(`kolvo`) FROM `in_way`");
                  foreach ($count as $valuta){}
                  echo " (отгрузок: ".$valuta.")";
                  ?>
              </a></li>
        <li><a href="long_time_product.php"><i class="icon-time"></i>
                <?php
                $days = $pdo->getRow("SELECT * FROM `magazins`");
                $interval_day = $days['time_day'];
                $count = $pdo->getRows("SELECT * FROM `tovar` WHERE `datatime` <= DATE_SUB(CURRENT_DATE, INTERVAL ? DAY)",[$interval_day]);
                foreach ($count as $valuta){$i++;}
                echo $i."шт добавлено более ".$interval_day." дней назад";
                ?>
            </a></li>
      </ul>
      </li>   
      <li><a href="prihod.php"><i class="icon-smile icon-xlarge"></i><span>Приходы</span></a></li>
      <li><a href="rashod.php"><i class="icon-frown icon-xlarge"></i><span>Расходы</span></a></li>


      <li class="dropdown-submenu">
        <a href="#"><i class="icon-folder-open icon-xlarge"></i><span>Справочники</span></a>
        <ul class="dropdown-menu">
          <li><a href="status.php"><i class="icon-credit-card"></i>Статусы (Заказы)</a></li>
          <li><a href="status_pr.php"><i class="icon-plus"></i>Статусы (+Приходы)</a></li>
          <li><a href="status_rs.php"><i class="icon-minus"></i>Статусы (-Расходы)</a></li>
          <li><a href="dostavka.php"><i class="icon-plane"></i>Службы доставки</a></li>
          <li><a href="potavshiki.php"><i class="icon-globe"></i>Поставщики</a></li>
          <li><a href="money.php"><i class="icon-money"></i>Валюта</a></li>
        </ul>
      </li>

      <li><a href="score.php"><i class="icon-dollar icon-xlarge"></i><span>Итого</span></a></li>

    <li class="dropdown-submenu">
        <a href="#"><i class="icon-bar-chart icon-xlarge"></i><span>Аналитика</span></a>
        <ul class="dropdown-menu">
            <li><a href="statistic_tovar.php"><i class="icon-gift"></i>Просмотренные товары</a></li>
            <li><a href="statistic_categor.php"><i class="icon-code-fork"></i>Просмотренные категории</a></li>
            <li><a href="statistic_incoming.php"><i class="icon-globe"></i>Посещений всего</a></li>
        </ul>
    </li>
<?php } ?>

