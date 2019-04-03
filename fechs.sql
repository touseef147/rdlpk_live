-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2014 at 06:18 AM
-- Server version: 5.5.16-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fechs`
--
CREATE DATABASE IF NOT EXISTS `fechs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fechs`;

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE IF NOT EXISTS `app` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `project` varchar(256) NOT NULL,
  `member_name` varchar(50) DEFAULT NULL,
  `CNIC` varchar(256) NOT NULL,
  `app_no` int(128) NOT NULL,
  `plot_size` varchar(50) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`id`, `project`, `member_name`, `CNIC`, `app_no`, `plot_size`, `email`, `mobile`, `status`) VALUES
(1, '1', 'Kashif', '786876876876', 0, '6 Marla', 'sohaib@gmail.com', '8767868768', 'Open'),
(2, '1', 'Sohaib', '', 0, '6 Marla', '', '', ''),
(3, '1', 'Waqas', '', 0, '6 Marla', '', '', ''),
(4, '1', 'Waqar', '', 0, '6 Marla', '', '', ''),
(5, '1', 'Iqbal', '', 0, '6 Marla', '', '', ''),
(6, '', 'iqbal2', '', 0, '30X50', '', '', ''),
(7, '', 'iqbal3', '', 0, '5 marla', '', '', ''),
(8, '', 'iqbal4', '', 0, '30x50', '', '', ''),
(9, '', 'iqbal5', '', 0, '30x50', '', '', ''),
(10, '', 'iqbal6', '', 0, '30x50', '', '', ''),
(11, '', 'iqbal7', '', 0, '30x50', '', '', ''),
(12, '', 'iqbal8', '', 0, '30x50', '', '', ''),
(13, '', 'Younis', '', 0, '30x70', '', '', ''),
(14, '', 'Younis', '', 0, '50x80', '', '', ''),
(15, '', 'Burhan', '', 0, '30x90', '', '', ''),
(16, '', 'sohaib', '', 0, '30x50', '', '', ''),
(17, '1', 'sohaib', '786876876876', 123, '6 marla', 'sohaib@gmail.com', '8767868768', 'Open'),
(18, '', 'Mr. A', '3520015581061', 101, '30X60', '', '', ''),
(19, '', 'Rehman Saeed', '3520015581087', 101, '30X60', '', '', ''),
(20, '', 'Rana Tanvir', '3510014432017', 1005, '30X60', '', '', ''),
(21, '', 'Ahmed Khan', '3520025581067', 90001, '30X9000', '', '', ''),
(22, '', 'Ahmed Khan', '3520025581067', 90001, '30X9000', '', '', ''),
(23, '', 'Ahmed Khan', '3520025581067', 90001, '30X9000', '', '', ''),
(24, '', 'Ahmed Khan', '3520025581067', 90001, '30X9000', '', '', ''),
(25, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(26, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(27, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(28, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(29, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(30, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', ''),
(31, '1', 'sohaib', '87878787878787', 0, '5 Marla', '9879879879', 'mr.sohaibmehmood@gmail.com', 'Open'),
(32, 'Royal Orchard, Multan', '', '', 0, '5 Marla', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ballotting`
--

CREATE TABLE IF NOT EXISTS `ballotting` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `project` varchar(256) NOT NULL,
  `size` varchar(256) NOT NULL,
  `desc1` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `createdate` varchar(256) NOT NULL,
  `ddate` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ballotting`
--

INSERT INTO `ballotting` (`id`, `project`, `size`, `desc1`, `status`, `createdate`, `ddate`) VALUES
(1, '1', '6 Marla', '500 Plots Drowhhhhhkkkk', 'Drawn', '14-08-06', '14-08-08'),
(4, '1', '5 Marla', 'kjkh', 'Open', '14-08-09', ''),
(5, '2', '10 Marla', 'lkjlh', 'Open', '14-08-09', ''),
(6, '2', '1 kanal', 'lkhiuy', 'Open', '14-08-09', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_plot`
--

CREATE TABLE IF NOT EXISTS `member_plot` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `plot_id` int(50) DEFAULT NULL,
  `member_name` varchar(100) DEFAULT NULL,
  `plot_size` varchar(100) DEFAULT NULL,
  `status` int(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `member_plot`
--

INSERT INTO `member_plot` (`id`, `plot_id`, `member_name`, `plot_size`, `status`) VALUES
(24, 68, '2', NULL, 0),
(25, 64, '1', NULL, 0),
(26, 68, '5', NULL, 0),
(27, 61, '4', NULL, 0),
(28, 53, '3', NULL, 0),
(29, 53, '4', NULL, 0),
(30, 64, '2', NULL, 0),
(31, 61, '5', NULL, 0),
(32, 68, '3', NULL, 0),
(33, 61, '1', NULL, 0),
(34, 53, '4', NULL, 0),
(35, 64, '3', NULL, 0),
(36, 68, '5', NULL, 0),
(37, 68, '1', NULL, 0),
(38, 64, '2', NULL, 0),
(39, 61, '17', NULL, 0),
(40, 53, '3', NULL, 0),
(41, 64, '17', NULL, 0),
(42, 53, '3', NULL, 0),
(43, 68, '5', NULL, 0),
(44, 61, '1', NULL, 0),
(45, 68, '5', NULL, 0),
(46, 53, '2', NULL, 0),
(47, 64, '17', NULL, 0),
(48, 61, '3', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
