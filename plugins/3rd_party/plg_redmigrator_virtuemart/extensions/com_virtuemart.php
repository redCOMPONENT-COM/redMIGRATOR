<?php
/**
 * @package     RedMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * RedMigrator class for Virtuemart migration
 *
 * This class migrates the Adminpraise extension
 *
 * @since		1.2.0
 */
class RedMigratorComponentVirtuemart extends RedMigrator
{
	/**
	 * Check if extension migration is supported.
	 *
	 * @return	boolean
	 * @since	1.2.0
	 */
	protected function detectExtension()
	{
		return true;
	}

	/**
	 * Migrate tables
	 *
	 * @return	boolean
	 * @since	1.2.0
	 */
	public function migrateExtensionCustom()
	{

/*
		// name -> title
		$query = "ALTER TABLE `#__adminpraise_menu` CHANGE `name` `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL";
		$this->db_new->setQuery($query);
		//$this->db_new->query();

		// Check for query error.
		$error = $this->db_new->getErrorMsg();

		if ($error) {
			throw new Exception($error);
		}

		// parent -> parent_id
		$query = "ALTER TABLE `#__adminpraise_menu` CHANGE `parent` `parent_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'";
		$this->db_new->setQuery($query);
		//$this->db_new->query();

		// Check for query error.
		$error = $this->db_new->getErrorMsg();

		if ($error) {
			throw new Exception($error);
		}
*/
		return true;
	}
}
