-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 27 2015 г., 15:52
-- Версия сервера: 5.6.25
-- Версия PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kvazar_genealog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cemeteries`
--

CREATE TABLE IF NOT EXISTS `cemeteries` (
  `id` int(10) unsigned NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(10) unsigned NOT NULL,
  `husband_id` int(10) unsigned NOT NULL,
  `wife_id` int(10) unsigned NOT NULL,
  `mdate` date DEFAULT NULL,
  `descr` mediumtext NOT NULL COMMENT 'Примечания к семье',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=821 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `log` text NOT NULL,
  `date_field` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1969 DEFAULT CHARSET=utf8;


--
-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `ID` mediumint(9) NOT NULL,
  `from` mediumint(9) DEFAULT NULL,
  `to` mediumint(9) DEFAULT NULL,
  `subj` varchar(100) DEFAULT NULL,
  `message` mediumtext,
  `checked` tinyint(1) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `descr` mediumtext,
  `relative_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=533 DEFAULT CHARSET=utf8;


--
-- Структура таблицы `relatives`
--

CREATE TABLE IF NOT EXISTS `relatives` (
  `id` int(10) unsigned NOT NULL,
  `index` varchar(40) NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `bday` int(2) DEFAULT NULL,
  `bmonth` varchar(2) DEFAULT NULL,
  `byear` varchar(4) DEFAULT NULL,
  `mother_id` int(10) unsigned DEFAULT NULL,
  `father_id` int(10) unsigned DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `bplace` varchar(150) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `descr` varchar(3000) DEFAULT NULL,
  `second_sname` varchar(150) DEFAULT NULL,
  `ddate` date DEFAULT NULL,
  `dday` varchar(2) DEFAULT NULL,
  `dmonth` varchar(2) DEFAULT NULL,
  `dyear` varchar(4) DEFAULT NULL,
  `rod` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `last_change` date NOT NULL,
  `hidden` varchar(3000) DEFAULT NULL COMMENT 'скрытые комментарии',
  `show_pict` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'показывать фотографии или нет',
  `grave_lon` double DEFAULT NULL,
  `grave_lat` double DEFAULT NULL,
  `cemetery_id` int(10) unsigned DEFAULT NULL,
  `grave_picture` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3034 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(10) unsigned NOT NULL,
  `ip` varchar(30) NOT NULL,
  `search_string` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28256 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `social_networks`
--

CREATE TABLE IF NOT EXISTS `social_networks` (
  `id` tinyint(4) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `title` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `social_networks`
--

INSERT INTO `social_networks` (`id`, `name`, `img`, `title`) VALUES
(1, 'odnoklassniki', 'pics/icons/odnoklassniki.jpg', 'Одноклассники'),
(2, 'vkontakte', 'pics/icons/vkontakte.png', 'Вконтакте'),
(3, 'facebook', 'pics/icons/facebook.png', 'Facebook'),
(4, 'google+', 'pics/icons/googleplus.png', 'Google+'),
(5, 'mailru', 'pics/icons/moimir.png', 'Мой мир');

-- --------------------------------------------------------

--
-- Структура таблицы `social_networks_records`
--

CREATE TABLE IF NOT EXISTS `social_networks_records` (
  `id` int(11) NOT NULL,
  `network_id` tinyint(4) unsigned NOT NULL,
  `owner_id` int(10) unsigned NOT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` mediumint(9) NOT NULL,
  `index` varchar(40) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `fileUpload` tinyint(1) DEFAULT '0',
  `editRelative` tinyint(1) DEFAULT '0',
  `passwd` varchar(150) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `relative_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'active user in system: 0 - enabled, 1 - disabled',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `ID` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `dt` datetime NOT NULL,
  `user_id` mediumint(9) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1567 DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cemeteries`
--
ALTER TABLE `cemeteries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `husband_id` (`husband_id`),
  ADD KEY `wife_id` (`wife_id`);

--
-- Индексы таблицы `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `relatives`
--
ALTER TABLE `relatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cemetery_id` (`cemetery_id`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `father_id` (`father_id`);

--
-- Индексы таблицы `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_networks`
--
ALTER TABLE `social_networks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_networks_records`
--
ALTER TABLE `social_networks_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `network_id` (`network_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `relative_id` (`relative_id`);

--
-- Индексы таблицы `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cemeteries`
--
ALTER TABLE `cemeteries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT для таблицы `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `families`
--
ALTER TABLE `families`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=821;
--
-- AUTO_INCREMENT для таблицы `logins`
--
ALTER TABLE `logins`
  MODIFY `ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1969;
--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
  MODIFY `ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=533;
--
-- AUTO_INCREMENT для таблицы `relatives`
--
ALTER TABLE `relatives`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3034;
--
-- AUTO_INCREMENT для таблицы `search`
--
ALTER TABLE `search`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28256;
--
-- AUTO_INCREMENT для таблицы `social_networks`
--
ALTER TABLE `social_networks`
  MODIFY `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `social_networks_records`
--
ALTER TABLE `social_networks_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=353;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `users_login`
--
ALTER TABLE `users_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1567;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `social_networks_records`
--
ALTER TABLE `social_networks_records`
  ADD CONSTRAINT `social_networks_records_ibfk_1` FOREIGN KEY (`network_id`) REFERENCES `social_networks` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
