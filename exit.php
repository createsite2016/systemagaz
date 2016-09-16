<?php
session_start();
unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);
setcookie("auto", "", time()+9999999);
exit("<html><head><meta http-equiv='Refresh' content='0; URL=index.php'></head></html>");
?>