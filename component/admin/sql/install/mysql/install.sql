-- --------------------------------------------------------

--
-- Table structure for table `#__redmigrator_extensions`
--

DROP TABLE IF EXISTS `#__redmigrator_extensions`;
CREATE TABLE IF NOT EXISTS `#__redmigrator_extensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tbl_key` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `class` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `cache` int(11) NOT NULL,
  `xmlpath` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `#__redmigrator_extensions`
--

INSERT INTO `#__redmigrator_extensions` (`id`, `name`, `title`, `tbl_key`, `source`, `destination`, `cid`, `class`, `status`, `cache`, `xmlpath`) VALUES
(1, 'extensions', 'Check extensions', '', '', '', 0, 'RedMigratorCheckExtensions', 0, 0, ''),
(2, 'ext_components', 'Check components', 'id', 'components', 'extensions', 0, 'RedMigratorExtensionsComponents', 0, 0, ''),
(3, 'ext_modules', 'Check modules', 'id', 'modules', 'extensions', 0, 'RedMigratorExtensionsModules', 0, 0, ''),
(4, 'ext_plugins', 'Check plugins', 'id', 'plugins', 'extensions', 0, 'RedMigratorExtensionsPlugins', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `#__redmigrator_steps`
--

DROP TABLE IF EXISTS `#__redmigrator_steps`;
CREATE TABLE IF NOT EXISTS `#__redmigrator_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tbl_key` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `cache` int(11) NOT NULL,
  `extension` int(1) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `stop` int(11) NOT NULL,
  `first` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j30_redmigrator_core_acl_aro`
--

DROP TABLE IF EXISTS `#__redmigrator_core_acl_aro`;
CREATE TABLE IF NOT EXISTS `#__redmigrator_core_acl_aro` (
  `user_id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;