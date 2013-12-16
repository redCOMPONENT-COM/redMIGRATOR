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
defined('_JEXEC') or die;

/**
 * RedMigrator Helper
 *
 * @package  Joomla.Administrator
 * @since    3.0.0
 */
class RedMigratorHelper
{
	/**
	 * Check if the class is called from CLI
	 *
	 * @return  void	True if is running from cli
	 *
	 * @since   3.0.0
	 */
	public static function isCli()
	{
		return (php_sapi_name() === 'cli') ? true : false;
	}

	/**
	 * Getting the parameters 
	 *
	 * @return  bool	True on success
	 *
	 * @since   3.0.0
	 */
	public static function getParams()
	{
		// Getting the type of interface between web server and PHP
		$sapi = php_sapi_name();

		// Getting the params and Joomla version web and cli
		if ($sapi == 'cli')
		{
			$params = new JRegistry(new JConfig);
		}
		else
		{
			$params	= JComponentHelper::getParams('com_redmigrator');
		}

		return $params->toObject();
	}

	/**
	 * Require the correct file from step
	 *
	 * @param   string  $name   Name
	 * @param   null    $type   Type
	 * @param   null    $class  Class
	 *
	 * @return none
	 */
	public static function requireClass($name, $type = null, $class = null)
	{
		if (!empty($name))
		{
			// Loading the JFile class
			JLoader::import('joomla.filesystem.file');

			if ($type == null) // Checks
			{
				$file_checks = JPATH_COMPONENT_ADMINISTRATOR . "/includes/extensions/{$name}.php";

				if (JFile::exists($file_checks))
				{
					JLoader::register($class, $file_checks);
				}
			}
			elseif ($type == "core15") // Joomla core15
			{
				$file_core = JPATH_COMPONENT_ADMINISTRATOR . "/includes/schemas/joomla15/{$name}.php";

				// Require the file
				if (JFile::exists($file_core))
				{
					JLoader::register($class, $file_core);
				}
			}
			elseif ($type == "core25") // Joomla core25
			{
				$file_core = JPATH_COMPONENT_ADMINISTRATOR . "/includes/schemas/joomla25/{$name}.php";

				// Require the file
				if (JFile::exists($file_core))
				{
					JLoader::register($class, $file_core);
				}
			}
			else // 3rd extension
			{
				$file_ext = JPATH_PLUGINS . "/redmigrator/redmigrator_{$type}/schemas/joomla15/{$name}.php";

				if (JFile::exists($file_ext))
				{
					JLoader::register($class, $file_ext);
				}
			}
		}
	}

	/**
	 * Getting the total
	 *
	 * @param   RedMigratorStep  $step  Step
	 *
	 * @return int
	 */
	public static function getTotal(RedMigratorStep $step = null)
	{
		JLoader::register('RedMigratorDriver', JPATH_COMPONENT_ADMINISTRATOR . '/includes/redmigrator.driver.class.php');

		$driver = RedMigratorDriver::getInstance($step);

		return $driver->getTotal();
	}

	/**
	 * Populate a sql file
	 *
	 * @param   JDatabase  $db       Database
	 * @param   string     $sqlfile  Sql script
	 *
	 * @return bool|int
	 *
	 * @throws Exception
	 */
	public static function populateDatabase($db, $sqlfile)
	{
		if (!($buffer = file_get_contents($sqlfile)))
		{
			return -1;
		}

		$queries = $db->splitSql($buffer);

		foreach ($queries as $query)
		{
			$query = trim($query);

			if ($query != '' && $query {0} != '#')
			{
				$db->setQuery($query);

				try
				{
					$db->query();
				}
				catch (Exception $e)
				{
					throw new Exception($e->getMessage());
				}
			}
		}

		return true;
	}

	/**
	 * Return error to client
	 *
	 * @param   int     $number  Number
	 * @param   string  $text    Text
	 *
	 * @return none
	 */
	public static function returnError($number, $text)
	{
		$message['number'] = $number;
		$message['text'] = JText::_($text);
		echo json_encode($message);
		exit;
	}

	/**
	 * Get next id will be inserted into the table
	 *
	 * @param   string  $table  Table name
	 *
	 * @return mixed
	 */
	public static function getAutoIncrement($table)
	{
		$conf = JFactory::getConfig();
		$db = JFactory::getDbo();
		$database = $conf->get('db');

		$query = "SHOW TABLE STATUS FROM `" . $database . "` WHERE name ='" . $db->getPrefix() . $table . "'";

		$db->setQuery($query);
		$row = $db->loadObject();

		return $row->Auto_increment;
	}

	/**
	 * Find new id from old
	 * Algorithm: Binary search
	 *
	 * @param   string  $sessionEntry  Table  name
	 * @param   int     $oldId         Old id
	 *
	 * @return int
	 */
	public static function lookupNewId($sessionEntry, $oldId)
	{
		$session = JFactory::getSession();

		$arrUsergroups = $session->get($sessionEntry, null, 'redmigrator_j25');

		$first = 0;
		$last = count($arrUsergroups) - 1;
		$middle = (int) (($first + $last) / 2);

		// Id not exist
		$newId = -1;

		while ($first <= $last)
		{
			if ((int) $arrUsergroups[$middle]['old_id'] < $oldId)
			{
				$first = $middle + 1;
			}
			elseif ((int) $arrUsergroups[$middle]['old_id'] == $oldId)
			{
				$newId = (int) $arrUsergroups[$middle]['new_id'];
				break;
			}
			else
			{
				$last = $middle - 1;
			}

			$middle = (int) (($first + $last) / 2);
		}

		return $newId;
	}

	/**
	 * Fill data from xml file to #__redmigrator_steps table
	 *
	 * @param   string  $xmlfile  The path of xml file
	 *
	 * @return none
	 */
	public static function populateSteps($xmlfile)
	{
		$xml = simplexml_load_file($xmlfile);

		$db = JFactory::getDbo();

		// Adding tables to migrate
		if (!empty($xml->tables[0]))
		{
			$count = count($xml->tables[0]->table);

			for ($i = 0; $i < $count; $i++)
			{
				$table = new StdClass;
				$attributes = $xml->tables->table[$i]->attributes();

				if (isset($attributes->name) && $attributes->name != "")
				{
					$table->name = (string) $attributes->name;
				}
				else
				{
					$table->name = (string) $xml->tables->table[$i];
				}

				$table->title = (string) $attributes->title;

				if (isset($attributes->tbl_key) && $attributes->tbl_key != "")
				{
					$table->tbl_key = (string) $attributes->tbl_key;
				}
				else
				{
					$table->tbl_key = "";
				}

				if (isset($attributes->source) && $attributes->source != "")
				{
					$table->source = (string) $attributes->source;
				}
				else
				{
					$table->source = $table->name;
				}

				if (isset($attributes->destination) && $attributes->destination != "")
				{
					$table->destination = (string) $attributes->destination;
				}
				else
				{
					$table->destination = $table->source;
				}

				$table->type = (string) $attributes->type;

				$table->class = (string) $attributes->class;

				if (!$db->insertObject('#__redmigrator_steps', $table))
				{
					throw new Exception($db->getErrorMsg());
				}
			}
		}
	}

	/**
	 * Only for developer debug
	 *
	 * @param   string  $filename  File name
	 * @param   string  $content   Content
	 *
	 * @return none
	 */
	public static function writeFile ($filename, $content)
	{
		$handle = fopen(JPATH_COMPONENT_ADMINISTRATOR . '/' . $filename, 'a');
		fwrite($handle, $content);
		fclose($handle);
	}
}
