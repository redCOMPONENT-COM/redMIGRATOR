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
 * Upgrade class for Banners
 *
 * This class takes the banners from the existing site and inserts them into the new site.
 *
 * @since       0.4.5
 */
class redMigratorBannersTracks extends redMigrator
{
	/**
	 * Setting the conditions hook
	 *
	 * @return	array
	 * @since	3.1.0
	 * @throws	Exception
	 */
	public static function getConditionsHook()
	{
		$conditions = array();
		
		$conditions['where'] = array();

		$conditions['group_by'] = "banner_id";
		
		return $conditions;
	}
} // end class
