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
 * Upgrade class for MenusTypes
 *
 * This class takes the menus from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */
class RedMigratorMenuTypes extends RedMigrator
{
	/**
	 * Change structure of table and value of fields
	 * so data can be inserted into target db
	 *
	 * @param $rows Rows of source db
	 *
	 * @return mixed
	 */
	public function dataHook($rows)
	{
		// Do some custom post processing on the list.
		foreach ($rows as $k => &$row)
		{
			$row = (array) $row;

			$row['id'] = null;

			if ($this->checkMenutypeExist($row['menutype']))
			{
				$rows[$k] = false;
			}
		}

		return $rows;
	}

	protected function checkMenutypeExist($menutype)
	{
		$query = $this->_db->getQuery(true);

		$query->select('count(id)')
			->from('#__menu_types')
			->where('menutype = "' . $menutype . '"');

		$this->_db->setQuery($query);

		$exist = $this->_db->loadResult();

		return $exist;
	}
}
