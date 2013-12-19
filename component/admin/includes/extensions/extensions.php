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

/**
 * Upgrade class for 3rd party extensions
 *
 * This class search for extensions to be migrated
 *
 * @since  0.4.5
 */
class RedMigratorCheckExtensions extends RedMigratorExtensions
{
	/**
	 * count adapters
	 * @var int
	 * @since 1.1.0
	 */
	public $count = 0;

	protected $extensions = array();

	/**
	 * Upgrade
	 *
	 * @return bool
	 */
	public function upgrade()
	{
		// $core_version = $this->params->core_version;

		/*if ($core_version == 0)
		{
			if (!$this->upgradeComponents())
			{
				return false;
			}

			if (!$this->upgradeModules())
			{
				return false;
			}

			if (!$this->upgradePlugins())
			{
				return false;
			}
		}*/

		if (!$this->_processExtensions())
		{
			return false;
		}

		return true;
	}

	/**
	 * Upgrade the components
	 *
	 * @return  bool
	 *
	 * @throws	Exception
	 */
	/*protected function upgradeComponents()
	{
		// Getting the step
		$step = RedMigratorStep::getInstance('ext_components', true);

		// Get RedMigratorExtensionsComponents instance
		$components = RedMigrator::getInstance($step);

		$rows = $components->dataSwitch();

		$this->_addExtensions($rows, 'com');

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}*/

	/**
	 * Upgrade the modules
	 *
	 * @return	bool
	 *
	 * @since	1.1.0
	 * @throws	Exception
	 */
	/*protected function upgradeModules()
	{
		// Getting the step
		$step = RedMigratorStep::getInstance('ext_modules', true);

		// Get RedMigratorExtensionsModules instance
		$modules = RedMigrator::getInstance($step);
		$rows = $modules->dataSwitch();

		$this->_addExtensions($rows, 'mod');

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}*/

	/**
	 * Upgrade the plugins
	 *
	 * @return  bool
	 *
	 * @since	1.1.0
	 * @throws	Exception
	 */
	/*protected function upgradePlugins()
	{
		// Getting the step
		$step = RedMigratorStep::getInstance('ext_plugins', true);

		// Get RedMigratorExtensionsPlugins instance
		$plugins = RedMigrator::getInstance($step);
		$rows = $plugins->dataSwitch();

		$this->_addExtensions($rows, 'plg');

		$step->status = 2;
		$step->_updateStep(true);

		return true;
	}*/

