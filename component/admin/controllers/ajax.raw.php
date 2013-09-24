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
defined('_JEXEC') or die;

/**
 * The redMigrator ajax controller 
 *
 * @package     redMigrator
 * @subpackage  com_redMigrator
 * @since       3.0.3
 */
class redMigratorControllerAjax extends RControllerAdmin
{
	/**
	 * @var		string	The context for persistent state.
	 * @since   3.0.3
	 */
	protected $context = 'com_redmigrator.ajax';

	/**
	 * Proxy for getModel.
	 *
	 * @param   string	$name	The name of the model.
	 * @param   string	$prefix	The prefix for the model class name.
	 *
	 * @return  redMigratorModel
	 * @since   3.0.3
	 */
	public function getModel($name = '', $prefix = 'redMigratorModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	/**
	 * Run the redMigrator checks
	 */
	public function checks()
	{
		// Get the model for the view.
		$model = $this->getModel('Checks');

		// Running the checks
		try {
			$model->checks();
		} catch (Exception $e) {
			$model->returnError (500, $e->getMessage());
		}

	}

	/**
	 * Run the redMigrator cleanup
	 */
	public function cleanup()
	{
		// Get the model for the view.
		$model = $this->getModel('Cleanup');

		// Running the cleanup
		try {
			$model->cleanup();
		} catch (Exception $e) {
			$model->returnError (500, $e->getMessage());
		}
	}

	/**
	 * Run redMigrator step
	 */
	public function step()
	{
		// Get the model for the view.
		$model = $this->getModel('Step');

		// Running the step
		try {
			$model->step(false, true);
		} catch (Exception $e) {
			$model->returnError (500, $e->getMessage());
		}
	}

	/**
	 * Run redMigrator migrate
	 */
	public function migrate()
	{
		// Get the model for the view.
		$model = $this->getModel('Migrate');

		// Running the migrate
		try {
			$model->migrate();
		} catch (Exception $e) {
			$model->returnError (500, $e->getMessage());
		}
	}

	/**
	 * Run redMigrator extensions
	 */
	public function extensions()
	{
		// Get the model for the view.
		$model = $this->getModel('Extensions');

		// Running the extensions
		try {
			$model->extensions();
		} catch (Exception $e) {
			$model->returnError (500, $e->getMessage());
		}
	}
}
