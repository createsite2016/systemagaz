<? echo '<br><br>мастер настройки базы данных<br><br><br>====================================<br>';

// Подключаемся к базе данных, указывая параметры базы данных,
// имя пользователя и пароль.

// $charset = 'UTF8';
// $db = 'test_bd';
// $host = 'localhost';

$charset = 'UTF8';


if (empty($_POST['db']) and empty($_POST['localhost']) and empty($_POST['password'])) {
    $db_name = "torpix";
    $host = "localhost";
    $user = "root";
    $password = "root";
} else {
    $db_name = $_POST['db'];
    $host = $_POST['localhost'];
    $user = $_POST['login'];
$password = $_POST['password'];
}


// Create connection
$conn = new mysqli($host, $user, $password);
// Check connection
if ($conn->connect_error) {
    die("Ошибка соединения с БД, не верный логин или пароль, возможно и хост");
}
// Create database
$sql = 'CREATE DATABASE IF NOT EXISTS '.$db_name.' CHARSET = '.$charset;
if ($conn->query($sql) === TRUE) {
    echo "База данных успешно созданна";
} else {
    echo "<font color='red'>Не удалось создать БД: <br>" . $conn->error."</font>";
}
$conn->close();




$dataSource = "mysql:dbname={$db_name};host={$host};charset={$charset}"; // тип СУБД, хост сервера и имя базы данных
$db = new PDO($dataSource, $user, $password); // Подключаемся к базе данных


// Добавляем в таблицу users записи
$db->exec("CREATE TABLE IF NOT EXISTS `categor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` varchar(55) NOT NULL DEFAULT '' COMMENT 'Сортировка вывода на ветрине'
) ENGINE=InnoDB DEFAULT CHARSET=$charset;");
echo '<font color="green"><br>Успешно мигрированна таблица categor<br>';

