-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 19, 2010 at 03:34 PM
-- Server version: 5.0.33
-- PHP Version: 5.2.1
-- 
-- Database: `pms`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `pms_messages`
-- 

CREATE TABLE `pms_messages` (
  `id` int(11) NOT NULL auto_increment,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text collate latin1_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `belong_to` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=121 ;

-- 
-- Dumping data for table `pms_messages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pms_users`
-- 

CREATE TABLE `pms_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(250) collate latin1_general_ci NOT NULL,
  `password` varchar(250) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `pms_users`
-- 

INSERT INTO `pms_users` VALUES (1, 'userA', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `pms_users` VALUES (2, 'userB', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `pms_users` VALUES (3, 'userC', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `pms_users` VALUES (4, 'userD', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `pms_users` VALUES (5, 'userE', '21232f297a57a5a743894a0e4a801fc3');
