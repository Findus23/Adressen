-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 09. Feb 2014 um 14:23
-- Server Version: 5.5.35-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `informatik-7a`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adressen`
--

CREATE TABLE IF NOT EXISTS `adressen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vorname` varchar(20) NOT NULL,
  `nachname` varchar(20) NOT NULL,
  `plz` varchar(4) NOT NULL,
  `ort` varchar(20) NOT NULL,
  `strasse` varchar(20) NOT NULL,
  `hausnummer` varchar(20) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `bemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `adressen`
--

INSERT INTO `adressen` (`id`, `vorname`, `nachname`, `plz`, `ort`, `strasse`, `hausnummer`, `telefon`, `email`, `bemerkung`) VALUES
(1, 'Max', 'Mustermann', '1234', 'Krems', 'Hauptstraße', '1', '06641234', 'mail@example.com', 'Anmerkung');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