$db->exec("CREATE TABLE `dostavka` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица dostavka<br>';

$db->exec("INSERT INTO `dostavka` (`id`, `name`, `komment`) VALUES
(3, 'Самовывоз', ''),
(4, 'Почта России', '') CHARSET=$charset;");
echo 'Заполнена основными данными таблица dostavka<br>';

$db->exec("CREATE TABLE `in_way` (
  `id` int(11) NOT NULL,
  `datatime` varchar(255) NOT NULL,
  `tovar` varchar(255) NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `ttn` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `magazin` varchar(255) NOT NULL,
  `menedger` varchar(255) NOT NULL,
  `prodavec` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=$charset COMMENT='Все товары которые в пути';");
echo 'Успешно мигрированна таблица in_way<br>';


$db->exec("CREATE TABLE `klient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя клиента',
  `phone` varchar(55) NOT NULL DEFAULT '' COMMENT 'Номер телефона клиента(он же логин от ЛК)',
  `password` varchar(55) NOT NULL DEFAULT '' COMMENT 'Пароль клиента от личного кабинет',
  `adress` varchar(255) NOT NULL DEFAULT '' COMMENT 'Адрес клиента'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица klient<br>';

$db->exec("CREATE TABLE `log_priem` (
  `id` int(11) NOT NULL,
  `id_zakaz` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `meneger` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `fio` varchar(25) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `dostavka` varchar(255) NOT NULL,
  `store` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица log_priem<br>';

$db->exec("CREATE TABLE `log_prihod` (
  `id` int(11) NOT NULL,
  `id_tovara` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `meneger` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица log_prihod<br>';

$db->exec("CREATE TABLE `log_rashod` (
  `id` int(11) NOT NULL,
  `id_tovara` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `prifut` varchar(255) NOT NULL,
  `nakladnaya` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `magazin` varchar(255) NOT NULL,
  `menedger` varchar(255) NOT NULL,
  `prodavec` varchar(255) NOT NULL,
  `nalogka` varchar(255) NOT NULL,
  `valuta` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица log_rashod<br>';

$db->exec("CREATE TABLE `magazins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `reklama` varchar(11) NOT NULL DEFAULT '' COMMENT 'Вывод рекламы',
  `id_ok_group` varchar(55) NOT NULL DEFAULT '' COMMENT 'ID группы в ОК',
  `id_ok_page` varchar(55) NOT NULL DEFAULT '' COMMENT 'ID страницы в ОК',
  `instagram_login` varchar(55) NOT NULL DEFAULT '' COMMENT 'Логин в инстграмме',
  `instagram_password` varchar(55) NOT NULL DEFAULT '' COMMENT 'Пароль для инстаграмма',
  `smslogin` varchar(55) NOT NULL DEFAULT '' COMMENT 'Логин для смс отправки',
  `smspassword` varchar(55) NOT NULL DEFAULT '' COMMENT 'Пароль для смс отправки',
  `smsid` varchar(55) NOT NULL DEFAULT '' COMMENT 'айди устройства',
  `smsnumber` varchar(55) NOT NULL DEFAULT '' COMMENT 'Номер на который будет приходить смс',
  `chatbroscript` LONGTEXT NOT NULL DEFAULT '' COMMENT 'скрипт для чата',
  `redconnectscript` LONGTEXT NOT NULL DEFAULT '' COMMENT 'скрипт для обратного звонка',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'Вечный токен',
  `private_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Секретный ключ приложения',
  `public_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Публичный ключ приложения',
  `time_day` varchar(255) DEFAULT NULL COMMENT 'Время через которое помечается товар',
  `keywords` varchar(255) NOT NULL COMMENT 'Ключевые слова',
  `description` varchar(55) NOT NULL COMMENT 'Описание',
  `title` varchar(255) NOT NULL COMMENT 'Тайт, заголовок страницы',
  `city` varchar(255) DEFAULT NULL COMMENT 'Название города',
  `theme` varchar(55) DEFAULT NULL COMMENT 'Тема магазина',
  `vklink` varchar(255) DEFAULT NULL COMMENT 'Ссылка на профиль ВК',
  `facebooklink` varchar(255) DEFAULT NULL COMMENT 'Ссылка на профиль Фэйсбук'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица magazins<br>';

$db->exec("CREATE TABLE `money` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
");
echo 'Успешно мигрированна таблица money<br>';

$db->exec("INSERT INTO `money` (`id`, `name`, `chena`, `komment`) VALUES
(6, 'Доллар', '50', ''),
(7, 'Евро', '70', ''),
(10, 'Рубль', '1', '');");
echo 'Успешно money заполнена данными<br>';

$db->exec("CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название страницы',
  `about` varchar(255) NOT NULL DEFAULT '' COMMENT 'Описание страницы',
  `datapage` longtext NOT NULL COMMENT 'Содержание страницы'
) ENGINE=InnoDB DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица pages<br>';

$db->exec("CREATE TABLE `postavshiki` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица postavshiki<br>';

$db->exec("CREATE TABLE `priem` (
  `id` int(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL COMMENT 'фио',
  `adress` varchar(255) NOT NULL COMMENT 'адрес-содержание',
  `user_name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL DEFAULT '' COMMENT 'Комментарий к заказу',
  `datatime` datetime NOT NULL COMMENT 'дата приема',
  `rem_datatime` datetime DEFAULT NULL COMMENT 'дата ремонта',
  `status` varchar(255) NOT NULL DEFAULT 'Новый заказ' COMMENT 'статус',
  `sklad` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '1',
  `dostavka` varchar(255) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL,
  `kolvo` varchar(255) NOT NULL DEFAULT '' COMMENT 'количество',
  `tovar` varchar(255) NOT NULL DEFAULT '' COMMENT 'ключ товара'
) ENGINE=InnoDB DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица priem<br>';

$db->exec("CREATE TABLE `prihod` (
  `id` int(11) NOT NULL,
  `datatime` datetime NOT NULL,
  `uah` varchar(255) NOT NULL,
  `usd` varchar(255) NOT NULL,
  `eur` varchar(255) NOT NULL,
  `cash1` varchar(255) NOT NULL,
  `cash2` varchar(255) NOT NULL,
  `cash3` varchar(255) NOT NULL,
  `cash4` varchar(255) NOT NULL,
  `cash5` varchar(255) NOT NULL,
  `cash6` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `statya` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=$charset;

-- --------------------------------------------------------

--
-- Table structure for table `rashod`
--

CREATE TABLE `rashod` (
  `id` int(11) NOT NULL,
  `datatime` datetime NOT NULL,
  `uah` varchar(255) NOT NULL,
  `usd` varchar(255) NOT NULL,
  `eur` varchar(255) NOT NULL,
  `cash1` varchar(255) NOT NULL,
  `cash2` varchar(255) NOT NULL,
  `cash3` varchar(255) NOT NULL,
  `cash4` varchar(255) NOT NULL,
  `cash5` varchar(255) NOT NULL,
  `cash6` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `statya` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=$charset;

-- --------------------------------------------------------

--
-- Table structure for table `statistic`
--

CREATE TABLE `statistic` (
  `id` int(11) unsigned NOT NULL,
  `id_statistic` varchar(255) NOT NULL DEFAULT '' COMMENT 'айдишник статистики',
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL DEFAULT '1' COMMENT 'количество просмотров',
  `caption` varchar(255) NOT NULL DEFAULT '' COMMENT 'вид статистики',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT 'ip адрес'
) ENGINE=MyISAM AUTO_INCREMENT=7975 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированны таблицы prihod, rashod и statistic<br>';

$db->exec("CREATE TABLE `status` (
`id` int(11) NOT NULL COMMENT 'Ключ',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя статуса',
  `color` varchar(255) NOT NULL DEFAULT '' COMMENT 'Цвет',
  `name_color` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя цвета',
  `komment` varchar(255) NOT NULL DEFAULT '' COMMENT 'Комментарий',
  `sort` varchar(255) NOT NULL DEFAULT '' COMMENT 'Сортировка'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица status<br>';

$db->exec("CREATE TABLE `status_pr` (
  `id` int(11) NOT NULL COMMENT 'Ключ',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя прихода',
  `komment` varchar(255) NOT NULL DEFAULT '' COMMENT 'Комментарий'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица status_pr<br>';

$db->exec("CREATE TABLE `status_rs` (
  `id` int(11) NOT NULL COMMENT 'Ключ',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя расхода',
  `komment` varchar(255) NOT NULL DEFAULT '' COMMENT 'Комментарий'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица status_rs<br>';


$db->exec("CREATE TABLE `zayavki` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ключ',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя заказчика',
  `phone` varchar(255) NOT NULL DEFAULT '' COMMENT 'Телефон заказчика',
  `tema` varchar(255) NOT NULL DEFAULT '' COMMENT 'Тема обращения',
  `obrashenie` varchar(255) NOT NULL DEFAULT '' COMMENT 'Текст обращения',
  `datatime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица zayavki<br>';


$db->exec("CREATE TABLE `tovar` (
  `id` int(11) NOT NULL,
  `categor_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ключ категории',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя категории',
  `model` varchar(255) NOT NULL DEFAULT '' COMMENT 'Страна производитель',
  `chena_input` varchar(255) NOT NULL DEFAULT '' COMMENT 'Цена закупки',
  `chena_output` varchar(255) NOT NULL DEFAULT '' COMMENT 'Цена продажи',
  `money_input` varchar(255) NOT NULL DEFAULT '' COMMENT '-Неиспользуется',
  `money_output` varchar(255) NOT NULL DEFAULT '' COMMENT '-Неиспользуется',
  `komment` varchar(255) NOT NULL DEFAULT '' COMMENT 'Описание',
  `status` varchar(255) NOT NULL DEFAULT '' COMMENT 'Витрина',
  `datatime` datetime NOT NULL COMMENT 'Дата добавления товара',
  `kolvo` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Количество товара',
  `user_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Пользователь который добавил товар',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'Картинка товара',
  `article` varchar(255) NOT NULL DEFAULT '' COMMENT 'Артикул к товару',
  `new` varchar(255) NOT NULL DEFAULT '' COMMENT 'Новинка',
  `skidka` varchar(255) NOT NULL DEFAULT '' COMMENT 'Процент скидки',
  `firma` varchar(255) NOT NULL DEFAULT '' COMMENT 'Фирма изготовитель',
  `razmer` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Размер',
  `ves` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Вес',
  `obem` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Объем',
  `dlina` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Длина',
  `material` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Материал',
  `color` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Цвет',
  `garant` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Гарантия',
  `complect` varchar(255) NOT NULL DEFAULT '' COMMENT 'Свойство - Комплектация',
  `shows` varchar(255) NOT NULL DEFAULT '' COMMENT 'Количество показов'
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица tovar<br>';

$db->exec("CREATE TABLE `users_8897532` (
  `id` int(11) NOT NULL COMMENT 'Ключ',
  `login` varchar(255) NOT NULL DEFAULT '' COMMENT 'Логин',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT 'Пароль',
  `role` varchar(255) NOT NULL DEFAULT '' COMMENT 'Роль',
  `profes` varchar(255) NOT NULL DEFAULT '' COMMENT 'Профессия',
  `inn` varchar(55) NOT NULL DEFAULT '' COMMENT 'ИНН',
  `ogrn` varchar(55) NOT NULL DEFAULT '' COMMENT 'ОГРН',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT 'Аватарка',
  `phone` varchar(55) NOT NULL DEFAULT '' COMMENT 'Номер телефона'
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица users_8897532<br>';

$db->exec("INSERT INTO `status` (`id`, `name`, `color`, `name_color`, `komment`, `sort`) VALUES
(1, 'Новый заказ', '#FFFFFF', 'Без цвета', 'Этот статус не удалять!!!', '0');");
$db->exec("INSERT INTO `status` (`id`, `name`, `color`, `name_color`, `komment`, `sort`) VALUES
(2, 'Заказ закрыт', '#FFFFFF', 'Без цвета', 'Этот статус не удалять!!!', '0');");
echo '<font color="red"></font><br>';

$db->exec("INSERT INTO `users_8897532` (`id`, `login`, `name`, `password`, `role`, `profes`, `inn`, `ogrn`, `phone`) VALUES
(1, 'admin', 'Администратор', '123456', '3', 'Директор', '2437286324', '2874783246873', '9891234567');");
echo '</font><font color="red">Внесен пользователь логин: admin     пароль: 123456</font><br>';

$db->exec("-- Indexes for table `categor`
--
ALTER TABLE `categor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dostavka`
--
ALTER TABLE `dostavka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_way`
--
ALTER TABLE `in_way`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_priem`
--
ALTER TABLE `log_priem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_prihod`
--
ALTER TABLE `log_prihod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_rashod`
--
ALTER TABLE `log_rashod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazins`
--
ALTER TABLE `magazins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postavshiki`
--
ALTER TABLE `postavshiki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priem`
--
ALTER TABLE `priem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prihod`
--
ALTER TABLE `prihod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rashod`
--
ALTER TABLE `rashod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pr`
--
ALTER TABLE `status_pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_rs`
--
ALTER TABLE `status_rs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_8897532`
--
ALTER TABLE `users_8897532`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categor`
--
ALTER TABLE `categor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dostavka`
--
ALTER TABLE `dostavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `in_way`
--
ALTER TABLE `in_way`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `log_priem`
--
ALTER TABLE `log_priem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `log_prihod`
--
ALTER TABLE `log_prihod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `log_rashod`
--
ALTER TABLE `log_rashod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `magazins`
--
ALTER TABLE `magazins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `postavshiki`
--
ALTER TABLE `postavshiki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `priem`
--
ALTER TABLE `priem`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prihod`
--
ALTER TABLE `prihod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rashod`
--
ALTER TABLE `rashod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ключ',AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `status_pr`
--
ALTER TABLE `status_pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ключ',AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `status_rs`
--
ALTER TABLE `status_rs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ключ',AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `tovar`
--
ALTER TABLE `tovar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users_8897532`
--
ALTER TABLE `users_8897532`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ключ',AUTO_INCREMENT=1;");
echo 'Установленны ключи ко всем таблицам и автоинкремент<br>';



// Открыть текстовый файл
$filename = 'classes/Database.php';

$text = '<?php

class Database{
    public $isConn;
    protected $datab;
    static $username, $password, $host, $dbname;



    // Соединение с БД
        public function __construct($username="'.$_POST['login'].'", $password="'.$_POST['password'].'", $host="'.$_POST['localhost'].'", $dbname="'.$_POST['db'].'", $options = []){
        //public function __construct($username="ce72683_magaz", $password="UC7dQbZC", $host="localhost", $dbname="ce72683_magaz", $options = []){
            $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            ?>
            <!DOCTYPE html>
            <html lang="ru">
            <head>
                <meta charset="utf-8">
                <title>Система управления интернет торговлей</title>
                <meta name="" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link rel="shortcut icon" href="/../../icon.ico" type="image/x-icon">
                <link rel="stylesheet" href="/../admin/css/bootstrap.css">
                <link rel="stylesheet" href="/../admin/css/font-awesome.min.css">
                <link rel="stylesheet" href="/../admin/css/font.css">
                <link rel="stylesheet" href="/../admin/js/select2/select2.css">
                <link rel="stylesheet" href="/../admin/css/style.css">
                <link rel="stylesheet" href="/../admin/css/plugin.css">
                <link rel="stylesheet" href="/../admin/css/landing.css">
<br><br><br><br><center><strong>Не удалось подключиться к БД, проверьте параметры соединения</strong></center>
            <br>
            <br>
            <br>
            <br>



            <section class="panel">
                <header class="panel-heading text-center">
                    Подключение
                </header>
                <form action="/admin/install_db.php" class="panel-body" method="POST">

                    <div class="block">
                        <label class="control-label">}{ост</label>
                        <input type="text" placeholder="ваш логин" name="localhost" value="localhost" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">БД</label>
                        <input type="text" placeholder="ваш логин" name="db" value="" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">Логин</label>
                        <input type="text" placeholder="ваш логин" name="login" value="" autocomplete="on" class="form-control">
                    </div>

                    <div class="block">
                        <label class="control-label">Пароль</label>
                        <input type="password" id="inputPassword" placeholder="ваш пароль" value="" autocomplete="on" name="password" class="form-control">
                    </div>


                    </div>
                    <center>
                        <button type="submit" class="btn btn-info"><i class="icon-signin"></i> Подключить</button>
                    </center>
                </form>
            </section>
            <?
            exit;
        }

    }


    // отключение от бд
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }
    // получить данные
    public function getRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // получить массив данных
    public function getRows($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // вставить данные
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // обновить данные
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // удалить данные
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // получить последний добавленный ID
    public function lastInsertId($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            $stmt = $this->datab->lastInsertId($query);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }



}

?>';

// Открываем файл, флаг W означает - файл открыт на запись
$f_hdl = fopen($filename, 'w');

// Записываем в файл $text
fwrite($f_hdl, $text);

// Закрывает открытый файл
fclose($f_hdl);

exit("<html><head><meta http-equiv='Refresh' content='5; URL=magazins.php'></head><body>Запускается основной блок программы..</body></html>");










