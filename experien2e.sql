-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 15 sep 2023 kl 01:48
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `experien2e`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `items`
--
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL, AUTO_INCREMENT
  `item_name` varchar(50) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `sbmt_date` date DEFAULT NULL,
  `price` int(11) NOT NULL,
  `sold` tinyint(4) DEFAULT NULL,
  `sold_date` date DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `seller_id`, `sbmt_date`, `price`, `sold`, `sold_date`) VALUES
(1, 'Adidas tracksuit', 1, '2023-09-10', 500, 1, '2023-09-12'),
(2, 'Stan Smith shoes', 1, '2023-09-14', 300, 0, NULL),
(3, 'Dior jeans', 2, '2023-07-02', 400, 1, '2023-09-01'),
(4, 'Cowboy boots', 3, '2023-08-13', 600, 1, '2023-09-04'),
(5, 'Hugo Boos tee', 3, '2023-09-01', 200, 1, '2023-09-07'),
(6, 'Softshell jacket Everest', 3, '2023-09-12', 400, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellstruktur `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `total_items` int(11) NOT NULL,
  `total_items_sold` int(11) NOT NULL,
  `total_sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `sellers`
--

INSERT INTO `sellers` (`seller_id`, `name`, `lastname`, `total_items`, `total_items_sold`, `total_sales`) VALUES
(1, 'Fredrik', 'Andersson', 2, 1, 500),
(2, 'Anders', 'Svensson', 1, 1, 400),
(3, 'Kalle', 'Moreus', 3, 2, 800);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`) USING BTREE,
  ADD KEY `seller_id` (`seller_id`);

--
-- Index för tabell `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`) USING BTREE;

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT för tabell `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
