-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Sob 19. úno 2022, 15:51
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
  `mileage` int(10) UNSIGNED DEFAULT NULL,
  `battery_capacity` decimal(5,2) DEFAULT NULL,
  `vehicle_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_vehicle_idx` (`vehicle_code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `log`
--

INSERT INTO `log` (`id`, `dttm`, `mileage`, `battery_capacity`, `vehicle_code`) VALUES
(1, '2022-02-19 09:48:03', 0, '80.00', 'MB42'),
(2, '2022-02-19 09:50:20', 2, '75.00', 'MB42'),
(3, '2022-02-19 13:50:16', 3, '50.00', 'MB42'),
(4, '2022-02-19 13:51:47', 5, '48.00', 'MB42');

-- --------------------------------------------------------

--
-- Struktura tabulky `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `code` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `vehicle`
--

INSERT INTO `vehicle` (`code`, `description`) VALUES
('MB42', 'Test motorcycle');

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
