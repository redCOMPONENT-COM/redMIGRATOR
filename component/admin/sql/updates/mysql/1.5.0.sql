SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `#__redmigrator_steps`
				ADD `type` varchar(255) NOT NULL;

CREATE TABLE IF NOT EXISTS `#__redmigrator_core_acl_aro` (
  `user_id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `#__redmigrator_categories`;
DROP TABLE IF EXISTS `#__redmigrator_errors`;
DROP TABLE IF EXISTS `#__redmigrator_extensions_tables`;
DROP TABLE IF EXISTS `#__redmigrator_files_images`;
DROP TABLE IF EXISTS `#__redmigrator_files_media`;
DROP TABLE IF EXISTS `#__redmigrator_files_templates`;
DROP TABLE IF EXISTS `#__redmigrator_menus`;
DROP TABLE IF EXISTS `#__redmigrator_modules`;
DROP TABLE IF EXISTS `#__redmigrator_default_menus`;
DROP TABLE IF EXISTS `#__redmigrator_default_categories`;

SET FOREIGN_KEY_CHECKS = 1;
