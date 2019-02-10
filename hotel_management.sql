-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2019 at 06:42 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `sett_country`
--

CREATE TABLE `sett_country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `pby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_country`
--

INSERT INTO `sett_country` (`id`, `name`, `p_id`, `type`, `ware`, `module`, `pby`) VALUES
(1, 'BD', 0, 1, 1, 0, 1),
(2, 'USA', 0, 1, 1, 0, 1),
(3, 'KSA', 0, 1, 1, 0, 1),
(4, 'Ctg', 1, 2, 1, 0, 1),
(5, 'Riyad', 3, 2, 1, 0, 1),
(6, 'Muradpur', 4, 3, 1, 0, 1),
(9, 'Makka', 3, 2, 1, 0, 1),
(10, 'Dhaka', 1, 2, 1, 0, 1),
(11, 'Gulshan', 10, 3, 1, 0, 1),
(12, 'Sylhet', 1, 2, 1, 0, 1),
(13, 'Rajshahi', 1, 2, 1, 0, 1),
(14, 'Riyad city', 5, 3, 1, 0, 1),
(22, 'Dubai', 0, 1, 1, 0, 1),
(26, 'Jessore', 1, 2, 1, 0, 1),
(28, 'Makka city', 5, 3, 1, 0, 1),
(31, 'Australia', 0, 1, 1, 0, 1),
(32, 'State of Ausralia', 31, 2, 1, 0, 1),
(33, 'adfa', 0, 1, 1, 0, 1),
(34, 'asdf', 33, 2, 1, 0, 1),
(35, 'adsf', 34, 3, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sett_menu`
--

CREATE TABLE `sett_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 = main menu, 1 = submenu',
  `module` int(11) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `ware` int(11) NOT NULL,
  `pby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = Inactive , 1 = Active , 2 = Disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_menu`
--

INSERT INTO `sett_menu` (`id`, `name`, `p_id`, `type`, `module`, `controller`, `ware`, `pby`, `status`) VALUES
(7, 'menu 5', 0, 0, 3, 'controller 5', 1, 62, 1),
(8, 'Leave', 0, 0, 3, 'leave', 1, 62, 1),
(9, 'menu', 0, 0, 4, 'controller', 1, 62, 1),
(11, 'Add Vehicle', 0, 0, 2, 'vehicle', 1, 1, 1),
(12, 'Holiday', 0, 0, 3, 'holiday', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sett_modules`
--

CREATE TABLE `sett_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_modules`
--

