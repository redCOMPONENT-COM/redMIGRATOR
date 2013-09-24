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
JLoader::register('redMigratorExtensions', JPATH_COMPONENT_ADMINISTRATOR.'/includes/redmigrator.extensions.class.php');

/**
 * redMigrator Model
 *
 * @package		redMigrator
 */
class redMigratorModelExtensions extends RModelAdmin
{
	/**
	 * Migrate the extensions
	 *
	 * @return	none
	 * @since	2.5.0
	 */
	function extensions() {

		// Get the step
		$step = redMigratorStep::getInstance('extensions', true);

		// Get redMigratorExtensions instance
		$extensions = redMigrator::getInstance($step);
		$success = $extensions->upgrade();

		if ($success === true) {
			$step->status = 2;
			$step->_updateStep();
			return true;
		}
	}
} // end class
