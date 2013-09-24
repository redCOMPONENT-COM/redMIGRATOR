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
class redMigratorModelStep extends RModelAdmin
{
	/**
	 * Initial checks in redMigrator
	 *
	 * @return	none
	 * @since	1.2.0
	 */
	public function step($name = false, $json = true, $extensions = false) {

		// Check if extensions exists if not get it from URI request
		$extensions = (bool) ($extensions != false) ? $extensions : JRequest::getCmd('extensions', '');

		// Getting the redMigratorStep instance
		$step = redMigratorStep::getInstance(null, $extensions);

		// Check if name exists
		$name = !empty($name) ? $name : $step->name;

		// Get the next step
		$step->getStep($name);

		if (!redMigratorHelper::isCli()) {
			echo $step->getParameters();
		}else{
			return $step->getParameters();
		}
	}

	/**
	 * returnError
	 *
	 * @return	none
	 * @since	2.5.0
	 */
	public function returnError ($number, $text)
	{
		$message['number'] = $number;
		$message['text'] = JText::_($text);
		echo json_encode($message);
		exit;
	}

} // end class
