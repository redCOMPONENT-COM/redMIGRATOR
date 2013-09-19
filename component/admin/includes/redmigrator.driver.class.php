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
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

/**
 * redMigrator driver class
 *
 * @package		MatWare
 * @subpackage	com_redMigrator
 */
class redMigratorDriver
{	
	/**
	 * @var      
	 * @since  3.0
	 */
	public $params = null;
	
	/**
	 * @var      
	 * @since  3.0
	 */
	public $_db = null;

	/**
	 * @var	array
	 * @since  3.0
	 */
	protected $_step = null;

	function __construct(redMigratorStep $step = null)
	{
		jimport('legacy.component.helper');
		JLoader::import('helpers.redmigrator', JPATH_COMPONENT_ADMINISTRATOR);

		// Set the step params	
		$this->_step = $step;

		$this->params = redMigratorHelper::getParams();

		// Creating dabatase instance for this installation
		$this->_db = JFactory::getDBO();
	}

	/**
	 *
	 * @param   stdClass   $options  Parameters to be passed to the database driver.
	 *
	 * @return  redMigrator  A redMigrator object.
	 *
	 * @since  3.0.0
	 */
	static function getInstance(redMigratorStep $step = null)
	{
		// Loading the JFile class
		jimport('joomla.filesystem.file');

		// Getting the params and Joomla version web and cli
		$params = redMigratorHelper::getParams();

		// Derive the class name from the driver.
		$class_name = 'redMigratorDriver' . ucfirst(strtolower($params->method));
		$class_file = JPATH_COMPONENT_ADMINISTRATOR.'/includes/driver/'.$params->method.'.php';

		// Require the driver file
		if (JFile::exists($class_file)) {
			JLoader::register($class_name, $class_file);
		}

		// If the class still doesn't exist we have nothing left to do but throw an exception.  We did our best.
		if (!class_exists($class_name))
		{
			throw new RuntimeException(sprintf('Unable to load redMigrator Driver: %s', $params->method));
		}

		// Create our new redMigratorDriver connector based on the options given.
		try
		{
			$instance = new $class_name($step);
		}
		catch (RuntimeException $e)
		{
			throw new RuntimeException(sprintf('Unable to load redMigrator object: %s', $e->getMessage()));
		}

		return $instance;
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
