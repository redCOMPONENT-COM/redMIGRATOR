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
 * Upgrade class for FrontEnd content
 *
 */
class RedMigratorContentFrontpage extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 */
	public function dataHook($rows)
	{
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			if ($row['content_id'] != '')
			{
				$row['content_id'] = RedMigratorHelper::lookupNewId('arrContent', (int) $row['content_id']);
			}
		}

		return $rows;
	}
}
