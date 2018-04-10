-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2014 at 07:57 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coursemashmembers`
--
CREATE DATABASE IF NOT EXISTS `coursemashmembers` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `coursemashmembers`;

-- --------------------------------------------------------

--
-- Table structure for table `blabbing`
--

CREATE TABLE IF NOT EXISTS `blabbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `the_blab` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `blab_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `blab_type` enum('a','b') COLLATE latin1_general_ci NOT NULL,
  `device` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `blabbing`
--

INSERT INTO `blabbing` (`id`, `mem_id`, `the_blab`, `blab_date`, `blab_type`, `device`) VALUES
(1, 1, 'hii friends', '2012-02-11 03:22:33', 'a', 'Google Chrome : Windows 7'),
(2, 1, 'welcome', '2012-05-07 07:07:01', 'a', 'Google Chrome : Windows XP');

-- --------------------------------------------------------

--
-- Table structure for table `friends_requests`
--

CREATE TABLE IF NOT EXISTS `friends_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mem1` int(11) NOT NULL,
  `mem2` int(11) NOT NULL,
  `timedate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `mymembers`
--

CREATE TABLE IF NOT EXISTS `mymembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `univ_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `gender` enum('male','female') COLLATE latin1_general_ci NOT NULL DEFAULT 'male',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `school` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Branch` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `zip` bigint(255) DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sign_up_date` date NOT NULL DEFAULT '0000-00-00',
  `last_log_date` date NOT NULL DEFAULT '0000-00-00',
  `bio_body` text COLLATE latin1_general_ci,
  `website` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `friend_array` text COLLATE latin1_general_ci,
  `account_type` enum('a','b','c') COLLATE latin1_general_ci NOT NULL DEFAULT 'a',
  `email_activated` enum('0','1') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `univ_id` (`univ_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `mymembers`
--

INSERT INTO `mymembers` (`id`, `univ_id`, `username`, `firstname`, `lastname`, `gender`, `birthday`, `school`, `Branch`, `country`, `state`, `city`, `zip`, `email`, `password`, `ipaddress`, `sign_up_date`, `last_log_date`, `bio_body`, `website`, `youtube`, `facebook`, `twitter`, `friend_array`, `account_type`, `email_activated`) VALUES
(1, '10313210020', 'Sagunesh', 'Sagunesh', 'Grover', 'male', '1995-06-29', 'SPS Rohini', 'Btech(CSE)', 'India', 'Delhi', 'New Delhi', 110089, 'sagunesh@gmail.com', 'sagunesh', '120.59.26.228', '2012-02-19', '2014-09-20', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1'),
(2, '10313210002', 'Akash', 'Akash', 'Antil', 'male', '2013-10-10', '', 'Btech(ME)', '', '', '', NULL, 'akash.antil@gmail.com', 'sagunesh', '', '0000-00-00', '2014-08-18', NULL, NULL, NULL, NULL, NULL, NULL, 'a', '1'),
(3, '10313210001\r\n\r\n', 'Aakash\r\n', 'Aakash', 'Goel', 'male', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'akashgoel1991@yahoo.in', 'sagunesh', '', '2014-08-10', '2014-08-10', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(4, '10313210003', ' Aniket', ' ANIKET', 'LAKRA', 'male', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'aniket.lakra1@gmail.com', 'sagunesh', '', '2014-08-10', '2014-09-20', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(5, '10313210004', 'Anshuka', 'Anshuka', 'Sachdeva', 'female', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'anshukasachdeva77@gmail.com', 'sagunesh', '', '2014-08-10', '2014-08-10', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(6, '10313210005', 'Avee', 'Avee', 'Mittal', 'male', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'aveemittal20@gmail.com', 'sagunesh', '', '0000-00-00', '2014-08-10', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(7, '10313210006', 'Ayush', 'Ayush ', 'Choudhary', 'male', '0000-00-00', '', '', '', '', '', NULL, 'ayushchoudhary@gmail.com', 'sagunesh', '', '0000-00-00', '2014-08-18', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(8, '10313210007', 'Bhavuk', 'Bhavuk', 'Sikka', 'male', '0000-00-00', '', 'Btech(CSE)\r\n', '', '', '', NULL, 'sikkabhavuk@gmail.com', 'sagunesh', '', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(9, '10313210008', 'Chirag', 'Chirag', 'Rathee', 'male', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'chirag.rathee10@gmail.com', 'sagunesh', '', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1'),
(10, '10313210009', 'DeepakS', 'Deepak', 'Sharma', 'male', '0000-00-00', '', 'Btech(CSE)', '', '', '', NULL, 'deepakshrm367@gmail.com', 'sagunesh', '', '0000-00-00', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, 'c', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pms_messages`
--

CREATE TABLE IF NOT EXISTS `pms_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `belong_to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=191 ;

--
-- Dumping data for table `pms_messages`
--

INSERT INTO `pms_messages` (`id`, `sender_id`, `receiver_id`, `content`, `date`, `is_read`, `belong_to`) VALUES
(179, 1, 2, 'Hi&nbsp;', '2014-08-10 12:30:44', 0, 1),
(180, 1, 2, 'Hi&nbsp;', '2014-08-10 12:30:44', 0, 2),
(181, 1, 2, 'How are You', '2014-08-10 15:20:22', 0, 1),
(182, 1, 2, 'How are You', '2014-08-10 15:20:22', 0, 2),
(183, 1, 2, 'Hiii', '2014-08-10 16:37:02', 0, 1),
(184, 1, 2, 'Hiii', '2014-08-10 16:37:02', 0, 2),
(185, 2, 1, 'Hello Test Successful (Y)', '2014-08-10 16:38:33', 0, 2),
(186, 2, 1, 'Hello Test Successful (Y)', '2014-08-10 16:38:33', 0, 1),
(187, 2, 1, '<b>Yes&nbsp;</b>', '2014-08-15 10:28:35', 0, 2),
(188, 2, 1, '<b>Yes&nbsp;</b>', '2014-08-15 10:28:35', 0, 1),
(190, 1, 4, 'Hi', '2014-09-20 07:33:53', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pms_users`
--

CREATE TABLE IF NOT EXISTS `pms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `username` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `avatar` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pms_users`
--

INSERT INTO `pms_users` (`id`, `name`, `username`, `password`, `avatar`) VALUES
(1, 'Sagunesh Grover', '10313210020', 'Lk1ZNA', '<img src="../members/1/image01.jpg" width="50" height="50"/>'),
(2, 'Akash Antil', '10313210002', 'S3NXSA', '<img src="../members/2/image01.jpg" width="50" height="50"/>\r\n'),
(3, 'Aakash Goel', '10313210001', 'Xm4rZA', '<img src="../members/3/image01.jpg" width="50" height="50"/>\r\n'),
(4, 'ANIKET LAKRA', '10313210003', 'ekUmQA', '<img src="../members/4/image01.jpg" width="50" height="50"/>'),
(5, 'Anshuka Sachdeva', '10313210004', 'ZW85JA', '<img src="../members/5/image01.jpg" width="50" height="50"/>'),
(6, 'Avee Mittal', '10313210005', 'Vi1AXw', '<img src="../members/6/image01.jpg" width="50" height="50"/>'),
(7, 'Ayush Choudhary', '10313210006', 'b2p1cQ', '<img src="../members/7/image01.jpg" width="50" height="50"/>'),
(8, 'BHAVUK SIKKA', '10313210007', 'sagunesh', '<img src="../members/8/image01.jpg" width="50" height="50"/>'),
(9, 'Chirag Rathee', '10313210008', 'sagunesh', '<img src="../members/9/image01.jpg" width="50" height="50"/>'),
(10, 'Deepak Sharma', '10313210009', 'sagunesh', '<img src="../members/10/image01.jpg" width="50" height="50"/>');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `message` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `message_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`, `branch`, `subject`, `teacher_name`, `message`, `message_date`) VALUES
(1, 'SRM Network loading.zip', 'Btech(CSE)', 'Check ', 'Sagunesh  Grover', ' \r\n                ', '0000-00-00 00:00:00'),
(2, 'change.html', 'Btech(CSE)', 'Mathematics', 'Sagunesh  Grover', ' View this on \r\n                ', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
