-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 11:59 PM
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
  `security_answer` varchar(255) NOT NULL,
  `contactNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `_unit`
--
ALTER TABLE `_unit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
