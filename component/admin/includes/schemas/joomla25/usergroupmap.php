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
 * Upgrade class for the Usergroup Map
 *
 * This translates the group mapping table from 2.5 to 3.0.
 * User id's are maintained in this upgrade process.
 *
 */
class RedMigratorUsergroupMap extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 *
	 * @since	0.4.
	 * @throws	Exception
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

			if (!empty($row['group_id']))
			{
				$newGroupId = RedMigratorHelper::lookupNewId('arrUsergroups', $row['group_id']);
				$row['group_id'] = $newGroupId;
			}
		}

		return $rows;
	}
}
