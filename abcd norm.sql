-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 10:45 PM
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
  `date` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_bill`
--

INSERT INTO `_bill` (`id`, `tid`, `trid`, `description`, `amount`, `date`) VALUES
(1, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(2, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(3, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(4, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(5, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(6, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(7, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(8, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(9, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(10, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(11, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(12, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(13, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(14, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(15, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(16, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(17, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(18, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(19, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(20, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(21, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(22, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(23, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(24, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(25, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(26, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(27, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(28, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(29, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(30, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(31, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(32, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(33, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(34, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(35, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(36, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(37, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(38, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(39, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(40, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(41, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(42, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(43, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(44, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(45, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(46, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(47, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(48, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(49, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(50, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(51, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(52, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(53, 21, 11, 'Monthly Bill', 9991, '0000-00-00 00:00:00'),
(54, 22, 12, 'Monthly Bill', 500, '8-9-2017'),
(55, 23, 13, 'Monthly Bill', 4, '23-9-2017'),
(56, 23, 13, 'Monthly Bill', 4, '23-10-2017'),
(57, 23, 13, 'Monthly Bill', 4, '23-11-2017'),
(58, 23, 13, 'Monthly Bill', 4, '23-12-2017'),
(59, 24, 14, 'Monthly Bill', 5, '16-8-2017'),
(60, 24, 14, 'Monthly Bill', 5, '16-9-2017'),
(61, 24, 14, 'Monthly Bill', 5, '16-10-2017'),
(62, 24, 14, 'Monthly Bill', 5, '16-11-2017'),
(63, 25, 15, 'Monthly Bill', 5, '11-9-2017'),
(64, 25, 15, 'Monthly Bill', 5, '11-10-2017'),
(65, 25, 15, 'Monthly Bill', 5, '11-11-2017'),
(66, 25, 15, 'Monthly Bill', 5, '11-12-2017'),
(67, 25, 15, 'Monthly Bill', 5, '11-1-2018'),
(68, 25, 15, 'Monthly Bill', 5, '11-2-2018'),
(69, 25, 15, 'Monthly Bill', 5, '11-3-2018'),
(70, 25, 15, 'Monthly Bill', 5, '11-4-2018'),
(71, 25, 15, 'Monthly Bill', 5, '11-5-2018'),
(72, 25, 15, 'Monthly Bill', 5, '11-6-2018'),
(73, 25, 15, 'Monthly Bill', 5, '11-7-2018'),
(74, 25, 15, 'Monthly Bill', 5, '11-8-2018'),
(75, 25, 15, 'Monthly Bill', 5, '11-9-2018'),
(76, 25, 15, 'Monthly Bill', 5, '11-10-2018'),
(77, 25, 15, 'Monthly Bill', 5, '11-11-2018'),
(78, 25, 15, 'Monthly Bill', 5, '11-12-2018'),
(79, 25, 15, 'Monthly Bill', 5, '11-1-2019'),
(80, 25, 15, 'Monthly Bill', 5, '11-2-2019'),
(81, 25, 15, 'Monthly Bill', 5, '11-3-2019'),
(82, 25, 15, 'Monthly Bill', 5, '11-4-2019'),
(83, 25, 15, 'Monthly Bill', 5, '11-5-2019'),
(84, 25, 15, 'Monthly Bill', 5, '11-6-2019'),
(85, 25, 15, 'Monthly Bill', 5, '11-7-2019'),
(86, 25, 15, 'Monthly Bill', 5, '11-8-2019'),
(87, 25, 15, 'Monthly Bill', 5, '11-9-2019'),
(88, 25, 15, 'Monthly Bill', 5, '11-10-2019'),
(89, 25, 15, 'Monthly Bill', 5, '11-11-2019'),
(90, 25, 15, 'Monthly Bill', 5, '11-12-2019'),
(91, 25, 15, 'Monthly Bill', 5, '11-1-2020'),
(92, 25, 15, 'Monthly Bill', 5, '11-2-2020'),
(93, 25, 15, 'Monthly Bill', 5, '11-3-2020'),
(94, 25, 15, 'Monthly Bill', 5, '11-4-2020'),
(95, 25, 15, 'Monthly Bill', 5, '11-5-2020'),
(96, 25, 15, 'Monthly Bill', 5, '11-6-2020'),
(97, 25, 15, 'Monthly Bill', 5, '11-7-2020'),
(98, 25, 15, 'Monthly Bill', 5, '11-8-2020'),
(99, 25, 15, 'Monthly Bill', 5, '11-9-2020'),
(100, 25, 15, 'Monthly Bill', 5, '11-10-2020'),
(101, 25, 15, 'Monthly Bill', 5, '11-11-2020'),
(102, 25, 15, 'Monthly Bill', 5, '11-12-2020'),
(103, 25, 15, 'Monthly Bill', 5, '11-1-2021'),
(104, 25, 15, 'Monthly Bill', 5, '11-2-2021'),
(105, 25, 15, 'Monthly Bill', 5, '11-3-2021'),
(106, 25, 15, 'Monthly Bill', 5, '11-4-2021'),
(107, 25, 15, 'Monthly Bill', 5, '11-5-2021'),
(108, 25, 15, 'Monthly Bill', 5, '11-6-2021'),
(109, 25, 15, 'Monthly Bill', 5, '11-7-2021'),
(110, 25, 15, 'Monthly Bill', 5, '11-8-2021'),
(111, 25, 15, 'Monthly Bill', 5, '11-9-2021'),
(112, 25, 15, 'Monthly Bill', 5, '11-10-2021'),
(113, 25, 15, 'Monthly Bill', 5, '11-11-2021'),
(114, 25, 15, 'Monthly Bill', 5, '11-12-2021'),
(115, 25, 15, 'Monthly Bill', 5, '11-1-2022'),
(116, 25, 15, 'Monthly Bill', 5, '11-2-2022'),
(117, 25, 15, 'Monthly Bill', 5, '11-3-2022'),
(118, 25, 15, 'Monthly Bill', 5, '11-4-2022'),
(119, 25, 15, 'Monthly Bill', 5, '11-5-2022'),
(120, 25, 15, 'Monthly Bill', 5, '11-6-2022'),
(121, 25, 15, 'Monthly Bill', 5, '11-7-2022'),
(122, 25, 15, 'Monthly Bill', 5, '11-8-2022'),
(123, 25, 15, 'Monthly Bill', 5, '11-9-2022'),
(124, 25, 15, 'Monthly Bill', 5, '11-10-2022'),
(125, 25, 15, 'Monthly Bill', 5, '11-11-2022'),
(126, 25, 15, 'Monthly Bill', 5, '11-12-2022'),
(127, 25, 15, 'Monthly Bill', 5, '11-1-2023'),
(128, 26, 16, 'Monthly Bill', 5, '7-8-2017'),
(129, 27, 17, 'Monthly Bill', 10000, '18-9-2017'),
(130, 27, 17, 'Monthly Bill', 10000, '18-10-2017'),
(131, 27, 17, 'Monthly Bill', 10000, '18-11-2017'),
(132, 27, 17, 'Monthly Bill', 10000, '18-12-2017'),
(133, 27, 17, 'Monthly Bill', 10000, '18-1-2018'),
(134, 27, 17, 'Monthly Bill', 10000, '18-2-2018'),
(135, 27, 17, 'Monthly Bill', 10000, '18-3-2018'),
(136, 27, 17, 'Monthly Bill', 10000, '18-4-2018'),
(137, 27, 17, 'Monthly Bill', 10000, '18-5-2018'),
(138, 27, 17, 'Monthly Bill', 10000, '18-6-2018'),
(139, 27, 17, 'Monthly Bill', 10000, '18-7-2018'),
(140, 27, 17, 'Monthly Bill', 10000, '18-8-2018'),
(141, 27, 17, 'Monthly Bill', 10000, '18-9-2018'),
(142, 27, 17, 'Monthly Bill', 10000, '18-10-2018'),
(143, 27, 17, 'Monthly Bill', 10000, '18-11-2018'),
(144, 27, 17, 'Monthly Bill', 10000, '18-12-2018'),
(145, 27, 17, 'Monthly Bill', 10000, '18-1-2019'),
(146, 27, 17, 'Monthly Bill', 10000, '18-2-2019'),
(147, 27, 17, 'Monthly Bill', 10000, '18-3-2019'),
(148, 27, 17, 'Monthly Bill', 10000, '18-4-2019'),
(149, 27, 17, 'Monthly Bill', 10000, '18-5-2019'),
(150, 27, 17, 'Monthly Bill', 10000, '18-6-2019'),
(151, 27, 17, 'Monthly Bill', 10000, '18-7-2019'),
(152, 27, 17, 'Monthly Bill', 10000, '18-8-2019'),
(153, 27, 17, 'Monthly Bill', 10000, '18-9-2019'),
(154, 27, 17, 'Monthly Bill', 10000, '18-10-2019'),
(155, 27, 17, 'Monthly Bill', 10000, '18-11-2019'),
(156, 27, 17, 'Monthly Bill', 10000, '18-12-2019'),
(157, 27, 17, 'Monthly Bill', 10000, '18-1-2020'),
(158, 27, 17, 'Monthly Bill', 10000, '18-2-2020'),
(159, 27, 17, 'Monthly Bill', 10000, '18-3-2020'),
(160, 27, 17, 'Monthly Bill', 10000, '18-4-2020'),
(161, 27, 17, 'Monthly Bill', 10000, '18-5-2020'),
(162, 27, 17, 'Monthly Bill', 10000, '18-6-2020'),
(163, 27, 17, 'Monthly Bill', 10000, '18-7-2020'),
(164, 27, 17, 'Monthly Bill', 10000, '18-8-2020'),
(165, 27, 17, 'Monthly Bill', 10000, '18-9-2020'),
(166, 27, 17, 'Monthly Bill', 10000, '18-10-2020'),
(167, 27, 17, 'Monthly Bill', 10000, '18-11-2020'),
(168, 27, 17, 'Monthly Bill', 10000, '18-12-2020'),
(169, 27, 17, 'Monthly Bill', 10000, '18-1-2021'),
(170, 27, 17, 'Monthly Bill', 10000, '18-2-2021'),
(171, 27, 17, 'Monthly Bill', 10000, '18-3-2021'),
(172, 27, 17, 'Monthly Bill', 10000, '18-4-2021'),
(173, 27, 17, 'Monthly Bill', 10000, '18-5-2021'),
(174, 27, 17, 'Monthly Bill', 10000, '18-6-2021'),
(175, 27, 17, 'Monthly Bill', 10000, '18-7-2021'),
(176, 27, 17, 'Monthly Bill', 10000, '18-8-2021'),
(177, 27, 17, 'Monthly Bill', 10000, '18-9-2021'),
(178, 27, 17, 'Monthly Bill', 10000, '18-10-2021'),
(179, 27, 17, 'Monthly Bill', 10000, '18-11-2021'),
(180, 27, 17, 'Monthly Bill', 10000, '18-12-2021'),
(181, 27, 17, 'Monthly Bill', 10000, '18-1-2022'),
(182, 27, 17, 'Monthly Bill', 10000, '18-2-2022'),
(183, 27, 17, 'Monthly Bill', 10000, '18-3-2022'),
(184, 27, 17, 'Monthly Bill', 10000, '18-4-2022'),
(185, 27, 17, 'Monthly Bill', 10000, '18-5-2022'),
(186, 27, 17, 'Monthly Bill', 10000, '18-6-2022'),
(187, 27, 17, 'Monthly Bill', 10000, '18-7-2022'),
(188, 27, 17, 'Monthly Bill', 10000, '18-8-2022'),
(189, 27, 17, 'Monthly Bill', 10000, '18-9-2022'),
(190, 27, 17, 'Monthly Bill', 10000, '18-10-2022'),
(191, 27, 17, 'Monthly Bill', 10000, '18-11-2022'),
(192, 27, 17, 'Monthly Bill', 10000, '18-12-2022'),
(193, 27, 17, 'Monthly Bill', 10000, '18-1-2023'),
(194, 27, 17, 'Monthly Bill', 10000, '18-2-2023'),
(195, 27, 17, 'Monthly Bill', 10000, '18-3-2023'),
(196, 27, 17, 'Monthly Bill', 10000, '18-4-2023'),
(197, 27, 17, 'Monthly Bill', 10000, '18-5-2023'),
(198, 27, 17, 'Monthly Bill', 10000, '18-6-2023'),
(199, 27, 17, 'Monthly Bill', 10000, '18-7-2023'),
(200, 27, 17, 'Monthly Bill', 10000, '18-8-2023'),
(201, 28, 18, 'Monthly Bill', 500, '14-9-2017'),
(202, 28, 18, 'Monthly Bill', 500, '14-10-2017'),
(203, 28, 18, 'Monthly Bill', 500, '14-11-2017'),
(204, 28, 18, 'Monthly Bill', 500, '14-12-2017'),
(205, 28, 18, 'Monthly Bill', 500, '14-1-2018'),
(206, 28, 18, 'Monthly Bill', 500, '14-2-2018'),
(207, 28, 18, 'Monthly Bill', 500, '14-3-2018'),
(208, 28, 18, 'Monthly Bill', 500, '14-4-2018'),
(209, 28, 18, 'Monthly Bill', 500, '14-5-2018'),
(210, 28, 18, 'Monthly Bill', 500, '14-6-2018'),
(211, 28, 18, 'Monthly Bill', 500, '14-7-2018'),
(212, 28, 18, 'Monthly Bill', 500, '14-8-2018'),
(213, 28, 18, 'Monthly Bill', 500, '14-9-2018'),
(214, 28, 18, 'Monthly Bill', 500, '14-10-2018'),
(215, 28, 18, 'Monthly Bill', 500, '14-11-2018'),
(216, 28, 18, 'Monthly Bill', 500, '14-12-2018'),
(217, 28, 18, 'Monthly Bill', 500, '14-1-2019'),
(218, 28, 18, 'Monthly Bill', 500, '14-2-2019'),
(219, 28, 18, 'Monthly Bill', 500, '14-3-2019'),
(220, 28, 18, 'Monthly Bill', 500, '14-4-2019'),
(221, 28, 18, 'Monthly Bill', 500, '14-5-2019'),
(222, 28, 18, 'Monthly Bill', 500, '14-6-2019'),
(223, 28, 18, 'Monthly Bill', 500, '14-7-2019'),
(224, 28, 18, 'Monthly Bill', 500, '14-8-2019'),
(225, 28, 18, 'Monthly Bill', 500, '14-9-2019'),
(226, 28, 18, 'Monthly Bill', 500, '14-10-2019'),
(227, 28, 18, 'Monthly Bill', 500, '14-11-2019'),
(228, 28, 18, 'Monthly Bill', 500, '14-12-2019'),
(229, 28, 18, 'Monthly Bill', 500, '14-1-2020'),
(230, 28, 18, 'Monthly Bill', 500, '14-2-2020'),
(231, 28, 18, 'Monthly Bill', 500, '14-3-2020'),
(232, 28, 18, 'Monthly Bill', 500, '14-4-2020'),
(233, 28, 18, 'Monthly Bill', 500, '14-5-2020'),
(234, 28, 18, 'Monthly Bill', 500, '14-6-2020'),
(235, 28, 18, 'Monthly Bill', 500, '14-7-2020'),
(236, 28, 18, 'Monthly Bill', 500, '14-8-2020');

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
(14, 1, 'Lobby');

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
  `security_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `_owner`
