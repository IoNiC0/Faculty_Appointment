-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 06:09 PM
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
-- Database: `appbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_id` int(255) NOT NULL,
  `Faculty_Id` int(255) NOT NULL,
  `Timing` date NOT NULL,
  `Subject` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `sTime` time NOT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `attendance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `Faculty_Id`, `Timing`, `Subject`, `email`, `sTime`, `Status`, `attendance`) VALUES
(1, 1, '2023-09-01', 'cjcfjhgvcjhgv', 'hangsha.s.0221@inspiria.edu.in', '15:18:00', 'Accepted', 'Present'),
(2, 1, '2023-09-01', 'kheghseayhiweyug', 'hangshasaha@gmail.com', '17:37:00', 'Declined', NULL),
(3, 1, '2023-09-01', 'rgahrregh', 'hangshasaha@gmail.com', '11:35:00', 'Accepted', 'Absent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `email` (`email`),
  ADD KEY `Faculty_Id` (`Faculty_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_registration` (`email`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Faculty_Id`) REFERENCES `faculty` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
