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

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Require redCORE
require_once JPATH_LIBRARIES . '/redcore/bootstrap.php';

// Turn off all error reporting
error_reporting(0);
//error_reporting(E_ALL);
//ini_set( 'display_errors','1'); 

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_redmigrator')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// import joomla controller library
jimport('joomla.application.component.controller');
 
// Getting the controller
$controller	= JControllerLegacy::getInstance('redMigrator');
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();
