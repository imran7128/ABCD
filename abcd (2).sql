-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 10:55 AM
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

--
-- Dumping data for table `_bill`
--

INSERT INTO `_bill` (`id`, `tid`, `trid`, `description`, `amount`, `date`, `status`) VALUES
(7, 41, 25, 'Monthly Bill', 5, '12-10-2017', 'pending'),
(8, 41, 25, 'Monthly Bill', 5, '12-11-2017', 'pending'),
(9, 41, 25, 'Monthly Bill', 5, '12-12-2017', 'pending'),
(10, 43, 26, 'Monthly Bill', 10000, '1-10-2017', 'paid'),
(11, 43, 26, 'Monthly Bill', 10000, '1-11-2017', 'paid'),
(12, 43, 26, 'Monthly Bill', 10000, '1-12-2017', 'paid'),
(13, 43, 26, 'Monthly Bill', 10000, '1-1-2018', 'paid'),
(14, 43, 26, 'Monthly Bill', 10000, '1-2-2018', 'paid'),
(15, 43, 26, 'Monthly Bill', 10000, '1-3-2018', 'pending'),
(16, 43, 26, 'Monthly Bill', 10000, '1-4-2018', 'pending'),
(17, 43, 26, 'Monthly Bill', 10000, '1-5-2018', 'pending'),
(18, 43, 26, 'Monthly Bill', 10000, '1-6-2018', 'pending'),
(19, 43, 26, 'Monthly Bill', 10000, '1-7-2018', 'pending');

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
(3, 2, 'Yeah'),
(14, 1, 'Lobby'),
(15, 1, 'Second'),
(16, 3, 'Test'),
(17, 4, 'First');

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
-- Table structure for table `_invoices`
--

CREATE TABLE `_invoices` (
  `invoice` varchar(255) NOT NULL,
  `invoice_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `invoice_due_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `total` double NOT NULL,
  `notes` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_invoice_items`
--

CREATE TABLE `_invoice_items` (
  `invoice` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double(255,2) NOT NULL,
  `subtota;` double(255,2) NOT NULL
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
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_owner`
--

INSERT INTO `_owner` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `security_question`, `security_answer`) VALUES
(1, 'imran7128', 'imranhussain7128@gmail.com', 'v2rocket', 'Syed Imran', 'Hussain', 'What is your name?', 'Imran'),
(2, 'imranimran', 'citadel101@outlook.ph', 'imranimran', 'Syed Imran', 'HYo', 'What is your other name?', 'Awesome'),
(3, 'Test', 'test@gmail.com', 'test123', 'Test', 'Test', 'Test', 'Test'),
(4, 'someone', 'someone@email.com', 'password', 'Some', 'One', 'What is my name', 'Someone');

-- --------------------------------------------------------

--
-- Table structure for table `_owneraccount`
--

CREATE TABLE `_owneraccount` (
  `id` int(255) NOT NULL,
  `tenant_limit` int(255) NOT NULL,
  `monthly_bill` double(255,2) NOT NULL,
  `balance` double(255,2) NOT NULL,
  `payment` double(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(89, 26, 10, '', 10000, '05-09-2017'),
(90, 26, 11, '', 10000, '05-09-2017'),
(97, 26, 12, '', 10000, '05-09-2017'),
(98, 26, 13, '', 10000, '05-09-2017'),
(99, 26, 14, '', 5000, '05-09-2017'),
(100, 26, 14, '', 300, '05-09-2017'),
(106, 26, 14, '', 4700, '05-09-2017');

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
(41, '1', 'Syed Imran', 'Hussain', 'Syed Imran1', 'Hussain1', 'Quezon Hill', 'syed_imran_hussain@hotmail.com', '9326616065', 'Susan Hussain', 'Tarlac', '9224014292', 15.00),
(43, '4', 'First', 'Renter', 'First4', 'Renter4', 'Baguio Citu', 'firstsomeone@gmail.com', '9951443564', 'Idk', 'Idk', '09951443564', 100000.00);

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

--
-- Dumping data for table `_tenantrentinginformation`
--

INSERT INTO `_tenantrentinginformation` (`id`, `tid`, `uid`, `downpayment`, `startDate`, `endDate`, `totalMonths`, `collectionDay`, `balance`, `adjustedRentPerMonth`) VALUES
(25, 41, 40, 0.00, '05-09-2017', '04-12-2017', 3, 12, 15.00, 5.00),
(26, 43, 44, 0.00, '06-09-2017', '19-07-2018', 10, 1, 10000.00, 10000.00);

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
(1, 14, 'One', 1, 10000.00, 10000.00, 0),
(38, 14, 'Two', 1, 500.00, 500.00, 0),
(39, 14, 'Three', 1, 1.00, 1.00, 0),
(40, 14, 'Four', 1, 5.00, 5.00, 1),
(41, 15, 'Invoice Test', 1, 10000.00, 10000.00, 0),
(42, 16, 'TestU', 1, 10000.00, 10000.00, 0),
(43, 15, 'Test', 1, 1500.00, 1500.00, 0),
(44, 17, 'Unit 1', 1, 10000.00, 10000.00, 0);

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
-- Indexes for table `_invoices`
--
ALTER TABLE `_invoices`
  ADD PRIMARY KEY (`invoice`);

--
-- Indexes for table `_invoice_items`
--
ALTER TABLE `_invoice_items`
  ADD PRIMARY KEY (`invoice`);

--
-- Indexes for table `_owner`
--
ALTER TABLE `_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_owneraccount`
--
ALTER TABLE `_owneraccount`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `_bill_items`
--
ALTER TABLE `_bill_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_floor`
--
ALTER TABLE `_floor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `_owner`
--
ALTER TABLE `_owner`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `_payments`
--
ALTER TABLE `_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `_unit`
--
ALTER TABLE `_unit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
