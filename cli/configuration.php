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

// Prevent direct access to this file outside of a calling application.
defined('_JEXEC') or die;

/**
* jUpgradeCli configuration class.
*
* @package jUpgradePro
* @since 3.0
*/
final class JConfig
{
	/**
	* The method of the migration 
	*
	* @var string	The method name. 'database' || 'rest'
	*/
	public $method = 'rest';
	/**
	* The limit of the cache system.
	*
	* @var int	The row limit. Defaults: 250 (database) ; 100 (rest)
	*/
	public $chunk_limit = '100';
	/**
	* Keep the template positions
	*
	* @var boolean	True if you like to keep the template positions
	*/
	public $positions = true;
	/**
	* Skip steps
	*
	* @vars ints
	*/
	public $skip_core_users = 0;
	public $skip_core_categories = 0;
	public $skip_core_contents = 0;
	public $skip_core_contents_frontpage = 0;
	public $skip_core_menus = 0;
	public $skip_core_menus_types = 0;
	public $skip_core_modules = 0;
	public $skip_core_modules_menu = 0;
	public $skip_core_banners = 0;
	public $skip_core_banners_clients = 0;
	public $skip_core_banners_tracks = 0;
	public $skip_core_contacts = 0;
	public $skip_core_newsfeeds = 0;
	public $skip_core_weblinks = 0;
	/**
	* The database configuration for your new site
	*
	* @vars strings
	*/
	public $dbtype = 'mysqli';
	public $host = 'localhost';
	public $user = 'root';
	public $password = 'root';
	public $db = 'Joomla_2.5.9';
	public $dbprefix = 'j25_';
	/**
	* The database configuration for your old site
	*
	* @vars strings
	*/
	public $old_dbtype = 'mysqli';
	public $old_hostname = 'localhost';
	public $old_username = 'root';
	public $old_password = 'root';
	public $old_db = 'Joomla_1.5.26';
	public $old_dbprefix = 'jos_';
	/**
	* The rest configuration.
	*
	* @vars strings
	*/
	public $rest_hostname = 'localhost/Joomla_1.5.26';
	public $rest_username = 'admin';
	public $rest_password = 'admin';
	public $rest_key = 'beer';
}
