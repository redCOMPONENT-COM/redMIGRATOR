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
 * Upgrade class for Users
 *
 * This class takes the users from the source site and inserts them into the target site.
 */
class RedMigratorUsernotes extends RedMigrator
{
	/**
	 * Change structure of table and value of fields
	 * so data can be inserted into target db
	 *
	 * @param $rows Rows of source db
	 *
	 * @return mixed
	 */
	public function dataHook($rows)
	{
		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			if (!empty($row['user_id']))
			{
				$newUserId = RedMigratorHelper::lookupNewId('arrUsers', $row['user_id']);
				$row['user_id'] = $newUserId;
			}

			if (!empty($row['created_user_id']))
			{
				$newCreatedUserId = RedMigratorHelper::lookupNewId('arrUsers', $row['created_user_id']);
				$row['created_user_id'] = $newCreatedUserId;
			}
		}

		return $rows;
	}
}
