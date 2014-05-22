-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 23 Maj 2014, 00:35
-- Wersja serwera: 5.5.21-log
-- Wersja PHP: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `stucku`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `excerpt` text COLLATE utf8_polish_ci NOT NULL,
  `author` text COLLATE utf8_polish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_pub` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `excerpt`, `author`, `date`, `date_pub`) VALUES
(16, 'Kod ÅºrÃ³dÅ‚owy', '<p><a href="https://github.com/karlosos/StuckU">https://github.com/karlosos/StuckU</a>&nbsp;Tutaj znajduje sie kod Åºr&oacute;dÅ‚owy tej strony.&nbsp;</p>', '', 'karlosos', '2014-04-24 19:36:37', '0000-00-00'),
(17, 'Czemu kod moÅ¼e wydawaÄ‡ siÄ™ chaotyczny?', '<p>Projekt ten wykonaÅ‚em w 3 dni (p&oacute;Åºno siÄ™ zorientowaÅ‚em Å¼e termin ucieka) dlatego nie miaÅ‚em czasu na przemyÅ›lanie pewnych spraw. Poprzedni projekt (praktycznie ta sama funkcjonalnoÅ›Ä‡)&nbsp;<a href="https://github.com/karlosos/SharU">https://github.com/karlosos/SharU</a>&nbsp;ten projekt ma lepiej zorganizowane foldery plikow i og&oacute;lnie zawartoÅ›Ä‡ plik&oacute;w.</p>', '', 'karlosos', '2014-04-24 19:38:18', '0000-00-00'),
(18, '123', '<p>213231</p>', '', 'karlosos', '2014-05-22 22:24:16', '0000-00-00'),
(19, '123', '<p>123</p>', '', 'karlosos', '2014-05-22 22:27:21', '0000-00-00'),
(20, '342', '<p>123</p>', '', 'karlosos', '2014-05-22 22:27:57', '0000-00-00'),
(21, '213213213231123', '<p>231</p>', '', 'karlosos', '2014-05-22 22:28:11', '2014-05-23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=56 ;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `content`, `author`, `date`, `active`) VALUES
(51, 17, ' ToÅ¼ to jest chaÅ„ba!', 'user', '2014-04-24 19:39:07', 1),
(52, 16, ' Bardzo sÅ‚abe :/', 'user', '2014-04-24 19:39:21', 1),
(53, 17, ' Czemu nie aktywujesz moich komentarzy?', 'user', '2014-04-24 19:39:52', 0),
(54, 17, ' ProszÄ™ o dodanie moich komentarzy!!!! Faszystowska strona!!!!!!!!!', 'user', '2014-04-24 19:40:06', 0),
(55, 17, ' Hehe sam jesteÅ› "chaÅ„ba" cieniasie', 'karlosos', '2014-04-24 19:40:40', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `menu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `info`
--

INSERT INTO `info` (`id`, `title`, `description`, `keywords`, `menu`) VALUES
(0, 'StuckU', 'Tutaj bajerancki opis', 'A tutaj sÅ‚owa kluczowe', '    <ul id="nav_ul">\r\n        <li id="nav_li"><a href="index.php"> Home </a> </li>\r\n        <li id="nav_li"><a href="panel.php"> Panel administratora </a></li>\r\n        <li id="nav_li"><a href="register.php">Rejestracja </a></li>\r\n    </ul>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `moderator` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `active`, `moderator`) VALUES
(1, 'karlosos', '202cb962ac59075b964b07152d234b70', 'karol', '', 'karoldzialowski@gmail.com', 1, 1),
(7, 'user', '202cb962ac59075b964b07152d234b70', 'karol', '', 'karol@karol.pl', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
