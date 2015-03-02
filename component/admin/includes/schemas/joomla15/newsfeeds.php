<?php
/**
 * @package     redMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */
/**
 * Upgrade class for Newsfeeds
 *
 * This class takes the newsfeeds from the existing site and inserts them into the new site.
 *
 * @since	0.4.5
 */
class redMigratorNewsfeeds extends redMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 * @since	3.0.
	 * @throws	Exception
	 */
	public function dataHook($rows = null)
	{
		// Getting the component parameter with global settings
		$params = $this->getParams();	

		// Getting the categories id's
		$categories = $this->getMapList('categories', 'com_newsfeeds');

		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			$row['access'] = 1;
			$row['language'] = '*';

			if (version_compare(PHP_VERSION, '3.0', '>=')) {
				unset($row['filename']);
			}

			$cid = $row['catid'];
			$row['catid'] = &$categories[$cid]->new;
		}

		return $rows;
	}
}
