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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * RedMigrator driver class
 *
 */
class RedMigratorDriver
{
	/**
	 * Config params
	 *
	 * @var object
	 */
	public $params = null;

	/**
	 * Target database
	 *
	 * @var object
	 */
	protected $_db = null;

	/**
	 * Current step
	 *
	 * @var	array
	 */
	protected $_step = null;

	/**
	 * Constructor
	 *
	 * @param RedMigratorStep $step
	 */
	public function __construct(RedMigratorStep $step = null)
	{
		JLoader::import('legacy.component.helper');

		// Get config params
		$this->params = RedMigratorHelper::getParams();

		// Creating dabatase instance for this installation
		$this->_db = JFactory::getDBO();

		// Set the step params
		$this->_step = $step;
	}

	/**
	 * Create driver instance depend on $param->method (database or restful)
	 *
	 * @param   stdClass   $options  Parameters to be passed to the database driver.
	 *
	 * @return  RedMigrator  A RedMigrator object.
	 */
	public static function getInstance(RedMigratorStep $step = null)
	{
		// Loading the JFile class
		JLoader::import('joomla.filesystem.file');

		// Getting the params and Joomla version web and cli
		$params = RedMigratorHelper::getParams();

		// Derive the class name from the driver.
		$class_name = 'RedMigratorDriver' . ucfirst(strtolower($params->method));
		$class_file = JPATH_COMPONENT_ADMINISTRATOR . '/includes/driver/' . $params->method . '.php';

		// Require the driver file
		if (JFile::exists($class_file))
		{
			JLoader::register($class_name, $class_file);
		}

		// If the class still doesn't exist we have nothing left to do but throw an exception.  We did our best.
		if (!class_exists($class_name))
		{
			throw new RuntimeException(sprintf('Unable to load RedMigrator Driver: %s', $params->method));
		}

		// Create our new RedMigratorDriver connector based on the options given.
		try
		{
			$instance = new $class_name($step);
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException(sprintf('Unable to load RedMigrator object: %s', $e->getMessage()));
		}

		return $instance;
	}

	/**
	 * Get data from source database
	 *
	 * @return null
	 */
	public function getSourceData()
	{
		return null;
	}

	/**
	 * Update the step id
	 *
	 * @return  int  The next id
	 *
	 * @since   3.0.0
	 */
	public function _getStepID()
	{
		return $this->_step->cid;
	}

	/**
	 * @return  string	The step name
	 *
	 * @since   3.0
	 */
	public function _getStepName()
	{
		return $this->_step->name;
	}
}
