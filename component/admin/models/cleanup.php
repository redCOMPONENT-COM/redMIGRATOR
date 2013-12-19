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
JLoader::register('RedMigratorDriver', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.driver.class.php');
JLoader::register('RedMigratorStep', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.step.class.php');

/**
 * RedMigrator Model
 */
class RedMigratorModelCleanup extends RModelAdmin
{
	/**
	 * Cleanup
	 *
	 * @return none
	 */
	function cleanup()
	{
		// Importing helper tags
		JLoader::import('cms.helper.tags');

		// Getting the component parameter with global settings
		$params = RedMigratorHelper::getParams();

		// Convert the params to array
		$core_skips = (array) $params;

		// Version of source joomla (J15 or J25)
		$core_version = $core_skips['core_version'];

		// Clean #__redmigrator_steps table
		$query = "Truncate table #__redmigrator_steps";
		$this->_db->setQuery($query)->execute();

		// Xml file includes core steps
		$schemasPath = JPATH_COMPONENT_ADMINISTRATOR . "/includes/schemas";

		// Init session values
		$session = JFactory::getSession();

		if ($core_version == 0) // J15 core
		{
			$xml_file = $schemasPath . "/joomla15/steps.xml";
		}
		else // J25 core
		{
			$xml_file = $schemasPath . "/joomla25/steps.xml";
		}

		// Map category old id to new id
		$session->set('arrCategories', array(), 'redmigrator_j25');

		// Category items have parent item after itself in db
		$session->set('arrCategoriesSwapped', array(), 'redmigrator_j25');

		// Map content old id to new id
		$session->set('arrContent', array(), 'redmigrator_j25');

		// Map user old id to new id
		$session->set('arrUsers', array(), 'redmigrator_j25');

		// Map usergroup old id to new id
		$session->set('arrUsergroups', array(), 'redmigrator_j25');

		// Usergroup items have parent item after itself in db
		$session->set('arrUsergroupsSwapped', array(), 'redmigrator_j25');

		// Map menu old id to new id
		$session->set('arrMenu', array(), 'redmigrator_j25');

		// Menu items have parent item after itself in db
		$session->set('arrMenuSwapped', array(), 'redmigrator_j25');

		// Map module old id to new id
		$session->set('arrModules', array(), 'redmigrator_j25');

		// Map banner old id to new id
		$session->set('arrBanners', array(), 'redmigrator_j25');

		// Save the steps in xml file into db
		RedMigratorHelper::populateSteps($xml_file);

		$query = $this->_db->getQuery(true);

		// Skipping the steps setted by user
		foreach ($core_skips as $k => $v)
		{
			$core = substr($k, 0, 9);
			$name = substr($k, 10, 18);

			if ($core == "skip_core")
			{
				if ($v == 1)
				{
					$query->clear();

					// Set all status to 2 and clear state
					$query->update('#__redmigrator_steps')
							->set('status = 2')
							->where("name = '{$name}'");

					try
					{
						$this->_db->setQuery($query)->execute();
					}
					catch (RuntimeException $e)
					{
						throw new RuntimeException($e->getMessage());
					}

					$query->clear();

					if ($name == 'users')
					{
						$query->update('#__redmigrator_steps')
								->set('status = 2');

						if ($core_version == 0)
						{
							$query->where('name = "arogroup" OR name = "usergroupmap" OR name = "aclaro"');
						}
						else
						{
							$query->where('name = "usergroups" OR name = "usergroupmap" OR name = "usernotes" OR name = "userprofiles"');
						}

						try
						{
							$this->_db->setQuery($query)->execute();
						}
						catch (RuntimeException $e)
						{
							throw new RuntimeException($e->getMessage());
						}
					}

					if ($name == 'categories')
					{
						if ($core_version == 0)
						{
							$query->update('#__redmigrator_steps')
								->set('status = 2')
								->where('name = "sections"');

							try
							{
								$this->_db->setQuery($query)->execute();
							}
							catch (RuntimeException $e)
							{
								throw new RuntimeException($e->getMessage());
							}
						}
					}
				}
			}

			if ($k == 'skip_extensions')
			{
				if ($v == 1)
				{
					$query->clear();
					$query->update('#__redmigrator_steps')
							->set('status = 2')
							->where('name = "extensions"');

					try
					{
						$this->_db->setQuery($query)->execute();
					}
					catch (RuntimeException $e)
					{
						throw new RuntimeException($e->getMessage());
					}
				}
			}
		}

		// Truncate the selected tables
		$tables = array('#__redmigrator_core_acl_aro');
		/*$tables[] = '#__redmigrator_categories';
		$tables[] = '#__redmigrator_menus';
		$tables[] = '#__redmigrator_modules';
		$tables[] = '#__redmigrator_default_categories';*/

		for ($i = 0; $i < count($tables); $i++)
		{
			$query->clear();
			$query->delete()->from("{$tables[$i]}");

			try
			{
				$this->_db->setQuery($query)->execute();
			}
			catch (RuntimeException $e)
			{
				throw new RuntimeException($e->getMessage());
			}
		}

		if (!RedMigratorHelper::isCli())
		{
			RedMigratorHelper::returnError(100, 'DONE');
		}
	}
} // End class
