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

jimport('joomla.html.parameter');

/**
 * REST Request Authorizer class
 *
 * @package     Joomla.Platform
 * @subpackage  REST
 * @since       1.0
 */
class RedRESTFULAuthorizer
{
	/**
	 * Authorize an REST signed request for a protected resource.
	 *
	 * @return  boolean  True if the user and pass are authorized
	 *
	 * @throws  InvalidArgumentException
	 */
	public function authorize(&$db, $params)
	{
		// Getting the client key
		$plugin =& JPluginHelper::getPlugin('system', 'redmigrator');

		$pluginParams = new JParameter($plugin->params);

		$client_key = trim($pluginParams->get('client_key'));

		// Decode the request
		$key = base64_decode($params['HTTP_KEY']);

		$parts = explode(':', $key);

		$key = trim($parts[0]);

		if ($key != $client_key)
		{
			JResponse::setHeader('status', 402);
			JResponse::setBody('Client key do not match.');
			JResponse::sendHeaders();
			exit;
		}

		if (!isset($params['AUTH_USER']) && !isset($params['HTTP_USER']) && !isset($params['USER']))
		{
			JResponse::setHeader('status', 405);
			JResponse::setBody('Username headers not found.');
			JResponse::sendHeaders();
			exit;
		}

		// Looking the username header
		if (isset($params['AUTH_USER']))
		{
			$user_decode = base64_decode($params['AUTH_USER']);
		}
		elseif (isset($params['HTTP_USER']))
		{
			$user_decode = base64_decode($params['HTTP_USER']);
		}
		elseif (isset($params['USER']))
		{
			$user_decode = base64_decode($params['USER']);
		}

		$parts	= explode(':', $user_decode);
		$user	= $parts[0];

		// Looking the username header
		if (isset($params['AUTH_PW']))
		{
			$password_decode = base64_decode($params['AUTH_PW']);
		}
		elseif (isset($params['HTTP_PW']))
		{
			$password_decode = base64_decode($params['HTTP_PW']);
		}
		elseif (isset($params['PW']))
		{
			$password_decode = base64_decode($params['PW']);
		}

		$parts	= explode(':', $password_decode);
		$password	= $parts[0];

		if (version_compare(JVERSION, '1.6.0', '<'))
		{
			$query = 'SELECT u.id, u.password'
				. ' FROM #__users AS u'
				. ' LEFT JOIN #__core_acl_aro_groups AS ug ON u.gid = ug.id'
				. ' WHERE username = ' . $db->quote($user) . ' AND ug.name = "Super Administrator"';
		}
		else
		{
			$query = 'SELECT u.id AS id, u.password AS password'
				. ' FROM #__users AS u'
				. ' LEFT JOIN #__user_usergroup_map AS uugm ON u.id = uugm.user_id'
				. ' LEFT JOIN #__usergroups AS ug ON uugm.group_id = ug.id'
				. ' WHERE u.username = ' . $db->quote($user) . ' AND ug.title = "Super Users"';
		}

		// Getting the local username and password
		$db->setQuery($query);
		$user_result = $db->loadObject();

		// Check the password
		$parts	= explode(':', $user_result->password);
		$crypt	= $parts[0];
		$salt	= @$parts[1];
		$testcrypt = JUserHelper::getCryptedPassword($password, $salt);

		if (!is_object($user_result))
		{
			JResponse::setHeader('status', 403);
			JResponse::setBody('Username not found OR not a Super user');
			JResponse::sendHeaders();
			exit;
		}

		if ($crypt != $testcrypt)
		{
			JResponse::setHeader('status', 406);
			JResponse::setBody('Username or password do not match');
			JResponse::sendHeaders();
			exit;
		}

		return true;
	}
}
