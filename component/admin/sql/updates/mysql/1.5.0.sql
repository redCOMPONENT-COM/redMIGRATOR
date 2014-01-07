SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `#__redmigrator_steps`
				ADD `type` varchar(255) NOT NULL;

SET FOREIGN_KEY_CHECKS = 1;
