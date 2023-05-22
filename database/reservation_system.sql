-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2023 at 01:25 AM
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
-- Table structure for table `aircraft`
--

DROP TABLE IF EXISTS `aircraft`;
CREATE TABLE IF NOT EXISTS `aircraft` (
  `aircraft_id` int NOT NULL AUTO_INCREMENT,
  `max_weight` int NOT NULL DEFAULT '10000' COMMENT 'in Kilo grams',
  `number_of_seats` int NOT NULL DEFAULT '40',
  `manufacture_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(130) NOT NULL,
  PRIMARY KEY (`aircraft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraft_id`, `max_weight`, `number_of_seats`, `manufacture_date`, `name`, `model`) VALUES
(1, 12000, 50, '2020-01-01', 'Airplane# 1', 'Model# 1'),
(2, 15000, 60, '2019-05-10', 'Airplane# 2', 'Model# 2'),
(3, 10000, 40, '2021-08-15', 'Airplane #3', 'Model #3'),
(10, 101010, 33, '2023-05-26', 'Boeng #4', ''),
(11, 4141141, 66, '2023-05-26', 'Boeng #4', ''),
(12, 4141141, 66, '2023-05-26', 'Boeng #4', ''),
(13, 4141141, 66, '2023-05-26', 'Boeng #4', ''),
(14, 10, 3, '2023-05-20', 'Boeng #5', 'latitude'),
(15, 100, 14, '2023-06-09', 'posa', 'posa and de7ka');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
CREATE TABLE IF NOT EXISTS `flight` (
  `flight_id` int NOT NULL AUTO_INCREMENT,
  `dep_location` varchar(130) NOT NULL,
  `arrival_location` varchar(130) NOT NULL,
  `dep_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `price` float NOT NULL,
  `aircraft_id` int NOT NULL,
  `airline` varchar(130) NOT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `aircraft_id` (`aircraft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `dep_location`, `arrival_location`, `dep_time`, `arrival_time`, `price`, `aircraft_id`, `airline`) VALUES
(1, 'New York', 'London', '2023-05-20 08:00:00', '2023-05-20 15:00:00', 500, 2, 'Airline ABC'),
(2, 'Paris', 'Tokyo', '2023-06-10 10:30:00', '2023-06-11 06:00:00', 800, 2, 'Airline XYZ'),
(4, 'El 3Asfra', 'BanhE', '2023-04-01 04:04:00', '2023-04-17 05:18:54', 225, 1, '3aseer Baty and 2L.E lib');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `res_id` int NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount` float NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payment_reservation_fk` (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `res_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `flight_id` int DEFAULT NULL,
  `seat_id` int DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `seat_id` (`seat_id`),
  KEY `reservation_ibfk_1` (`user_id`),
  KEY `reservation_ibfk_2` (`flight_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`res_id`, `user_id`, `flight_id`, `seat_id`, `date`) VALUES
(1, 1, 1, 19, '2023-05-20 00:11:12'),
(12, 4, 1, 2, '2023-05-20 05:07:13'),
(13, 4, 1, 5, '2023-05-20 05:07:13');

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
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(196, 14, 'First Class'),
(197, 2, 'Seat 2 '),
(198, 15, 'Economic'),
(199, 15, 'Economic'),
(200, 15, 'Economic'),
(201, 15, 'Economic'),
(202, 15, 'Economic'),
(203, 15, 'Economic'),
(204, 15, 'Economic'),
(205, 15, 'Economic'),
(206, 15, 'Economic'),
(207, 15, 'Economic'),
(208, 15, 'Economic'),
(209, 15, 'Economic'),
(210, 15, 'Economic'),
(211, 15, 'Economic');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(130) NOT NULL,
  `phone` varchar(130) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(130) NOT NULL,
  `role` int DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `phone`, `address`, `password`, `role`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', '1234567890', '123 Main St', 'password123', 0),
(2, 'Jane', 'Smith', 'janesmith@example.com', '9876543210', '456 Oak Ave', 'securepass', 0),
(3, 'Mike', 'Johnson', 'mikejohnson@example.com', '010', '789 Elm ST', 'pass1234', 0),
(4, 'YousseF', 'Elnaggar', 'elnagaryoussef864@gmail.com', '+201012366503', 'Giza, cairo', '123', 1),
(5, 'Tony ', 'Elia ', '1@1.com', '+201012366504', 'asd', '123', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`aircraft_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`seat_id`);

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`aircraft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
