<?php
ini_set("session.gc_maxlifetime",99999) ; // устанавливаем время сессии
session_start(); // вкл сессию

//include_once "classes/Database.php"; // подключаем БД
include_once "classes/App.php"; // подключаем функции приложения

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} } //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести

$App = new App();
$login = $App->Clear($login); // передаем Логин на зачистку
$password = $App->Clear($password); //передаем Пароль на зачистку

$db = new Database();
$check = $db->getRow("SELECT * FROM `users_8897532` WHERE `login` = ? AND `password` = ?", [$login,$password]);

if ( empty($check) ) {
    include_once "views/login/errorlogin.php"; // если результа выборки нет, выводим вьюху о неудаче
}
else {
    $_SESSION['login'] = $login; // записуем в сессию логин
    $_SESSION['id'] = $check['id']; // записуем в сессию айдишку
    $db->Disconnect(); // опустошаем объект БД
    $App->goWay('index'); // уходим на страницу index_old.php
}

?>