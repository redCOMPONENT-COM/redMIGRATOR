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

// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * Joomla! System RedMigrator Plugin
 *
 */
class PlgSystemRedMigrator extends JPlugin
{
	/**
	 * Folder where the helpers are stored
	 *
	 * @var  string
	 */
	protected $helpersFolder = null;

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $config    An array that holds the plugin configuration
	 *
	 * @since	1.0
	 */
	public function __construct(&$subject, $config)
	{
	parent::__construct($subject, $config);

		// Load plugin language
		$this->loadLanguage();

		$this->helpersFolder = JPATH_ROOT . '/plugins/system/redmigrator/redmigrator';

		if (version_compare(JVERSION, '1.6.0', '<'))
		{
			$this->helpersFolder = JPATH_ROOT . '/plugins/system/redmigrator';
		}
	}

	function onAfterInitialise()
	{
		jimport('joomla.user.helper');

		require_once $this->helpersFolder . '/rest.php';
		require_once $this->helpersFolder . '/authorizer.php';
		require_once $this->helpersFolder . '/dispatcher.php';
		require_once $this->helpersFolder . '/table.php';

		// Check if RedMigrator_steps exists
		$this->checkStepTable();

		// Getting the database instance
		$db = JFactory::getDbo();

		$request = false;

		// Get the REST message from the current request.
		$rest = new JRESTMessage;

		if ($rest->loadFromRequest())
		{
			$request = true;
		}

		// Request was found
		if ($request == true)
		{
			// Check the username and pass
			$auth = new JRESTAuthorizer;

			if (!$auth->authorize($db, $rest->_parameters))
			{
				JResponse::setHeader('status', 400);
				JResponse::setBody('Invalid password.');
				JResponse::sendHeaders();
				exit;
			}

			// Check the username and pass
			$dispatcher = new JRESTDispatcher;

			$return = $dispatcher->execute($rest->_parameters);

			if ($return !== false)
			{
				echo $return;
			}
			else
			{
				JResponse::setHeader('status', 401);
				JResponse::setBody('Dispatch error.');
				JResponse::sendHeaders();
				exit;
			}

			exit;
		}
	} // End method


	function checkStepTable()
	{
		// Getting the database instance
		$db = JFactory::getDbo();

		$sqlfile = $this->helpersFolder . '/sql/install.sql';

		// Checking tables
		$query = "SHOW TABLES";
		$db->setQuery($query);

		if (version_compare(JVERSION, '1.6.0', '<'))
		{
			$tables = $db->loadResultArray();
		}
		else
		{
			$tables = $db->loadColumn();
		}

		if (!in_array('redmigrator_plugin_steps', $tables))
		{
			$this->populateDatabase($db, $sqlfile);
		}
	}

	/**
	 * populateDatabase
	 */
	function populateDatabase(&$db, $sqlfile)
	{
		if(!($buffer = file_get_contents($sqlfile)))
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
				$db->query() or die($db->getErrorMsg());
			}
		}

		return true;
	}
}
