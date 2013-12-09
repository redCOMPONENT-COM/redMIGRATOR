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
 * Upgrade class for modules
 *
 * This class takes the modules from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */
class RedMigratorModules extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 */
	public function dataHook($rows = null)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('modules') - 1;

		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			// Create a map of old id and new id
			$old_id = (int) $row['id'];
			$new_id ++;
			$arrTemp = array('old_id' => $old_id, 'new_id' => $new_id);

			$arrModules = $session->get('arrModules', null, 'redmigrator_j25');

			$arrModules[] = $arrTemp;

			// Save the map to session
			$session->set('arrModules', $arrModules, 'redmigrator_j25');

			$row['id'] = null;
		}

		return $rows;
	}
}
