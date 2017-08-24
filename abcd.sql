-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2017 at 10:04 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `_floors`
--

CREATE TABLE `_floors` (
  `id` int(255) NOT NULL,
  `floorName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_floors`
--

INSERT INTO `_floors` (`id`, `floorName`, `userName`) VALUES
(7, 'One', 'imran7128'),
(8, 'Two', 'imran7128'),
(9, 'Three', 'imran7128');

-- --------------------------------------------------------

--
-- Table structure for table `_owners`
--

CREATE TABLE `_owners` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` tinytext NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_owners`
--

INSERT INTO `_owners` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `security_question`, `security_answer`) VALUES
(3, 'imran7128', 'imranhussain7128@gmail.com', 'imranimran', 'Syed Imran', 'Hussain', 'What is your name?', 'Imran'),
(4, 'imranimran', 'imran@gmail.com', 'imranimran', 'Imran ', 'Hussain', 'Hello', 'Hi');

-- --------------------------------------------------------

--
-- Table structure for table `_owner_dorm`
--

CREATE TABLE `_owner_dorm` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_tenantprofile`
--

CREATE TABLE `_tenantprofile` (
  `id` int(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `guardianName` varchar(255) NOT NULL,
  `guardianAddress` varchar(255) NOT NULL,
  `guardianContact` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_tenantprofile`
--

INSERT INTO `_tenantprofile` (`id`, `firstName`, `lastName`, `userName`, `password`, `address`, `email`, `contactNumber`, `guardianName`, `guardianAddress`, `guardianContact`, `owner`) VALUES
(14, 'Syed Imran', 'Hussain', 'Syed Imran', 'Hussain', 'Quezon Hill', 'syed_imran_hussain@hotmail.com', '9326616065', 'Susan Hussain', 'Tarlac', '9224014292', 'imran7128');

-- --------------------------------------------------------

--
-- Table structure for table `_tenantrentinginformation`
--

CREATE TABLE `_tenantrentinginformation` (
  `id` int(255) NOT NULL,
  `tenant_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `floorName` varchar(255) DEFAULT NULL,
  `unitName` varchar(255) DEFAULT NULL,
  `downpayment` double(255,2) DEFAULT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `endDate` varchar(255) DEFAULT NULL,
  `totalMonths` int(255) DEFAULT NULL,
  `collectionDay` int(2) DEFAULT NULL,
  `balance` double(255,2) DEFAULT NULL,
  `adjustedRentPerMonth` double(255,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_tenantrentinginformation`
--

INSERT INTO `_tenantrentinginformation` (`id`, `tenant_id`, `status`, `floorName`, `unitName`, `downpayment`, `startDate`, `endDate`, `totalMonths`, `collectionDay`, `balance`, `adjustedRentPerMonth`) VALUES
(4, 14, '1', 'One', 'Lobby', 5000.00, '25-08-2017', '01-01-2019', 16, 15, 160000.00, 9675.00);

-- --------------------------------------------------------

--
-- Table structure for table `_units`
--

CREATE TABLE `_units` (
  `id` int(255) NOT NULL,
  `rent` double(255,2) NOT NULL,
  `unitName` varchar(255) NOT NULL,
  `floorName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `tenant` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_units`
--

INSERT INTO `_units` (`id`, `rent`, `unitName`, `floorName`, `userName`, `tenant`, `status`) VALUES
(5, 10000.00, 'Lobby', 'One', 'imran7128', '14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_floors`
--
ALTER TABLE `_floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_owners`
--
ALTER TABLE `_owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_owner_dorm`
--
ALTER TABLE `_owner_dorm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  ADD PRIMARY KEY (`id`,`owner`);

--
-- Indexes for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_units`
--
ALTER TABLE `_units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_floors`
--
ALTER TABLE `_floors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `_owners`
--
ALTER TABLE `_owners`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `_units`
--
ALTER TABLE `_units`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
