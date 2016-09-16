<?php
$login = $_SESSION['login'];
$sql222 = mysql_query("SELECT * FROM `users_8897532` WHERE `login`='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
$data222 = mysql_fetch_array($sql222);
$id_user = $data222['id'];


$sql_us = mysql_query("SELECT * FROM `users_8897532` WHERE `id`<>'$id_user' ",$db); //извлекаем из базы все данные о пользователе с введенным логином
$us_ids = mysql_fetch_array($sql_us);
 ?>
      <li><a href="index.php"><i class="icon-credit-card icon-xlarge"></i><span>Заказы</span></a></li>
      <li><a href="prihod.php"><i class="icon-smile icon-xlarge"></i><span>Приходы</span></a></li>
      <li><a href="rashod.php"><i class="icon-frown icon-xlarge"></i><span>Расходы</span></a></li>


      <li class="dropdown-submenu">
        <a href="#"><i class="icon-folder-open icon-xlarge"></i><span>Справочники</span></a>
        <ul class="dropdown-menu">
          <li><a href="magazins.php"><i class="icon-shopping-cart"></i>Магазины</a></li>
          <li><a href="status.php"><i class="icon-credit-card"></i>Статусы (Заказы)</a></li>
          <li><a href="status_pr.php"><i class="icon-plus"></i>Статусы (+Приходы)</a></li>
          <li><a href="status_rs.php"><i class="icon-minus"></i>Статусы (-Расходы)</a></li>
          <li><a href="dostavka.php"><i class="icon-plane"></i>Службы доставки</a></li>
          <li><a href="potavshiki.php"><i class="icon-truck"></i>Поставщики</a></li>
        </ul>
      </li>

      <!--<li><a href="buy.php"><i class=" icon-money icon-xlarge"></i><span>Продажа</span></a></li>
      <li><a href="mail.php?id=<?php echo $us_ids['id']?>"><i class="icon-envelope-alt icon-xlarge"></i><span>Сообщения</span></a></li>
      <li><a href="chat.php"><i class="icon-group icon-xlarge"></i><span>Чат</span></a></li> -->
