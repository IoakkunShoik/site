-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2019 г., 21:36
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `preview` text NOT NULL,
  `discription` text NOT NULL,
  `chars` text NOT NULL,
  `price` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `name`, `image`, `preview`, `discription`, `chars`, `price`, `date`) VALUES
(42, 's', '{\"0\":\"http://shop-art-jako.ru/article_files/1650.jpg\"}', 'http://shop-art-jako.ru/article_files/1650.jpgpreview.jpg', '1', '1', '2', '2019-12-05 15:17:22'),
(43, '1', '{\"0\":\"http://shop-art-jako.ru/article_files/1650.jpg\"}', 'http://shop-art-jako.ru/article_files/1650.jpgpreview.jpg', '1', '1', '1', '2019-12-05 15:19:32'),
(44, '2', '{\"0\":\"http://shop-art-jako.ru/article_files/41004-astronomicheskij_obekt-temnota-pejzazhi_gor-zakat-atmosfera-1920x1080.jpg\"}', 'http://shop-art-jako.ru/article_files/41004-astronomicheskij_obekt-temnota-pejzazhi_gor-zakat-atmosfera-1920x1080.jpgpreview.jpg', '2', '1', '2', '2019-12-05 15:20:11');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ids` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `ids`) VALUES
(1, 'Curtains', '{\r\n\"0\":[\"44\", \"45\"]\r\n}'),
(2, 'Curtains', '{\"0\":[\"44\", \"45\"]}');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `url`, `category`) VALUES
(14, '234', 'http://shop-art-jako.ru/article_files/snezhnyy_bars_morda_bolshaya_koshka_hischnik_65466_1920x1200.jpg', '234'),
(15, '234', 'http://shop-art-jako.ru/article_files/snezhnyy_bars_morda_bolshaya_koshka_hischnik_65466_1920x1200.jpg', '234');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nickName` varchar(15) NOT NULL,
  `inicials` text NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickName`, `inicials`, `password`) VALUES
(1, 'io1', '111', 111),
(2, 'io2', '222', 222);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
