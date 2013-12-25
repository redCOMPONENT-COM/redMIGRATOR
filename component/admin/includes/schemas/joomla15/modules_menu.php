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
 * Upgrade class for modules menu
 *
 * This class takes the modules from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */
class RedMigratorModulesMenu extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @param   array  $rows  Rows
	 *
	 * @return	object
	 */
	public function dataHook($rows = null)
	{
		foreach ($rows as $k => &$row)
		{
			// Convert the array into an object.
			$row = (array) $row;

			if ($row['moduleid'] != '')
			{
				$row['moduleid'] = RedMigratorHelper::lookupNewId('arrModules', (int) $row['moduleid']);
			}

			if ($row['menuid'] != '' && (int) $row['menuid'] > 0)
			{
				$row['menuid'] = RedMigratorHelper::lookupNewId('arrMenu', (int) $row['menuid']);
			}

			// Module or menu item doesn't exist
			if ((int) $row['moduleid'] == -1 || (int) $row['menuid'] == -1)
			{
				$rows[$k] = false;
			}
		}

		return $rows;
	}
}
