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
 * Upgrade class for banners clients 
 *
 * @since  2.5.2
 */
class RedMigratorBannerClients extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @param   array  $rows  Rows
	 *
	 * @return      void
	 *
	 * @throws      Exception
	 */
	public function dataHook($rows = null)
	{
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			$row['id'] = null;
		}

		return $rows;
	}
}
