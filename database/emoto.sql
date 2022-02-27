-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Ned 27. úno 2022, 16:41
-- Verze serveru: 5.7.26
-- Verze PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `emoto`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mileage` int(10) UNSIGNED DEFAULT NULL COMMENT 'meter',
  `battery_capacity` float DEFAULT NULL COMMENT '0-1',
  `gps` varchar(45) DEFAULT NULL COMMENT 'WGS84',
  `vehicle_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_vehicle_idx` (`vehicle_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `log`
--

INSERT INTO `log` (`id`, `dttm`, `mileage`, `battery_capacity`, `gps`, `vehicle_code`) VALUES
(1, '2022-02-27 15:40:41', 0, 0, NULL, 'ZIDAN');

-- --------------------------------------------------------

--
-- Struktura tabulky `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `code` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `secret` varchar(24) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `vehicle`
--

INSERT INTO `vehicle` (`code`, `description`, `secret`) VALUES
('ZIDAN', 'Test emoto', 'OzRFZqwb5JTlZX929a91');

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_vehicle` FOREIGN KEY (`vehicle_code`) REFERENCES `vehicle` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
