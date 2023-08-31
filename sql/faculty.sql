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
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Id` int(200) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Number` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Id`, `Name`, `Email`, `Password`, `Number`, `Address`) VALUES
(1, 'Saurav Bhaumik', 'saurav.b@inspiria.edu.in', '5f4dcc3b5aa765d61d8327deb882cf99', '9845312125', 'Matigara'),
(2, 'Subhro Sarkar', 'subhro.s@inspiria.edu.in', '5f4dcc3b5aa765d61d8327deb882cf99', '9847772125', 'Jalpaiguri'),
(3, 'Neha Thapa', 'neha.t@inspiria.edu.in', '5f4dcc3b5aa765d61d8327deb882cf99', '9841472125', 'Siliguri'),
(4, 'Tanmoy Ghosh', 'tanmoy.g@inspiria.edu.in', '5f4dcc3b5aa765d61d8327deb882cf99', '9841400125', 'Matigara'),
(5, 'Somik Mondal', 'somik.m@inspiria.edu.in', '5f4dcc3b5aa765d61d8327deb882cf99', '1234567890', 'Matigara,Siliguri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
