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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Import Joomla controller library
JLoader::import('joomla.application.component.controller');

/**
 * General Controller of RedMigrator component
 */
class RedMigratorController extends JControllerLegacy
{
	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = array())
	{
		// Set default view if not set
		JRequest::setVar('view', JRequest::getCmd('view', 'cpanel'));

		// Call parent behavior
		parent::display($cachable);
	}
}
