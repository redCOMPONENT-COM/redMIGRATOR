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

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Content table
 *
 * @since	1.0
 */
class RedMigratorTableContentsFrontpage extends RedMigratorTable
{
	/** @var int Primary key */
	var $content_id	= null;

	/** @var int */
	var $ordering	= null;

	/**
	 * Table type
	 *
	 * @var string
	 */
	var $_type = 'contents_frontpage';

	/**
	* @param database A database connector object
	*/
	function __construct(&$db)
	{
		parent::__construct('#__content_frontpage', 'content_id', $db);
	}
}
