-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2023 at 12:48 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
CREATE TABLE IF NOT EXISTS `seat` (
  `seat_id` int NOT NULL AUTO_INCREMENT,
  `aircraft_id` int DEFAULT NULL,
  `class_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`seat_id`),
  KEY `aircraft_id` (`aircraft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `aircraft_id`, `class_type`) VALUES
(1, 1, 'Economy'),
(2, 1, 'Business'),
(3, 1, 'First'),
(4, 1, 'Economy'),
(5, 1, 'Business'),
(6, 1, 'First'),
(7, 1, 'Economy'),
(8, 1, 'Business'),
(9, 1, 'First'),
(10, 1, 'Economy'),
(11, 1, 'Business'),
(12, 1, 'First'),
(13, 1, 'Economy'),
(14, 1, 'Business'),
(15, 1, 'First'),
(16, 1, 'Economy'),
(17, 1, 'Business'),
(18, 1, 'First'),
(19, 1, 'Economy'),
(20, 1, 'Business'),
(21, 1, 'First'),
(22, 1, 'Economy'),
(23, 1, 'Business'),
(24, 1, 'First'),
(25, 1, 'Economy'),
(26, 1, 'Business'),
(27, 2, 'Seat 2 '),
(28, 2, 'Ecomonic  '),
(194, 14, 'Economic'),
(195, 14, 'Business'),
(196, 14, 'First Class');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`aircraft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