INSERT INTO `sett_modules` (`id`, `name`, `module`, `ware`, `status`) VALUES
(1, 'Restaurant', 0, 1, 1),
(2, 'Parking', 0, 1, 1),
(3, 'Payroll', 0, 1, 1),
(4, 'HRM', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sett_season`
--

CREATE TABLE `sett_season` (
  `id` int(11) NOT NULL,
  `season_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `ware` int(11) NOT NULL,
  `module` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `pby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sett_season`
--

INSERT INTO `sett_season` (`id`, `season_name`, `start_date`, `end_date`, `ware`, `module`, `status`, `pby`) VALUES
(1, 'name of season', '2019-02-07', '2019-02-08', 2, 1, 1, 1),
(2, 'Regular 2', '2019-02-07', '2019-02-13', 1, 1, 1, 1),
(3, 'Regular 3', '2019-02-07', '2019-02-13', 1, 1, 1, 1),
(4, 'Regular 4', '2019-02-14', '2019-02-27', 1, 1, 1, 1),
(5, 'Off Season', '2019-02-07', '2019-02-21', 2, 1, 1, 1),
(6, 'Regular 5', '2019-02-14', '2019-02-28', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblfloorlist`
--

CREATE TABLE `tblfloorlist` (
  `floor_id` int(11) NOT NULL,
  `floor_no` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `trace` int(11) NOT NULL,
  `by` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfloorlist`
--

INSERT INTO `tblfloorlist` (`floor_id`, `floor_no`, `hid`, `ware`, `status`, `date_time`, `trace`, `by`) VALUES
(1, 101, 0, 1, 0, '2019-02-06 13:33:11', 0, ''),
(2, 101, 0, 1, 0, '2019-02-07 11:54:03', 0, ''),
(3, 102, 0, 1, 0, '2019-02-02 16:08:37', 1, '1'),
(4, 103, 0, 2, 0, '2019-01-31 12:23:28', 0, ''),
(5, 101, 0, 2, 0, '2019-02-02 15:55:13', 0, ''),
(6, 200, 0, 1, 0, '2019-02-07 15:08:28', 1, '1'),
(7, 120, 0, 1, 0, '2019-02-10 23:25:18', 0, ''),
(8, 110, 0, 1, 0, '2019-02-10 23:25:03', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest_info`
--

CREATE TABLE `tbl_guest_info` (
  `id` int(11) NOT NULL,
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
  `by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guest_info`
--

INSERT INTO `tbl_guest_info` (`id`, `ware`, `resv_id`, `name`, `email`, `mobile_no`, `address`, `country`, `indentity`, `doc_no`, `room_type`, `date_time`, `by`) VALUES
(1, 1, 1, '', '', '', '', 0, 0, '', 0, '2019-02-10 11:59:10', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1'),
(2, 1, 2, '', '', '', '', 0, 0, '', 0, '2019-02-10 12:01:55', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1'),
(3, 1, 3, '', '', '', '', 0, 0, '', 0, '2019-02-10 13:30:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `resv_id` int(11) NOT NULL,
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
  `by` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`resv_id`, `ware`, `resv_date`, `agent`, `adult`, `children`, `resv_code`, `season`, `trace`, `room_type`, `resv_type`, `date_time`, `by`) VALUES
(1, 1, '2019-02-10', NULL, 0, 0, 'resv-201902-1', 1, 0, 1, 1, '2019-02-10 11:59:10', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1'),
(2, 1, '2019-02-10', NULL, 0, 0, 'resv-201902-2', 1, 0, 1, 1, '2019-02-10 12:01:55', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1'),
(3, 1, '2019-02-10', NULL, 0, 0, 'resv-201902-3', 1, 0, 1, 1, '2019-02-10 13:30:52', 'Pc Name : cursor-PC,Ip Address: ::1, user id:1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_check_in`
--

CREATE TABLE `tbl_room_check_in` (
  `id` int(11) NOT NULL,
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
  `conv_start_datetime` int(30) NOT NULL,
  `conv_end_datetime` int(30) NOT NULL,
  `date_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_room_check_in`
--

INSERT INTO `tbl_room_check_in` (`id`, `ware`, `resv_id`, `room_id`, `bed_no`, `start_date`, `end_date`, `total_day`, `season`, `rent`, `room_type`, `status`, `by`, `conv_start_datetime`, `conv_end_datetime`, `date_time`) VALUES
(16, 1, 2, 1, 0, '2019-02-10', '2019-02-10', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549731600, 1549731600, '2019-02-10 12:01:55'),
(20, 1, 3, 5, 0, '2019-02-10', '2019-02-10', 0, 1, '0', 2, 0, 'Pc Name : cursor-PC,Ip Address: ::1, user id:1', 1549731600, 1549731600, '2019-02-10 13:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_info`
--

CREATE TABLE `tbl_room_info` (
  `id` int(11) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `ware` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `total_bed` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  `date_time` text NOT NULL,
  `trace` int(1) NOT NULL,
  `rent` varchar(255) NOT NULL,
  `season` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_room_info`
--

INSERT INTO `tbl_room_info` (`id`, `room_no`, `ware`, `floor`, `room_type`, `total_bed`, `status`, `date_time`, `trace`, `rent`, `season`) VALUES
(1, '101', 1, 1, 2, '100', 1, '2019-02-06 15:16:21', 0, '', 0),
(5, '102', 1, 1, 2, '100', 0, '2019-02-06 15:18:23', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_list`
--

CREATE TABLE `type_list` (
  `id` int(11) NOT NULL,
  `type_name` varchar(30) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ware` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_list`
--

INSERT INTO `type_list` (`id`, `type_name`, `type_id`, `ware`, `status`) VALUES
(1, 'Single', 20, 0, 1),
(2, 'Double', 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ware`
--

CREATE TABLE `ware` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `country` int(11) NOT NULL,
  `isImage` text NOT NULL,
  `status` int(11) NOT NULL,
  `module` int(11) NOT NULL DEFAULT '1',
  `trace` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ware`
--

INSERT INTO `ware` (`id`, `hotel_name`, `address`, `country`, `isImage`, `status`, `module`, `trace`) VALUES
(1, 'BD Hotel.Com', '', 0, '', 0, 1, 0),
(2, 'Ctg Hotel.Com', 'abc', 0, '', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sett_country`
--
ALTER TABLE `sett_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sett_menu`
--
ALTER TABLE `sett_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sett_modules`
--
ALTER TABLE `sett_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sett_season`
--
ALTER TABLE `sett_season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfloorlist`
--
ALTER TABLE `tblfloorlist`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `tbl_guest_info`
--
ALTER TABLE `tbl_guest_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`resv_id`);

--
-- Indexes for table `tbl_room_check_in`
--
ALTER TABLE `tbl_room_check_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room_info`
--
ALTER TABLE `tbl_room_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_list`
--
ALTER TABLE `type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ware`
--
ALTER TABLE `ware`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sett_country`
--
ALTER TABLE `sett_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sett_menu`
--
ALTER TABLE `sett_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sett_modules`
--
ALTER TABLE `sett_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sett_season`
--
ALTER TABLE `sett_season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblfloorlist`
--
ALTER TABLE `tblfloorlist`
  MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_guest_info`
--
ALTER TABLE `tbl_guest_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `resv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_room_check_in`
--
ALTER TABLE `tbl_room_check_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_room_info`
--
ALTER TABLE `tbl_room_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_list`
--
ALTER TABLE `type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ware`
--
ALTER TABLE `ware`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
