-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2017 at 03:25 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `_bill`
--

CREATE TABLE `_bill` (
  `id` int(255) NOT NULL,
  `tid` int(255) NOT NULL,
  `trid` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double(255,0) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_bill_items`
--

CREATE TABLE `_bill_items` (
  `id` int(255) NOT NULL,
  `bid` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double(255,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_bill_items`
--

INSERT INTO `_bill_items` (`id`, `bid`, `description`, `amount`) VALUES
(1, 1, 'Electric Bill ', 10000),
(2, 7, 'Kuryente', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `_floor`
--

CREATE TABLE `_floor` (
  `id` int(255) NOT NULL,
  `oid` int(255) NOT NULL,
  `floorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_floor`
--

INSERT INTO `_floor` (`id`, `oid`, `floorName`) VALUES
(1, 1, 'First'),
(2, 1, 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `_imran`
--

CREATE TABLE `_imran` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_owner`
--

CREATE TABLE `_owner` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` tinytext NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_owner`
--

INSERT INTO `_owner` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `security_question`, `security_answer`, `contactNumber`) VALUES
(1, 'imran7128', 'imranhussain7128@gmail.com', 'dfd89768fb0dae9373ecd4c17200fe85', 'Syed', 'Hussain', 'What is your name', 'Imran', '(0995) 144-3564');

-- --------------------------------------------------------

--
-- Table structure for table `_payments`
--

CREATE TABLE `_payments` (
  `id` int(255) NOT NULL,
  `tid` int(255) NOT NULL,
  `bid` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double(255,0) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_payments`
--

INSERT INTO `_payments` (`id`, `tid`, `bid`, `description`, `amount`, `date`) VALUES
(2, 2, 7, '', 14350, '25-09-2017'),
(3, 2, 8, '', 9300, '25-09-2017'),
(4, 2, 8, '', 25, '25-09-2017');

-- --------------------------------------------------------

--
-- Table structure for table `_tenantprofile`
--

CREATE TABLE `_tenantprofile` (
  `id` int(255) NOT NULL,
  `oid` varchar(255) NOT NULL,
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
  `balance` double(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_tenantprofile`
--

INSERT INTO `_tenantprofile` (`id`, `oid`, `firstName`, `lastName`, `userName`, `password`, `address`, `email`, `contactNumber`, `guardianName`, `guardianAddress`, `guardianContact`, `balance`) VALUES
(1, '1', 'Syed Imran', 'Hussain', 'imran', '9ce0dd3ecd56296859fdd74554c0af74', 'Baguio City', 'syed_imran_hussain@hotmail.com', '(0995) 144-3564', 'Susan Hussain', 'Tarlac', '(0922) 542-2644', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `_tenantrentinginformation`
--

CREATE TABLE `_tenantrentinginformation` (
  `id` int(255) NOT NULL,
  `tid` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `downpayment` double(255,2) DEFAULT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `endDate` varchar(255) DEFAULT NULL,
  `totalMonths` int(255) DEFAULT NULL,
  `collectionDay` int(2) DEFAULT NULL,
  `balance` double(255,2) DEFAULT NULL,
  `adjustedRentPerMonth` double(255,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_unit`
--

CREATE TABLE `_unit` (
  `id` int(255) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `unitName` varchar(255) NOT NULL,
  `tenantAllowed` int(100) NOT NULL,
  `rentPerTenant` double(100,2) NOT NULL,
  `totalRent` double(100,2) NOT NULL,
  `currentTenant` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_unit`
--

INSERT INTO `_unit` (`id`, `floor_id`, `unitName`, `tenantAllowed`, `rentPerTenant`, `totalRent`, `currentTenant`) VALUES
(1, 1, '101', 1, 10000.00, 10000.00, 0),
(2, 1, 'Masking', 10, 10.00, 100.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_bill`
--
ALTER TABLE `_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_bill_items`
--
ALTER TABLE `_bill_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_floor`
--
ALTER TABLE `_floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_imran`
--
ALTER TABLE `_imran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_owner`
--
ALTER TABLE `_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_payments`
--
ALTER TABLE `_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_unit`
--
ALTER TABLE `_unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_bill`
--
ALTER TABLE `_bill`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_bill_items`
--
ALTER TABLE `_bill_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `_floor`
--
ALTER TABLE `_floor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `_owner`
--
ALTER TABLE `_owner`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `_payments`
--
ALTER TABLE `_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_unit`
--
ALTER TABLE `_unit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
