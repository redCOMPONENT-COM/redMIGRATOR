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

/**
 * Upgrade class for Contacts
 *
 * This class takes the contacts from the existing site and inserts them into the new site.
 */
class RedMigratorContacts extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @param   array  $rows  $rows
	 *
	 * @return null
	 */
	public function dataHook($rows = null)
	{
		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			$row['id'] = null;
			$row['alias'] = $row['alias'] . '_old';

			if ($row['user_id'] != '')
			{
				$row['user_id'] = RedMigratorHelper::lookupNewId('arrUsers', (int) $row['user_id']);
			}

			if ($row['catid'] != '')
			{
				$row['catid'] = RedMigratorHelper::lookupNewId('arrCategories', (int) $row['catid']);
			}

			if (version_compare(PHP_VERSION, '3.0', '>='))
			{
				unset($row['imagepos']);
			}
		}

		return $rows;
	}
}
