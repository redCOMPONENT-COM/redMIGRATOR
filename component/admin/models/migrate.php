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

// No direct access.
defined('_JEXEC') or die;

JLoader::register('redMigrator', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.class.php');
JLoader::register('redMigratorStep', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.step.class.php');

/**
 * redMigrator Model
 *
 * @package		redMigrator
 */
class redMigratorModelMigrate extends RModelAdmin
{
	/**
	 * Migrate
	 *
	 * @return	none
	 * @since	3.0.3
	 */
	function migrate($table = false, $json = true, $extensions = false) {

		$table = (bool) ($table != false) ? $table : JRequest::getCmd('table', '');
		$extensions = (bool) ($extensions != false) ? $extensions : JRequest::getCmd('extensions', '');

		// Init the redMigrator instance
		$step = redMigratorStep::getInstance($table, $extensions);
		$redmigrator = redMigrator::getInstance($step);

		// Get the database structure
		if ($step->first == true && $extensions == 'tables') {
			$structure = $redmigrator->getTableStructure();
		}

		// Run the upgrade
		if ($step->total > 0) {
			try
			{
				$redmigrator->upgrade();
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage());
			}
		}

		// Javascript flags
		if ( $step->cid == $step->stop+1 && $step->total != 0) {
			$step->next = true;
		}
		if ($step->name == $step->laststep) {
			$step->end = true;
		}

		$empty = false;
		if ($step->cid == 0 && $step->total == 0 && $step->start == 0 && $step->stop == 0) {
			$empty = true;
		} 

		if ($step->stop == 0) {
			$step->stop = -1;
		}

		// Update #__redMigrator_steps table if id = last_id
		if ( ( ($step->total <= $step->cid) || ($step->stop == -1) && ($empty == false) ) )
		{
			$step->next = true;
			$step->status = 2;

			$step->_updateStep();
		}

		if (!redMigratorHelper::isCli()) {
			echo $step->getParameters();
		}else{
			return $step->getParameters();
		}
	}
} // end class
