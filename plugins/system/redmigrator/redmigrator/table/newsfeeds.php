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
 * RedMigratorTableNewsfeeds Table class
 */
class RedMigratorTableNewsfeeds extends RedMigratorTable
{
	/** @var int(11) */
	var $catid = null;

	/** @var int(11) */
	var $id = null;

	/** @var text */
	var $name = null;

	/** @var varchar(255) */
	var $alias = null;

	/** @var text */
	var $link = null;

	/** @var varchar(200) */
	var $filename = null;

	/** @var tinyint(1) */
	var $published = null;

	/** @var int(11) unsigned */
	var $numarticles = null;

	/** @var int(11) unsigned */
	var $cache_time = null;

	/** @var tinyint(3) unsigned */
	var $checked_out = null;

	/** @var datetime */
	var $checked_out_time = null;

	/** @var int(11) */
	var $ordering = null;

	/** @var tinyint(4) */
	var $rtl = null;

	/**
	 * Table type
	 *
	 * @var string
	 */
	var $_type = 'newsfeeds';

	function __construct(&$db)
	{
		parent::__construct('#__newsfeeds', 'id', $db);
	}
}
