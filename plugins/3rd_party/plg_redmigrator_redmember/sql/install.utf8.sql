-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2013 at 04:56 PM
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
-- Table structure for table `#__redmember_country`
--

CREATE TABLE IF NOT EXISTS `#__redmember_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Country records' AUTO_INCREMENT=246 ;
-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_currency`
--

CREATE TABLE IF NOT EXISTS `#__redmember_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(64) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  PRIMARY KEY (`currency_id`),
  KEY `idx_currency_name` (`currency_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Currency Detail' AUTO_INCREMENT=159 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_fields`
--

CREATE TABLE IF NOT EXISTS `#__redmember_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` text NOT NULL,
  `field_dbname` varchar(60) NOT NULL,
  `field_type` varchar(20) NOT NULL,
  `entity_type` varchar(50) NOT NULL,
  `field_desc` longtext NOT NULL,
  `field_class` varchar(20) NOT NULL,
  `field_tabid` int(11) NOT NULL,
  `field_maxlength` int(11) NOT NULL,
  `field_cols` int(11) NOT NULL,
  `field_rows` int(11) NOT NULL,
  `field_size` tinyint(4) NOT NULL,
  `altered_one_time` tinyint(4) NOT NULL,
  `required` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  `language` char(7) NOT NULL DEFAULT '*',
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `field_dbname` (`field_dbname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Custom Fields' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_fields_values`
--

CREATE TABLE IF NOT EXISTS `#__redmember_fields_values` (
  `entity_id` int(11) NOT NULL,
  `field_dbname` varchar(60) NOT NULL,
  `field_value` longtext NOT NULL,
  PRIMARY KEY (`entity_id`,`field_dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Custom Fields Values';

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_filemanager`
--

CREATE TABLE IF NOT EXISTS `#__redmember_filemanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL,
  `depthlevel` int(11) NOT NULL,
  `folder` tinyint(4) NOT NULL DEFAULT '0',
  `filesize` bigint(19) NOT NULL DEFAULT '0',
  `fulltext` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `upload_access` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `enable_upload` tinyint(4) NOT NULL DEFAULT '0',
  `superadmin_upload` tinyint(4) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `language` char(7) NOT NULL DEFAULT '*',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum filemanager' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_filemanager_categories`
--

CREATE TABLE IF NOT EXISTS `#__redmember_filemanager_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '*',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum filemanager categories' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_forum_category`
--

CREATE TABLE IF NOT EXISTS `#__redmember_forum_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `addedby` int(11) NOT NULL,
  `moderator` varchar(250) NOT NULL,
  `datetime` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum category' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_forum_post`
--

CREATE TABLE IF NOT EXISTS `#__redmember_forum_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) NOT NULL,
  `post_message` text NOT NULL,
  `thread_id` int(11) NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedby_name` varchar(255) NOT NULL,
  `addedby_email` varchar(255) NOT NULL,
  `mailalert` tinyint(4) NOT NULL,
  `datetime` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum post' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_forum_section`
--

CREATE TABLE IF NOT EXISTS `#__redmember_forum_section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `addedby` int(11) NOT NULL,
  `datetime` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum section' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_forum_subscribe`
--

CREATE TABLE IF NOT EXISTS `#__redmember_forum_subscribe` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedby_name` varchar(255) NOT NULL,
  `addedby_email` varchar(255) NOT NULL,
  `mailalert` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum subscribe' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_forum_thread`
--

CREATE TABLE IF NOT EXISTS `#__redmember_forum_thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_name` varchar(255) NOT NULL,
  `thread_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedby_name` varchar(255) NOT NULL,
  `addedby_email` varchar(255) NOT NULL,
  `datetime` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER forum thread' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_mail`
--

CREATE TABLE IF NOT EXISTS `#__redmember_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_name` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_section` varchar(255) NOT NULL,
  `mail_body` longtext NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Mail Center' AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_membership`
--

CREATE TABLE IF NOT EXISTS `#__redmember_membership` (
  `membership_id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_name` varchar(255) NOT NULL,
  `membership_description` text NOT NULL,
  `user_group_ids` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`membership_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_membership_order`
--

CREATE TABLE IF NOT EXISTS `#__redmember_membership_order` (
  `membership_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `period_amount` float NOT NULL,
  `order_status` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Date and time of order creation.',
  `payment_date` datetime DEFAULT NULL COMMENT 'Date and time when order is paid and confirmed.',
  `transaction_id` varchar(255) NOT NULL,
  `auto_renew` tinyint(1) NOT NULL,
  `reminder` tinyint(1) NOT NULL,
  PRIMARY KEY (`membership_order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_messages`
--

CREATE TABLE IF NOT EXISTS `#__redmember_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `message_title` varchar(255) NOT NULL,
  `message_text` text NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_messages_receivers`
--

CREATE TABLE IF NOT EXISTS `#__redmember_messages_receivers` (
  `message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `read_date` datetime DEFAULT NULL,
  `read_status` tinyint(11) NOT NULL,
  `report_status` tinyint(11) NOT NULL,
  PRIMARY KEY (`message_id`,`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_newsletter`
--

CREATE TABLE IF NOT EXISTS `#__redmember_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `template_id` int(11) NOT NULL,
  `subscriber_only` tinyint(4) NOT NULL,
  `use_joomla_email` tinyint(4) NOT NULL,
  `use_redmember_extrafield` longtext NOT NULL,
  `secondary_newsletter_id` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Newsletter' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_newsletter_subscription`
--

CREATE TABLE IF NOT EXISTS `#__redmember_newsletter_subscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `newsletter_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Newsletter subscribers' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_newsletter_tracker`
--

CREATE TABLE IF NOT EXISTS `#__redmember_newsletter_tracker` (
  `tracker_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sendflag` tinyint(4) NOT NULL,
  `readflag` tinyint(4) NOT NULL,
  `readdate` int(11) NOT NULL DEFAULT '0',
  `senddate` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tracker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Newsletter Tracker' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_organization`
--

CREATE TABLE IF NOT EXISTS `#__redmember_organization` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(50) NOT NULL,
  `organization_desc` text,
  `template_id` int(11) NOT NULL,
  `organization_class` varchar(50) DEFAULT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Organizations' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_payment_method`
--

CREATE TABLE IF NOT EXISTS `#__redmember_payment_method` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(100) NOT NULL,
  `payment_method_name` varchar(255) DEFAULT NULL,
  `payment_class` varchar(50) NOT NULL DEFAULT '',
  `payment_method_code` varchar(8) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `is_creditcard` tinyint(1) NOT NULL DEFAULT '0',
  `payment_discount_is_percent` tinyint(4) NOT NULL,
  `payment_discount` float(10,2) NOT NULL,
  `payment_extrainfo` text NOT NULL,
  `payment_passkey` blob NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Payment Method' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_search`
--

CREATE TABLE IF NOT EXISTS `#__redmember_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_name` varchar(255) NOT NULL,
  `joomlauser_field_name` varchar(255) NOT NULL,
  `free_text_search` varchar(255) NOT NULL,
  `field_id` varchar(255) NOT NULL,
  `form_id` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER Search' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_search_form`
--

CREATE TABLE IF NOT EXISTS `#__redmember_search_form` (
  `form_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) NOT NULL,
  `search_template_id` int(11) NOT NULL,
  `result_template_id` int(11) NOT NULL,
  `user_group_ids` varchar(255) NOT NULL,
  `organization_ids` varchar(255) NOT NULL,
  `form_tag` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER search form' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_state`
--

CREATE TABLE IF NOT EXISTS `#__redmember_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `state_name` varchar(64) DEFAULT NULL,
  `state_3_code` char(3) DEFAULT NULL,
  `state_2_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_3_code` (`country_id`,`state_3_code`),
  UNIQUE KEY `state_2_code` (`country_id`,`state_2_code`),
  KEY `idx_country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='States that are assigned to a country' AUTO_INCREMENT=449 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_tab`
--

CREATE TABLE IF NOT EXISTS `#__redmember_tab` (
  `tab_id` int(11) NOT NULL AUTO_INCREMENT,
  `tab_name` varchar(250) NOT NULL,
  `tab_dbname` varchar(250) NOT NULL,
  `tab_desc` longtext NOT NULL,
  `tab_class` varchar(20) NOT NULL,
  `tab_show_in_front` tinyint(4) NOT NULL,
  `tab_user_groups` varchar(71) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`tab_id`),
  UNIQUE KEY `tab_dbname` (`tab_dbname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Tab' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_template`
--

CREATE TABLE IF NOT EXISTS `#__redmember_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(250) NOT NULL,
  `template_section` varchar(250) NOT NULL,
  `template_desc` longtext NOT NULL,
  `mail_to_admin` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Template Managment' AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_usergroups`
--

CREATE TABLE IF NOT EXISTS `#__redmember_usergroups` (
  `usergroup_id` int(11) NOT NULL,
  `auto_activation` tinyint(1) NOT NULL,
  `payment_required` tinyint(1) NOT NULL,
  `tax_exempt` tinyint(1) NOT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_users`
--

CREATE TABLE IF NOT EXISTS `#__redmember_users` (
  `user_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `show_in_search` tinyint(4) NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `status_change_date` datetime DEFAULT NULL,
  `payment_required` tinyint(4) NOT NULL,
  `user_photo` varchar(250) NOT NULL DEFAULT 'noimage.jpeg',
  `rm_post_code` int(11) NOT NULL,
  `rm_street` varchar(255) NOT NULL,
  `rm_city` varchar(255) NOT NULL,
  `rm_country` varchar(255) NOT NULL,
  `rm_id_number` int(11) NOT NULL,
  `rm_brief_description` longtext NOT NULL,
  `rm_drivers_licence` varchar(255) NOT NULL,
  PRIMARY KEY (`user_info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redMEMBER Users' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_user_organization_xref`
--

CREATE TABLE IF NOT EXISTS `#__redmember_user_organization_xref` (
  `user_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_user_statuses`
--

CREATE TABLE IF NOT EXISTS `#__redmember_user_statuses` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(71) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_vatgroup`
--

CREATE TABLE IF NOT EXISTS `#__redmember_vatgroup` (
  `vatgroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `vatgroup_title` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`vatgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER VAT group' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redmember_vatrates`
--

CREATE TABLE IF NOT EXISTS `#__redmember_vatrates` (
  `vatrates_id` int(11) NOT NULL AUTO_INCREMENT,
  `vatgroup_id` int(11) NOT NULL,
  `vat_country` varchar(255) NOT NULL,
  `vat_state` varchar(255) NOT NULL,
  `vat_rate` decimal(10,4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`vatrates_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redMEMBER VAT rates' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;