/*
Navicat MySQL Data Transfer

Source Server         : abcs
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : abcd

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2017-08-16 10:59:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for _floors
-- ----------------------------
DROP TABLE IF EXISTS `_floors`;
CREATE TABLE `_floors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `floorName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _floors
-- ----------------------------
INSERT INTO `_floors` VALUES ('1', 'Imran', 'imran7128');
INSERT INTO `_floors` VALUES ('2', 'Second', 'imran7128');
INSERT INTO `_floors` VALUES ('3', 'Third', 'imran7128');
INSERT INTO `_floors` VALUES ('4', 'Fourth', 'imran7128');
INSERT INTO `_floors` VALUES ('5', 'Fifth', 'imran7128');
INSERT INTO `_floors` VALUES ('6', '8', 'imran7128');

-- ----------------------------
-- Table structure for _owners
-- ----------------------------
DROP TABLE IF EXISTS `_owners`;
CREATE TABLE `_owners` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` tinytext NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _owners
-- ----------------------------
INSERT INTO `_owners` VALUES ('3', 'imran7128', 'imranhussain7128@gmail.com', 'imranimran', 'Syed Imran', 'Hussain', 'What is your name?', 'Imran');
INSERT INTO `_owners` VALUES ('4', 'imranimran', 'imran@gmail.com', 'imranimran', 'Imran ', 'Hussain', 'Hello', 'Hi');

-- ----------------------------
-- Table structure for _owner_dorm
-- ----------------------------
DROP TABLE IF EXISTS `_owner_dorm`;
CREATE TABLE `_owner_dorm` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _owner_dorm
-- ----------------------------

-- ----------------------------
-- Table structure for _tenantprofile
-- ----------------------------
DROP TABLE IF EXISTS `_tenantprofile`;
CREATE TABLE `_tenantprofile` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `owner` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _tenantprofile
-- ----------------------------

-- ----------------------------
-- Table structure for _tenantrentinginformation
-- ----------------------------
DROP TABLE IF EXISTS `_tenantrentinginformation`;
CREATE TABLE `_tenantrentinginformation` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `floorName` varchar(255) DEFAULT NULL,
  `unitName` varchar(255) DEFAULT NULL,
  `downpayment` double(255,2) DEFAULT NULL,
  `issueDate` date NOT NULL,
  `balance` double(255,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _tenantrentinginformation
-- ----------------------------

-- ----------------------------
-- Table structure for _units
-- ----------------------------
DROP TABLE IF EXISTS `_units`;
CREATE TABLE `_units` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `rent` double(255,2) NOT NULL,
  `unitName` varchar(255) NOT NULL,
  `floorName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `tenant` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of _units
-- ----------------------------
INSERT INTO `_units` VALUES ('1', '10000.00', 'One', 'Imran', 'imran7128', '0', '0');
INSERT INTO `_units` VALUES ('2', '25000.00', 'Two', 'Second', 'imran7128', '0', '0');
