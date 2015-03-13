-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 09 2015 г., 12:49
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shelegDA`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `showhide` enum('show','hide') NOT NULL DEFAULT 'show',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `showhide`) VALUES
(1, 'здесь название должно быть', 'show'),
(2, 'товары', 'show'),
(3, 'услуги', 'show');

-- --------------------------------------------------------

--
-- Структура таблицы `maintexts`
--

CREATE TABLE IF NOT EXISTS `maintexts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `body` text NOT NULL,
  `url` tinytext NOT NULL,
  `showhide` enum('show','hide') NOT NULL DEFAULT 'show',
  `lang` enum('ru','en') NOT NULL DEFAULT 'ru',
  `putdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `maintexts`
--

INSERT INTO `maintexts` (`id`, `name`, `body`, `url`, `showhide`, `lang`, `putdate`) VALUES
(1, 'Добро пожаловать на сайт!', 'сайт, который делается', 'index', 'show', 'ru', '2015-02-25'),
(2, 'Услуги', 'получение навыков php', 'services', 'show', 'ru', '2015-02-25'),
(3, 'портфолио', 'ученик', 'portfolio', 'show', 'ru', '2015-02-25'),
(4, 'Контакты', 'телефон\r\nemail', 'contacts', 'show', 'ru', '2015-02-25');

-- --------------------------------------------------------

--
-- Структура таблицы `system_accounts`
--

CREATE TABLE IF NOT EXISTS `system_accounts` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `pass` tinytext NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `system_accounts`
--

INSERT INTO `system_accounts` (`id_account`, `name`, `pass`) VALUES
(26, 'test', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Структура таблицы `tovars`
--

CREATE TABLE IF NOT EXISTS `tovars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `body` text NOT NULL,
  `price` tinytext NOT NULL,
  `cat_id` int(11) NOT NULL,
  `showhide` enum('show','hide') NOT NULL DEFAULT 'show',
  `vip` enum('1','2') NOT NULL DEFAULT '1',
  `picture` tinytext NOT NULL,
  `picturesmall` tinytext NOT NULL,
  `putdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `tovars`
--

INSERT INTO `tovars` (`id`, `name`, `body`, `price`, `cat_id`, `showhide`, `vip`, `picture`, `picturesmall`, `putdate`) VALUES
(1, 'уацуацу', 'ауцапцу', 'уцацуа', 1, 'show', '1', '', '', '2015-03-04'),
(2, '1212', '1312', '111111', 1, 'show', '1', '15_03_04_12_35_Tulips.jpg', 's_15_03_04_12_35_Tulips.jpg', '2015-03-04'),
(3, '123456', '7890', '1112', 2, 'show', '2', '15_03_04_12_37_Penguins.jpg', 's_15_03_04_12_37_Penguins.jpg', '2015-03-04'),
(4, '544', '51654', '14584', 1, 'show', '1', '15_03_04_12_41_bg.jpg', 's_15_03_04_12_41_bg.jpg', '2015-03-04'),
(5, 'Ghbdtn', 'еуые', '111111', 1, 'show', '1', '15_03_04_12_42_Penguins.jpg', 's_15_03_04_12_42_Penguins.jpg', '2015-03-04'),
(6, 'Ghbdtn', 'еуые', '111111', 1, 'show', '1', '15_03_04_12_44_Penguins.jpg', 's_15_03_04_12_44_Penguins.jpg', '2015-03-04'),
(7, 'некн', 'кнкн', 'кегнкек', 1, 'show', '1', '15_03_04_12_44_bg.jpg', 's_15_03_04_12_44_bg.jpg', '2015-03-04'),
(9, 'Телевизор ЖК', '<p><img alt="" src="http://shelegDA/media/upload/Desert.jpg" style="height:150px; width:200px" />телевизор</p>\r\n', '2222226', 1, 'show', '1', '', '', '2015-03-09'),
(10, 'castle', '<p>ancient</p>\r\n', '99999999999', 2, 'show', '1', '15_03_09_11_55_Lighthouse.jpg', 'S_15_03_09_11_55_Lighthouse.jpg', '2015-03-09'),
(11, '1423', '<p>1232131</p>\r\n', '222222222222222222222', 1, 'show', '1', '15_03_09_11_57_Penguins.jpg', 'S_15_03_09_11_57_Penguins.jpg', '2015-03-09'),
(12, '1111', '<p>415413541</p>\r\n', '5555555', 1, 'show', '1', '15_03_09_12_00_Jellyfish.jpg', 'S_15_03_09_12_00_Jellyfish.jpg', '2015-03-09'),
(13, 'dgsd', '<p>sdgdsgds</p>\r\n', '76868', 1, 'show', '1', '15_03_09_12_04_Koala - RieR', 'S_15_03_09_12_04_Koala - RieR', '2015-03-09'),
(14, 'тест', '<p>tewt</p>\r\n', '1000000 руб', 1, 'show', '1', '15_03_09_12_05_gg.jpg', 'S_15_03_09_12_05_gg.jpg', '2015-03-09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `putdate` date NOT NULL,
  `lastvisit` datetime NOT NULL,
  `blockunblock` enum('unblock','block') NOT NULL DEFAULT 'unblock',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `putdate`, `lastvisit`, `blockunblock`) VALUES
(1, '11111', '11111', '11111@11.ru', '2015-03-02', '2015-03-04 09:01:53', 'unblock');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
