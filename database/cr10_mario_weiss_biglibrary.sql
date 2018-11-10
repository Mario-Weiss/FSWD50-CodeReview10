-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Nov 2018 um 16:58
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr10_mario_weiss_biglibrary`
--
CREATE DATABASE IF NOT EXISTS `cr10_mario_weiss_biglibrary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cr10_mario_weiss_biglibrary`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `surname` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`id`, `name`, `surname`) VALUES
(1, 'John', 'Grisham'),
(3, 'Peter', 'Parker'),
(5, 'Thomas', 'Grauss');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `ISBN` bigint(13) NOT NULL,
  `short_desc` varchar(2048) NOT NULL,
  `publish_date` date NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`id`, `title`, `img`, `author_id`, `ISBN`, `short_desc`, `publish_date`, `publisher_id`, `type`, `status`) VALUES
(6, 'new titlw', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 1, 234324234, '234324234', '2018-01-01', 1, 'book', 1),
(9, 'new titlw', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 3, 123, '123', '2018-01-01', 1, 'book', 1),
(10, 'Superman', 'https://images-na.ssl-images-amazon.com/images/I/51KpwLmtUSL._SX351_BO1,204,203,200_.jpg', 3, 345434534, '345345345', '2018-11-10', 1, 'book', 1),
(13, 'testbook', 'https://via.placeholder.com/50', 1, 1234567890123, 'this is a fairly short description', '2018-11-01', 1, 'book', 1),
(14, 'testbook', 'https://via.placeholder.com/50', 1, 1234567890123, 'this is a fairly short description', '2018-11-01', 1, 'book', 1),
(15, 'testbook', 'https://via.placeholder.com/50', 1, 1234567890123, 'this is a fairly short description', '2018-11-01', 1, 'book', 1),
(16, 'batman', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 5, 123, '123', '2018-11-02', 2, 'book', 1),
(18, 'new titlw', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 3, 123, '1123', '2018-11-02', 2, 'book', 1),
(19, 'batman', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 3, 123, '123', '2018-11-09', 1, 'book', 0),
(20, '<script>alert()</script>', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 1, 123, '123', '2018-11-02', 2, 'book', 0),
(21, '\'best\' ever', 'https://images-na.ssl-images-amazon.com/images/I/61FOK1-BSnL._SY445_.jpg', 3, 123, '123', '2018-11-02', 2, 'book', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `publisher`
--

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `size` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `adress`, `size`) VALUES
(1, 'Herbert GrÃ¶nemeier Verlag', 'SchÃ¶nbrunnerstraÃŸe 42, 1120 Vienna', 'big'),
(2, 'Publisher 1', 'Publisherstreet 1, 1234 publishing', 'small'),
(3, 'Publisher xy', 'somewherestreet 3, 3452 somewhere', 'big');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indizes für die Tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
