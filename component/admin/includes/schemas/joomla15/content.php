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
/**
 * Migrate class for content
 *
 * This class takes the content from the existing site and inserts them into the new site.
 */
class RedMigratorContent extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 */
	public function dataHook($rows)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('content') - 1;

		foreach ($rows as &$row)
		{
			$row = (array) $row;

			// Create a map of old id and new id
			$old_id = (int) $row['id'];
			$new_id ++;
			$arrTemp = array('old_id' => $old_id, 'new_id' => $new_id);

			$arrContent = $session->get('arrContent', null, 'redmigrator');

			$arrContent[] = $arrTemp;

			// Save the map to session
			$session->set('arrContent', $arrContent, 'redmigrator');

			$row['id'] = null;

			if ($row['catid'] != '')
			{
				$row['catid'] = RedMigratorHelper::lookupNewId('arrCategories', (int) $row['catid']);
			}

			if ($row['created_by'] != '')
			{
				$row['created_by'] = RedMigratorHelper::lookupNewId('arrUsers', (int) $row['created_by']);
			}

			if ($row['modified_by'] != '')
			{
				$row['modified_by'] = RedMigratorHelper::lookupNewId('arrUsers', (int) $row['modified_by']);
			}

			if (version_compare(PHP_VERSION, '3.0', '>='))
			{
				unset($row['title_alias']);
				unset($row['sectionid']);
				unset($row['mask']);
				unset($row['parentid']);
			}
		}

		return $rows;
	}
}
