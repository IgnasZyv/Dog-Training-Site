-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 04:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(4) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `Pnumber` varchar(12) NOT NULL,
  `bookedDate` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(50) NOT NULL,
  `dateOfBooking` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `surname`, `email`, `Pnumber`, `bookedDate`, `time`, `reason`, `dateOfBooking`) VALUES
(24, 'admin', 'admin', 'admin@gmail.com', '447533181611', '2021-05-12', '13:00:00', 'asd', '2021-05-11'),
(26, 'admin', 'admin', 'admin@gmail.com', '447533181611', '2021-05-13', '15:00:00', 'asd', '2021-05-11'),
(27, 'ignas', 'ignas', 'yrap@ggmial.com', '9515911', '2021-05-12', '12:00:00', 'asd', '2021-05-11'),
(28, 'Raymond', 'Redington', 'Red@gmail.com', '654123654316', '2021-05-13', '10:00:00', 'Training', '2021-05-12'),
(36, 'admin', 'admin', 'admin@gmail.com', '447533181611', '2021-05-20', '13:00:00', 'kk', '2021-05-15'),
(39, 'pswtest', 'pswtest', 'pswtest@gmail.com', '987651231', '2021-05-21', '14:00:00', 'hhh', '2021-05-16'),
(41, 'user', 'user', 'user123@gmail.com', '987654321', '2021-05-17', '13:00:00', 'asd', '2021-05-16'),
(42, 'user', 'user', 'user123@gmail.com', '987654321', '2021-05-17', '13:00:00', 'asd', '2021-05-16'),
(43, 'admin', 'admin', 'admin@gmail.com', '447533181611', '2021-05-18', '15:00:00', 'asd', '2021-05-17'),
(44, 'admin', 'admin', 'admin@gmail.com', '447533181611', '2021-05-19', '13:00:00', 'aasd', '2021-05-18'),
(47, 'admin', 'admin', 'admin@gmail.com', '321654', '2021-05-19', '13:00:00', 'Grooming', '2021-05-19'),
(49, 'admin', 'admin', 'admin@gmail.com', '321654', '2021-05-27', '13:00:00', 'asd', '2021-05-19'),
(50, 'user', 'user', 'user@gmail.com', '987654321', '2021-05-19', '16:00:00', 'training', '2021-05-19'),
(51, 'user', 'user', 'user@gmail.com', '987654321', '2021-05-19', '17:00:00', 'grooming', '2021-05-19'),
(52, 'user', 'user', 'user@gmail.com', '987654321', '2021-05-28', '13:00:00', 'grooming', '2021-05-19'),
(53, 'user', 'user', 'user@gmail.com', '987654321', '2021-05-28', '10:00:00', 'Daycare', '2021-05-19'),
(54, 'admin', 'admin', 'admin@gmail.com', '987654321', '2021-05-19', '10:00:00', 'asd', '2021-05-19'),
(55, 'admin', 'admin', 'admin@gmail.com', '987654321', '2021-05-20', '14:00:00', 'asd', '2021-05-19'),
(56, 'admin', 'admin', 'admin@gmail.com', '987654321', '2021-05-26', '13:00:00', 'asd', '2021-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `Pnumber` varchar(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `Pnumber`, `password`, `role`) VALUES
(5, 'ignas', 'ignas', 'yrap@ggmial.com', '9515911', 'd413030d2b401986928943e1eddf39d3', 1),
(7, 'admin', 'admin', 'admin@gmail.com', '987654321', 'd413030d2b401986928943e1eddf39d3', 0),
(14, 'user', 'user', 'user@gmail.com', '987654321', 'd413030d2b401986928943e1eddf39d3', 1),
(15, 'every', 'day', 'everyday@gmail.com', '987654321', 'd413030d2b401986928943e1eddf39d3', 1),
(19, 'Sara', 'Sara', 'Sara@gmail.com', '321654987', 'd413030d2b401986928943e1eddf39d3', 1),
(20, 'test', 'test', 'testadmin@gmail.com', '321654', 'd413030d2b401986928943e1eddf39d3', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
