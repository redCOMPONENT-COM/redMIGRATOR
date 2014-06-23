-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2013 at 04:17 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `joomla_2.5.9_redshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_accessmanager`
--

CREATE TABLE IF NOT EXISTS `#__redshop_accessmanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(256) NOT NULL,
  `gid` int(11) NOT NULL,
  `view` enum('1','0') DEFAULT NULL,
  `add` enum('1','0') DEFAULT NULL,
  `edit` enum('1','0') DEFAULT NULL,
  `delete` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Access Manager' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_attribute_set`
--

CREATE TABLE IF NOT EXISTS `#__redshop_attribute_set` (
  `attribute_set_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_set_name` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`attribute_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Attribute set detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_cart`
--

CREATE TABLE IF NOT EXISTS `#__redshop_cart` (
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `section` varchar(250) NOT NULL,
  `qty` int(11) NOT NULL,
  `time` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Cart';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_catalog`
--

CREATE TABLE IF NOT EXISTS `#__redshop_catalog` (
  `catalog_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_name` varchar(250) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`catalog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Catalog' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_catalog_colour`
--

CREATE TABLE IF NOT EXISTS `#__redshop_catalog_colour` (
  `colour_id` int(11) NOT NULL AUTO_INCREMENT,
  `sample_id` int(11) NOT NULL,
  `code_image` varchar(250) NOT NULL,
  `is_image` tinyint(4) NOT NULL,
  PRIMARY KEY (`colour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Catalog Colour' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_catalog_request`
--

CREATE TABLE IF NOT EXISTS `#__redshop_catalog_request` (
  `catalog_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `registerDate` int(11) NOT NULL,
  `block` tinyint(4) NOT NULL,
  `reminder_1` tinyint(4) NOT NULL,
  `reminder_2` tinyint(4) NOT NULL,
  `reminder_3` tinyint(4) NOT NULL,
  PRIMARY KEY (`catalog_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Catalog Request' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_catalog_sample`
--

CREATE TABLE IF NOT EXISTS `#__redshop_catalog_sample` (
  `sample_id` int(11) NOT NULL AUTO_INCREMENT,
  `sample_name` varchar(100) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Catalog Sample' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_category`
--

CREATE TABLE IF NOT EXISTS `#__redshop_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  `category_short_description` longtext NOT NULL,
  `category_description` longtext NOT NULL,
  `category_template` int(11) NOT NULL,
  `category_more_template` varchar(255) NOT NULL,
  `products_per_page` int(11) NOT NULL,
  `category_thumb_image` varchar(250) NOT NULL,
  `category_full_image` varchar(250) NOT NULL,
  `metakey` varchar(250) NOT NULL,
  `metadesc` longtext NOT NULL,
  `metalanguage_setting` text NOT NULL,
  `metarobot_info` text NOT NULL,
  `pagetitle` text NOT NULL,
  `pageheading` longtext NOT NULL,
  `sef_url` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `category_pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ordering` int(11) NOT NULL,
  `canonical_url` text NOT NULL,
  `category_back_full_image` varchar(250) NOT NULL,
  `compare_template_id` varchar(255) NOT NULL,
  `append_to_global_seo` enum('append','prepend','replace') NOT NULL DEFAULT 'append',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Category' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_category_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_category_xref` (
  `category_parent_id` int(11) NOT NULL DEFAULT '0',
  `category_child_id` int(11) NOT NULL DEFAULT '0',
  KEY `category_xref_category_parent_id` (`category_parent_id`),
  KEY `category_xref_category_child_id` (`category_child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Category relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_container`
--

CREATE TABLE IF NOT EXISTS `#__redshop_container` (
  `container_id` int(11) NOT NULL AUTO_INCREMENT,
  `container_name` varchar(250) NOT NULL,
  `manufacture_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `container_desc` longtext NOT NULL,
  `creation_date` double NOT NULL,
  `min_del_time` int(11) NOT NULL,
  `max_del_time` int(11) NOT NULL,
  `container_volume` double NOT NULL,
  `stockroom_id` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`container_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Container' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_container_product_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_container_product_xref` (
  `container_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  UNIQUE KEY `container_id` (`container_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Container Product Relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_country`
--

CREATE TABLE IF NOT EXISTS `#__redshop_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  `country_jtext` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Country records' AUTO_INCREMENT=253 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_coupons`
--

CREATE TABLE IF NOT EXISTS `#__redshop_coupons` (
  `coupon_id` int(16) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(32) NOT NULL DEFAULT '',
  `percent_or_total` tinyint(4) NOT NULL,
  `coupon_value` decimal(12,2) NOT NULL DEFAULT '0.00',
  `start_date` double NOT NULL,
  `end_date` double NOT NULL,
  `coupon_type` tinyint(4) NOT NULL COMMENT '0 - Global, 1 - User Specific',
  `userid` int(11) NOT NULL,
  `coupon_left` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `free_shipping` tinyint(4) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Coupons' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_coupons_transaction`
--

CREATE TABLE IF NOT EXISTS `#__redshop_coupons_transaction` (
  `transaction_coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_value` decimal(10,3) NOT NULL,
  `userid` int(11) NOT NULL,
  `trancation_date` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`transaction_coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Coupons Transaction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_cron`
--

CREATE TABLE IF NOT EXISTS `#__redshop_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Cron Job' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_currency`
--

CREATE TABLE IF NOT EXISTS `#__redshop_currency` (
  `currency_id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(64) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  PRIMARY KEY (`currency_id`),
  KEY `idx_currency_name` (`currency_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Currency Detail' AUTO_INCREMENT=159 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_customer_question`
--

CREATE TABLE IF NOT EXISTS `#__redshop_customer_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `question_date` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Customer Question' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_discount`
--

CREATE TABLE IF NOT EXISTS `#__redshop_discount` (
  `discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `condition` tinyint(1) NOT NULL DEFAULT '1',
  `discount_amount` decimal(10,4) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `start_date` double NOT NULL,
  `end_date` double NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Discount' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_discount_product`
--

CREATE TABLE IF NOT EXISTS `#__redshop_discount_product` (
  `discount_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `condition` tinyint(1) NOT NULL DEFAULT '1',
  `discount_amount` decimal(10,2) NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `start_date` double NOT NULL,
  `end_date` double NOT NULL,
  `published` tinyint(4) NOT NULL,
  `category_ids` text NOT NULL,
  PRIMARY KEY (`discount_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_discount_product_shoppers`
--

CREATE TABLE IF NOT EXISTS `#__redshop_discount_product_shoppers` (
  `discount_product_id` int(11) NOT NULL,
  `shopper_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_discount_shoppers`
--

CREATE TABLE IF NOT EXISTS `#__redshop_discount_shoppers` (
  `discount_id` int(11) NOT NULL,
  `shopper_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_economic_accountgroup`
--

CREATE TABLE IF NOT EXISTS `#__redshop_economic_accountgroup` (
  `accountgroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `accountgroup_name` varchar(255) NOT NULL,
  `economic_vat_account` varchar(255) NOT NULL,
  `economic_nonvat_account` varchar(255) NOT NULL,
  `economic_discount_nonvat_account` varchar(255) NOT NULL,
  `economic_shipping_vat_account` varchar(255) NOT NULL,
  `economic_shipping_nonvat_account` varchar(255) NOT NULL,
  `economic_discount_product_number` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `economic_service_nonvat_account` varchar(255) NOT NULL,
  `economic_discount_vat_account` varchar(255) NOT NULL,
  PRIMARY KEY (`accountgroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Economic Account Group' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_fields`
--

CREATE TABLE IF NOT EXISTS `#__redshop_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_title` varchar(250) NOT NULL,
  `field_name` varchar(20) NOT NULL,
  `field_type` varchar(20) NOT NULL,
  `field_desc` longtext NOT NULL,
  `field_class` varchar(20) NOT NULL,
  `field_section` varchar(20) NOT NULL,
  `field_maxlength` int(11) NOT NULL,
  `field_cols` int(11) NOT NULL,
  `field_rows` int(11) NOT NULL,
  `field_size` tinyint(4) NOT NULL,
  `field_show_in_front` tinyint(4) NOT NULL,
  `required` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  `display_in_product` tinyint(4) NOT NULL,
  `display_in_checkout` tinyint(4) NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Fields' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_fields_data`
--

CREATE TABLE IF NOT EXISTS `#__redshop_fields_data` (
  `data_id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) DEFAULT NULL,
  `data_txt` longtext,
  `itemid` int(11) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  `alt_text` varchar(255) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  PRIMARY KEY (`data_id`),
  KEY `itemid` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Fields Data' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_fields_value`
--

CREATE TABLE IF NOT EXISTS `#__redshop_fields_value` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `field_value` varchar(250) NOT NULL,
  `field_name` varchar(250) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `image_link` text NOT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Fields Value' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_giftcard`
--

CREATE TABLE IF NOT EXISTS `#__redshop_giftcard` (
  `giftcard_id` int(11) NOT NULL AUTO_INCREMENT,
  `giftcard_name` varchar(255) NOT NULL,
  `giftcard_price` decimal(10,3) NOT NULL,
  `giftcard_value` decimal(10,3) NOT NULL,
  `giftcard_validity` int(11) NOT NULL,
  `giftcard_date` int(11) NOT NULL,
  `giftcard_bgimage` varchar(255) NOT NULL,
  `giftcard_image` varchar(255) NOT NULL,
  `published` int(11) NOT NULL,
  `giftcard_desc` longtext NOT NULL,
  `customer_amount` int(11) NOT NULL,
  `accountgroup_id` int(11) NOT NULL,
  PRIMARY KEY (`giftcard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Giftcard' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_mail`
--

CREATE TABLE IF NOT EXISTS `#__redshop_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_name` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_section` varchar(255) NOT NULL,
  `mail_order_status` varchar(11) NOT NULL,
  `mail_body` longtext NOT NULL,
  `published` tinyint(4) NOT NULL,
  `mail_bcc` varchar(255) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Mail Center' AUTO_INCREMENT=188 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_manufacturer`
--

CREATE TABLE IF NOT EXISTS `#__redshop_manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(250) NOT NULL,
  `manufacturer_desc` longtext NOT NULL,
  `manufacturer_email` varchar(250) NOT NULL,
  `product_per_page` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metalanguage_setting` text NOT NULL,
  `metarobot_info` text NOT NULL,
  `pagetitle` text NOT NULL,
  `pageheading` text NOT NULL,
  `sef_url` text NOT NULL,
  `published` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `manufacturer_url` varchar(255) NOT NULL,
  `excluding_category_list` text NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Manufacturer' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_mass_discount`
--

CREATE TABLE IF NOT EXISTS `#__redshop_mass_discount` (
  `mass_discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_product` longtext NOT NULL,
  `category_id` longtext NOT NULL,
  `manufacturer_id` longtext NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `discount_amount` double(10,2) NOT NULL,
  `discount_startdate` int(11) NOT NULL,
  `discount_enddate` int(11) NOT NULL,
  `discount_name` longtext NOT NULL,
  PRIMARY KEY (`mass_discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Page Viewer' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_media`
--

CREATE TABLE IF NOT EXISTS `#__redshop_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_name` varchar(250) NOT NULL,
  `media_alternate_text` varchar(255) NOT NULL,
  `media_section` varchar(20) NOT NULL,
  `section_id` int(11) NOT NULL,
  `media_type` varchar(250) NOT NULL,
  `media_mimetype` varchar(20) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Media' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_media_download`
--

CREATE TABLE IF NOT EXISTS `#__redshop_media_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `media_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Media Additional Downloadable Files' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_newsletter`
--

CREATE TABLE IF NOT EXISTS `#__redshop_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `template_id` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Newsletter' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_newsletter_subscription`
--

CREATE TABLE IF NOT EXISTS `#__redshop_newsletter_subscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `newsletter_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `checkout` tinyint(4) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Newsletter subscribers' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_newsletter_tracker`
--

CREATE TABLE IF NOT EXISTS `#__redshop_newsletter_tracker` (
  `tracker_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `subscriber_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `read` tinyint(4) NOT NULL,
  `date` double NOT NULL,
  PRIMARY KEY (`tracker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Newsletter Tracker' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_notifystock_users`
--

CREATE TABLE IF NOT EXISTS `#__redshop_notifystock_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `subproperty_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_orderbarcode_log`
--

CREATE TABLE IF NOT EXISTS `#__redshop_orderbarcode_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `search_date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_ordernumber_track`
--

CREATE TABLE IF NOT EXISTS `#__redshop_ordernumber_track` (
  `trackdatetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='redSHOP Order number track';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_orders`
--

CREATE TABLE IF NOT EXISTS `#__redshop_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_number` varchar(32) DEFAULT NULL,
  `barcode` varchar(13) NOT NULL,
  `user_info_id` varchar(32) DEFAULT NULL,
  `order_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `order_subtotal` decimal(15,5) DEFAULT NULL,
  `order_tax` decimal(10,2) DEFAULT NULL,
  `order_tax_details` text NOT NULL,
  `order_shipping` decimal(10,2) DEFAULT NULL,
  `order_shipping_tax` decimal(10,2) DEFAULT NULL,
  `coupon_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `special_discount_amount` decimal(12,2) NOT NULL,
  `payment_dicount` decimal(12,2) NOT NULL,
  `order_status` varchar(5) DEFAULT NULL,
  `order_payment_status` varchar(25) NOT NULL,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `ship_method_id` varchar(255) DEFAULT NULL,
  `customer_note` text NOT NULL,
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `encr_key` varchar(255) NOT NULL,
  `split_payment` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `mail1_status` tinyint(1) NOT NULL,
  `mail2_status` tinyint(1) NOT NULL,
  `mail3_status` tinyint(1) NOT NULL,
  `special_discount` decimal(10,2) NOT NULL,
  `payment_discount` decimal(10,2) NOT NULL,
  `is_booked` tinyint(1) NOT NULL,
  `order_label_create` tinyint(1) NOT NULL,
  `vm_order_number` varchar(32) NOT NULL,
  `requisition_number` varchar(255) NOT NULL,
  `bookinvoice_number` int(11) NOT NULL,
  `bookinvoice_date` int(11) NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `customer_message` varchar(255) NOT NULL,
  `shop_id` varchar(255) NOT NULL,
  `order_discount_vat` decimal(10,3) NOT NULL,
  `track_no` varchar(250) NOT NULL,
  `payment_oprand` varchar(50) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `analytics_status` int(1) NOT NULL,
  `tax_after_discount` decimal(10,3) NOT NULL,
  `recuuring_subcription_id` varchar(500) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `idx_orders_user_id` (`user_id`),
  KEY `idx_orders_order_number` (`order_number`),
  KEY `idx_orders_user_info_id` (`user_info_id`),
  KEY `idx_orders_ship_method_id` (`ship_method_id`),
  KEY `vm_order_number` (`vm_order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Order Detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_acc_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_acc_item` (
  `order_item_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_acc_item_sku` varchar(255) NOT NULL,
  `order_acc_item_name` varchar(255) NOT NULL,
  `order_acc_price` decimal(15,4) NOT NULL,
  `order_acc_vat` decimal(15,4) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_acc_item_price` decimal(15,4) NOT NULL,
  `product_acc_final_price` decimal(15,4) NOT NULL,
  `product_attribute` text NOT NULL,
  PRIMARY KEY (`order_item_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Order Accessory Item Detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_attribute_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_attribute_item` (
  `order_att_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_item_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `section` varchar(250) NOT NULL,
  `parent_section_id` int(11) NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `section_price` decimal(15,4) NOT NULL,
  `section_vat` decimal(15,4) NOT NULL,
  `section_oprand` char(1) NOT NULL,
  `is_accessory_att` tinyint(4) NOT NULL,
  `stockroom_id` varchar(255) NOT NULL,
  `stockroom_quantity` varchar(255) NOT NULL,
  PRIMARY KEY (`order_att_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP order Attribute item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_info_id` varchar(32) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_item_sku` varchar(64) NOT NULL DEFAULT '',
  `order_item_name` varchar(255) NOT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_item_price` decimal(15,4) DEFAULT NULL,
  `product_item_price_excl_vat` decimal(15,4) DEFAULT NULL,
  `product_final_price` decimal(12,4) NOT NULL DEFAULT '0.0000',
  `order_item_currency` varchar(16) DEFAULT NULL,
  `order_status` varchar(250) DEFAULT NULL,
  `customer_note` text NOT NULL,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `product_attribute` text,
  `product_accessory` text NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `container_id` int(11) NOT NULL,
  `stockroom_id` varchar(255) NOT NULL,
  `stockroom_quantity` varchar(255) NOT NULL,
  `is_split` tinyint(1) NOT NULL,
  `attribute_image` text NOT NULL,
  `wrapper_id` int(11) NOT NULL,
  `wrapper_price` decimal(10,2) NOT NULL,
  `is_giftcard` tinyint(4) NOT NULL,
  `giftcard_user_name` varchar(255) NOT NULL,
  `giftcard_user_email` varchar(255) NOT NULL,
  `product_item_old_price` decimal(10,4) NOT NULL,
  `product_purchase_price` decimal(10,4) NOT NULL,
  `discount_calc_data` text NOT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Order Item Detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_payment`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_payment` (
  `payment_order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `payment_method_id` int(11) DEFAULT NULL,
  `order_payment_code` varchar(30) NOT NULL DEFAULT '',
  `order_payment_cardname` blob NOT NULL,
  `order_payment_number` blob,
  `order_payment_ccv` blob NOT NULL,
  `order_payment_amount` double(10,2) NOT NULL,
  `order_payment_expire` int(11) DEFAULT NULL,
  `order_payment_name` varchar(255) DEFAULT NULL,
  `payment_method_class` varchar(256) DEFAULT NULL,
  `order_payment_trans_id` text NOT NULL,
  `authorize_status` varchar(255) DEFAULT NULL,
  `order_transfee` double(10,2) NOT NULL,
  PRIMARY KEY (`payment_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Order Payment Detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_status`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_code` varchar(64) NOT NULL,
  `order_status_name` varchar(64) DEFAULT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`order_status_id`),
  UNIQUE KEY `order_status_code` (`order_status_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Orders Status' AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_status_log`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_status_log` (
  `order_status_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_status` varchar(5) NOT NULL,
  `order_payment_status` varchar(25) NOT NULL,
  `date_changed` int(11) NOT NULL,
  `customer_note` text NOT NULL,
  PRIMARY KEY (`order_status_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Orders Status history' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_order_users_info`
--

CREATE TABLE IF NOT EXISTS `#__redshop_order_users_info` (
  `order_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_info_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `vat_number` varchar(250) NOT NULL,
  `tax_exempt` tinyint(4) NOT NULL,
  `shopper_group_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country_code` varchar(11) NOT NULL,
  `state_code` varchar(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `tax_exempt_approved` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `is_company` tinyint(4) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `ean_number` varchar(250) NOT NULL,
  `requesting_tax_exempt` tinyint(4) NOT NULL,
  `thirdparty_email` varchar(255) NOT NULL,
  PRIMARY KEY (`order_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Order User Information' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_pageviewer`
--

CREATE TABLE IF NOT EXISTS `#__redshop_pageviewer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  `section_id` int(11) NOT NULL,
  `hit` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Page Viewer' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_payment_method`
--

CREATE TABLE IF NOT EXISTS `#__redshop_payment_method` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(100) NOT NULL,
  `payment_method_name` varchar(255) DEFAULT NULL,
  `payment_class` varchar(50) NOT NULL DEFAULT '',
  `payment_method_code` varchar(8) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `is_creditcard` tinyint(1) NOT NULL DEFAULT '0',
  `payment_discount_is_percent` tinyint(4) NOT NULL,
  `payment_price` float(10,2) NOT NULL,
  `payment_extrainfo` text NOT NULL,
  `payment_passkey` blob NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `shopper_group` varchar(250) NOT NULL,
  `accepted_credict_card` varchar(255) NOT NULL,
  `payment_oprand` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Payment Method' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_parent_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_on_sale` tinyint(4) NOT NULL,
  `product_special` tinyint(4) NOT NULL,
  `product_download` tinyint(4) NOT NULL,
  `product_template` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` double NOT NULL,
  `discount_price` double NOT NULL,
  `discount_stratdate` int(11) NOT NULL,
  `discount_enddate` int(11) NOT NULL,
  `product_number` varchar(250) NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `product_s_desc` longtext NOT NULL,
  `product_desc` longtext NOT NULL,
  `product_volume` double NOT NULL,
  `product_tax_id` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `product_thumb_image` varchar(250) NOT NULL,
  `product_full_image` varchar(250) NOT NULL,
  `publish_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `visited` int(11) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metalanguage_setting` text NOT NULL,
  `metarobot_info` text NOT NULL,
  `pagetitle` text NOT NULL,
  `pageheading` text NOT NULL,
  `sef_url` text NOT NULL,
  `cat_in_sefurl` int(11) NOT NULL,
  `weight` float(10,3) NOT NULL,
  `expired` tinyint(4) NOT NULL,
  `not_for_sale` tinyint(4) NOT NULL,
  `use_discount_calc` tinyint(4) NOT NULL,
  `discount_calc_method` varchar(255) NOT NULL,
  `min_order_product_quantity` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `product_length` decimal(10,2) NOT NULL,
  `product_height` decimal(10,2) NOT NULL,
  `product_width` decimal(10,2) NOT NULL,
  `product_diameter` decimal(10,2) NOT NULL,
  `product_availability_date` int(11) NOT NULL,
  `use_range` tinyint(4) NOT NULL,
  `product_tax_group_id` int(11) NOT NULL,
  `product_download_days` int(11) NOT NULL,
  `product_download_limit` int(11) NOT NULL,
  `product_download_clock` int(11) NOT NULL,
  `product_download_clock_min` int(11) NOT NULL,
  `accountgroup_id` int(11) NOT NULL,
  `canonical_url` text NOT NULL,
  `minimum_per_product_total` int(11) NOT NULL,
  `quantity_selectbox_value` varchar(255) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `max_order_product_quantity` int(11) NOT NULL,
  `product_download_infinite` tinyint(4) NOT NULL,
  `product_back_full_image` varchar(250) NOT NULL,
  `product_back_thumb_image` varchar(250) NOT NULL,
  `product_preview_image` varchar(250) NOT NULL,
  `product_preview_back_image` varchar(250) NOT NULL,
  `preorder` varchar(255) NOT NULL,
  `append_to_global_seo` enum('append','prepend','replace') NOT NULL DEFAULT 'append',
  PRIMARY KEY (`product_id`),
  KEY `product_number` (`product_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_accessory`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_accessory` (
  `accessory_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `child_product_id` int(11) NOT NULL,
  `accessory_price` double NOT NULL,
  `oprand` char(1) NOT NULL,
  `setdefault_selected` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`accessory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Accessory' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_attribute`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(250) NOT NULL,
  `attribute_required` tinyint(4) NOT NULL,
  `allow_multiple_selection` tinyint(1) NOT NULL,
  `hide_attribute_price` tinyint(1) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `display_type` varchar(255) NOT NULL,
  `attribute_published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Attribute' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_attribute_price`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_attribute_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `product_currency` varchar(10) NOT NULL,
  `cdate` int(11) NOT NULL,
  `shopper_group_id` int(11) NOT NULL,
  `price_quantity_start` int(11) NOT NULL,
  `price_quantity_end` bigint(20) NOT NULL,
  `discount_price` double NOT NULL,
  `discount_start_date` int(11) NOT NULL,
  `discount_end_date` int(11) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Attribute Price' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_attribute_property`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_attribute_property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_price` double NOT NULL,
  `oprand` char(1) NOT NULL DEFAULT '+',
  `property_image` varchar(255) NOT NULL,
  `property_main_image` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  `setdefault_selected` tinyint(4) NOT NULL,
  `setrequire_selected` tinyint(3) NOT NULL,
  `setmulti_selected` tinyint(4) NOT NULL,
  `setdisplay_type` varchar(255) NOT NULL,
  `extra_field` varchar(250) NOT NULL,
  `property_published` int(11) NOT NULL DEFAULT '1',
  `property_number` varchar(255) NOT NULL,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Attribute Property' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_attribute_stockroom_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_attribute_stockroom_xref` (
  `section_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `stockroom_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `preorder_stock` int(11) NOT NULL,
  `ordered_preorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Attribute Stockroom relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_category_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_category_xref` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  KEY `ref_category` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Category Relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_compare`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_compare` (
  `compare_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`compare_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Comparision' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_discount_calc`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_discount_calc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `area_start` float(10,2) NOT NULL,
  `area_end` float(10,2) NOT NULL,
  `area_price` double NOT NULL,
  `discount_calc_unit` varchar(255) NOT NULL,
  `area_start_converted` float(20,8) NOT NULL,
  `area_end_converted` float(20,8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Discount Calculator' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_discount_calc_extra`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_discount_calc_extra` (
  `pdcextra_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `oprand` char(1) NOT NULL,
  `price` float(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`pdcextra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Discount Calculator Extra Value' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_download`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_download` (
  `product_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `end_date` int(11) NOT NULL DEFAULT '0',
  `download_max` int(11) NOT NULL DEFAULT '0',
  `download_id` varchar(32) NOT NULL DEFAULT '',
  `file_name` varchar(255) NOT NULL DEFAULT '',
  `product_serial_number` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`download_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Downloadable Products';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_download_log`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_download_log` (
  `user_id` int(11) NOT NULL,
  `download_id` varchar(32) NOT NULL,
  `download_time` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Downloadable Products Logs';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_navigator`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_navigator` (
  `navigator_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `child_product_id` int(11) NOT NULL,
  `navigator_name` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`navigator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Navigator' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_price`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_price` decimal(12,4) NOT NULL,
  `product_currency` varchar(10) NOT NULL,
  `cdate` date NOT NULL,
  `shopper_group_id` int(11) NOT NULL,
  `price_quantity_start` int(11) NOT NULL,
  `price_quantity_end` bigint(20) NOT NULL,
  `discount_price` decimal(12,4) NOT NULL,
  `discount_start_date` int(11) NOT NULL,
  `discount_end_date` int(11) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='redSHOP Product Price' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_rating`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `user_rating` tinyint(1) NOT NULL DEFAULT '0',
  `favoured` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`rating_id`),
  UNIQUE KEY `product_id` (`product_id`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_related`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_related` (
  `related_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Related Products';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_serial_number`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_serial_number` (
  `serial_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`serial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP downloadable product serial numbers' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_stockroom_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_stockroom_xref` (
  `product_id` int(11) NOT NULL,
  `stockroom_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `preorder_stock` int(11) NOT NULL,
  `ordered_preorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Stockroom Relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_subattribute_color`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_subattribute_color` (
  `subattribute_color_id` int(11) NOT NULL AUTO_INCREMENT,
  `subattribute_color_name` varchar(255) NOT NULL,
  `subattribute_color_price` double NOT NULL,
  `oprand` char(1) NOT NULL,
  `subattribute_color_image` varchar(255) NOT NULL,
  `subattribute_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `setdefault_selected` tinyint(4) NOT NULL,
  `extra_field` varchar(250) NOT NULL,
  `subattribute_published` int(11) NOT NULL DEFAULT '1',
  `subattribute_color_number` varchar(255) NOT NULL,
  `subattribute_color_title` varchar(255) NOT NULL,
  `subattribute_color_main_image` varchar(255) NOT NULL,
  PRIMARY KEY (`subattribute_color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Product Subattribute Color' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_subscribe_detail`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_subscribe_detail` (
  `product_subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `renewal_reminder` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_subscribe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP User product Subscribe detail' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_subscription`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_subscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `subscription_period` int(11) NOT NULL,
  `period_type` varchar(10) NOT NULL,
  `subscription_price` double NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Subscription' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_tags`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_tags` (
  `tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(255) NOT NULL,
  `tags_counter` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Product Tags' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_tags_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_tags_xref` (
  `tags_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Product Tags Relation With product and user';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_voucher`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_voucher` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_code` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `voucher_type` varchar(250) CHARACTER SET latin1 NOT NULL,
  `start_date` double NOT NULL,
  `end_date` double NOT NULL,
  `free_shipping` tinyint(4) NOT NULL,
  `voucher_left` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Voucher' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_voucher_transaction`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_voucher_transaction` (
  `transaction_voucher_id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_id` int(11) NOT NULL,
  `voucher_code` varchar(255) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `trancation_date` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  PRIMARY KEY (`transaction_voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Product Voucher Transaction' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_product_voucher_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_product_voucher_xref` (
  `voucher_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Products Voucher Relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_quotation`
--

CREATE TABLE IF NOT EXISTS `#__redshop_quotation` (
  `quotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_info_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quotation_total` decimal(15,2) NOT NULL,
  `quotation_subtotal` decimal(15,2) NOT NULL,
  `quotation_tax` decimal(15,2) NOT NULL,
  `quotation_discount` decimal(15,4) NOT NULL,
  `quotation_status` int(11) NOT NULL,
  `quotation_cdate` int(11) NOT NULL,
  `quotation_mdate` int(11) NOT NULL,
  `quotation_note` text NOT NULL,
  `quotation_ipaddress` varchar(20) NOT NULL,
  `quotation_encrkey` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `quotation_special_discount` decimal(15,4) NOT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Quotation' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_quotation_accessory_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_quotation_accessory_item` (
  `quotation_item_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_item_id` int(11) NOT NULL,
  `accessory_id` int(11) NOT NULL,
  `accessory_item_sku` varchar(255) NOT NULL,
  `accessory_item_name` varchar(255) NOT NULL,
  `accessory_price` decimal(15,4) NOT NULL,
  `accessory_vat` decimal(15,4) NOT NULL,
  `accessory_quantity` int(11) NOT NULL,
  `accessory_item_price` decimal(15,2) NOT NULL,
  `accessory_final_price` decimal(15,2) NOT NULL,
  `accessory_attribute` text NOT NULL,
  PRIMARY KEY (`quotation_item_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Quotation Accessory item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_quotation_attribute_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_quotation_attribute_item` (
  `quotation_att_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_item_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `section` varchar(250) NOT NULL,
  `parent_section_id` int(11) NOT NULL,
  `section_name` varchar(250) NOT NULL,
  `section_price` decimal(15,4) NOT NULL,
  `section_vat` decimal(15,4) NOT NULL,
  `section_oprand` char(1) NOT NULL,
  `is_accessory_att` tinyint(4) NOT NULL,
  PRIMARY KEY (`quotation_att_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Quotation Attribute item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_quotation_fields_data`
--

CREATE TABLE IF NOT EXISTS `#__redshop_quotation_fields_data` (
  `data_id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) DEFAULT NULL,
  `data_txt` longtext,
  `quotation_item_id` int(11) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`data_id`),
  KEY `quotation_item_id` (`quotation_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Quotation USer field' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_quotation_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_quotation_item` (
  `quotation_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(15,4) NOT NULL,
  `product_excl_price` decimal(15,4) NOT NULL,
  `product_final_price` decimal(15,4) NOT NULL,
  `actualitem_price` decimal(15,4) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_attribute` text NOT NULL,
  `product_accessory` text NOT NULL,
  `mycart_accessory` text NOT NULL,
  `product_wrapperid` int(11) NOT NULL,
  `wrapper_price` decimal(15,2) NOT NULL,
  `is_giftcard` tinyint(4) NOT NULL,
  PRIMARY KEY (`quotation_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Quotation Item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_sample_request`
--

CREATE TABLE IF NOT EXISTS `#__redshop_sample_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `colour_id` varchar(250) NOT NULL,
  `block` tinyint(4) NOT NULL,
  `reminder_1` tinyint(1) NOT NULL,
  `reminder_2` tinyint(1) NOT NULL,
  `reminder_3` tinyint(1) NOT NULL,
  `reminder_coupon` tinyint(1) NOT NULL,
  `registerdate` int(11) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Sample Request' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_shipping_boxes`
--

CREATE TABLE IF NOT EXISTS `#__redshop_shipping_boxes` (
  `shipping_box_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_box_name` varchar(255) NOT NULL,
  `shipping_box_length` decimal(10,2) NOT NULL,
  `shipping_box_width` decimal(10,2) NOT NULL,
  `shipping_box_height` decimal(10,2) NOT NULL,
  `shipping_box_priority` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`shipping_box_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Shipping Boxes' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_shipping_rate`
--

CREATE TABLE IF NOT EXISTS `#__redshop_shipping_rate` (
  `shipping_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_rate_name` varchar(255) NOT NULL DEFAULT '',
  `shipping_class` varchar(255) NOT NULL DEFAULT '',
  `shipping_rate_country` longtext NOT NULL,
  `shipping_rate_zip_start` varchar(20) NOT NULL,
  `shipping_rate_zip_end` varchar(20) NOT NULL,
  `shipping_rate_weight_start` decimal(10,2) NOT NULL,
  `company_only` tinyint(4) NOT NULL,
  `apply_vat` tinyint(4) NOT NULL,
  `shipping_rate_weight_end` decimal(10,2) NOT NULL,
  `shipping_rate_volume_start` decimal(10,2) NOT NULL,
  `shipping_rate_volume_end` decimal(10,2) NOT NULL,
  `shipping_rate_ordertotal_start` decimal(10,3) NOT NULL DEFAULT '0.000',
  `shipping_rate_ordertotal_end` decimal(10,3) NOT NULL,
  `shipping_rate_priority` tinyint(4) NOT NULL DEFAULT '0',
  `shipping_rate_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_rate_package_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_location_info` longtext NOT NULL,
  `shipping_rate_length_start` decimal(10,2) NOT NULL,
  `shipping_rate_length_end` decimal(10,2) NOT NULL,
  `shipping_rate_width_start` decimal(10,2) NOT NULL,
  `shipping_rate_width_end` decimal(10,2) NOT NULL,
  `shipping_rate_height_start` decimal(10,2) NOT NULL,
  `shipping_rate_height_end` decimal(10,2) NOT NULL,
  `shipping_rate_on_shopper_group` longtext NOT NULL,
  `consignor_carrier_code` varchar(255) NOT NULL,
  `deliver_type` int(11) NOT NULL,
  `economic_displaynumber` varchar(255) NOT NULL,
  `shipping_rate_on_product` longtext NOT NULL,
  `shipping_rate_on_category` longtext NOT NULL,
  `shipping_tax_group_id` int(11) NOT NULL,
  `shipping_rate_state` longtext NOT NULL,
  PRIMARY KEY (`shipping_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Shipping Rates' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_shopper_group`
--

CREATE TABLE IF NOT EXISTS `#__redshop_shopper_group` (
  `shopper_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `shopper_group_name` varchar(32) DEFAULT NULL,
  `shopper_group_customer_type` tinyint(4) NOT NULL,
  `shopper_group_portal` tinyint(4) NOT NULL,
  `shopper_group_categories` longtext NOT NULL,
  `shopper_group_url` varchar(255) NOT NULL,
  `shopper_group_logo` varchar(255) NOT NULL,
  `shopper_group_introtext` longtext NOT NULL,
  `shopper_group_desc` text,
  `parent_id` int(11) NOT NULL,
  `default_shipping` tinyint(4) NOT NULL,
  `default_shipping_rate` float(10,2) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `shopper_group_cart_checkout_itemid` int(11) NOT NULL,
  `shopper_group_cart_itemid` int(11) NOT NULL,
  `shopper_group_quotation_mode` tinyint(4) NOT NULL,
  `show_price_without_vat` tinyint(4) NOT NULL,
  `tax_group_id` int(11) NOT NULL,
  `apply_product_price_vat` int(11) NOT NULL,
  `show_price` varchar(255) NOT NULL DEFAULT 'global',
  `use_as_catalog` varchar(255) NOT NULL DEFAULT 'global',
  `is_logged_in` int(11) NOT NULL DEFAULT '1',
  `shopper_group_manufactures` text NOT NULL,
  PRIMARY KEY (`shopper_group_id`),
  KEY `idx_shopper_group_name` (`shopper_group_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Shopper Groups that users can be assigned to' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_siteviewer`
--

CREATE TABLE IF NOT EXISTS `#__redshop_siteviewer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(250) NOT NULL,
  `created_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Site Viewer' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_state`
--

CREATE TABLE IF NOT EXISTS `#__redshop_state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `state_name` varchar(64) DEFAULT NULL,
  `state_3_code` char(3) DEFAULT NULL,
  `state_2_code` char(2) DEFAULT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `show_state` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_3_code` (`country_id`,`state_3_code`),
  UNIQUE KEY `state_2_code` (`country_id`,`state_2_code`),
  KEY `idx_country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='States that are assigned to a country' AUTO_INCREMENT=465 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_stockroom`
--

CREATE TABLE IF NOT EXISTS `#__redshop_stockroom` (
  `stockroom_id` int(11) NOT NULL AUTO_INCREMENT,
  `stockroom_name` varchar(250) NOT NULL,
  `min_stock_amount` int(11) NOT NULL,
  `stockroom_desc` longtext CHARACTER SET latin1 NOT NULL,
  `creation_date` double NOT NULL,
  `min_del_time` int(11) NOT NULL,
  `max_del_time` int(11) NOT NULL,
  `show_in_front` tinyint(1) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`stockroom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Stockroom' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_stockroom_amount_image`
--

CREATE TABLE IF NOT EXISTS `#__redshop_stockroom_amount_image` (
  `stock_amount_id` int(11) NOT NULL AUTO_INCREMENT,
  `stockroom_id` int(11) NOT NULL,
  `stock_option` tinyint(4) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_amount_image` varchar(255) NOT NULL,
  `stock_amount_image_tooltip` text NOT NULL,
  PRIMARY KEY (`stock_amount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP stockroom amount image' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_stockroom_container_xref`
--

CREATE TABLE IF NOT EXISTS `#__redshop_stockroom_container_xref` (
  `stockroom_id` int(11) NOT NULL,
  `container_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Stockroom Container Relation';

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_subscription_renewal`
--

CREATE TABLE IF NOT EXISTS `#__redshop_subscription_renewal` (
  `renewal_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `before_no_days` int(11) NOT NULL,
  PRIMARY KEY (`renewal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Subscription Renewal' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_supplier`
--

CREATE TABLE IF NOT EXISTS `#__redshop_supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(250) NOT NULL,
  `supplier_desc` longtext NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Supplier' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_tax_group`
--

CREATE TABLE IF NOT EXISTS `#__redshop_tax_group` (
  `tax_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_group_name` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`tax_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Tax Group' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_tax_rate`
--

CREATE TABLE IF NOT EXISTS `#__redshop_tax_rate` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_state` varchar(64) DEFAULT NULL,
  `tax_country` varchar(64) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `tax_rate` decimal(10,4) DEFAULT NULL,
  `tax_group_id` int(11) NOT NULL,
  `is_eu_country` tinyint(4) NOT NULL,
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Tax Rates' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_template`
--

CREATE TABLE IF NOT EXISTS `#__redshop_template` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(250) NOT NULL,
  `template_section` varchar(250) NOT NULL,
  `template_desc` longtext NOT NULL,
  `order_status` varchar(250) NOT NULL,
  `payment_methods` varchar(250) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `shipping_methods` varchar(255) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Templates Detail' AUTO_INCREMENT=551 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_textlibrary`
--

CREATE TABLE IF NOT EXISTS `#__redshop_textlibrary` (
  `textlibrary_id` int(11) NOT NULL AUTO_INCREMENT,
  `text_name` varchar(255) DEFAULT NULL,
  `text_desc` varchar(255) DEFAULT NULL,
  `text_field` text,
  `section` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`textlibrary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP TextLibrary' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_usercart`
--

CREATE TABLE IF NOT EXISTS `#__redshop_usercart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cdate` int(11) NOT NULL,
  `mdate` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP User Cart Item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_usercart_accessory_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_usercart_accessory_item` (
  `cart_acc_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_item_id` int(11) NOT NULL,
  `accessory_id` int(11) NOT NULL,
  `accessory_quantity` int(11) NOT NULL,
  PRIMARY KEY (`cart_acc_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP User Cart Accessory Item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_usercart_attribute_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_usercart_attribute_item` (
  `cart_att_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_item_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `section` varchar(25) NOT NULL,
  `parent_section_id` int(11) NOT NULL,
  `is_accessory_att` tinyint(4) NOT NULL,
  PRIMARY KEY (`cart_att_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP User cart Attribute Item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_usercart_item`
--

CREATE TABLE IF NOT EXISTS `#__redshop_usercart_item` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_idx` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_wrapper_id` int(11) NOT NULL,
  `product_subscription_id` int(11) NOT NULL,
  `giftcard_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP User Cart Item' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_users_info`
--

CREATE TABLE IF NOT EXISTS `#__redshop_users_info` (
  `users_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `address_type` varchar(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `vat_number` varchar(250) NOT NULL,
  `tax_exempt` tinyint(4) NOT NULL,
  `shopper_group_id` int(11) NOT NULL,
  `country_code` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state_code` varchar(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `tax_exempt_approved` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `is_company` tinyint(4) NOT NULL,
  `ean_number` varchar(250) NOT NULL,
  `braintree_vault_number` varchar(255) NOT NULL,
  `veis_vat_number` varchar(255) NOT NULL,
  `veis_status` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `requesting_tax_exempt` tinyint(4) NOT NULL,
  `accept_terms_conditions` tinyint(4) NOT NULL,
  PRIMARY KEY (`users_info_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='redSHOP Users Information' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_wishlist`
--

CREATE TABLE IF NOT EXISTS `#__redshop_wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `wishlist_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `cdate` double NOT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP wishlist' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_wishlist_product`
--

CREATE TABLE IF NOT EXISTS `#__redshop_wishlist_product` (
  `wishlist_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cdate` int(11) NOT NULL,
  PRIMARY KEY (`wishlist_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Wishlist Product' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_wishlist_userfielddata`
--

CREATE TABLE IF NOT EXISTS `#__redshop_wishlist_userfielddata` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `userfielddata` text NOT NULL,
  PRIMARY KEY (`fieldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Wishlist Product userfielddata' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_wrapper`
--

CREATE TABLE IF NOT EXISTS `#__redshop_wrapper` (
  `wrapper_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) NOT NULL,
  `category_id` varchar(250) NOT NULL,
  `wrapper_name` varchar(255) NOT NULL,
  `wrapper_price` double NOT NULL,
  `wrapper_image` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL,
  `wrapper_use_to_all` tinyint(4) NOT NULL,
  `published` tinyint(4) NOT NULL,
  PRIMARY KEY (`wrapper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP Wrapper' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_xml_export`
--

CREATE TABLE IF NOT EXISTS `#__redshop_xml_export` (
  `xmlexport_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `display_filename` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `section_type` varchar(255) NOT NULL,
  `auto_sync` tinyint(4) NOT NULL,
  `sync_on_request` tinyint(4) NOT NULL,
  `auto_sync_interval` int(11) NOT NULL,
  `xmlexport_date` int(11) NOT NULL,
  `xmlexport_filetag` text NOT NULL,
  `element_name` varchar(255) DEFAULT NULL,
  `published` tinyint(4) NOT NULL,
  `use_to_all_users` tinyint(4) NOT NULL,
  `xmlexport_billingtag` text NOT NULL,
  `billing_element_name` varchar(255) NOT NULL,
  `xmlexport_shippingtag` text NOT NULL,
  `shipping_element_name` varchar(255) NOT NULL,
  `xmlexport_orderitemtag` text NOT NULL,
  `orderitem_element_name` varchar(255) NOT NULL,
  `xmlexport_stocktag` text NOT NULL,
  `stock_element_name` varchar(255) NOT NULL,
  `xmlexport_prdextrafieldtag` text NOT NULL,
  `prdextrafield_element_name` varchar(255) NOT NULL,
  `xmlexport_on_category` text NOT NULL,
  PRIMARY KEY (`xmlexport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP XML Export' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_xml_export_ipaddress`
--

CREATE TABLE IF NOT EXISTS `#__redshop_xml_export_ipaddress` (
  `xmlexport_ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `xmlexport_id` int(11) NOT NULL,
  `access_ipaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`xmlexport_ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP XML Export Ip Address' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_xml_export_log`
--

CREATE TABLE IF NOT EXISTS `#__redshop_xml_export_log` (
  `xmlexport_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `xmlexport_id` int(11) NOT NULL,
  `xmlexport_filename` varchar(255) NOT NULL,
  `xmlexport_date` int(11) NOT NULL,
  PRIMARY KEY (`xmlexport_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP XML Export log' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_xml_import`
--

CREATE TABLE IF NOT EXISTS `#__redshop_xml_import` (
  `xmlimport_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `display_filename` varchar(255) NOT NULL,
  `xmlimport_url` varchar(255) NOT NULL,
  `section_type` varchar(255) NOT NULL,
  `auto_sync` tinyint(4) NOT NULL,
  `sync_on_request` tinyint(4) NOT NULL,
  `auto_sync_interval` int(11) NOT NULL,
  `override_existing` tinyint(4) NOT NULL,
  `add_prefix_for_existing` varchar(50) NOT NULL,
  `xmlimport_date` int(11) NOT NULL,
  `xmlimport_filetag` text NOT NULL,
  `xmlimport_billingtag` text NOT NULL,
  `xmlimport_shippingtag` text NOT NULL,
  `xmlimport_orderitemtag` text NOT NULL,
  `xmlimport_stocktag` text NOT NULL,
  `xmlimport_prdextrafieldtag` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `element_name` varchar(255) NOT NULL,
  `billing_element_name` varchar(255) NOT NULL,
  `shipping_element_name` varchar(255) NOT NULL,
  `orderitem_element_name` varchar(255) NOT NULL,
  `stock_element_name` varchar(255) NOT NULL,
  `prdextrafield_element_name` varchar(255) NOT NULL,
  `xmlexport_billingtag` text NOT NULL,
  `xmlexport_shippingtag` text NOT NULL,
  `xmlexport_orderitemtag` text NOT NULL,
  PRIMARY KEY (`xmlimport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP XML Import' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_xml_import_log`
--

CREATE TABLE IF NOT EXISTS `#__redshop_xml_import_log` (
  `xmlimport_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `xmlimport_id` int(11) NOT NULL,
  `xmlimport_filename` varchar(255) NOT NULL,
  `xmlimport_date` int(11) NOT NULL,
  PRIMARY KEY (`xmlimport_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='redSHOP XML Import log' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `#__redshop_zipcode`
--

CREATE TABLE IF NOT EXISTS `#__redshop_zipcode` (
  `zipcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(10) NOT NULL DEFAULT '',
  `state_code` varchar(10) NOT NULL DEFAULT '',
  `city_name` varchar(64) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `zipcodeto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`zipcode_id`),
  KEY `zipcode` (`zipcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;