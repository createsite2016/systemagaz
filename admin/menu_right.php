<?php
if ($user_role == 3)
{
?>
          <li><a href="users.php"><i class="icon-group"></i> Управление сотрудниками</a></li>
          <li><a href="pages.php"><i class="icon-file"></i> Управление страницами сайта</a></li>
          <li class="divider"></li>
          <li><a href="exit.php"><i class="icon-off"></i> Выйти из админ панели</a></li>
<?php } ?>

<?php
if ($user_role == 1)
{
?>
          <li><a href="exit.php">Выйти</a></li>
<?php }
if ($_SESSION['login']<>$login)
{ ?>
   <li><a href="exit.php">Нажмите сюда (для синхранизации профиля)</a></li>
<?php
} ?>
