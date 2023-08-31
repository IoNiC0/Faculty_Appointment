-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 10:38 PM
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
-- Database: `hangsha`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `Name` varchar(200) NOT NULL,
  `Number` varchar(200) NOT NULL,
  `Course` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Roll` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`Name`, `Number`, `Course`, `Address`, `username`, `password`, `Roll`) VALUES
('Rohit Roy', '123456789', 'BCA', 'Malda', 'rohit', '5f4dcc3b5aa765d61d8327deb882cf99', '2'),
('Deep', '159753654', 'BBA', 'Jalpaiguri', 'deep', '5f4dcc3b5aa765d61d8327deb882cf99', '3'),
('Hangsha Saha', '9749264132', 'BCA', 'Subhasnagar, Maynaguri', 'user1', '5f4dcc3b5aa765d61d8327deb882cf99', '34401221009'),
('Pankaj', '4567891598', 'BMAGD', 'Alipur', 'pankaj', '5f4dcc3b5aa765d61d8327deb882cf99', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`Roll`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
