-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 06:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airline_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$fmRUiUSsp/35/CN59qPtoeiEYUabpydwutvdKYHPXtl4JQy/cVJX6'),
(4, 'kent', '$2y$10$h5nMxFTbBxDBgwwL0PgsVeiSl71xRsQdYouh40sfrZzUPmt4Asvt.');

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `aircraft_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `model` varchar(45) NOT NULL DEFAULT '',
  `aircraft_name` varchar(45) NOT NULL,
  `manufacturer` varchar(45) NOT NULL DEFAULT '',
  `economy_seats` int(45) NOT NULL,
  `business_seats` int(45) NOT NULL,
  `comfort_seats` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`aircraft_code`, `model`, `aircraft_name`, `manufacturer`, `economy_seats`, `business_seats`, `comfort_seats`) VALUES
(501, 'A456', 'Nelgie\'s', 'Airbus', 39, 28, 37),
(502, 'B44', 'Skyline', 'FlyMaker', 45, 50, 60),
(503, 'A143', 'Nelgie\'s06', 'Airjeep', 34, 56, 28);

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airlines_id` int(255) NOT NULL,
  `airlines_name` varchar(45) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airlines_id`, `airlines_name`, `seats`) VALUES
(1, 'Llavado Airlines', 4),
(2, 'Nelgie Airlines', 66),
(3, 'Cebu Oceanic', 77),
(4, 'Bacarisa Airlines', 50),
(5, 'CJC Airways', 120),
(6, 'Bukakang Airways', 545),
(7, 'CSP Airlines', 50),
(9, 'CCIS Airlines', 444),
(157, '2024 Airways', 400),
(158, 'New Year Airways', 300);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_name`) VALUES
('China'),
('Davao'),
('Digos'),
('Dubai'),
('General Santos'),
('London'),
('Los Angeles'),
('Mexico'),
('Mumbai'),
('New York'),
('Paris'),
('Seoul'),
('Singapore'),
('Sydney'),
('Tagum'),
('Tokyo');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(255) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'Economy'),
(2, 'Business Class');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(255) NOT NULL,
  `from` varchar(45) NOT NULL,
  `to` varchar(45) NOT NULL,
  `depart_time` time NOT NULL,
  `airlines_id` int(255) NOT NULL,
  `arrive_time` time NOT NULL,
  `depart_date` date NOT NULL,
  `arrive_date` date NOT NULL,
  `price` int(255) NOT NULL,
  `duration` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `from`, `to`, `depart_time`, `airlines_id`, `arrive_time`, `depart_date`, `arrive_date`, `price`, `duration`) VALUES
