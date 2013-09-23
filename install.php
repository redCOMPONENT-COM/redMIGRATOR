<?php
/**
 * @package     Redmigrator
 * @subpackage  Install
 *
 * @copyright   Copyright (C) 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

// Find redRAD installer to use it as base system
if (!class_exists('Pkg_RedradInstallerScript'))
{
	$searchPaths = array(
		// Install
		dirname(__FILE__) . '/redRAD',
		// Discover install
		JPATH_ADMINISTRATOR . '/manifests/packages/redrad',
		// Uninstall
		JPATH_LIBRARIES . '/redrad'
	);

	if ($redradInstaller = JPath::find($searchPaths, 'install.php'))
	{
		require_once $redradInstaller;
	}
	else
	{
		throw new Exception('redRAD installer not found!', 500);
	}
}

/**
 * Custom installation of redMIGRATOR
 *
 * @package     Redmigrator
 * @subpackage  Install
 * @since       1.0
 */
class Com_RedmigratorInstallerScript extends Pkg_RedradInstallerScript
{
	public function postflight($type, $parent)
	{
		if (parent::postflight($type, $parent))
		{
			jimport(joomla.filesystem.file);

			JFile::move('com_redmigrator.xml', 'redmigrator.xml', JPATH_ADMINISTRATOR . '/components/com_redmigrator');

			return true;
		}

		return false;
	}
}
