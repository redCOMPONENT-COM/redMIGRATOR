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
 * RedMigrator RESTful utility class
 *
 */
class RedMigratorDriverRestful extends RedMigratorDriver
{
	/**
	 * Constructor
	 *
	 * @param   RedMigratorStep  $step  Current step
	 */
	function __construct(RedMigratorStep $step = null)
	{
		parent::__construct($step);
	}

	/**
	 * Get the raw data for this part of the upgrade.
	 *
	 * @return	array	Returns a reference to the source data array.
	 *
	 * @throws	Exception
	 */
	public function getRestfulAuthData()
	{
		$data = array();

		// Setting the headers for REST
		$restful_username = $this->params->restful_username;
		$restful_password = $this->params->restful_password;
		$restful_key = $this->params->restful_key;

		// Setting the headers for REST
		$str = $restful_username . ":" . $restful_password;
		$data['Authorization'] = base64_encode($str);

		// Encoding user
		$user_encode = $restful_username . ":" . $restful_key;
		$data['AUTH_USER'] = base64_encode($user_encode);

		// Sending by other way, some servers not allow AUTH_ values
		$data['USER'] = base64_encode($user_encode);

		// Encoding password
		$pw_encode = $restful_password . ":" . $restful_key;
		$data['AUTH_PW'] = base64_encode($pw_encode);

		// Sending by other way, some servers not allow AUTH_ values
		$data['PW'] = base64_encode($pw_encode);

		// Encoding key
		$key_encode = $restful_key . ":" . $restful_key;
		$data['KEY'] = base64_encode($key_encode);

		return $data;
	}

	/**
	 * Get source data
	 *
	 * @return array|null
	 */
	public function getSourceData()
	{
		return (array) $this->_requestRestful('row');
	}

	/**
	 * Get total rows of source table
	 *
	 * @return int
	 */
	public function getTotal()
	{
		return (int) $this->_requestRestful('total');
	}

	/**
	 * Receive data from source site through webservice
	 *
	 * @param   string  $task  Total or row
	 *
	 * @return int|string
	 *
	 * @throws Exception
	 */
	protected function _requestRestful($task = 'total')
	{
		$http = JHttpFactory::getHttp();

		$data = $this->getRestfulAuthData();

		$data['table'] = $this->_step->source;
		$data['task'] = $task;

		if ($task == 'row')
		{
			$data['start'] = $this->_step->cid;
			$data['limit'] = 1;
		}

		$request = $http->get($this->params->restful_hostname . '/index.php', $data);

		$code = $request->code;

		if ($code == 500)
		{
			throw new Exception('COM_REDMIGRATOR_REDMIGRATOR_ERROR_REST_REQUEST');
		}
		else
		{
			if ($code == 200 || $code == 301)
			{
				return json_decode($request->body);
			}
		}

		return $code;
	}
}
