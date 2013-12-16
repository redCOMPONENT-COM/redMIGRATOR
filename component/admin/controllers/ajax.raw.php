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
 * The RedMigrator ajax controller 
 *
 * @package     RedMigrator
 * @subpackage  com_RedMigrator
 * @since       3.0.3
 */
class RedMigratorControllerAjax extends RControllerAdmin
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string	$name    The name of the model.
	 * @param   string	$prefix  The prefix for the model class name.
	 * @param   array   $config  Config
	 *
	 * @return RedMigratorModel
	 */
	public function getModel($name = '', $prefix = 'RedMigratorModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}

	/**
	 * Run the RedMigrator checks
	 *
	 * @return none
	 */
	public function checks()
	{
		// Get the model for the view.
		$model = $this->getModel('Checks');

		// Running the checks
		try
		{
			$model->checks();
		}
		catch (Exception $e)
		{
			RedMigratorHelper::returnError(500, $e->getMessage());
		}

	}

	/**
	 * Run the RedMigrator cleanup
	 *
	 * @return none
	 */
	public function cleanup()
	{
		// Get the model for the view.
		$model = $this->getModel('Cleanup');

		// Running the cleanup
		try
		{
			$model->cleanup();
		}
		catch (Exception $e)
		{
			RedMigratorHelper::returnError(500, $e->getMessage());
		}
	}

	/**
	 * Run RedMigrator step
	 *
	 * @return none
	 */
	public function step()
	{
		// Get the model for the view.
		$model = $this->getModel('Step');

		// Running the step
		try
		{
			$model->step();
		}
		catch (Exception $e)
		{
			RedMigratorHelper::returnError(500, $e->getMessage());
		}
	}

	/**
	 * Run RedMigrator migrate
	 *
	 * @return none
	 */
	public function migrate()
	{
		// Get the model for the view.
		$model = $this->getModel('Migrate');

		// Running the migrate
		try
		{
			$model->migrate();
		}
		catch (Exception $e)
		{
			RedMigratorHelper::returnError(500, $e->getMessage());
		}
	}

	/**
	 * Run RedMigrator extensions
	 *
	 * @return none
	 */
	public function extensions()
	{
		// Get the model for the view.
		$model = $this->getModel('Extensions');

		// Running the extensions
		try
		{
			$model->extensions();
		}
		catch (Exception $e)
		{
			RedMigratorHelper::returnError(500, $e->getMessage());
		}
	}
}
