-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2019 at 04:23 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_list`
--

CREATE TABLE IF NOT EXISTS `agent_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ware` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `commision` int(11) NOT NULL,
  `cmp_name` varchar(30) NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  `module` int(1) NOT NULL,
  `trace` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `agent_list`
--

INSERT INTO `agent_list` (`id`, `ware`, `code`, `name`, `email`, `phone`, `address`, `commision`, `cmp_name`, `date_time`, `by`, `module`, `trace`) VALUES
(1, 1, 'agent-201902-1', 'abdul kader', 'kader@gmail.com', '01999999999', '', 10, 'a to z', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `gross_amount` double NOT NULL,
  `dis_taka` double NOT NULL,
  `dis_per` int(20) NOT NULL,
  `cash` double NOT NULL,
  `b_type` int(20) NOT NULL,
  `gross_dis` double NOT NULL,
  `change` double NOT NULL,
  `date` date NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `ware_house` varchar(20) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `by` varchar(20) NOT NULL,
  `voucher` varchar(20) NOT NULL,
  `card` double NOT NULL,
  `due` double NOT NULL,
  `noti` int(20) NOT NULL,
  `issu` int(20) NOT NULL,
  `ware` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `to_ware` int(11) NOT NULL,
  `invoice` int(20) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `bk_id` varchar(10) NOT NULL,
  `bk_amount` double NOT NULL,
  `bk` varchar(1) NOT NULL,
  `pdate` date NOT NULL,
  `store` int(11) NOT NULL,
  `con_time` text NOT NULL,
  `ap_date` date NOT NULL,
  `approve` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invoice`
--


-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE IF NOT EXISTS `payment_info` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_mode` int(11) NOT NULL,
  `date` date NOT NULL,
  `tax` varchar(15) NOT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `ware` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `trace` int(11) NOT NULL,
  `resv_id` int(11) NOT NULL,
  `by` text NOT NULL,
  `module` int(1) NOT NULL,
  `pay_type` int(1) NOT NULL DEFAULT '22',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`pay_id`, `pay_mode`, `date`, `tax`, `amount`, `remarks`, `ware`, `date_time`, `trace`, `resv_id`, `by`, `module`, `pay_type`) VALUES
(1, 4, '2019-02-12', '1000', 3000, 'aaasdfdfsdf', 1, '2019-02-13 13:46:41', 0, 6, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 22),
(2, 4, '2019-02-17', '222', 233222, 'eeee', 1, '2019-02-17 18:23:46', 0, 1, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 24);

-- --------------------------------------------------------

--
-- Table structure for table `product_trans`
--

CREATE TABLE IF NOT EXISTS `product_trans` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cheque_no` varchar(20) NOT NULL,
  `cheque_date` date NOT NULL,
  `dr` varchar(20) NOT NULL,
  `cr` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `voucher` int(20) NOT NULL,
  `by` text NOT NULL,
  `noti` int(2) NOT NULL,
  `show` int(2) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `l_id` int(20) NOT NULL,
  `d_c` varchar(20) NOT NULL,
  `l_type` varchar(20) NOT NULL,
  `ware` int(11) NOT NULL,
  `trans` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `cash` varchar(2) NOT NULL,
  `store` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `pf_id` int(11) NOT NULL COMMENT 'salary generated id',
  `con_time` text NOT NULL,
  `pay_id` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `resv_id` int(11) NOT NULL,
  `trace` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `sett_season`
--

CREATE TABLE IF NOT EXISTS `sett_season` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `season_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `ware` int(11) NOT NULL,
  `module` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `pby` int(11) NOT NULL,
  `trace` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sett_season`
--

