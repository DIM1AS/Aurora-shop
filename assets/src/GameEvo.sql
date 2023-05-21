-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2023 г., 11:33
-- Версия сервера: 5.7.20
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `GameEvo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`) VALUES
(4, 'HEARTS OF IRON IV: CADET EDITION', 'Возьмите победу в свои руки! Станьте величайшим главнокомандующим Второй мировой в Hearts of Iron IV. Лидерские качества и умение планировать действия — вот ваше главное оружие в этой кровожадной войне, оставившей огромное темное пятно в мировой истории.', '399.00', '../../assets/img/profile/Product_1/1.jpg'),
(5, 'SQUAD', 'Феноменальная реалистичность, насыщенный геймплей и первостепенное значение командной работы выделяют Squad из ряда других многопользовательских шутеров. Он представляет собой достоверную имитацию масштабных сражений.\r\n\r\n', '999.00', '../../assets/img/profile/Product_2/1.jpg'),
(6, 'BAROTRAUMA', 'Не столь далекое будущее. Мест для обитания становится катастрофически мало. Человечество отправилось на Европу, спутник Юпитера. На промерзшей поверхности небесного тела крайне суровые условия, поэтому люди сформировали небольшие зоны обитания в глубинах океана подо льдом. Но в океане они не одиноки.\r\n\r\n', '799.00', '../../assets/img/profile/Product_3/1.jpg'),
(7, 'HITMAN: ABSOLUTION', 'Последняя часть в серии Hitman стала эталонной. В Blood Money механика игры была доведена до абсолюта. Казалось, что выше прыгать некуда. Оказалось, что есть куда. Hitman: Absolution выводит серию на новый уровень.\r\n\r\n', '99.00', '../../assets/img/profile/Product_4/1.jpg'),
(8, 'DAYS GONE', 'Очередной эксклюзив от Sony оказался временным! Days Gone, постапокалиптический экшен в открытом мире, теперь доступен пользователям ПК. В нём игроку предстоит взять на себя роль Дикона Сент-Джона, сурового байкера и ветерана Афганистана, который пытается выжить в мире, пережившем ужасную пандемию.', '1199.00', '../../assets/img/profile/Product_5/1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(6, 'Дмитрий', 'dima.kostiasev@mail.ru', '$2y$10$u7U8EFzPb3fwQBQfrIXdPu2HE6ClAePL9eihPYwf.u2nASR3YDesy');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
