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

// User define for Joomla! 2.5 / 3.0 / 3.1 path
define('JPATH_SITE', dirname(dirname(dirname(__FILE__))).'/Joomla_2.5.9');

// @@@ DONT TOUCH BELOW THIS @@@
// Setup the base path related constant.
define('JPATH_BASE', dirname(__FILE__));
define('JPATH_ROOT', dirname(__FILE__));
define('JPATH_PLUGINS', JPATH_SITE.'/plugins');
define('JPATH_ADMINISTRATOR', JPATH_SITE.'/administrator'   );
define('JPATH_LIBRARIES', JPATH_SITE.'/libraries'   );
define('JPATH_INSTALLATION', JPATH_SITE.'/installation'   );
define('JPATH_CACHE', JPATH_SITE.'/cache'   );
define('JPATH_COMPONENT', dirname(dirname(__FILE__)).'/trunk/admin' );
define('JPATH_COMPONENT_ADMINISTRATOR', dirname(dirname(__FILE__)).'/trunk/admin');

// Import the Joomla! Platform
if (file_exists(JPATH_LIBRARIES.'/import.legacy.php')) {
	require_once JPATH_LIBRARIES.'/import.legacy.php';
} else if (file_exists(JPATH_LIBRARIES.'/import.php')) {
	require_once JPATH_LIBRARIES.'/import.php';
}

// Import the Joomla! CMS
if (file_exists(JPATH_LIBRARIES.'/cms.php')) {
	require_once JPATH_LIBRARIES.'/cms.php';
}

// Import the Joomla! classes from the platform.
jimport('joomla.application.cli');
jimport('joomla.filesystem.file');
jimport('joomla.database.database');
jimport('joomla.environment.request');
jimport('cms.model.legacy');

// Require the jUpgradePro files
require_once JPATH_COMPONENT.'/models/checks.php';
require_once JPATH_COMPONENT.'/models/cleanup.php';
require_once JPATH_COMPONENT.'/models/step.php';
require_once JPATH_COMPONENT.'/models/migrate.php';
require_once JPATH_COMPONENT.'/models/extensions.php';
