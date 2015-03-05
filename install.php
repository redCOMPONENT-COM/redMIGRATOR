<?php
/**
 * @package     Redmigrator
 * @subpackage  Install
 *
 * @copyright   Copyright (C) 2012 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

// Find redCORE installer to use it as base system
if (!class_exists('Com_RedcoreInstallerScript'))
{
	$searchPaths = array(
		// Install
		dirname(__FILE__) . '/redCORE',
		// Discover install
		JPATH_ADMINISTRATOR . '/components/com_redcore'
	);

	if ($redcoreInstaller = JPath::find($searchPaths, 'install.php'))
	{
		require_once $redcoreInstaller;
	}
}


/**
 * Custom installation of redMIGRATOR
 *
 * @package     Redmigrator
 * @subpackage  Install
 * @since       1.0
 */
class Com_RedmigratorInstallerScript extends Com_RedcoreInstallerScript
{
}