(1, 'Davao City', 'Bangkok', '00:00:14', 1, '00:00:14', '2023-11-06', '2023-11-29', 10, '4'),
(2, 'Singapore', 'Seoul', '02:16:00', 2, '15:20:00', '2023-11-07', '2023-11-10', 10, '5 '),
(3, 'Manila', 'Digos', '00:25:00', 3, '00:25:00', '2023-11-13', '2023-11-14', 10, '4 '),
(4, 'Singapore', 'Bangkok', '10:23:00', 4, '10:23:00', '2023-11-13', '2023-11-13', 43, '43'),
(5, 'Bangkok', 'Manila', '23:50:00', 1, '11:50:00', '2023-11-16', '2023-11-16', 43, '43 '),
(6, 'Seoul', 'Singapore', '23:55:00', 2, '11:56:00', '2023-11-16', '2023-11-17', 43, '43 '),
(7, 'Davao City', 'Seoul', '00:10:00', 1, '12:12:00', '2023-11-16', '2023-11-17', 443, ' 23'),
(8, 'Davao City', 'Singapore', '00:22:00', 2, '12:20:00', '2023-11-16', '2023-11-17', 500, '1 '),
(9, 'Davao City', 'Singapore', '23:07:00', 3, '00:07:00', '2023-12-03', '2023-12-04', 200, '12 '),
(10, 'Davao City', 'Manila', '01:09:00', 5, '01:09:00', '2023-12-10', '2023-12-11', 5000, '14'),
(11, 'Manila', 'Manila', '18:35:00', 3, '06:35:00', '2023-12-13', '2023-12-14', 450, '2 '),
(12, 'Tokyo', 'Manila', '21:02:00', 2, '12:02:00', '2023-12-16', '2023-12-17', 500, '1'),
(13, 'Tokyo', 'Seoul', '17:49:00', 1, '05:50:00', '2023-12-17', '2023-12-18', 250, '2'),
(14, 'Davao City', 'Singapore', '17:50:00', 1, '17:50:00', '2023-12-20', '2023-12-23', 300, '3 '),
(15, 'Tokyo', 'Seoul', '17:55:00', 3, '05:55:00', '2023-12-21', '2023-12-22', 250, '2 '),
(20, 'Davao City', 'Singapore', '18:52:00', 1, '19:52:00', '2024-01-05', '2024-01-06', 200, '1 '),
(21, 'Davao City', 'Singapore', '19:18:00', 1, '08:18:00', '2024-01-05', '2024-02-10', 23, '2 '),
(22, 'Manila', 'Seoul', '22:37:00', 4, '14:37:00', '2024-01-05', '2024-01-06', 250, '16'),
(23, 'Digos', 'Bangkok', '18:43:00', 1, '01:43:00', '2024-01-04', '2024-01-05', 199, '7'),
(24, 'Davao', 'China', '20:42:00', 6, '13:42:00', '2024-01-08', '2024-01-09', 250, '17'),
(25, 'New York', 'Paris', '21:09:00', 5, '09:09:00', '2024-01-09', '2024-01-10', 250, '12'),
(26, 'Mumbai', 'Digos', '23:59:00', 5, '11:59:00', '2024-01-10', '2024-01-11', 300, '12'),
(27, 'Davao', 'London', '23:59:00', 9, '11:59:00', '2024-01-06', '2024-01-07', 500, '12'),
(28, 'Los Angeles', 'Mumbai', '00:02:00', 3, '00:01:00', '2024-01-05', '2024-01-06', 2000, '23'),
(29, 'China', 'Dubai', '12:05:00', 2, '01:06:00', '2024-01-10', '2024-01-11', 500, '13'),
(30, 'China', 'Los Angeles', '00:06:00', 2, '12:06:00', '2024-01-06', '2024-01-06', 540, '12'),
(31, 'Davao', 'New York', '00:07:00', 3, '14:08:00', '2024-01-06', '2024-01-06', 150, '14'),
(32, 'Seoul', 'Tokyo', '00:09:00', 4, '07:15:00', '2024-01-06', '2024-01-06', 100, '7'),
(33, 'Sydney', 'Tokyo', '00:50:00', 5, '17:50:00', '2024-01-06', '2024-01-06', 200, '17'),
(34, 'Mexico', 'Tokyo', '01:23:00', 9, '05:23:00', '2024-01-06', '2024-01-06', 250, '4');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(45) NOT NULL DEFAULT '',
  `middle_name` varchar(45) NOT NULL DEFAULT '',
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `phone_no` int(11) NOT NULL,
  `email` varchar(45) NOT NULL DEFAULT '',
  `flight_id` int(255) DEFAULT NULL,
  `user_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `first_name`, `middle_name`, `last_name`, `phone_no`, `email`, `flight_id`, `user_id`, `class_id`) VALUES
(1, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 1, 5, 1),
(2, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 1, 5, 1),
(3, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 1, 5, 1),
(4, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 2, 5, 1),
(5, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 3, 5, 1),
(6, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 3, 5, 1),
(7, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 3, 5, 1),
(8, 'nelgie', 'sarao', 'sarao', 2147483647, 'kentoyllavado@gmail.com', 5, 5, 1),
(9, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 6, 5, 1),
(10, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 10, 5, 1),
(11, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 9, 5, 1),
(12, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 3, 5, 1),
(142, 'Kent', 'Miko', 'Miko', 2147483647, 'kentoyllavado@gmail.com', 14, 7, 2),
(143, 'Miko', 'Ayo', 'Bacarisa', 2147483647, 'kentoyllavado@gmail.com', 15, 7, 1),
(144, 'Kent', 'Miko', 'Miko', 2147483647, 'kentoyllavado@gmail.com', 15, 7, 1),
(150, 'Miko', 'Kent', 'Bacarisa', 2147483647, 'kentoyllavado@gmail.com', 15, 7, 1),
(151, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentgllavado@gmail.com', 24, 7, 1),
(152, 'Nelgie', 'Gordonas', 'Sarao', 995107325, 'nelgiesarao@yahoo.com', 24, 7, 1),
(153, 'John', 'Llenard', 'Llegunas', 2147483647, 'johnllegunas@gmail.com', 25, 7, 1),
(154, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentgllavado@gmail.com', 24, 7, 1),
(155, 'Nelgie', 'Gordonas', 'Sarao', 2147483647, 'nelgiesarao@yahoo.com', 24, 7, 1),
(156, 'Nelgie', 'Gordonas', 'Sarao', 2147483647, 'nelgiesarao@yahoo.com', 24, 7, 1),
(157, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 24, 7, 1),
(158, 'Kent', 'Guerrero', 'Llavado', 2147483647, 'kentoyllavado@gmail.com', 25, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(255) NOT NULL,
  `card_no` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `card_no`, `user_id`, `flight_id`, `date`, `amount`) VALUES
(1, 123, 7, 12, '2023-12-13', 500),
(2, 123, 7, 12, '2023-12-13', 500),
(3, 444, 7, 12, '2023-12-13', 500),
(5, 123, 7, 14, '2023-12-17', 0),
(6, 123, 7, 15, '2023-12-17', 0),
(7, 123, 7, 14, '2023-12-17', 0),
(8, 123, 7, 15, '2023-12-17', 250),
(9, 123, 7, 14, '2023-12-17', 300),
(10, 123, 7, 15, '2023-12-17', 500),
(11, 123, 7, 15, '2023-12-18', 250),
(12, 1232, 7, 24, '2024-01-06', 500),
(13, 1231, 7, 25, '2024-01-06', 250),
(14, 1321, 7, 24, '2024-01-06', 500),
(15, 5141, 7, 24, '2024-01-06', 500),
(16, 3213, 10, 25, '2024-01-06', 250);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(255) NOT NULL,
  `flight_id` int(255) NOT NULL,
  `passenger_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `seat_no` int(255) NOT NULL,
  `class_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `birthdate`, `email`) VALUES
(5, 'freakskent1', '$2y$10$2xzRyZT9jTxEP9JP1ue1HuNbR.BtT6WqVmOUiM', '2002-01-09', 'kentoyllavado@gmail.com'),
(6, 'admin', '$2y$10$joIoiI4B9zMhrDZ6zHBp2uowH8a.oLF4ICcGTD', '2008-01-03', 'kentoyllavado@gmail.com'),
(7, 'user', '$2y$10$PCH4MaP1UGVVunzZVYXbUOsPQW5LsagF0h97eN7sSgA7AZs.Z8tYq', '2003-01-09', 'kentgllavado@gmail.com'),
(8, 'kentllavado', '$2y$10$B2rEQ1KLSFfkTUmjG7tMweWH9cT23xyJ49wf9bqW0lL.X7R4lNa5G', '2002-01-09', 'kentllavado@yahoo.com'),
(9, 'user1', '$2y$10$LjiusSXb8eifRYQs00Nx9ODdZnGwBN83DFIjEgnj7/csQQFRFmneK', '2002-09-01', 'kentoyllavado@gmail.com'),
(10, 'kent123', '$2y$10$C7epwaLMvB99SHnURDccGuRamz1ffFuf69tpZWy/zKC3uSaT7v6ka', '2002-09-01', 'kentoyllavado@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`aircraft_code`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airlines_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_name`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`),
  ADD KEY `airline_id` (`airlines_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class` (`class_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airlines_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `passenger_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`airlines_id`) REFERENCES `airlines` (`airlines_id`);

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `passengers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `passengers_ibfk_3` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `passengers_ibfk_4` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
