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

// Require redCORE
require_once JPATH_LIBRARIES . '/redcore/bootstrap.php';

// Turn off all error reporting
error_reporting(0);
// Error reporting(E_ALL);
// Ini_set('display_errors','1');

// Set unlimit timeout
ini_set('max_execution_time', 0);

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_redmigrator'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Import joomla controller library
Jloader::import('joomla.application.component.controller');

// Loading the helper
JLoader::import('helpers.redmigrator', JPATH_COMPONENT_ADMINISTRATOR);

// Getting the controller
$controller	= JControllerLegacy::getInstance('RedMigrator');
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();
