# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.5.42)
# Схема: systemagaz
# Время создания: 2016-12-19 08:06:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы categor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categor`;

CREATE TABLE `categor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы dostavka
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dostavka`;

CREATE TABLE `dostavka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dostavka` WRITE;
/*!40000 ALTER TABLE `dostavka` DISABLE KEYS */;

INSERT INTO `dostavka` (`id`, `name`, `komment`)
VALUES
	(3,'Служба 1',''),
	(4,'Новая почта',''),
	(5,'Курьерская служба \"Черепаха\"','');

/*!40000 ALTER TABLE `dostavka` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы in_way
# ------------------------------------------------------------

DROP TABLE IF EXISTS `in_way`;

CREATE TABLE `in_way` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datatime` varchar(255) NOT NULL,
  `tovar` varchar(255) NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `ttn` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `magazin` varchar(255) NOT NULL,
  `menedger` varchar(255) NOT NULL,
  `prodavec` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Все товары которые в пути';



# Дамп таблицы log_priem
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log_priem`;

CREATE TABLE `log_priem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `postavshik` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы log_prihod
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log_prihod`;

CREATE TABLE `log_prihod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tovara` varchar(255) NOT NULL,
  `datatime` datetime NOT NULL,
  `kolvo` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `postavshik` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `meneger` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы log_rashod
# ------------------------------------------------------------

DROP TABLE IF EXISTS `log_rashod`;

CREATE TABLE `log_rashod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `valuta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы magazins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `magazins`;

CREATE TABLE `magazins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `magazins` WRITE;
/*!40000 ALTER TABLE `magazins` DISABLE KEYS */;

INSERT INTO `magazins` (`id`, `name`, `komment`)
VALUES
	(8,'Магазин 1','Полное название \"Магазин 1\"'),
	(9,'Магазин 2','Полное название \"Магазин 2\"');

/*!40000 ALTER TABLE `magazins` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы money
# ------------------------------------------------------------

DROP TABLE IF EXISTS `money`;

CREATE TABLE `money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `chena` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `money` WRITE;
/*!40000 ALTER TABLE `money` DISABLE KEYS */;

INSERT INTO `money` (`id`, `name`, `chena`, `komment`)
VALUES
	(6,'Доллар','67',''),
	(7,'Евро','70',''),
	(10,'Рубли','67','На сентябрь');

/*!40000 ALTER TABLE `money` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы postavshiki
# ------------------------------------------------------------

DROP TABLE IF EXISTS `postavshiki`;

CREATE TABLE `postavshiki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `postavshiki` WRITE;
/*!40000 ALTER TABLE `postavshiki` DISABLE KEYS */;

INSERT INTO `postavshiki` (`id`, `name`, `komment`)
VALUES
	(5,'Склад',''),
	(6,'Булат',''),
	(7,'Полтава навеска',''),
	(8,'AliExpress','Из интернета');

/*!40000 ALTER TABLE `postavshiki` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы priem
# ------------------------------------------------------------

DROP TABLE IF EXISTS `priem`;

CREATE TABLE `priem` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `postavshik` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы prihod
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prihod`;

CREATE TABLE `prihod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы rashod
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rashod`;

CREATE TABLE `rashod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `name_color` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `name`, `color`, `name_color`, `komment`, `sort`)
VALUES
	(28,'Обработан','#FFFFFF','Без цвета','','1'),
	(29,'Закрыт','#45B5B3','Синий','','9'),
	(30,'Отправлен','#45B562','Зеленый','','2'),
	(31,'Добавлен','#E7D627','Желтый','','0'),
	(32,'Ремонт','#CC3E43','Красный','','4'),
	(33,'Поставщик','#CCC9CF','Серый','','5'),
	(34,'Оранжевый','#FF7400','Оранжевый','','6'),
	(36,'Салатовый','#CDEB8B','Салатовый','','8'),
	(38,'Розовый','#FF0096','Розовый','','7');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы status_pr
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status_pr`;

CREATE TABLE `status_pr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status_pr` WRITE;
/*!40000 ALTER TABLE `status_pr` DISABLE KEYS */;

INSERT INTO `status_pr` (`id`, `name`, `komment`)
VALUES
	(4,'Покупка',''),
	(5,'Возврат НП',''),
	(6,'Возврат Интайм','');

/*!40000 ALTER TABLE `status_pr` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы status_rs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status_rs`;

CREATE TABLE `status_rs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status_rs` WRITE;
/*!40000 ALTER TABLE `status_rs` DISABLE KEYS */;

INSERT INTO `status_rs` (`id`, `name`, `komment`)
VALUES
	(6,'Закупка',''),
	(7,'ГСМ',''),
	(8,'Зарплата',''),
	(9,'Связь',''),
	(10,'Сайты','');

/*!40000 ALTER TABLE `status_rs` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы tovar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tovar`;

CREATE TABLE `tovar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `kolvo` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы users_8897532
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_8897532`;

CREATE TABLE `users_8897532` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profes` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_8897532` WRITE;
/*!40000 ALTER TABLE `users_8897532` DISABLE KEYS */;

INSERT INTO `users_8897532` (`id`, `login`, `name`, `password`, `role`, `profes`)
VALUES
	(153,'admin','Андрей','123456','3','Менеджер'),
	(156,'vladimir','Владимир','123456','3','Директор');

/*!40000 ALTER TABLE `users_8897532` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
