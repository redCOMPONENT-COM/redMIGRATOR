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
 * Upgrade class for Banners
 *
 * This class takes the banners from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */
class RedMigratorBanners extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return      void
	 *
	 * @since       0.4.
	 * @throws      Exception
	 */
	public function dataHook($rows = null)
	{
		foreach($rows as &$row)
		{
			$row = (array) $row;

			$row['id'] = null;
			$row['alias'] = $row['alias'] . '_old';

			if ($row['catid'] != '')
			{
				$row['catid'] = RedMigratorHelper::lookupNewId('arrCategories', (int) $row['catid']);
			}
		}

		return $rows;
	}
}