	/**
	 * @param $rows
	 * @param $prefix
	 */
	/*protected function _addExtensions($rows, $prefix)
	{
		// Create new indexed array
		foreach ($rows as &$row)
		{
			// Convert the array into an object.
			$row = (object) $row;
			$row->id = null;

			if (isset($row->element))
			{
				$row->element = strtolower($row->element);

				// Ensure that name is always using form: xxx_folder_name
				$name = preg_replace('/^' . $prefix . '_/', '', $row->element);

				if (!empty($row->folder))
				{
					$element = preg_replace('/^' . $row->folder . '_/', '', $row->element);
					$row->name = ucfirst($row->folder) . ' - ' . ucfirst($element);
					$name = $row->folder . '_' . $element;
				}

				$name = $prefix . '_' . $name;
				$this->extensions[$name] = $row;
			}
		}
	}*/

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 *
	 * @since 1.1.0
	 * @throws	Exception
	 */
	protected function _processExtensions()
	{
		JLoader::import('joomla.filesystem.folder');

		$types = array(
			'/^com_(.+)$/e',		/*Com_componentname*/
			'/^mod_(.+)$/e',		/*Mod_modulename*/
			'/^plg_(.+)_(.+)$/e',	/*Plg_folder_pluginname*/
			'/^tpl_(.+)$/e');		/*Tpl_templatename*/

		$classes = array(
			"'RedMigratorComponent'.ucfirst('\\1')",				/*RedMigratorComponentComponentname*/
			"'RedMigratorModule'.ucfirst('\\1')",					/*RedMigratorModuleModulename*/
			"'RedMigratorPlugin'.ucfirst('\\1').ucfirst('\\2')",	/*RedMigratorPluginPluginname*/
			"'RedMigratorTemplate'.ucfirst('\\1')");				/*RedMigratorTemplateTemplatename*/

		// Getting the plugins list
		$query = $this->_db->getQuery(true);
		$query->select('*');
		$query->from('#__extensions');
		$query->where("type = 'plugin'");
		$query->where("folder = 'redmigrator'");
		$query->where("enabled = 1");

		// Setting the query and getting the result
		$this->_db->setQuery($query);
		$plugins = $this->_db->loadObjectList();

		// Do some custom post processing on the list.
		foreach ($plugins as $plugin)
		{
			// Remove database or 3rd extensions if exists
			$uninstall_script = JPATH_PLUGINS . "/redmigrator/{$plugin->element}/sql/uninstall.utf8.sql";
			RedMigratorHelper::populateDatabase($this->_db, $uninstall_script);

			// Install blank database of new 3rd extensions
			$install_script = JPATH_PLUGINS . "/redmigrator/{$plugin->element}/sql/install.utf8.sql";
			RedMigratorHelper::populateDatabase($this->_db, $install_script);

			// Looking for xml files
			$files = (array) JFolder::files(JPATH_PLUGINS . "/redmigrator/{$plugin->element}/extensions", '\.xml$', true, true);

			foreach ($files as $xmlfile)
			{
				if (!empty($xmlfile))
				{
					$element = JFile::stripExt(basename($xmlfile));

					if (array_key_exists($element, $this->extensions))
					{
						$extension = $this->extensions[$element];

						// Read xml definition file
						$xml = simplexml_load_file($xmlfile);

						// Getting the php file
						if (!empty($xml->installer->file[0]))
						{
							$phpfile = JPATH_ROOT . '/' . trim($xml->installer->file[0]);
						}

						if (empty($phpfile))
						{
							$default_phpfile = JPATH_PLUGINS . "/redmigrator/{$plugin->element}/extensions/{$element}.php";
							$phpfile = file_exists($default_phpfile) ? $default_phpfile : null;
						}

						// Getting the class
						if (!empty($xml->installer->class[0]))
						{
							$class = trim($xml->installer->class[0]);
						}

						if (empty($class))
						{
							$class = preg_replace($types, $classes, $element);
						}

						// Saving the extensions and migrating the tables
						if (!empty($phpfile) || !empty($xmlfile))
						{
							// Adding +1 to count
							/*$this->count = $this->count + 1;

							// Inserting the collection if exists
							if (isset($xml->name) && isset($xml->collection))
							{
								$query->clear();
								$query->insert('#__update_sites')->columns('name, type, location, enabled')
										->values("'{$xml->name}', 'collection',  '{$xml->collection}, 1");
								$this->_db->setQuery($query);
								$this->_db->execute();
							}*/

							// Adding tables to migrate
							if (!empty($xml->tables[0]))
							{
								$count = count($xml->tables[0]->table);

								for ($i = 0; $i < $count; $i++)
								{
									$table = new StdClass;
									$attributes = $xml->tables->table[$i]->attributes();
									$table->name = (string) $xml->tables->table[$i];
									$table->title = (string) $attributes->title;
									$table->tbl_key = (string) $attributes->tbl_key;
									$table->source = (string) $xml->tables->table[$i];
									$table->destination = (string) $attributes->destination;
									$table->type = (string) $attributes->type;
									$table->class = (string) $attributes->class;

									if (!$this->_db->insertObject('#__redmigrator_steps', $table))
									{
										throw new Exception($this->_db->getErrorMsg());
									}
								}
							}
						} /*End if*/
					} /*End if*/
				} /*End if*/

				unset($class);
				unset($phpfile);
				unset($xmlfile);
			} /*End foreach*/
		} /*End foreach*/

		return true;
	}
} /*End class*/
