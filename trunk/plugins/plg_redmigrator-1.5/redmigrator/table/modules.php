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
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Module table
 *
 * @package 	Joomla.Framework
 * @subpackage		Table
 * @since	1.0
 */
class redMigratorTableModules extends redMigratorTable
{
	/** @var int Primary key */
	var $id					= null;
	/** @var string */
	var $title				= null;
	/** @var string */
	var $showtitle			= null;
	/** @var int */
	var $content			= null;
	/** @var int */
	var $ordering			= null;
	/** @var string */
	var $position			= null;
	/** @var boolean */
	var $checked_out		= 0;
	/** @var time */
	var $checked_out_time	= 0;
	/** @var boolean */
	var $published			= null;
	/** @var string */
	var $module				= null;
	/** @var int */
	var $access				= null;
	/** @var string */
	var $params				= null;
	/** @var string */
	var $client_id			= null;

	/**
	 * Table type
	 *
	 * @var string
	 */	
	var $_type = 'modules';	

	/**
	 * Contructor
	 *
	 * @access protected
	 * @param database A database connector object
	 */
	function __construct( &$db ) {
		parent::__construct( '#__modules', 'id', $db );
	}

	/**
	 * Setting the conditions hook
	 *
	 * @return	void
	 * @since	3.0.0
	 * @throws	Exception
	 */
	public function getConditionsHook()
	{
		$conditions = array();
				
		$conditions['where'][] = "client_id = 0";
		$conditions['where'][] = "module IN ('mod_breadcrumbs', 'mod_footer', 'mod_mainmenu', 'mod_menu', 'mod_related_items', 'mod_stats', 'mod_wrapper', 'mod_archive', 'mod_custom', 'mod_latestnews', 'mod_mostread', 'mod_search', 'mod_syndicate', 'mod_banners', 'mod_feed', 'mod_login', 'mod_newsflash', 'mod_random_image', 'mod_whosonline' )";
				
		return $conditions;
	}

	/**
	 * 
	 *
	 * @access	public
	 * @param		Array	Result to migrate
	 * @return	Array	Migrated result
	 */
	function migrate( )
	{		
		$this->params = isset($this->params) ? $this->convertParams($this->params) : '';

		## Fix access
		$this->access = $this->access+1;

		## Language
		$this->language = "*";

		## Module field changes
		if ($this->module == "mod_mainmenu") {
			$this->module = "mod_menu";
		}
		else if ($this->module == "mod_archive") {
			$this->module = "mod_articles_archive";
		}
		else if ($this->module == "mod_latestnews") {
			$this->module = "mod_articles_latest";
		}
		else if ($this->module == "mod_mostread") {
			$this->module = "mod_articles_popular";
		}
		else if ($this->module == "mod_newsflash") {
			$this->module = "mod_articles_news";
		}
	}
}