INSERT INTO `sett_season` (`id`, `season_name`, `start_date`, `end_date`, `ware`, `module`, `status`, `pby`, `trace`) VALUES
(1, 'Off season', '2019-02-07', '2019-02-08', 2, 1, 1, 1, 0),
(2, 'Regular Season', '2019-02-07', '2019-02-13', 1, 1, 1, 1, 0),
(3, 'Off Season', '2019-02-07', '2019-02-13', 1, 1, 1, 1, 0),
(4, 'On Season', '2019-02-14', '2019-02-27', 1, 1, 1, 1, 0),
(5, 'On Season', '2019-02-07', '2019-02-21', 2, 1, 1, 1, 0),
(6, 'Regular Season', '2019-02-14', '2019-02-28', 2, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblfloorlist`
--

CREATE TABLE IF NOT EXISTS `tblfloorlist` (
  `floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_no` varchar(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `trace` int(11) NOT NULL,
  `by` text NOT NULL,
  `module` int(1) NOT NULL,
  PRIMARY KEY (`floor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblfloorlist`
--

INSERT INTO `tblfloorlist` (`floor_id`, `floor_no`, `hid`, `ware`, `status`, `date_time`, `trace`, `by`, `module`) VALUES
(1, '101', 0, 1, 0, '2019-02-06 13:33:11', 0, '', 0),
(2, '101', 0, 2, 0, '2019-01-31 12:10:26', 0, '', 0),
(3, '102', 0, 1, 0, '2019-02-02 16:08:37', 1, '1', 0),
(4, '103', 0, 2, 0, '2019-01-31 12:23:28', 0, '', 0),
(5, '101', 0, 2, 0, '2019-02-02 15:55:13', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allotment`
--

CREATE TABLE IF NOT EXISTS `tbl_allotment` (
  `allot_id` int(11) NOT NULL AUTO_INCREMENT,
  `isComplete` int(1) NOT NULL DEFAULT '0',
  `trace` int(11) NOT NULL DEFAULT '0',
  `agent_id` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `allot_code` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  PRIMARY KEY (`allot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_allotment`
--

INSERT INTO `tbl_allotment` (`allot_id`, `isComplete`, `trace`, `agent_id`, `ware`, `allot_code`, `date`, `remarks`, `date_time`, `by`) VALUES
(1, 1, 0, 1, 1, 'allot-201902-1', '2019-02-17', '', '2019-02-17 18:23:46', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest_info`
--

CREATE TABLE IF NOT EXISTS `tbl_guest_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ware` int(11) NOT NULL,
  `resv_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mobile_no` text NOT NULL,
  `address` text NOT NULL,
  `country` int(11) NOT NULL,
  `indentity` int(11) NOT NULL,
  `doc_no` text NOT NULL,
  `room_type` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  `module` int(1) NOT NULL,
  `trace` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_guest_info`
--

INSERT INTO `tbl_guest_info` (`id`, `ware`, `resv_id`, `name`, `email`, `mobile_no`, `address`, `country`, `indentity`, `doc_no`, `room_type`, `date_time`, `by`, `module`, `trace`) VALUES
(1, 1, 1, '', '', '', '                                                                    ', 0, 0, '', 0, '2019-02-13 13:48:31', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(2, 1, 2, '', '', '', '', 0, 0, '', 0, '2019-02-10 12:01:55', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(3, 1, 3, '', '', '', '', 0, 0, '', 0, '2019-02-10 13:30:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(4, 1, 4, '', '', '', '', 0, 0, '', 0, '2019-02-11 12:11:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(5, 1, 5, 'rrr', 'rrr', '', '', 0, 0, '', 0, '2019-02-12 13:56:03', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(6, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 1),
(7, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 1),
(8, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 1),
(9, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 1),
(10, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(11, 1, 6, 'sdfsdf', 'sfsf', 'sdfsd', '                                    sdfsdfs                                ', 0, 0, '', 0, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay_bank_info`
--

CREATE TABLE IF NOT EXISTS `tbl_pay_bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` varchar(30) NOT NULL,
  `resv_id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `chq_number` varchar(30) NOT NULL,
  `chq_date` date NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `ware` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  `trace` int(11) NOT NULL,
  `module` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_pay_bank_info`
--

INSERT INTO `tbl_pay_bank_info` (`id`, `account_number`, `resv_id`, `pay_id`, `branch_name`, `chq_number`, `chq_date`, `bank_name`, `ware`, `date_time`, `by`, `trace`, `module`) VALUES
(1, 'asdfsfd', 6, 1, '0', '0', '2019-02-12', 'safa', 1, '2019-02-12 14:09:00', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(2, 'asdfsfd', 6, 1, '0', '0', '2019-02-12', 'safa', 1, '2019-02-12 14:12:12', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(3, 'asdfsfd', 6, 1, '0', '0', '2019-02-12', 'safa', 1, '2019-02-12 14:15:05', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(4, '2221111', 6, 1, '0', '3', '2019-02-13', '2222', 1, '2019-02-13 13:44:42', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(5, '2221111', 6, 1, '0', '3', '2019-02-13', '2222', 1, '2019-02-13 13:45:02', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(6, '2221111', 6, 1, '55555', '55555555ddd', '2019-02-13', '2222', 1, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(7, '0222', 1, 2, '0222', '2222', '2019-02-17', '222', 1, '2019-02-17 18:22:36', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(8, '0222', 1, 2, '0222', '2222', '2019-02-17', '222', 1, '2019-02-17 18:22:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(9, '0222', 1, 2, '0222', '2222', '2019-02-17', '222', 1, '2019-02-17 18:23:46', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rent`
--

CREATE TABLE IF NOT EXISTS `tbl_rent` (
  `rent_id` int(11) NOT NULL,
  `rent` float DEFAULT NULL,
  `rent_season` int(11) DEFAULT NULL,
  `trace` int(11) DEFAULT NULL,
  `rent_room_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ware` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rent`
--

INSERT INTO `tbl_rent` (`rent_id`, `rent`, `rent_season`, `trace`, `rent_room_id`, `status`, `ware`) VALUES
(1, 1000, 1, 0, 1, 0, 0),
(2, 1500, 6, 0, 1, 0, 0),
(3, 1200, 6, 0, 5, 0, 0),
(4, 1300, 2, 0, 6, 0, 0),
(5, 1100, 2, 0, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE IF NOT EXISTS `tbl_reservation` (
  `resv_id` int(11) NOT NULL AUTO_INCREMENT,
  `ware` int(11) DEFAULT NULL,
  `resv_date` date DEFAULT NULL,
  `agent` int(11) DEFAULT NULL,
  `adult` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `resv_code` varchar(50) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `trace` int(11) NOT NULL DEFAULT '0',
  `room_type` int(11) NOT NULL,
  `resv_type` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  `isComplete` int(1) NOT NULL,
  `module` int(1) NOT NULL,
  PRIMARY KEY (`resv_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`resv_id`, `ware`, `resv_date`, `agent`, `adult`, `children`, `resv_code`, `season`, `trace`, `room_type`, `resv_type`, `date_time`, `by`, `isComplete`, `module`) VALUES
(1, 1, '2019-02-10', 0, 0, 0, 'resv-201902-1', 1, 0, 1, 1, '2019-02-13 13:48:31', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0),
(2, 1, '2019-02-10', NULL, 0, 0, 'resv-201902-2', 1, 0, 1, 1, '2019-02-10 12:01:55', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(3, 1, '2019-02-10', NULL, 0, 0, 'resv-201902-3', 1, 0, 1, 1, '2019-02-10 13:30:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(4, 1, '2019-02-11', NULL, 0, 0, 'resv-201902-4', 1, 0, 1, 1, '2019-02-11 12:11:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(5, 1, '2019-02-12', NULL, 0, 0, 'resv-201902-5', 1, 0, 1, 1, '2019-02-12 13:56:03', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 0, 0),
(6, 1, '2019-02-12', 0, 12, 2, 'resv-201902-6', 1, 0, 1, 1, '2019-02-13 13:46:41', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_allotment`
--

CREATE TABLE IF NOT EXISTS `tbl_room_allotment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allot_ref_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `rent` float NOT NULL,
  `season_id` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `date_time` text NOT NULL,
  `by` text NOT NULL,
  `conv_start_datetime` bigint(20) NOT NULL,
  `conv_end_datetime` bigint(20) NOT NULL,
  `trace` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_room_allotment`
--

INSERT INTO `tbl_room_allotment` (`id`, `allot_ref_id`, `agent_id`, `ware`, `room_id`, `from_date`, `to_date`, `rent`, `season_id`, `release_date`, `date_time`, `by`, `conv_start_datetime`, `conv_end_datetime`, `trace`) VALUES
(1, 25, 1, 1, 5, '2019-02-22', '2019-02-22', 1100, 2, '0000-00-00', '2019-02-17 18:17:50', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1550768400, 1550768400, 0),
(3, 1, 1, 1, 5, '2019-02-17', '2019-02-17', 1100, 2, '0000-00-00', '2019-02-17 18:18:19', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1550336400, 1550336400, 0),
(4, 1, 1, 1, 6, '2019-02-17', '2019-02-17', 1300, 2, '0000-00-00', '2019-02-17 18:18:19', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1550336400, 1550336400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_check_in`
--

CREATE TABLE IF NOT EXISTS `tbl_room_check_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ware` int(11) NOT NULL,
  `resv_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_no` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_day` int(11) NOT NULL,
  `season` int(20) NOT NULL,
  `rent` varchar(20) NOT NULL,
  `room_type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `by` text NOT NULL,
  `conv_start_datetime` bigint(30) NOT NULL,
  `conv_end_datetime` bigint(30) NOT NULL,
  `date_time` text NOT NULL,
  `module` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_room_check_in`
--

INSERT INTO `tbl_room_check_in` (`id`, `ware`, `resv_id`, `room_id`, `bed_no`, `start_date`, `end_date`, `total_day`, `season`, `rent`, `room_type`, `status`, `by`, `conv_start_datetime`, `conv_end_datetime`, `date_time`, `module`) VALUES
(16, 1, 2, 1, 0, '2019-02-10', '2019-02-10', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549731600, 1549731600, '2019-02-10 12:01:55', 0),
(20, 1, 3, 5, 0, '2019-02-10', '2019-02-10', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549731600, 1549731600, '2019-02-10 13:30:52', 0),
(21, 1, 5, 5, 0, '2019-02-12', '2019-02-12', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549904400, 1549904400, '2019-02-12 13:56:03', 0),
(22, 1, 5, 6, 0, '2019-02-12', '2019-02-12', 0, 1, '0', 1, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549904400, 1549904400, '2019-02-12 13:56:04', 0),
(23, 1, 6, 1, 0, '2019-02-12', '2019-02-12', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549904400, 1549904400, '2019-02-12 14:03:51', 0),
(24, 1, 6, 1, 0, '2019-02-13', '2019-02-13', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549990800, 1549990800, '2019-02-12 14:22:01', 0),
(30, 1, 1, 5, 0, '2019-02-13', '2019-02-13', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549990800, 1549990800, '2019-02-13 13:48:27', 0),
(31, 1, 1, 6, 0, '2019-02-13', '2019-02-13', 0, 1, '0', 1, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549990800, 1549990800, '2019-02-13 13:48:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_info`
--

CREATE TABLE IF NOT EXISTS `tbl_room_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` varchar(50) NOT NULL,
  `ware` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `total_bed` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `trace` int(1) NOT NULL,
  `rent` float NOT NULL,
  `module` int(1) NOT NULL,
  `season` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_room_info`
--

INSERT INTO `tbl_room_info` (`id`, `room_no`, `ware`, `floor`, `room_type`, `total_bed`, `status`, `date_time`, `trace`, `rent`, `module`, `season`) VALUES
(1, '101', 1, 1, 2, '100', 1, '2019-02-06 15:16:21', 0, 2000, 0, 1),
(5, '102', 1, 1, 2, '100', 0, '2019-02-06 15:18:23', 0, 0, 0, 2),
(6, '105', 1, 1, 1, '50', 1, '2019-02-06 15:16:21', 0, 0, 0, 1),
(7, '101', 1, 1, 2, '100', 0, '', 0, 1000, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `type_list`
--

CREATE TABLE IF NOT EXISTS `type_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '20=room_type',
  `ware` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `module` int(1) NOT NULL,
  `trace` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `type_list`
--

INSERT INTO `type_list` (`id`, `type_name`, `type_id`, `ware`, `status`, `module`, `trace`) VALUES
(1, 'Single', 20, 0, 1, 0, 0),
(2, 'Double', 20, 0, 1, 0, 0),
(3, 'Cash', 21, 0, 1, 0, 0),
(4, 'Bank', 21, 0, 1, 0, 0),
(5, 'Bkash', 21, 0, 1, 0, 0),
(6, 'Room Reservation', 22, 0, 1, 0, 0),
(8, 'Allotment', 24, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ware`
--

CREATE TABLE IF NOT EXISTS `ware` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `country` int(11) NOT NULL,
  `isImage` text NOT NULL,
  `status` int(11) NOT NULL,
  `trace` int(1) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `module` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ware`
--

INSERT INTO `ware` (`id`, `hotel_name`, `address`, `country`, `isImage`, `status`, `trace`, `start_time`, `end_time`, `module`) VALUES
(1, 'BD Hotel.Com', '', 0, '', 0, 0, 0, 0, 0),
(2, 'Ctg Hotel.Com', 'abc', 0, '', 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
