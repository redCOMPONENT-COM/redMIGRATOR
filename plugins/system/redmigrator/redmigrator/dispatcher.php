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
 * REST Request Dispatcher class 
 *
 * @package     Joomla.Platform
 * @subpackage  REST
 * @since       3.0
 */
class RedRESTFULDispatcher
{
	/**
	 * @var    array  Associative array of parameters for the REST message.
	 * @since  3.0
	 */
	private $_parameters = array();

	/**
	 * @param $parameters
	 *
	 * @return bool
	 */
	public function execute($parameters)
	{
		// Loading params
		$this->_parameters = $parameters;

		$table = '';

		if (isset($this->_parameters['HTTP_TABLE']))
		{
			$table = $this->_parameters['HTTP_TABLE'];
		}

		$task = '';

		if (isset($this->_parameters['HTTP_TASK']))
		{
			$task = $this->_parameters['HTTP_TASK'];
		}

		$result = null;

		if ($task == 'total')
		{
			if ($this->_checkTableExist($table))
			{
				$result = $this->_getTotal($table);
			}
			else
			{
				$result = 0;
			}
		}
		elseif ($task == 'row')
		{
			$start = $this->_parameters['HTTP_START'];
			$limit = $this->_parameters['HTTP_LIMIT'];

			$result = $this->_getRow($table, $start, $limit);
		}

		if ($result !== null)
		{
			return json_encode($result);
		}
		else
		{
			JResponse::setHeader('status', 407);
			JResponse::setBody('Can not get result');
			JResponse::sendHeaders();
			exit;
		}
	}

	/**
	 * Check if table exist in database
	 *
	 * @param $table
	 *
	 * @return bool
	 */
	protected function _checkTableExist($table)
	{
		// Getting the database instance
		$db = JFactory::getDbo();

		$table = $db->getPrefix() . $table;

		// Set the query to get the tables statement.
		$db->setQuery('SHOW TABLES');

		$tables = $db->loadResultArray();

		if (in_array($table, $tables))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Get total of rows
	 *
	 * @param $table
	 *
	 * @return int
	 */
	protected function _getTotal($table)
	{
		$db = JFactory::getDbo();

		$query = 'SELECT count(*) FROM ' . $db->getPrefix() . $table;

		$db->setQuery($query);

		$total = $db->loadResult();

		return (int) $total;
	}

	/**
	 * Get a row
	 *
	 * @param $table
	 * @param $start
	 * @param $limit
	 *
	 * @return mixed|string
	 */
	protected function _getRow($table, $start, $limit)
	{
		$db = JFactory::getDbo();

		$query = 'SELECT *'
			. ' FROM ' . $db->getPrefix() . $table
			. ' LIMIT ' . $start . ', ' . $limit;

		$db->setQuery($query);

		$row = $db->loadAssocList();

		return $row;
	}
}
