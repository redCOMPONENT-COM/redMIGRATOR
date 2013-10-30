-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2013 at 01:14 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `joomla_2.5.9`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_configuration`
--

CREATE TABLE IF NOT EXISTS `#__rwf_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Configuration for redFORM' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `#__rwf_configuration`
--

INSERT INTO `#__rwf_configuration` (`id`, `name`, `value`) VALUES
(1, 'phplist_path', 'lists');

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_fields`
--

CREATE TABLE IF NOT EXISTS `#__rwf_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `field_header` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fieldtype` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'textfield',
  `published` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `form_id` int(11) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `redmember_field` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  `unique` tinyint(1) NOT NULL DEFAULT '0',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `default` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tooltip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `params` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Fields for redFORM' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_forms`
--

CREATE TABLE IF NOT EXISTS `#__rwf_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NoName',
  `startdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enddate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` int(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) DEFAULT NULL,
  `checked_out_time` datetime DEFAULT '0000-00-00 00:00:00',
  `submissionsubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `submissionbody` text COLLATE utf8_unicode_ci NOT NULL,
  `showname` int(1) NOT NULL DEFAULT '0',
  `classname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactpersoninform` tinyint(1) NOT NULL DEFAULT '0',
  `contactpersonemail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactpersonfullpost` int(11) NOT NULL DEFAULT '0',
  `submitterinform` tinyint(1) NOT NULL DEFAULT '0',
  `submitnotification` tinyint(1) NOT NULL DEFAULT '0',
  `redirect` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notificationtext` text COLLATE utf8_unicode_ci NOT NULL,
  `formexpires` tinyint(1) NOT NULL DEFAULT '1',
  `virtuemartactive` tinyint(1) NOT NULL DEFAULT '0',
  `vmproductid` int(11) DEFAULT NULL,
  `vmitemid` int(4) NOT NULL DEFAULT '1',
  `captchaactive` tinyint(1) NOT NULL DEFAULT '0',
  `access` tinyint(3) NOT NULL DEFAULT '0',
  `activatepayment` tinyint(2) NOT NULL DEFAULT '0',
  `show_js_price` tinyint(2) NOT NULL DEFAULT '1',
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentprocessing` text COLLATE utf8_unicode_ci,
  `paymentaccepted` text COLLATE utf8_unicode_ci,
  `contactpaymentnotificationsubject` text COLLATE utf8_unicode_ci,
  `contactpaymentnotificationbody` text COLLATE utf8_unicode_ci,
  `submitterpaymentnotificationsubject` text COLLATE utf8_unicode_ci,
  `submitterpaymentnotificationbody` text COLLATE utf8_unicode_ci,
  `cond_recipients` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `vmproductid` (`vmproductid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Forms for redFORM' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_mailinglists`
--

CREATE TABLE IF NOT EXISTS `#__rwf_mailinglists` (
  `field_id` int(11) unsigned NOT NULL DEFAULT '0',
  `mailinglist` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `listnames` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Mailinglists for redFORM';

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_payment`
--

CREATE TABLE IF NOT EXISTS `#__rwf_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submit_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `gateway` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `paid` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submit_key` (`submit_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='logging gateway notifications' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_submitters`
--

CREATE TABLE IF NOT EXISTS `#__rwf_submitters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL DEFAULT '0',
  `submission_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `integration` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xref` int(11) NOT NULL DEFAULT '0',
  `answer_id` int(11) NOT NULL DEFAULT '0',
  `submitternewsletter` int(11) NOT NULL DEFAULT '0',
  `rawformdata` text COLLATE utf8_unicode_ci NOT NULL,
  `submit_key` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `uniqueid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waitinglist` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmdate` datetime DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `event_id` (`xref`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Submitters for redFORM' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__rwf_values`
--

CREATE TABLE IF NOT EXISTS `#__rwf_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `field_id` int(11) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Answers for redFORM' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;