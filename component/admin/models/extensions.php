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

// No direct access.
defined('_JEXEC') or die;

JLoader::register('RedMigrator', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.class.php');
JLoader::register('RedMigratorStep', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.step.class.php');
JLoader::register('RedMigratorExtensions', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.extensions.class.php');

/**
 * RedMigrator Model
 *
 */
class RedMigratorModelExtensions extends RModelAdmin
{
	/**
	 * Migrate the extensions
	 *
	 * @return	none
	 *
	 * @since	2.5.0
	 */
	function extensions()
	{
		// Get the step
		$step = RedMigratorStep::getInstance('extensions', true);

		// Get RedMigratorExtensions instance
		$extensions = RedMigrator::getInstance($step);

		// Initialize 3rd extensions
		$success = $extensions->upgrade();

		if ($success === true)
		{
			$step->status = 2;
			$step->_updateStep();

			return true;
		}
	}
} // End class
