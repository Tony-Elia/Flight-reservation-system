

DROP TABLE IF EXISTS `aircraft`;
CREATE TABLE IF NOT EXISTS `aircraft` (
  `aircraft_id` int NOT NULL AUTO_INCREMENT,
  `max_weight` int NOT NULL DEFAULT '10000' COMMENT 'in Kilo grams',
  `number_of_seats` int NOT NULL DEFAULT '40',
  `manufacture_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(130) NOT NULL,
  PRIMARY KEY (`aircraft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(14, 10, 3, '2023-05-20', 'Boeng #5', 'latitude');
COMMIT;
