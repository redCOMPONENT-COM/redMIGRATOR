<?php
/**
 * @package     Redmigrator.Plugin
 * @subpackage  System.Redmigrator
 *
 * @copyright   Copyright (C) 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

/**
 * Custom installation of redMIGRATOR
 *
 * @package     Redmigrator
 * @subpackage  Install
 * @since       1.0
 */
class PlgSystemRedmigratorInstallerScript
{
	/**
	 * Method to run after an install/update/uninstall method
	 *
	 * @param   object  $type    type of change (install, update or discover_install)
	 * @param   object  $parent  class calling this method
	 *
	 * @return void
	 */
	public function postflight($type, $parent)
	{
		// Rename the suffixed J25 manifest
		$suffixedManifest = JPATH_SITE . '/plugins/system/redmigrator/redmigrator.j25.xml';
		$manifest         = JPATH_SITE . '/plugins/system/redmigrator/redmigrator.xml';

		if (file_exists(JPATH_SITE . '/plugins/system/redmigrator/redmigrator.j25.xml'))
		{
			rename($suffixedManifest, $manifest);
		}

		return true;
	}
}
