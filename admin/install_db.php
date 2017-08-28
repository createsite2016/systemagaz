<? echo 'файл установки БД';

// Подключаемся к базе данных, указывая параметры базы данных,
// имя пользователя и пароль.

$charset = 'UTF8';
$db = 'test_bd';
$host = 'localhost';

$dataSource = "mysql:dbname={$db};host={$host};charset={$charset}"; // тип СУБД, хост сервера и имя базы данных
$user = 'root';
$password = 'root';
$db = new PDO($dataSource, $user, $password); // Подключаемся к базе данных

// Добавляем в таблицу users записи
$db->exec("CREATE TABLE `categor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` varchar(55) NOT NULL DEFAULT '' COMMENT 'Сортировка вывода на ветрине'
) ENGINE=InnoDB DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица categor<br>';

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
  `phone` varchar(55) NOT NULL DEFAULT '' COMMENT 'Номер телефона клиента',
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
  `instagram_login` varchar(55) NOT NULL DEFAULT '' COMMENT 'Логин в инстграмме',
  `instagram_password` varchar(55) NOT NULL DEFAULT '' COMMENT 'Пароль для инстаграмма',
  `token` varchar(255) NOT NULL DEFAULT '' COMMENT 'Вечный токен',
  `private_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Секретный ключ приложения',
  `public_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Публичный ключ приложения',
  `time_day` varchar(255) DEFAULT NULL COMMENT 'Время через которое помечается товар',
  `keywords` varchar(255) NOT NULL COMMENT 'Ключевые слова',
  `description` varchar(55) NOT NULL COMMENT 'Описание',
  `title` varchar(255) NOT NULL COMMENT 'Тайт, заголовок страницы',
  `city` varchar(255) DEFAULT NULL COMMENT 'Название города'
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=$charset;");
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
  `color` varchar(255) NOT NULL DEFAULT '31',
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=$charset;");
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
  `article` varchar(255) NOT NULL DEFAULT '' COMMENT 'Артикул к товару'
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
  `phone` varchar(55) NOT NULL DEFAULT '' COMMENT 'Номер телефона'
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=$charset;");
echo 'Успешно мигрированна таблица users_8897532<br>';

$db->exec("INSERT INTO `users_8897532` (`id`, `login`, `name`, `password`, `role`, `profes`, `inn`, `ogrn`, `phone`) VALUES
(1, 'admin', 'Андрей Галушко', '123456', '3', 'Директор', '2437286324', '2874783246873', '9891234567');");
echo '<font color="red">Внесен пользователь логин: admin     пароль: 123456</font><br>';

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










