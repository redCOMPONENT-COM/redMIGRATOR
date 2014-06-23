-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2013 at 12:00 PM
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
-- Table structure for table `#__acesef_bookmarks`
--

CREATE TABLE IF NOT EXISTS `#__acesef_bookmarks` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `html` text NOT NULL,
  `btype` varchar(20) NOT NULL DEFAULT '',
  `placeholder` varchar(150) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_extensions`
--

CREATE TABLE IF NOT EXISTS `#__acesef_extensions` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(45) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `extension` (`extension`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_ilinks`
--

CREATE TABLE IF NOT EXISTS `#__acesef_ilinks` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `nofollow` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `iblank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ilimit` varchar(30) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_metadata`
--

CREATE TABLE IF NOT EXISTS `#__acesef_metadata` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url_sef` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(30) NOT NULL DEFAULT '',
  `robots` varchar(30) NOT NULL DEFAULT '',
  `googlebot` varchar(30) NOT NULL DEFAULT '',
  `canonical` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_sef` (`url_sef`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_sitemap`
--

CREATE TABLE IF NOT EXISTS `#__acesef_sitemap` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url_sef` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sdate` date NOT NULL DEFAULT '0000-00-00',
  `frequency` varchar(30) NOT NULL DEFAULT '',
  `priority` varchar(10) NOT NULL DEFAULT '',
  `sparent` int(12) unsigned NOT NULL DEFAULT '0',
  `sorder` int(5) unsigned NOT NULL DEFAULT '1000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_sef` (`url_sef`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_tags`
--

CREATE TABLE IF NOT EXISTS `#__acesef_tags` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL DEFAULT '',
  `alias` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(150) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` int(12) NOT NULL DEFAULT '0',
  `hits` int(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_tags_map`
--

CREATE TABLE IF NOT EXISTS `#__acesef_tags_map` (
  `url_sef` varchar(255) NOT NULL DEFAULT '',
  `tag` varchar(150) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_urls`
--

CREATE TABLE IF NOT EXISTS `#__acesef_urls` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url_sef` varchar(255) NOT NULL DEFAULT '',
  `url_real` varchar(255) NOT NULL DEFAULT '',
  `cdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `used` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(12) unsigned NOT NULL DEFAULT '0',
  `source` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_real` (`url_real`),
  KEY `url_sef` (`url_sef`),
  KEY `used` (`used`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__acesef_urls_moved`
--

CREATE TABLE IF NOT EXISTS `#__acesef_urls_moved` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `url_new` varchar(255) NOT NULL DEFAULT '',
  `url_old` varchar(255) NOT NULL DEFAULT '',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `hits` int(12) unsigned NOT NULL DEFAULT '0',
  `last_hit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_old` (`url_old`),
  KEY `url_new` (`url_new`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;