<?php
/**
 * @package     Redmigrator
 * @subpackage  Install
 *
 * @copyright   Copyright (C) 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die;

JLoader::import('joomla.filesystem.file');

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
	else
	{
		throw new Exception('redCORE installer not found!', 500);
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
	public function preflight($type, $parent)
	{
		if ($type == "update")
		{
			// Get component id
			$db = JFactory::getDbo();

			$query = $db->getQuery(true);
			$query->select('extension_id');
			$query->from('#__extensions');
			$query->where($query->qn('type') . ' = ' . $db->quote('component'));
			$query->where($query->qn('element') . ' = ' . $db->quote('com_redmigrator'));
			$db->setQuery($query);
			$componentId = $db->loadResult();

			// Change version from JUpgradePro (3.1.0) to redMigrator (1.0.0)
			if ($componentId)
			{
				$query->clear();
				$query->update('#__schemas')
					->set('version_id = "1.0.0"')
					->where('extension_id = ' . $componentId)
					->where('version_id = "3.1.0"');
				$db->setQuery($query);
				$db->execute();
			}

			// Delete update script 3.1.0.sql
			$updateScript = JPATH_ADMINISTRATOR . '/components/com_redmigrator/sql/updates/mysql/3.1.0.sql';

			if (JFile::exists($updateScript))
			{
				JFile::delete($updateScript);
			}
		}
	}

	public function postflight($type, $parent)
	{
		if (parent::postflight($type, $parent))
		{
			JFile::move('com_redmigrator.xml', 'redmigrator.xml', JPATH_ADMINISTRATOR . '/components/com_redmigrator');

			return true;
		}

		return false;
	}
}