--

INSERT INTO `_owner` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `security_question`, `security_answer`) VALUES
(1, 'imran7128', 'imranhussain7128@gmail.com', 'v2rocket', 'Syed Imran', 'Hussain', 'What is your name?', 'Imran'),
(2, 'imranimran', 'citadel101@outlook.ph', 'imranimran', 'Syed Imran', 'HYo', 'What is your other name?', 'Awesome');

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
  `tr_id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double(255,0) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
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

--
-- Dumping data for table `_tenantprofile`
--

INSERT INTO `_tenantprofile` (`id`, `oid`, `firstName`, `lastName`, `userName`, `password`, `address`, `email`, `contactNumber`, `guardianName`, `guardianAddress`, `guardianContact`, `balance`) VALUES
(27, '1', 'm', 'm', 'm1', 'm1', 'm', 'm@gmail.com', '1', 'm', 'm', '5', 720000.00),
(28, '1', 'u', 'u', 'u1', 'u1', 'u', 'u@gmail.com', 'u', 'u', 'u', 'u', 18000.00);

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
(17, 27, 1, 0.00, '01-08-2017', '13-07-2023', 72, 18, 720000.00, 10000.00),
(18, 28, 38, 0.00, '01-08-2017', '01-08-2020', 36, 14, 18000.00, 500.00);

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
(1, 14, 'One', 1, 10000.00, 10000.00, 1),
(38, 14, 'Two', 1, 500.00, 500.00, 1),
(39, 14, 'Three', 1, 1.00, 1.00, 0),
(40, 14, 'Four', 1, 5.00, 5.00, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `_bill`
--
ALTER TABLE `_bill`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT for table `_floor`
--
ALTER TABLE `_floor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `_owner`
--
ALTER TABLE `_owner`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `_payments`
--
ALTER TABLE `_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_tenantprofile`
--
ALTER TABLE `_tenantprofile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `_tenantrentinginformation`
--
ALTER TABLE `_tenantrentinginformation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `_unit`
--
ALTER TABLE `_unit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
