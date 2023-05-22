

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `flight` (`flight_id`, `dep_location`, `arrival_location`, `dep_time`, `arrival_time`, `price`, `aircraft_id`, `airline`) VALUES
(1, 'New York', 'London', '2023-05-20 08:00:00', '2023-05-20 15:00:00', 500, 2, 'Airline ABC'),
(2, 'Paris', 'Tokyo', '2023-06-10 10:30:00', '2023-06-11 06:00:00', 800, 2, 'Airline XYZ'),
(4, 'El 3Asfra', 'BanhE', '2023-04-01 04:04:00', '2023-04-17 05:18:54', 225, 1, '3aseer Baty and 2L.E lib');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`aircraft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
