-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Дек 19 2016 г., 11:06
-- Версия сервера: 5.5.42
-- Версия PHP: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `systemagaz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categor`
--

CREATE TABLE `categor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `dostavka`
--

CREATE TABLE `dostavka` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dostavka`
--

INSERT INTO `dostavka` (`id`, `name`, `komment`) VALUES
(3, 'Служба 1', ''),
(4, 'Новая почта', ''),
(5, 'Курьерская служба "Черепаха"', '');

-- --------------------------------------------------------

--
-- Структура таблицы `in_way`
--

CREATE TABLE `in_way` (
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='Все товары которые в пути';

-- --------------------------------------------------------

--
-- Структура таблицы `log_priem`
--

CREATE TABLE `log_priem` (
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
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `log_prihod`
--

CREATE TABLE `log_prihod` (
  `id` int(11) NOT NULL,
  `id_tovara` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `meneger` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `log_rashod`
--

CREATE TABLE `log_rashod` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `magazins`
--

CREATE TABLE `magazins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `magazins`
--

INSERT INTO `magazins` (`id`, `name`, `komment`) VALUES
(8, 'Магазин 1', 'Полное название "Магазин 1"'),
(9, 'Магазин 2', 'Полное название "Магазин 2"');

-- --------------------------------------------------------

--
-- Структура таблицы `money`
--

CREATE TABLE `money` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `money`
--

INSERT INTO `money` (`id`, `name`, `chena`, `komment`) VALUES
(6, 'Доллар', '67', ''),
(7, 'Евро', '70', ''),
(10, 'Рубли', '67', 'На сентябрь');

-- --------------------------------------------------------

--
-- Структура таблицы `postavshiki`
--

CREATE TABLE `postavshiki` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `postavshiki`
--

INSERT INTO `postavshiki` (`id`, `name`, `komment`) VALUES
(5, 'Склад', ''),
(6, 'Булат', ''),
(7, 'Полтава навеска', ''),
(8, 'AliExpress', 'Из интернета');

-- --------------------------------------------------------

--
-- Структура таблицы `priem`
--

CREATE TABLE `priem` (
  `id` int(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL COMMENT 'фио',
  `adress` varchar(255) NOT NULL COMMENT 'адрес-содержание',
  `user_name` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL COMMENT 'дата приема',
  `rem_datatime` datetime DEFAULT NULL COMMENT 'дата ремонта',
  `status` varchar(255) NOT NULL COMMENT 'статус',
  `tovar` varchar(255) NOT NULL COMMENT 'товар',
  `sklad` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `dostavka` varchar(255) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `prihod`
--

CREATE TABLE `prihod` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rashod`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `name_color` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`, `color`, `name_color`, `komment`, `sort`) VALUES
(28, 'Обработан', '#FFFFFF', 'Без цвета', '', '1'),
(29, 'Закрыт', '#45B5B3', 'Синий', '', '9'),
(30, 'Отправлен', '#45B562', 'Зеленый', '', '2'),
(31, 'Добавлен', '#E7D627', 'Желтый', '', '0'),
(32, 'Ремонт', '#CC3E43', 'Красный', '', '4'),
(33, 'Поставщик', '#CCC9CF', 'Серый', '', '5'),
(34, 'Оранжевый', '#FF7400', 'Оранжевый', '', '6'),
(36, 'Салатовый', '#CDEB8B', 'Салатовый', '', '8'),
(38, 'Розовый', '#FF0096', 'Розовый', '', '7');

-- --------------------------------------------------------

--
-- Структура таблицы `status_pr`
--

CREATE TABLE `status_pr` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status_pr`
--

INSERT INTO `status_pr` (`id`, `name`, `komment`) VALUES
(4, 'Покупка', ''),
(5, 'Возврат НП', ''),
(6, 'Возврат Интайм', '');

-- --------------------------------------------------------

--
-- Структура таблицы `status_rs`
--

CREATE TABLE `status_rs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status_rs`
--

INSERT INTO `status_rs` (`id`, `name`, `komment`) VALUES
(6, 'Закупка', ''),
(7, 'ГСМ', ''),
(8, 'Зарплата', ''),
(9, 'Связь', ''),
(10, 'Сайты', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE `tovar` (
  `id` int(11) NOT NULL,
  `categor_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `chena_input` varchar(255) NOT NULL,
  `chena_output` varchar(255) NOT NULL,
  `money_input` varchar(255) NOT NULL,
  `money_output` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_8897532`
--

CREATE TABLE `users_8897532` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profes` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_8897532`
--

INSERT INTO `users_8897532` (`id`, `login`, `name`, `password`, `role`, `profes`) VALUES
(153, 'admin', 'Андрей', '123456', '3', 'Менеджер'),
(156, 'vladimir', 'Владимир', '123456', '3', 'Директор');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categor`
--
ALTER TABLE `categor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dostavka`
--
ALTER TABLE `dostavka`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `in_way`
--
ALTER TABLE `in_way`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `log_priem`
--
ALTER TABLE `log_priem`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `log_prihod`
--
ALTER TABLE `log_prihod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `log_rashod`
--
ALTER TABLE `log_rashod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `magazins`
--
ALTER TABLE `magazins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `postavshiki`
--
ALTER TABLE `postavshiki`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `priem`
--
ALTER TABLE `priem`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prihod`
--
ALTER TABLE `prihod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rashod`
--
ALTER TABLE `rashod`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status_pr`
--
ALTER TABLE `status_pr`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status_rs`
--
ALTER TABLE `status_rs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_8897532`
--
ALTER TABLE `users_8897532`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categor`
--
ALTER TABLE `categor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `dostavka`
--
ALTER TABLE `dostavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `in_way`
--
ALTER TABLE `in_way`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `log_priem`
--
ALTER TABLE `log_priem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT для таблицы `log_prihod`
--
ALTER TABLE `log_prihod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `log_rashod`
--
ALTER TABLE `log_rashod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `magazins`
--
ALTER TABLE `magazins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `postavshiki`
--
ALTER TABLE `postavshiki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `priem`
--
ALTER TABLE `priem`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=509;
--
-- AUTO_INCREMENT для таблицы `prihod`
--
ALTER TABLE `prihod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `rashod`
--
ALTER TABLE `rashod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `status_pr`
--
ALTER TABLE `status_pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `status_rs`
--
ALTER TABLE `status_rs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `tovar`
--
ALTER TABLE `tovar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_8897532`
--
ALTER TABLE `users_8897532`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=160;