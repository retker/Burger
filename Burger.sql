-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 29 2018 г., 01:58
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Burger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(10) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `block` varchar(255) DEFAULT NULL,
  `apartment` int(4) UNSIGNED DEFAULT NULL,
  `floor` int(3) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `callback` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `userid`, `street`, `building`, `block`, `apartment`, `floor`, `comment`, `payment`, `callback`) VALUES
(1, 1, 'tytyla', '10', '2', 12, 4, 'burger beef', 0, 1),
(2, 2, 'tytyla', '34', '', 0, 0, 'burger beef', 0, 1),
(3, 2, 'tytyla', '34', '', 0, 0, 'burger beef', 0, 1),
(4, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(5, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(6, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(7, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(8, 3, '', '12', '', 1, 1, 'beef burger - 500', 1, 0),
(9, 3, '', '12', '', 1, 1, 'beef burger - 500', 1, 0),
(10, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 1),
(11, 3, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(12, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 1),
(13, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(14, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 0),
(15, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 1),
(16, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 1),
(17, 4, '', '12', '', 1, 1, 'beef burger - 500', 0, 1),
(18, 4, '', '12', '', 1, 1, 'beef burger - 500', 1, 1),
(19, 4, '', '12', '', 1, 1, 'beef burger - 500', 1, 1),
(20, 4, '', '12', '', 1, 1, 'beef burger - 500', 1, 1),
(21, 4, '', '12', '', 1, 1, 'beef burger - 500', 1, 1),
(22, 4, '', '12', '', 1, 1, 'beef burger - 500', 1, 1),
(23, 5, '', '1', '', 2, 1, 'beef', 0, 1),
(24, 5, '', '1', '', 2, 1, 'beef', 1, 1),
(25, 5, '', '1', '', 2, 1, 'beef', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`) VALUES
(1, 'evgenii yakovlev', 'ev1@ya.ru', '+7 (999) 999 99 99'),
(2, 'dima yakovlev', 'di1@ya.ru', '+7 (999) 888 88 88'),
(3, 'egor yakovlev', 'dm21@ya.ru', '+7 (777) 777 77 77'),
(4, 'ee yakovlev', '2211@ya.ru', '+7 (777) 777 77 77'),
(5, 'rryakovlev', 'rr@ya.ru', '+7 (766) 767 67 67');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
