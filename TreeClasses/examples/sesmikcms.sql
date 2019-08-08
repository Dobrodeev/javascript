-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 05 2019 г., 09:31
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sesmikcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `subdivisions`
--

CREATE TABLE `subdivisions` (
  `subdivision_id` bigint(20) NOT NULL,
  `subdivision_left` bigint(20) NOT NULL DEFAULT '0',
  `subdivision_right` bigint(20) NOT NULL DEFAULT '0',
  `subdivision_level` int(11) DEFAULT NULL,
  `subdivision_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subdivisions`
--

INSERT INTO `subdivisions` (`subdivision_id`, `subdivision_left`, `subdivision_right`, `subdivision_level`, `subdivision_name`) VALUES
(1, 1, 22, 0, 'Univer'),
(13, 2, 13, 1, 'Facultet 1'),
(14, 14, 19, 1, 'Facultet 2'),
(15, 3, 10, 2, 'Kafedra 1 1'),
(16, 11, 12, 2, 'Kafedra 1 2'),
(17, 15, 16, 2, 'Kafedra 2 1'),
(18, 17, 18, 2, 'Kafedra 2 2'),
(20, 6, 9, 3, 'Spec 1 1 2'),
(21, 7, 8, 4, 'Subject 1 1 2 1'),
(22, 20, 21, 1, 'Facultet 3'),
(23, 4, 5, 3, 'Spec 1 1 1');

-- --------------------------------------------------------

--
-- Структура таблицы `test_sections_seq`
--

CREATE TABLE `test_sections_seq` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test_sections_seq`
--

INSERT INTO `test_sections_seq` (`id`) VALUES
(12);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `subdivisions`
--
ALTER TABLE `subdivisions`
  ADD PRIMARY KEY (`subdivision_id`),
  ADD UNIQUE KEY `section_id` (`subdivision_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `subdivisions`
--
ALTER TABLE `subdivisions`
  MODIFY `subdivision_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
