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

/**
 * Class RedMigratorModelStep
 */
class RedMigratorModelStep extends RModelAdmin
{
	/**
	 * Initial checks in RedMigrator
	 *
	 * @param   bool  $name        Name of step
	 * @param   bool  $extensions  True if migrate 3rd extension
	 *
	 * @return mixed
	 */
	public function step($name = false, $extensions = false)
	{
		// Check if extensions exists if not get it from URI request
		if ($extensions === false)
		{
			$extensions = JRequest::getCmd('extensions', '');
		}

		// Getting the RedMigratorStep instance
		$step = RedMigratorStep::getInstance(null, $extensions);

		// Check if name exists
		if ($name === false)
		{
			$name = $step->name;
		}

		// Get the next step
		$step->getStep($name);

		if (!RedMigratorHelper::isCli())
		{
			echo $step->getParameters();
		}
		else
		{
			return $step->getParameters();
		}
	}
} // End class
