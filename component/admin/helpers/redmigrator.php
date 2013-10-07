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
	 * @return  int	The total number
	 *
	 * @since   3.0.0
	 */
	public static function requireClass($name, $xmlpath, $class)
	{
		if (!empty($name))
		{
			// Loading the JFile class
			JLoader::import('joomla.filesystem.file');

			$file_core = JPATH_COMPONENT_ADMINISTRATOR . "/includes/schemas/joomla15/{$name}.php";
			$file_checks = JPATH_COMPONENT_ADMINISTRATOR . "/includes/extensions/{$name}.php";

			// Require the file
			if (JFile::exists($file_core))
			{
				JLoader::register($class, $file_core);
			}
			elseif (JFile::exists($file_checks)) // Checks
			{
				JLoader::register($class, $file_checks);
			}
			elseif (isset($xmlpath)) // 3rd party extensions
			{
				$phpfile_strip = JFile::stripExt(JPATH_PLUGINS . "/redmigrator/" . $xmlpath);

				if (JFile::exists("{$phpfile_strip}.php"))
				{
					JLoader::register($class, "{$phpfile_strip}.php");
				}
			}
		}
	}

	/**
	 * Getting the total 
	 *
	 * @return  int	The total number
	 *
	 * @since   3.0.0
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
	 * @return  bool	True if succeful
	 *
	 * @since   3.1.0
	 */
	public static function populateDatabase(& $db, $sqlfile)
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
     * returnError
     *
     * @return	none
     *
     * @since	2.5.0
     */
    public static function returnError ($number, $text)
    {
        $message['number'] = $number;
        $message['text'] = JText::_($text);
        echo json_encode($message);
        exit;
    }
}
