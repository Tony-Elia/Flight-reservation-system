-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2023 at 10:16 PM
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
  `manufacture_year` date NOT NULL,
  PRIMARY KEY (`aircraft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraft_id`, `max_weight`, `number_of_seats`, `manufacture_year`) VALUES
(1, 12000, 50, '2020-01-01'),
(2, 15000, 60, '2019-05-10'),
(3, 10000, 40, '2021-08-15');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `dep_location`, `arrival_location`, `dep_time`, `arrival_time`, `price`, `aircraft_id`, `airline`) VALUES
(1, 'New York', 'London', '2023-05-20 08:00:00', '2023-05-20 15:00:00', 500, 1, 'Airline ABC'),
(2, 'Paris', 'Tokyo', '2023-06-10 10:30:00', '2023-06-11 06:00:00', 800, 2, 'Airline XYZ'),
(3, 'Los Angeles', 'Sydney', '2023-07-05 18:45:00', '2023-07-06 14:30:00', 700, 3, 'Airline PQR');

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
  `res_id` int NOT NULL,
  `user_id` int NOT NULL,
  `flight_id` int NOT NULL,
  `class` char(10) NOT NULL,
  `res_seats` int NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  PRIMARY KEY (`res_id`,`user_id`,`flight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `phone`, `address`, `password`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', '1234567890', '123 Main St', 'password123'),
(2, 'Jane', 'Smith', 'janesmith@example.com', '9876543210', '456 Oak Ave', 'securepass'),
(3, 'Mike', 'Johnson', 'mikejohnson@example.com', '5555555555', '789 Elm St', 'pass1234'),
(4, 'Youssef', 'Elnaggar', 'elnagaryoussef864@gmail.com', '+201012366503', 'Giza, cairo', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
