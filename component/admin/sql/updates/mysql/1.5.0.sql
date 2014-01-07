SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `#__redmigrator_steps`
				ADD `type` varchar(255) NOT NULL;

CREATE TABLE IF NOT EXISTS `#__redmigrator_core_acl_aro` (
  `user_id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
