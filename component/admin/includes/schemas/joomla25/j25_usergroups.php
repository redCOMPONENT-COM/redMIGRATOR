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
 * Upgrade class for Usergroups
 *
 * This class takes the usergroups from the source site and inserts them into the target site.
 */
class RedMigratorJ25Usergroups extends RedMigrator
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
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('usergroups') - 1;

		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			// Create a map of old id and new id
			$old_id = $row['id'];

			if ($row['parent_id'] == 0)
			{
				$new_root_id = $this->getRootId();
				$arrTemp = array('old_id' => $old_id, 'new_id' => $new_root_id);
			}
			else
			{
				$new_id ++;
				$arrTemp = array('old_id' => $old_id, 'new_id' => $new_id);
			}

			$arrUsergroups = $session->get('arrUsergroups', null, 'redmigrator_j25');

			$arrUsergroups[] = $arrTemp;

			// Save the map to session
			$session->set('arrUsergroups', $arrUsergroups, 'redmigrator_j25');

			if ($row['parent_id'] != 0)
			{
				$row['id'] = null;
				$row['title'] = $row['title'] . '_old';
				$row['parent_id'] = RedMigratorHelper::lookupNewId('arrUsergroups', $row['parent_id']);
				$row['lft'] = null;
				$row['rgt'] = null;
			}
		}

		return $rows;
	}

	/**
	 * @param $rows Rows for target db
	 *
	 * @return bool|void
	 * @throws Exception
	 */
	protected function insertData($rows)
	{
		if (is_array($rows))
		{
			$total = count($rows);

			foreach ($rows as $row)
			{
				if ($row != false && $row['parent_id'] != 0)
				{
					try
					{
						$objTable = JTable::getInstance('usergroup', 'JTable', array('dbo' => $this->_db));
						$objTable->bind((array) $row);
						$objTable->store();
					}
					catch (Exception $e)
					{
						throw new Exception($e->getMessage());
					}
				}

				$this->_step->_nextCID($total);
			}
		}
		elseif (is_object($rows))
		{
			if ($rows != false && $rows->parent_id != 0)
			{
				try
				{
					$objTable = JTable::getInstance('usergroup', 'JTable', array('dbo' => $this->_db));
					$objTable->bind((array) $rows);
					$objTable->store();
				}
				catch (Exception $e)
				{
					throw new Exception($e->getMessage());
				}
			}
		}

		return !empty($this->_step->error) ? false : true;
	}

	/**
	 * Get the id of root usergroup
	 *
	 * @return mixed
	 */
	protected function getRootId()
	{
		$query = $this->_db->getQuery(true);

		$query->select('id')
				->from('#__usergroups')
				->where('parent_id = 0');

		$this->_db->setQuery($query);

		$id = $this->_db->loadResult();

		return $id;
	}
}
